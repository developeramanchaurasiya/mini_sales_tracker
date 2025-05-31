@extends('layouts.app')

@section('content')
   @include('partials.breadcrumb', [
        'breadcrumbs' => [
            'Orders' => null
        ]
    ])

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('orders.list') }}" class="row g-3 align-items-end">

            <div class="col-md-2">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">All</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="from_date" class="form-label">From Date</label>
                <input type="date" name="from_date" id="from_date" value="{{ request('from_date') }}" class="form-control">
            </div>

            <div class="col-md-2">
                <label for="to_date" class="form-label">To Date</label>
                <input type="date" name="to_date" id="to_date" value="{{ request('to_date') }}" class="form-control">
            </div>

            <div class="col-md-2">
                <label for="sort_by" class="form-label">Sort By</label>
                <select name="sort_by" id="sort_by" class="form-select">
                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Date</option>
                    <option value="total_amount" {{ request('sort_by') == 'total_amount' ? 'selected' : '' }}>Amount</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="sort_dir" class="form-label">Sort Direction</label>
                <select name="sort_dir" id="sort_dir" class="form-select">
                    <option value="asc" {{ request('sort_dir') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('sort_dir') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
            </div>

            <div class="col-md-1 d-grid">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>

            <div class="col-md-1 d-grid" title="Export CSV">
                <a href="{{ route('orders.export', request()->query()) }}" class="btn btn-outline-secondary">Export</a>
            </div>

        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Order ID</th>
                    <th>User Name</th>
                    <th>Service Name</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->service->name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center py-4">No orders found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $orders->links() }}
</div>

@endsection
