<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Traits\ConsumesExternalServices;

class StripeService
{
    use ConsumesExternalServices;

    protected $baseUri;

    protected $key;

    protected $secret;

    public function __construct(){
        $this->baseUri      = config('services.stripe.base_uri');
        $this->key          = config('services.stripe.key');
        $this->secret       = config('services.stripe.secret');
    }

    public function resolveAuthorization(&$queryParams, &$headers, &$formParams)
    {   
        $headers['Authorization'] = $this->resolveAccessToken();
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function resolveAccessToken()
    {
        // returning the bearer access token
        return "Bearer {$this->secret}";
    }

    public function handlePayment(Request $request)
    {
        // this is because only the stripe have payment_method input field
        $request->validate([
            'payment_method' => 'required'
        ]);

        $intent = $this->createIntent($request->price, Payment::CURRENCY, $request->payment_method);

        session()->put('paymentIntentId', $intent->id);

        return redirect()->route('admin.approval');
    }

    public function handleApproval()
    {
        if(session()->has('paymentIntentId')){

            $paymentIntentId    = session()->get('paymentIntentId');

            $confirmation       = $this->confirmPayment($paymentIntentId);

            if($confirmation->status === 'requires_action'){
                $clientSecret   = $confirmation->client_secret;  
                
                return view('stripe.3d-secure', ['clientSecret' => $clientSecret]);
            }

            if($confirmation->status === 'succeeded'){
                $name       = $confirmation->charges->data[0]->billing_details->name;
                $currency   = strtoupper($confirmation->currency);
                $amount     = $confirmation->amount / $this->resolveFactor($currency);

                return redirect()->route('admin')->withSuccess(['payment' => "Thanks, {$name}. We recieved your {$amount} {$currency} payment"]);
            }
        }   

        return redirect()->route('admin')->withErrors('We are unable to confirm your payment, Try Again please');
    }

    

    public function createIntent($value, $currency, $paymentMethod)
    {
        return $this->makeRequest(
            'POST',
            '/v1/payment_intents',
            [
                'amount' => round($value * $this->resolveFactor($currency)),
                'currency' => strtolower($currency),
                'payment_method' => $paymentMethod,
                'confirmation_method' => 'manual'
            ]
        );

    }

    public function confirmPayment($paymentIntentId)
    {
        return $this->makeRequest(
            'POST',
            "/v1/payment_intents/{$paymentIntentId}/confirm"
        );
    }

    public function resolveFactor($currency)
    {
        $zeroDecimalCurrency = ['JPY'];

        if(in_array(strtoupper($currency),$zeroDecimalCurrency))
        {
            return 1;
        }

        return 100;
    }
}