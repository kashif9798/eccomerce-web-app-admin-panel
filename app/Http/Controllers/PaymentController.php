<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\StripeService;

class PaymentController extends Controller
{
     
/**
     * Render payment Page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Product $product)
    {
        return view('admin.payment.index', ['product' => $product]);
    }


    /**
     * Obtain Payment Details
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pay(Request $request)
    {
        $rules = [
            'price'             => ['required', 'numeric', 'min:1']
        ];

        $request->validate($rules);

        session()->put('pay_run',true);

        
        $stripe = new StripeService();

        return $stripe->handlePayment($request);
    }

    /**
     * Payment Approved
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function approval(){
        // this if condition is for so if someone doesnt run this route directly
        if(session()->has('pay_run')){

            $stripe = new StripeService();

            return $stripe->handleApproval();

        }

        return redirect()
            ->route('admin')
            ->withErrors('We cannot retrive your payment platform, Please try again');
    }

    /**
     * Payment Cancelled
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cancelled(){
        return redirect()
            ->route('admin')
            ->withErrors('The payment was cancelled');
    }
}
