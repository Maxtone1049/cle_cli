<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\General;
use App\PaymentGatway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mollie\Laravel\Facades\Mollie;

class MollieController extends Controller
{
    public $paymentGatway;
    public function  __construct(){
        $gateWay = PaymentGatway::find(10);
        $this->paymentGatway = $gateWay;
        config([
            'mollie.key' => $gateWay->gateway_key_one
        ]);

        Mollie::api()->setApiKey($gateWay->gateway_key_one);
    }

    public function preparePayment(){
        $general =  General::first();
        $track = Session::get('Track');
        $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => 'USD',
                'value' => ''.sprintf('%0.2f', round($data->usd_amo,2)).'',
            ],
            'description' => 'Payment To'.$general->web_name.'Account', 
            'redirectUrl' => route('mollie.payment.success'), 
            'metadata' => [
                "order_id" => $track,
            ],
        ]);
    
        $payment = Mollie::api()->payments()->get($payment->id);

        session()->put('payment_id',$payment->id);

        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function paymentSuccess(DepositController $controller) {
        $track = Session::get('Track');
        $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();

        $payment = Mollie::api()->payments()->get(session()->get('payment_id'));

        if ($payment->status == "paid") {
            return $controller->userDataUpdate($data);
            return redirect()->route('users.showDepositMethods')->with('payment has been received');
        }

        return redirect()->route('users.showDepositMethods')->with('alert', 'Sorry you payment is canceled');

    }
}
