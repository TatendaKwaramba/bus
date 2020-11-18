<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp;


class WebAccessController extends Controller
{

    public function grantWebAccess(Request $request)
    {
        if (!$request->email) {
            return 'Email is required';
        }

        $pin = rand(pow(10, 4 - 1), pow(10, 4) - 1);
        User::updateOrCreate([
            'email' => $request->email
        ], [
            'email' => $request->email,
            'password' => bcrypt($pin),
            'name' => $request->name,
        ]);
      echo 'Web Access Granted Successfully';
        $client = new GuzzleHttp\Client(['verify'=>false]);
        $res = $client->post('https://comms.getcash.co.zw/sms/send', ['json' => [
            'message' => $request->name." visit business.getcash.co.zw to do your transactions online your pin is ". $pin,
            'mobile' => $request->email,
            'from'=>'Test'
        ]
        ]);
    }

}