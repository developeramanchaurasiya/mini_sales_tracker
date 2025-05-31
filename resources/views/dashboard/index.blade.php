@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-4">Dashboard</h1>

<!-- Summary Boxes -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
    <div class="bg-blue-500 text-white rounded-lg p-4 relative hover:bg-blue-600 transition">
        <h5 class="text-lg font-semibold mb-2">Total Users</h5>
        <p class="text-2xl">{{ $totalUsers }}</p>
        <a href="{{ route('users.index') }}" class="absolute inset-0"></a>
    </div>
    <div class="bg-green-500 text-white rounded-lg p-4 relative hover:bg-green-600 transition">
        <h5 class="text-lg font-semibold mb-2">Total Services</h5>
        <p class="text-2xl">{{ $totalServices }}</p>
        <a href="{{ route('services.index') }}" class="absolute inset-0"></a>
    </div>
    <div class="bg-yellow-500 text-white rounded-lg p-4 relative hover:bg-yellow-600 transition">
        <h5 class="text-lg font-semibold mb-2">Total Orders</h5>
        <p class="text-2xl">{{ $totalOrders }}</p>
        <a href="{{ route('orders.list') }}" class="absolute inset-0"></a>
    </div>
    <div class="bg-red-500 text-white rounded-lg p-4">
        <h5 class="text-lg font-semibold mb-2">Total Revenue</h5>
        <p class="text-2xl">${{ number_format($totalRevenue, 2) }}</p>
    </div>
</div>

<!-- Sales Chart -->
<div class="bg-white rounded-lg shadow p-6 mb-4">
    <h5 class="text-lg font-semibold mb-2">Sales (Last 6 Months)</h5>
    <canvas id="salesChart" class="w-full h-64"></canvas>
</div>

<!-- Top Services -->
<div class="bg-white rounded-lg shadow p-6">
    <h5 class="text-lg font-semibold mb-2">Top 3 Services by Revenue</h5>
    <ul class="divide-y divide-gray-200">
        @foreach($topServices as $service)
            <li class="py-2 flex justify-between items-center">
                <span>{{ $service->name }}</span>
                <span class="font-semibold">${{ number_format($service->revenue, 2) }}</span>
            </li>
        @endforeach
    </ul>
</div>

<script>
  let salesChart; // store chart instance globally

  fetch('{{ route("sales.last6months") }}')
    .then(response => response.json())
    .then(data => {
      const ctx = document.getElementById('salesChart').getContext('2d');

      // If chart instance already exists, destroy it before creating a new one
      if (salesChart) {
        salesChart.destroy();
      }

      salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: data.labels,
          datasets: [{
            label: 'Total Sales',
            data: data.totals,
            backgroundColor: 'rgba(59, 130, 246, 0.7)',
            borderColor: 'rgba(59, 130, 246, 1)',
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: { beginAtZero: true }
          }
        }
      });
    });
</script>

@endsection
