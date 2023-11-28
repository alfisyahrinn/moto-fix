<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DetailService;
use App\Models\Product;
use App\Models\Queue;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    // Display the booking form
    public function index()
    {
        return view('user.pages.booking');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'merk' => 'nullable|string|max:255',
            // 'type' => 'nullable|string|max:255',
            'number_plate' => 'nullable|string|max:255',
            'date' => 'nullable|string|max:255',
            'problem' => 'nullable|string',
        ]);

        $select = Queue::where('time', $request->date)->get()->count();
        if ($select == 0) {
            $no_queuq = $select + 1;
        } else {
            $no_queuq = $select + 1;
        }
        // dd('default: ' . $select, 'sudah : ' . $no_queuq);
        if ($select > 2) {
            return redirect()->route('booking.index')->with('danger', 'This date is Full! ');
        } else {
            $queue = Queue::create([
                'merk' => $request->merk,
                'no_queue' => $no_queuq,
                'user_id' => $user->id,
                'number_plate' => $request->number_plate,
                'time' => $request->date,
                'problem' => $request->problem,
                'status' => false,
            ]);
            Transaction::create([
                'user_id' => $user->id,
                'queue_id' => $queue->id,
                'status' => false,
                'total_price' => 0,
            ]);
            return redirect()->route('booking.jadwal')->with('success', 'Booking create successfully! ' . $queue->id);
        }
    }
    // Display the jadwal page
    public function showJadwal()
    {
        $user = Auth::user();
        $datas = Transaction::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        // dd($datas);
        return view('user.pages.jadwal', [
            'datas' => $datas,
        ]);
    }

    public function show(Transaction $transaction)
    {
        // dd($transaction);
        $details = DetailService::where('transaction_id', $transaction->id)->get();
        return view('user.pages.jadwal.show', [
            'title' => 'jadwal',
            'data' => $transaction,
            'details' => $details,
        ]);
    }
}
