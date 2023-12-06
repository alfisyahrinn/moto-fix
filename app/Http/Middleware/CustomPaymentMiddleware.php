<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomPaymentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      // Retrieve the payment status from session storage
      $paymentStatus = $request->session()->get('paymentStatus');

      // Check the payment status and redirect accordingly
      if ($paymentStatus === 'success') {
          return redirect()->route('user.payment.finish');
      } elseif ($paymentStatus === 'pending') {
          return redirect()->route('user.payment.unfinish');
      } elseif ($paymentStatus === 'error') {
          return redirect()->route('user.payment.error');
      }

      // If payment status is not set or is invalid, proceed to the next middleware/route
      return $next($request);
  }
}
    