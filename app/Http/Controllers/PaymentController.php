<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use App\Models\Payment;

class PaymentController extends Controller
{
    //

    // Show payment form
    public function showPaymentForm()
    {
        return view('payment.form', [
            'stripeKey' => config('cashier.key')
        ]);
    }

    // Create payment intent
    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(config('cashier.secret'));

        $paymentIntent = PaymentIntent::create([
            'amount'   => $request->amount * 100, // in cents
            'currency' => 'usd',
            'metadata' => [
                'student_id'  => Auth::id(),
                'description' => $request->description,
            ],
        ]);

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret
        ]);
    }

    // Payment success
    public function paymentSuccess(Request $request)
    {
        // Save payment record to database
            $user = Auth::user();

            if (!$user) {
                 return response()->json(['error' => 'Unauthorized'], 401);
            }

            $user->payments()->create([
                    'amount'         => $request->amount,
                    'payment_intent' => $request->payment_intent,
                    'status'         => 'paid',
                    'description'    => $request->description,
            ]);

        return redirect()->route('school.index')->with('success', 'Payment successful!');
    }


    public function allPayment(Request $request){



$payment = Payment::query()
    ->with('user')
    ->when($request->search, function ($query) use ($request) {
        return $query->whereAny([
            'payment_intent',
            'status',
            'amount',
            'description',
        ], 'like', '%' . $request->search . '%')
        ->orWhereHas('user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        });
    })
    ->paginate(10);

return view('payment.index', compact('payment'));




}
}
