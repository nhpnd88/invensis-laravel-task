<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Page;

class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => $currency,
        ]);

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    }

    public function paymentSuccess()
    {
        $page = Page::first();
        
        return view('frontend.success', compact('page'));
    }

    public function paymentFailure()
    {
        $page = Page::where('title', 'Failure Page')->first();
        if (!$page) {
            abort(404, 'Failure page not found');
        }
        return view('frontend.failure', compact('page'));
    }
}
