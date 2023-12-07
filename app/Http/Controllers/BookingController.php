<?php

namespace App\Http\Controllers;

use Midtrans;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Queue;
use App\Models\Product;
use App\Models\Category;
use Midtrans\Notification;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\DetailService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkPaymentStatus')->only('show');
    }
    // Display the booking form
    // Inside the index method of BookingController
    public function index()
    {
        return view('user.pages.booking');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'merk' => 'nullable|string|max:255',
            'number_plate' => 'nullable|string|max:255',
            'date' => 'nullable|string|max:255',
            'problem' => 'nullable|string',
        ]);

        $select = Queue::where('time', $request->date)
            ->get()
            ->count();
        if ($select == 0) {
            $no_queue = $select + 1;
        } else {
            $no_queue = $select + 1;
        }

        if ($select > 2) {
            return redirect()
                ->route('booking.index')
                ->with('danger', 'This date is Full! ');
        } else {
            $queue = Queue::create([
                'merk' => $request->merk,
                'no_queue' => $no_queue,
                'user_id' => $user->id,
                'number_plate' => $request->number_plate,
                'time' => $request->date,
                'problem' => $request->problem,
                'status' => false,
            ]);

            // Generate unique order_id
            $order_id = 'ORD_' . uniqid() . '_' . now()->format('YmdHis');

            Transaction::create([
                'user_id' => $user->id,
                'queue_id' => $queue->id,
                'payment_status' => 'unpaid',
                'total_price' => 0,
                'order_id' => $order_id,
                // Add other fields as needed
            ]);

            return redirect()
                ->route('booking.jadwal')
                ->with('success', 'Booking created successfully! ' . $queue->id);
        }
    }

    // Display the jadwal page
    public function showJadwal()
    {
        $user = Auth::user();
        $datas = Transaction::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();
        // dd($datas);
        return view('user.pages.jadwal', [
            'datas' => $datas,
        ]);
    }

    public function show(Transaction $transaction)
{
    // Apply the new middleware to check transaction conditions
    $this->middleware('checkTransactionConditions');
    // Apply the middleware to check payment status
    $this->middleware('checkPaymentStatus');

    // Generate a new unique order_id
    $newOrderId = 'ORD_' . uniqid() . '_' . now()->format('YmdHis');

    // Update the transaction's order_id in the database
    $transaction->update(['order_id' => $newOrderId]);

    // Generate a new Snap token with the updated order_id
    $snapToken = $this->generateSnapToken($transaction);

    // Retrieve details related to the transaction
    $details = DetailService::where('transaction_id', $transaction->id)->get();

    // Pass the updated transaction and other data to the view
    return view('user.pages.jadwal.show', [
        'title' => 'jadwal',
        'data' => $transaction->refresh(), // Refresh the model to get the updated data from the database
        'details' => $details,
        'snapToken' => $snapToken,
    ]);
}


    public function generateSnapToken(Transaction $transaction)
    {
        // Get customer details
        $user = Auth::user();

        // Use the Midtrans configuration to create a Snap transaction
        $snapToken = $this->getSnapToken([
            'transaction_details' => [
                'order_id' => $transaction->order_id, // Use order_id from the transaction
                'gross_amount' => $transaction->total_price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                // Add other customer details as needed
            ],
            // Add other necessary details for your transaction
        ]);

        return $snapToken;
    }


    protected function getSnapToken(array $params)
    {
        // Configure your Midtrans credentials
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');

        // Use Midtrans Snap API to get the Snap token
        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }

    public function callback(Request $request)
    {
        try {
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$serverKey = config('midtrans.server_key');

            $notification = new \Midtrans\Notification();

            $transactionStatus = $notification->transaction_status;
            $paymentType = $notification->payment_type;
            $fraudStatus = $notification->fraud_status;

            // Retrieve the order ID from the request or JSON payload
            $orderId = $request->input('order_id') ?? $notification->order_id;

            $transaction = Transaction::where('order_id', $orderId)->first();

            if ($transaction) {
                // Update payment status based on transaction_status
                if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                    $transaction->update(['payment_status' => 'paid']);
                } elseif ($transactionStatus == 'expire' || $transactionStatus == 'cancel' || $transactionStatus == 'deny') {
                    $transaction->update(['payment_status' => 'failed']);
                } elseif ($transactionStatus == 'pending') {
                    $transaction->update(['payment_status' => 'unpaid']);
                }

                // Update other relevant fields
                $transaction->update([
                    'payment_method' => $paymentType,
                    'midtrans_transaction_id' => $notification->transaction_id,
                    'transaction_time' => $notification->transaction_time,
                    'transaction_status' => $transactionStatus,
                    'fraud_status' => $fraudStatus,
                    'masked_card' => $notification->masked_card,
                    'gross_amount' => $notification->gross_amount,
                    'expiry_time' => $notification->expiry_time,
                    'currency' => $notification->currency,
                    'channel_response_message' => $notification->channel_response_message,
                    'channel_response_code' => $notification->channel_response_code,
                    'card_type' => $notification->card_type,
                    'bank' => $notification->bank,
                    'approval_code' => $notification->approval_code,
                    // Add other fields as needed
                ]);

                Log::info("Payment status for order_id $orderId updated to $transactionStatus");
            } else {
                Log::error("Transaction order_id: $orderId not found in the database.");
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Error in Midtrans callback: ' . $e->getMessage());
            return response()->json(['status' => 'error'], 500);
        }
    }



}