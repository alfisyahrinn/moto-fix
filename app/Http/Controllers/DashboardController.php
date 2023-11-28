<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'checkRole:admin']);
    }
    public function index()
    {
        $pendingQueues = Queue::where('status', 0)->get();
        $pendingTransactions = Transaction::where('status', 0)->get();

        return view('admin.pages.dashboard', compact('pendingQueues', 'pendingTransactions'));
    }
}