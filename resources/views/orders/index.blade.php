@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Заказы</h1>
        <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Создать новый заказ</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Дата</th>
                <th>Номер</th>
                <th>ФИО Клиента</th>
                <th>Общая сумма</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->date }}</td>
                    <td>{{ $order->number }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->total_amount }}</td>
                    <td>
                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning">Редактировать</a>
                        <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

