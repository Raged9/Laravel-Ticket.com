<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('Payment.payment');
    }

    public function show()
    {
        return view('Paymment.payment');
    }

    public function process(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:bank,credit_card,e_wallet',
        ]);

        if ($request->payment_method) {
            return redirect()->route('payment.success');
        }

        return redirect()->route('payment.failed');
    }

    public function success()
    {
        return view('Payment.payment-success');
    }

    public function failed()
    {
        return view('Payment.payment-failed');
    }
}