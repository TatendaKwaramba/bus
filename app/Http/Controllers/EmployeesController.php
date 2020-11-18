<?php
/**
 * Created by PhpStorm.
 * User: deant
 * Date: 2/19/17
 * Time: 3:33 PM
 */

namespace App\Http\Controllers;


class EmployeesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function viewEmployees()
    {
        return view('employees.view');
    }
}