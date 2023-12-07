<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
<<<<<<< HEAD
       public function finishPayment(Request $request)
=======
    public function finishPayment(Request $request)
>>>>>>> 562b7654275ed848d96b497654446c0be45c3669
    {
        return view('user.pages.payment.finish');
    }

    public function unfinishPayment(Request $request)
    {
        return view('user.pages.payment.unfinish');
    }

    public function errorPayment(Request $request)
    {
        return view('user.pages.payment.error');
    }
}
