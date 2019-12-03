<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Log;

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

        // nganluong
        $nganluongpay = [
            'active' => '1',
            'payment_currency' => 'vnd',
            'payment_method' => 'nganluongpay',
            'nganluong_apipoint' => $this->getNganLuongCheckoutLink($payments_setting[0])
        ];

        $result[1] = $momopay;
        $result[2] = $nganluongpay;

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

    // integrate Ngan Luong
    private function getNganLuongCheckoutLink($payment_setting) {
        $shipping_address = session('shipping_address');
        $products_price = session('total_price');
        $buyer_info = data_get($shipping_address, 'firstname') . '*|*' . '*|*' . data_get($shipping_address, 'delivery_phone') . '*|*' . data_get($shipping_address, 'street');

        $nganluong_data = [
            'merchant_site_code' => $payment_setting->nganluongpay_merchantsitecode,
            // 'return_url' => url('/checkout/callback/nganluong'),
            'return_url' => URL('/viewcheckout'),
            'receiver' => $payment_setting->nganluongpay_receiver,
            'transaction_info' => 'transactioninfo',
            'order_code' => 'order' . time(),
            // 'price' => strval(intval($products_price)),
            'price' => 100000,
            'currency' => 'vnd',
            'quantity' => '1',
            'tax' => '0',
            'discount' => '0',
            'fee_cal' => '0',
            'fee_shipping' => '0',
            'order_description' => 'orderdescription',
            'buyer_info' => $buyer_info,
            'affiliate_code' => '',
            'lang' => 'vi',
            // 'cancel_url' => url('/checkout/callback/nganluong'),
            // 'notify_url' => url('/checkout/callback/nganluong')
            'cancel_url' => url('/viewcheckout'),
            'notify_url' => url('/viewcheckout')
        ];

        $secure_pass = $payment_setting->nganluongpay_securepass;
        $secure_code = [
            $nganluong_data['merchant_site_code'],
            $nganluong_data['return_url'],      
            $nganluong_data['receiver'],
            $nganluong_data['transaction_info'],
            $nganluong_data['order_code'],
            $nganluong_data['price'],
            $nganluong_data['currency'] ,
            $nganluong_data['quantity'],
            $nganluong_data['tax'],
            $nganluong_data['discount'],
            $nganluong_data['fee_cal'],
            $nganluong_data['fee_shipping'],
            $nganluong_data['order_description'],
            $nganluong_data['buyer_info'],
            $nganluong_data['affiliate_code'],
            $secure_pass
        ];

        $nganluong_data['secure_code'] = MD5(implode(' ', $secure_code));

        $query = [];
        foreach ($nganluong_data as $k => $v) {
            $query[] = "$k=$v"; 
        }

        return $payment_setting->nganluongpay_apipoint . '?'.implode('&', $query);
    }

}
