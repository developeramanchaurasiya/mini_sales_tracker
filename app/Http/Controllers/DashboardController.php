<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Service;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalServices = Service::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'paid')->sum('total_amount');

        $topServices = DB::table('orders')
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->select('services.name', DB::raw('SUM(orders.total_amount) as revenue'))
            ->where('orders.status', 'paid')
            ->groupBy('services.id', 'services.name')
            ->orderByDesc('revenue')
            ->limit(3)
            ->get();

        return view('dashboard.index', compact(
            'totalUsers', 'totalServices', 'totalOrders', 'totalRevenue', 'topServices'
        ));
    }

public function salesLast6Months()
{
    $startDate = Carbon::now()->subMonths(5)->startOfMonth();
    $endDate = Carbon::now()->endOfMonth();

    $data = DB::table('orders')
        ->select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
            DB::raw('SUM(total_amount) as total_sales')
        )
        ->where('status', 'paid')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    $labels = [];
    $totals = [];

    foreach ($data as $monthData) {
        $labels[] = date('M-Y', strtotime($monthData->month));
        $totals[] = $monthData->total_sales;
    }

    return response()->json([
        'labels' => $labels,
        'totals' => $totals,
    ]);
}



}


