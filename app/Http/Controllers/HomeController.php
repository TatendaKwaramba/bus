<?php

namespace App\Http\Controllers;

use App\SuperAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(strpos(Auth::user()->email,'@') !== FALSE && !$request->hasCookie('agent_number'))
        {
            $agents = SuperAgent::where('email','=',Auth::user()->email)
                                    ->get();
            return view('superagent.view',['agents'=>$agents]);
        }
        return view('home');
    }
}
