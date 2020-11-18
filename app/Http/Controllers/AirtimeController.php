<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


class AirtimeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function airtimeview(){
        return view('airtime.view');
    }


}