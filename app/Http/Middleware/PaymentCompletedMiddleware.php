<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentCompletedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Check if the user has any transactions
       $userId = auth()->id(); // Adjust as needed
       $transaction = Transaction::where('user_id', $userId)->latest()->first();

       if ($transaction && $transaction->payment_status == 'paid') {
           return $next($request);
       }

       // If no transactions or payment status is not 'paid', redirect to user.index
       return redirect()->route('user.index');
   }
}
