@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>
    <p>Total Users: {{ $totalUsers }}</p>
    <p>Total Services: {{ $totalServices }}</p>
    <p>Total Orders: {{ $totalOrders }}</p>
    <p>Total Revenue: {{ number_format($totalRevenue, 2) }}</p>

    {{-- Top 3 Services by Revenue --}}
    <h2>Top 3 Services by Revenue</h2>
    <ul>
        @foreach ($topServices as $service)
            <li>
                {{ $service->service->name }} — Revenue: {{ number_format($service->revenue, 2) }}
            </li>
        @endforeach
    </ul>

    {{-- Monthly Sales Chart --}}
    <canvas id="salesChart"></canvas>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesData = @json($monthlySales);
    const labels = salesData.map(item => item.month);
    const data = salesData.map(item => item.total);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Sales by Month',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
            }]
        }
    });
</script>
@endpush
