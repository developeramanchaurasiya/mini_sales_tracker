@extends('layouts.app')

@section('content')
    <h1>Orders</h1>
    <form method="GET" action="{{ route('orders.index') }}">
        <label>Status:</label>
        <select name="status">
            <option value="">All</option>
            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        </select>

        <label>From:</label>
        <input type="date" name="from" value="{{ request('from') }}">
        <label>To:</label>
        <input type="date" name="to" value="{{ request('to') }}">
        <button type="submit">Filter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Service</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->service->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->total_amount }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
@endsection
