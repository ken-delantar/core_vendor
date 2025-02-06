<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\User;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;
use Stripe\Customer;
use Stripe\Plan;
use Stripe\Price;
use Stripe\Subscription;

class SubscriptionController extends Controller
{
    public function subscribe_confirmatiom($plan_id){
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $plan = \Stripe\Product::retrieve($plan_id);
        $prices = \Stripe\Price::all([
            'product' => $plan->id,
        ]);

        return view('subscription.subscribe_confirmation', compact('plan', 'prices'));
    }

    public function subscribe(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $domain = env('APP_URL');
        $user = Auth::user();

        try {
            if (!$user->stripe_customer_id) {
                $customer = \Stripe\Customer::create([
                    'email' => $user->email,
                    'name' => $user->name,
                    'metadata' => [
                        'role' => 'vendor',
                        'active_plan' => '',
                    ]
                ]);

                User::where('id', $user->id)->update(['stripe_customer_id' => $customer->id]);
            } else {
                $customer = \Stripe\Customer::retrieve($user->stripe_customer_id);
            }

            $checkoutSession = \Stripe\Checkout\Session::create([
                'customer' => $customer->id,
                'line_items' => [
                    [
                        'price' => $request->price_id,
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'subscription',
                'success_url' => $domain . '/dashboard',
                'cancel_url' => $domain . '/cancel',
            ]);

            if ($checkoutSession) {
                User::where('id', $user->id)->update(['is_subscriber' => true]);

                $price = \Stripe\Price::retrieve($request->price_id);
                $product = \Stripe\Product::retrieve($price->product);

                \Stripe\Customer::update($customer->id, [
                    'metadata' => [
                        'active_plan' => $product->id,
                    ]
                ]);
            }

            return redirect($checkoutSession->url);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

}
