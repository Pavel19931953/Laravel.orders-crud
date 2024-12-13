<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')->get();  // Получение всех заказов с их позициями
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');  // Показать форму создания заказа
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'number' => 'required|string|unique:orders',
            'customer_name' => 'required|string',
            'total_amount' => 'required|numeric',
            'items' => 'required|array',
            'items.*.product_name' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer',
        ]);

        // Создание заказа
        $order = Order::create($request->only('date', 'number', 'customer_name', 'total_amount'));

        // Создание позиций заказа
        foreach ($request->items as $item) {
            $item['order_id'] = $order->id;
            $item['cost'] = $item['price'] * $item['quantity'];
            OrderItem::create($item);
        }

        return redirect()->route('orders.index')->with('success', 'Заказ успешно создан!');
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));  // Показать форму редактирования заказа
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'date' => 'required|date',
            'number' => 'required|string|unique:orders,number,' . $order->id,
            'customer_name' => 'required|string',
            'total_amount' => 'required|numeric',
            'items' => 'required|array',
            'items.*.product_name' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer',
        ]);

        // Обновление заказа
        $order->update($request->only('date', 'number', 'customer_name', 'total_amount'));

        // Обновление позиций заказа
        $order->items()->delete();  // Удаляем старые позиции
        foreach ($request->items as $item) {
            $item['order_id'] = $order->id;
            $item['cost'] = $item['price'] * $item['quantity'];
            OrderItem::create($item);
        }

        return redirect()->route('orders.index')->with('success', 'Заказ успешно обновлен!');
    }

    public function destroy(Order $order)
    {
        $order->delete();  // Удаление заказа
        return redirect()->route('orders.index')->with('success', 'Заказ успешно удален!');
    }
}
