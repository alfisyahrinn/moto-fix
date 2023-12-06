<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPaymentStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $transaction = $request->route('transaction'); // Assuming the route parameter is named 'transaction'

        // Check if the transaction status is 'paid'
        if ($transaction->payment_status === 'paid') {
            // Redirect the user to the showJadwal route
            return redirect()
                ->route('booking.jadwal')
                ->with('success', 'Payment has been completed!');
        }

        // Continue with the request if the status is not 'paid'
        return $next($request);
    }
}
