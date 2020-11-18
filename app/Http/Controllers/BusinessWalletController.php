<?php

namespace App\Http\Controllers;


use App\SuperAgent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use GuzzleHttp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BusinessWalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewBusinessWallet()
    {
        return view('businesswallet.view');
    }

    public function viewChangePin()
    {
        return view('businesswallet.pin.reset');
    }

    public function viewSuperAgent(Request $request)
    {
        if (strpos(Auth::user()->email, '@') !== FALSE) {
            Cookie::forget('agent_number');
            $agents = SuperAgent::where('email', '=', Auth::user()->email)
                ->get();
            return view('superagent.view', ['agents' => $agents]);
        }
        abort(404);

    }




}