<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class integrateController extends Controller
{
    public function viewcheckout()
    {
        $result['payment_methods'] = $this->getPaymentMethods();
        return view('integratePay')->with('result',$result);
    }

    //get default payment method
    public function getPaymentMethods(){
        $result = array();
        $payments_setting = DB::table('payments_setting')->get();

        if($payments_setting[0]->momopay_enviroment=='0'){
            $momopay_enviroment = 'Test';
        }else{
            $momopay_enviroment = 'Live';
        }

        $momopay_description = DB::table('payment_description')->where([['payment_name','momopay'],['language_id',1]])->get();
        $momopay_data = $this->getMomoDataApi($payments_setting[0]);
        session(['momopay_data' => $momopay_data]);
        $momopay = array(
            'environment' => $momopay_enviroment,
            'name' => $momopay_description[0]->name,
            'active' => $payments_setting[0]->momopay_active,
            'payment_method' => 'momopay',
            'payment_currency' => 'vnd',

            'momopay_apipoint' => $payments_setting[0]->momopay_apipoint,
            'momopay_data' => $momopay_data,
        );

        $result[1] = $momopay;

        return $result;
    }

    public function getMomoDataApi($payment_setting) {
        $secretKey = $payment_setting->momopay_secretkey;
        $partnerCode = $payment_setting->momopay_partnercode;
        $accessKey = $payment_setting->momopay_accesskey;

        $requestId = 'request-' . time();
//        $amount = strval(intval(session('total_price')));
        $amount = '3000';
        $orderId = 'order-' . time();
        $orderInfo = 'Momo pay';
        $returnUrl = $notifyUrl = url('/checkout/momo/callback');
        $extraData = "";
        $requestType = "captureMoMoWallet";
        $str = "partnerCode=$partnerCode&accessKey=$accessKey&requestId=$requestId&amount=$amount&orderId=$orderId&orderInfo=$orderInfo&returnUrl=$returnUrl&notifyUrl=$notifyUrl&extraData=$extraData";
        $signature = hash_hmac('sha256', $str, $secretKey);
        return [
            "accessKey" 	=> $accessKey,
            "partnerCode" 	=> $partnerCode,
            "requestType"	=> $requestType,
            "notifyUrl" 	=> $notifyUrl,
            "returnUrl" 	=> $returnUrl,
            "orderId"		=> $orderId,
            "amount" 		=> $amount,
            "orderInfo" 	=> $orderInfo,
            "requestId"		=> $requestId,
            "extraData"		=> $extraData,
            "signature"		=> $signature
        ];
    }
}
