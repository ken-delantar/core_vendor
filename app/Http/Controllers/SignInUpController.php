<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\User;
use Stripe\Customer;
use Stripe\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Plan;

class SignInUpController extends Controller
{
    public function __construct()
    {
        $this->active_sub_checker();
    }

    public function active_sub_checker()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        foreach (User::all() as $user) {
            if ($user->stripe_customer_id != null) {
                $subscriptions = Subscription::all(['customer' => $user->stripe_customer_id]);
    
                $hasActiveSubscription = false;
    
                foreach ($subscriptions->data as $subscription) {
                    if ($subscription->status == 'active') {
                        $hasActiveSubscription = true;
                        break;
                    }
                }
    
                $user->is_subscriber = $hasActiveSubscription;
                $user->save();
            }
        }
    }
    

    public function vendor_registration(){
        return view('vendor_registration');
    }

    public function vendor_signin(){
        return view('vendor_signin');
    }

    public function sign_in_acc(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            Stripe::setApiKey(env('STRIPE_SECRET'));
            
            if($user->is_subscriber){
                return view('dashboard');
            }else{
                Stripe::getApiKey(env('STRIPE_SECRET'));
                $plans = \Stripe\Product::all([
                    'type' => 'service',
                    'active' => true,
                ]);

                return view('subscription.vendor_completion', compact('plans'));
            }

        } else {
            return redirect()->route('sign_in')->with('error', 'Incorrect credentials!');
        }
    }

    public function acc_registration(Request $request){
        $request->validate([
            'full_name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email);

        if($user->exists()){
            return redirect()->route('index')->with('error', 'Email already exists, sign in instead');
        } else {
            User::create([
                'name' => $request->full_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            Auth::attempt(['email' => $request->email, 'password' => $request->password]);

            Stripe::getApiKey(env('STRIPE_SECRET'));
            $plans = \Stripe\Product::all([
                'type' => 'service',
                'active' => true,
            ]);

            return view('subscription.vendor_completion', compact('plans'));
        }
    }

    public function testing() {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $subscriptions = Subscription::all();

        return view('testing', compact('subscriptions'));
    }
}
