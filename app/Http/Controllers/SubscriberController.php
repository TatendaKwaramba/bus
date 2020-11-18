<?php
/**
 * Created by PhpStorm.
 * User: Dean
 * Date: 11/7/2016
 * Time: 19:19
 */

namespace App\Http\Controllers;


class SubscriberController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function subscriberview(){

        return view('subscriber.view');

    }

}