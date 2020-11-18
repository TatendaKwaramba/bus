<?php
/**
 * Created by PhpStorm.
 * User: Dean
 * Date: 10/28/2016
 * Time: 11:10
 */

namespace App\Http\Controllers;


class PayMerchantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewpaymerchants()
    {
        return view('pay_merchant.view');
    }

}