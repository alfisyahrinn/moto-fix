<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTransactionConditions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $transaction = $request->route('transaction');

        // Check if total_price is 0
        if ($transaction->total_price == 0) {
            // Redirect the user to the schedule page
            return redirect()->route('booking.jadwal')->with('danger', 'The queue has not been completed!');
        }

        return $next($request);
    }
}