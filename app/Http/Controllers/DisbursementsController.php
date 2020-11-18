<?php
/**
 * Created by PhpStorm.
 * User: Dean
 * Date: 10/28/2016
 * Time: 11:03
 */

namespace App\Http\Controllers;


class DisbursementsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewdisbursements()
    {
        return view('disbursements.view');
    }

}