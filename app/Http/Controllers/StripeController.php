<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\Stripe\Stripe;

use Session;
use Stripe;

class StripeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function checkout(){
      return view('payments.stripecheckout');
    }

    public function afterpayment(Request $request){
       
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // return response()->json($request->stripeToken);

       $res = Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose phpcodingstuff.com",
                
        ]);

        Session::flash('success', 'Payment successful!');
           
       return back();

       //dd($res->status);




    }

    public function checkoutsec(){
        return view('payments.stripecheckoutsec');
    }

    public function checkoutsecpayment(Request $request){

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // \Stripe\Checkout\Session


        $session = \Stripe\Checkout\Session::create([
            "payment_method_types" => ['card'],
            // "unit_amount" => 20000,
            // "quantity" => 3,

            'line_items' => [[
                'price_data' => [
                  'currency' => 'usd',
                  'product_data' => [
                    'name' => 'T-shirt',
                  ],
                  'unit_amount' => 20000,
                ],
                'quantity' => 3,
              ]],



            "mode" => "payment",
            "success_url" => route('stripe.post.sec'),
            "cancel_url" => route('home'),
        ]);

        return response()->json(["url" => $session->url]);
    }
}
