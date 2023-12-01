<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingQueues = Queue::where('status', 0)->get();
        $pendingTransactions = Transaction::where('status', 0)->get();

        // Fetch paid transactions for the chart
        $paidTransactions = Transaction::where('status', '1') // '1' represents the "paid" status
            ->selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->groupBy('date')
            ->get();

        // Fetch total counts
        $categoryCount = Category::count();
        $supplierCount = Supplier::count();

        // Fetch total count of products
        $totalProductCount = Product::count();

        return view('admin.pages.dashboard', compact('pendingQueues', 'pendingTransactions', 'paidTransactions', 'categoryCount', 'supplierCount', 'totalProductCount'));
    }

}