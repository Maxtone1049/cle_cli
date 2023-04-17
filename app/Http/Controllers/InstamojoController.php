<?php

namespace App\Http\Controllers;

use App\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Lib\Instamojo as LibInstamojo;

class InstamojoController extends Controller
{
    public function instamojoIndex()
    {
        return view('user.deposit.payment_views.instamojo');
    }

    public function instamojoPay(Request $request){

        // TEST :  https://test.instamojo.com/api/1.1/ & LIVE : https://instamojo.com/api/1.1/
        $track = Session::get('Track');
        $data = Deposit::where('user_id',\auth()->id())->where('trx', $track)->orderBy('id', 'DESC')->first();
        $api = new LibInstamojo($data->gateway->gateway_key_one, $data->gateway->gateway_key_two,$data->gateway->gateway_key_three);

        try {
            $response = $api->paymentRequestCreate(array(
                "purpose" => "Wowtheme7",
                "amount" => ''.sprintf('%0.2f', round($data->usd_amo,2)).'',
                "buyer_name" => "$request->name",
                "send_email" => true,
                "email" => "$request->email",
                "phone" => "$request->mobile_number",
                "redirect_url" => route('instamojo.payment.success')
                ));

                header('Location: ' . $response['longurl']);
                exit();
        }catch (\Exception $e) {
            return redirect()->route('users.showDepositMethods')->with('alert', $e->getMessage());
        }
    }

    public function instamojoSuccess(Request $request, DepositController $controller){
        try {

            $track = Session::get('Track');
            $deposit = Deposit::where('trx',$track)->first();

            $api = new LibInstamojo($deposit->gateway->gateway_key_one, $deposit->gateway->gateway_key_two,$deposit->gateway->gateway_key_three);
            $response = $api->paymentRequestStatus(request('payment_request_id'));

            if(!isset($response['payments'][0]['status']) ) {
                return redirect()->route('users.showDepositMethods')->with('alert', 'Something went wrong.');
            } else if($response['payments'][0]['status'] != 'Credit') {
                return redirect()->route('users.showDepositMethods')->with('alert', 'Something went wrong.');
            }

            if($deposit instanceof Deposit){
                return $controller->userDataUpdate($deposit);
            }
        }catch (\Exception $e) {
            return redirect()->route('users.showDepositMethods')->with('alert', $e->getMessage());
        }

    }
}
