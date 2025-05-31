<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'service']);

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        // Sorting
        if ($request->filled('sort_by')) {
            $direction = $request->get('sort_dir', 'asc');
            if (in_array($request->sort_by, ['created_at', 'total_amount'])) {
                $query->orderBy($request->sort_by, $direction);
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $orders = $query->paginate(15)->appends($request->query());

        return view('orders.list', compact('orders'));
    }

    public function exportOrders(Request $request)
    {
        $query = Order::with(['user', 'service']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        $orders = $query->get();

        $response = new StreamedResponse(function() use ($orders) {
            $handle = fopen('php://output', 'w');

            // CSV headers
            fputcsv($handle, ['Order ID', 'User Name', 'Service Name', 'Quantity', 'Total Amount', 'Status', 'Order Date']);

            foreach ($orders as $order) {
                fputcsv($handle, [
                    $order->id,
                    $order->user->name,
                    $order->service->name,
                    $order->quantity,
                    $order->total_amount,
                    $order->status,
                    $order->created_at->format('Y-m-d'),
                ]);
            }

            fclose($handle);
        });

        $filename = 'orders_export_' . now()->format('Ymd_His') . '.csv';

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', "attachment; filename=\"$filename\"");

        return $response;
    }
}
