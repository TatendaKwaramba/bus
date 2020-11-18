<?php
/**
 * Created by PhpStorm.
 * User: Dean
 * Date: 2/15/2017
 * Time: 10:12
 */

namespace App\Http\Controllers;


class CardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function viewCardActivation()
    {
        return view('cardactivation.view');
    }
}