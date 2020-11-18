<?php

namespace App\Http\Controllers;


class BankingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function bankview()
    {
        return view('banking.view');
    }

}