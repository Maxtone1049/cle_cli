<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\PaymentGatway;
use Illuminate\Http\Request;

class TwocheckoutController extends Controller
{
    public static function ipn(Request $request, DepositController $controller)
    {
        $gate_way = PaymentGatway::find(15);
        $hash_secret = $gate_way->gateway_key_one;
        $hash_id = $gate_way->gateway_key_two;
        $order = Deposit::where('trx', $request->li_0_product_id)->latest()->first();
        $hash_total = round(floatval($order->amount) + floatval($order->charge), 2);
        $hash_order = $request->order_number;
        $string_hash = strtoupper(md5($hash_secret . $hash_id . $hash_order . $hash_total));

        if ($string_hash != $request->key) {
            return $controller->userDataUpdate($order);
        } else {
            return redirect()->route('users.showDepositMethods')->with('alert', 'Payment cancelled.');
        }
    }
}
