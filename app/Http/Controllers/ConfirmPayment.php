<?php

namespace App\Http\Controllers;
use GuzzleHttp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



class ConfirmPayment extends Controller
{

    public function index(Request $request){

        if (!$request->has('token')){
            Log::info('****Missing or Invalid TOKEN****');
            Log::info($request->input());
            abort(400, 'Invalid Request');
        }
        if (!$request->has('success_return_url')){
            Log::info('****Missing or Invalid Return URL****');
            Log::info($request->input());
            abort(400, 'Invalid Request');

        }if (!$request->has('failure_return_url')){
            Log::info('****Missing or Invalid Return URL****');
            Log::info($request->input());
            abort(400, 'Invalid Request');

        }if (!$request->has('merchant_ref')){
            Log::info('****Missing or Invalid Merchant Reference****');
            Log::info($request->input());
            abort(400, 'Invalid Request');

        }
        if (!$request->has('amount')){
            Log::info('****Missing or Invalid Amount****');
            Log::info($request->input());
            abort(400, 'Invalid Request');

        }
        else{
            $token = (string)$request->input('token');
            $success_return_url = $request->input('success_return_url');
            $failure_return_url = $request->input('failure_return_url');
            $merchant_ref = $request->input('merchant_ref');
            $amount = $request->input('amount');
            return view('make-payment.view',[
                'token'=> $token,
                'success_return_url'=> $success_return_url,
                'failure_return_url'=> $failure_return_url,
                'merchant_ref'=> $merchant_ref,
                'amount'=> $amount,
                ]);
        }
    }

    public function processPreauth(Request $request){
        $data = array(
        'token' => $request->input('token'),
        'amount' => $request->input('amount'),
        'mobile' => $request->input('mobile'),
        'pin' => $request->input('pin'),
        'merchant_ref' => $request->input('merchant_ref'),
        'success_return_url' => $request->input('success_return_url'),
        'failure_return_url' => $request->input('failure_return_url'),
        'type'=>'c2b'
        );
        $client = new GuzzleHttp\Client();
        $res = $client->post('https://ssl.getcash.co.zw/test/commerce_pay_merchant/preauth', ['json' => $data]);
        echo $res->getBody();

    }
    public function process(Request $request){
        $data = array(
        'token' => $request->input('token'),
        'amount' => $request->input('amount'),
        'mobile' => $request->input('mobile'),
        'pin' => $request->input('pin'),
        'auth_id' => (int)$request->input('auth_id'),
        'merchant_ref' => $request->input('merchant_ref'),
        'success_return_url' => $request->input('success_return_url'),
        'failure_return_url' => $request->input('failure_return_url'),
        'type'=>'c2b'
        );
        $client = new GuzzleHttp\Client();
        $res = $client->post('https://ssl.getcash.co.zw/test/commerce_pay_merchant/personal', ['json' => $data]);
        echo $res->getBody();

    }


}