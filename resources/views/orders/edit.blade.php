@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редактировать заказ</h1>

        <form action="{{ route('orders.update', $order) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="date">Дата</label>
                <input type="date" class="form-control" name="date" value="{{ $order->date }}" required>
            </div>
            <div class="form-group">
                <label for="number">Номер</label>
                <input type="text" class="form-control" name="number" value="{{ $order->number }}" required>
            </div>
            <div class="form-group">
                <label for="customer_name">ФИО Клиента</label>
                <input type="text" class="form-control" name="customer_name" value="{{ $order->customer_name }}" required>
            </div>
            <div class="form-group">
                <label for="total_amount">Общая сумма</label>
                <input type="number" class="form-control" name="total_amount" value="{{ $order->total_amount }}" required step="0.01">
            </div>

            <h4>Позиции заказа</h4>
            <div id="order-items">
                @foreach ($order->items as $item)
                    <div class="order-item mb-3">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="product_name">Название товара</label>
                                <input type="text" class="form-control" name="items[{{ $loop->index }}][product_name]" value="{{ $item->product_name }}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="price">Цена</label>
                                <input type="number" class="form-control" name="items[{{ $loop->index }}][price]" value="{{ $item->price }}" required step="0.01">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="quantity">Количество</label>
                                <input type="number" class="form-control" name="items[{{ $loop->index }}][quantity]" value="{{ $item->quantity }}" required>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-secondary mb-3" id="add-item">Добавить позицию</button>
            <button type="submit" class="btn btn-primary">Обновить заказ</button>
        </form>
    </div>

    @section('scripts')
        <script>
            document.getElementById('add-item').addEventListener('click', function() {
                const orderItemsDiv = document.getElementById('order-items');
                const index = orderItemsDiv.children.length;

                const itemDiv = document.createElement('div');
                itemDiv.className = 'order-item mb-3';
                itemDiv.innerHTML = `
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="product_name">Название товара</label>
                    <input type="text" class="form-control" name="items[${index}][product_name]" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="price">Цена</label>
                    <input type="number" class="form-control" name="items[${index}][price]" required step="0.01">
                </div>
                <div class="form-group col-md-4">
                    <label for="quantity">Количество</label>
                    <input type="number" class="form-control" name="items[${index}][quantity]" required>
                </div>
            </div>`;
                orderItemsDiv.appendChild(itemDiv);
            });
        </script>
    @endsection


