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

    public function checkoutGiaohangtietkiem(Request $request) {
        $id = 'yolo'. now()->timestamp ;
        $order = [
            'products' => [
                    "name" => "bút",
                    "weight" => 0.1,
                    "quantity" => 1
                    ],
            'order' => [
                "id" => $id,
                "pick_name" => "HCM-nội thành",
                "pick_address" => "590 CMT8 P.11",
                "pick_province" => "TP. Hồ Chí Minh",
                "pick_district" => "Quận 3",
                "pick_tel" => "0911222333",
                "tel" => "0911222333",
                "name" => "GHTK - HCM - Noi Thanh",
                "address" => "123 nguyễn chí thanh",
                "province" => "TP. Hồ Chí Minh",
                "district" => "Quận 1",
                "is_freeship" => "1",
                "pick_date" => "2016-09-30",
                "pick_money" => 47000,
                "note" => "Khối lượng tính cước tối đa: 1.00 kg",
                "value" => 3000000,
                "transport" => "fly"
            ]
        ];
        $data = json_encode($order);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/order",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Token: 1d5261338ACE773eEE972c038E80B355cFC604D5",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        var_dump($response);
    } 

    function calDeliveryGHTT() {

        $condition = [
            "pick_province" => 'Hà Nội',
            "pick_district" => 'Quận Hai Bà Trưng',
            "province" => 'Hà nội',
            "district" => 'Quận Cầu Giấy',
            "address" => 'P.503 tòa nhà Auu Việt, số 1 Lê Đức Thọ',
            "weight" => 1000,
            "value" => 3000000,
            "transport" => "fly"
        ];
        $query = http_build_query($condition);
    $token = '1d5261338ACE773eEE972c038E80B355cFC604D5';
    $url = "https://services.giaohangtietkiem.vn/services/shipment/fee?". $query;

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Token: " . $token,
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    var_dump($response);
}

}
