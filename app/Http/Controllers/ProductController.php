<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        $products = \Stripe\Product::all(['type' => 'good']);
        $productsArray = $products->data;
    
        $filteredProducts = array_filter($productsArray, function ($product) use ($user) {
            return isset($product->metadata->vendor_id) && $product->metadata->vendor_id === $user->stripe_customer_id;
        });
    
        return view('product_management.index', ['products' => $filteredProducts]);
    }    

    public function store_product(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'desc' => 'required',
        ]);

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $product = \Stripe\Product::create([
                'name' => $request->name,
                'description' => $request->desc,
                'active' => true,
                'type' => 'good',
                'metadata' => [
                    'stock' => $request->stock,
                    'vendor_id' => $user->stripe_customer_id,
                    'status' => 'Pending',
                ],
            ]);

            \Stripe\Price::create([
                'currency' => 'php',
                'unit_amount' => $request->price * 100,
                'product' => $product->id,
            ]);

            return redirect()->back()->with('success', 'Product added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function update_product(Request $request, $product_id){
        $request->validate([
            'name' => 'required',
            'stock' => 'required|integer',
            'desc' => 'required',
        ]);

        try {

            Stripe::setApiKey(env('STRIPE_SECRET'));
            \Stripe\Product::update($product_id, [
                'name' => $request->name,
                'description' => $request->desc,
                'metadata' => [
                    'stock' => $request->stock,
                ],
            ]);

            return redirect()->back()->with('success', 'Product updated successfully.');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function delete_product($product_id){
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $product = \Stripe\Product::retrieve($product_id);
            $product->delete();

            return redirect()->back()->with('success', 'Product updated successfully');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

}
