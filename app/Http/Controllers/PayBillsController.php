<?php
/**
 * Created by PhpStorm.
 * User: Dean
 * Date: 10/28/2016
 * Time: 11:06
 */

namespace App\Http\Controllers;


class PayBillsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewpaybills()
    {

        return view('pay_bills.view');
    }


}