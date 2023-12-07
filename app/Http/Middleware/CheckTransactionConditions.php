<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
<<<<<<< HEAD
use RealRashid\SweetAlert\Facades\Alert;
=======
>>>>>>> 562b7654275ed848d96b497654446c0be45c3669

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
<<<<<<< HEAD
            // Show a SweetAlert message
            Alert::error('Error', 'The queue has not been completed!');

            // Redirect the user to the schedule page
            return redirect()->route('booking.jadwal');
        }

        // Continue with the request if total_price is not 0
        return $next($request);
    }

=======
            // Redirect the user to the schedule page
            return redirect()->route('booking.jadwal')->with('danger', 'The queue has not been completed!');
        }

        return $next($request);
    }
>>>>>>> 562b7654275ed848d96b497654446c0be45c3669
}