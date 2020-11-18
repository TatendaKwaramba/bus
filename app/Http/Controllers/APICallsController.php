<?php

namespace App\Http\Controllers;

use Anouar\Fpdf\Fpdf;
use App\User;
use Carbon\Carbon;
use GuzzleHttp;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class APICallsController extends Controller
{

    public function agentLogin(Request $request)
    {

        $validator = $this->agentLoginRules($request->all());
        if ($validator->fails()) {
            return response()->json(['code' => '99', 'description' => array_values($validator->errors()->toArray())[0][0]]);
        }

        $agent = User::whereEmail($request->mobile)->first();

        if (!(Hash::check($request->pin, $agent->password))) {
            return array('code'        => '01',
                         'description' => 'Invalid PIN');
        }

        $data = array(
            'mobile' => $request->mobile
        );
        $client = new GuzzleHttp\Client();
        $res = $client->post(env('BASE_URL') . '/agent_crud/get_agent', ['json' => $data]);

        return $res->getBody()->getContents();

    }

    protected function agentLoginRules(array $data)
    {
        return Validator::make($data, [
            'mobile' => ['required', 'numeric', 'exists:users,email'],
            'pin'    => 'required',
        ]);
    }


    public function getAgentInformation(Request $request)
    {
        if (strpos(Auth::user()->email, '@') !== FALSE && $request->hasCookie('agent_number')) {
            $data = array(
                'mobile' => Cookie::get('agent_number')
            );
            $client = new GuzzleHttp\Client();
            $res = $client->post(env('BASE_URL') . '/agent_crud/get_agent', ['json' => $data]);

            echo $res->getBody()->getContents();
            return;

        }
        Cookie::queue('agent_number', $request->agent_number, time() - 3600);
        Cookie::queue('agent_name', $request->agent_number, time() - 3600);
        $data = array(
            'mobile' => Auth::user()->email
        );


        $client = new GuzzleHttp\Client();
        $res = $client->post(env('BASE_URL') . '/agent_crud/get_agent', ['json' => $data]);

        echo $res->getBody()->getContents();

    }

    public function getSuperAgentInformation(Request $request)
    {
        Cookie::queue('agent_number', $request->agent_number, 100);
        Cookie::queue('agent_name', $request->agent_name, 100);
        return redirect()->route('home');

    }


    public function getProducts()
    {
        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', env('BASE_URL') . '/product_crud/get');
        echo $res->getBody()->getContents();
    }

    public function getClassOfService()
    {
        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', env('BASE_URL') . '/class_of_service/get');
        echo $res->getBody()->getContents();
    }

    public function getAgents()
    {
        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', env('BASE_URL') . '/pay_merchant/get_businesses');
        echo $res->getBody()->getContents();
    }

    public function aiLogout()
    {
        //Auth::logout();
        //Session::flush();
    }

    public function addSubscriber(Request $request)
    {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $address = $request->input('address');
        $id = $request->input('id');
        $mobile = $request->input('mobile');
        $agent = $request->input('agent');
        $email = $request->input('email');
        $deposit = $request->input('deposit');
        $class = $request->input('class');
        $imei = $request->input('imei');

        $data = array(
            'firstname' => $first_name,
            'lastname' => $last_name,
            'address' => $address,
            'idNumber' => $id,
            'deposit' => (float)$deposit,
            'mobile' => $mobile,
            'email' => $email,
            'agentId' => array('id' => $agent),
            'clientClassOfServiceId' => array('id' => $class),
        );


        $client = new GuzzleHttp\Client();
        $res = $client->post(env('BASE_URL') . '/client_crud/add', ['json' => [
            'clients' => array($data),
            'imei' => $imei,
            "admin_id" => 1
        ]
        ]);
        echo $res->getBody();
    }


    public function payBillPreauthCash(Request $request)
    {
        $imei = $request->input('imei');
        $amount = $request->input('amount');
        $product_id = $request->input('product_id');
        $employee_code = $request->input('employee_code');
        $reference = $request->input('reference');
        $agent_id = $request->input('agent_id');

        $array = array_add(["mParameterName" => "bill_id"], "mParameterValue", $reference);
        $array2 = array_add(["mParameterName" => "amount"], "mParameterValue", $amount);
        $data = array(
            'imei' => $imei,
            'amount' => $amount,
            'product_id' => $product_id,
            'employee_code' => $employee_code,
            'channel' => 'web',
            'agent_id' => $agent_id,

            'php_params' => array($array, $array2)


        );
        //return $data;
        $client = new GuzzleHttp\Client();


        $res = $client->post(env('BASE_URL') . '/pay_bills/cash_preauth', ['json' => $data]);

        echo $res->getBody();


    }

    public function payBillConfirmCash(Request $request)
    {
        $imei = $request->input('imei');
        $amount = $request->input('amount');
        $product_id = $request->input('product_id');
        $employee_code = $request->input('employee_code');
        $reference = $request->input('reference');
        $auth_id = $request->input('auth_id');
        $agent_id = $request->input('agent_id');


        $array = array_add(["mParameterName" => "bill_id"], "mParameterValue", $reference);
        $array2 = array_add(["mParameterName" => "amount"], "mParameterValue", $amount);
        $data = array(
            'imei' => $imei,
            'auth_id' => $auth_id,
            'amount' => $amount,
            'product_id' => $product_id,
            'employee_code' => $employee_code,
            'channel' => 'web',
            'agent_id' => $agent_id,


            'php_params' => array($array, $array2)


        );

        $client = new GuzzleHttp\Client();


        $res = $client->post(env('BASE_URL') . '/pay_bills/cash', ['json' => $data]);

        echo $res->getBody();

    }

    public function payBillPreauthAccount(Request $request)
    {

        $imei = $request->input('imei');
        $amount = $request->input('amount');
        $product_id = $request->input('product_id');
        $employee_code = $request->input('employee_code');
        $reference = $request->input('reference');
        $mobile = $request->input('mobile');
        $pin = $request->input('pin');
        $agent_id = $request->input('agent_id');


        $array = array_add(["mParameterName" => "bill_id"], "mParameterValue", $reference);
        $array2 = array_add(["mParameterName" => "amount"], "mParameterValue", $amount);
        $data = array(
            'imei' => $imei,
            'amount' => $amount,
            'product_id' => (int)$product_id,
            'employee_code' => $employee_code,
            'mobile' => $mobile,
            'pin' => $pin,
            'channel' => 'web',
            'agent_id' => $agent_id,

            'php_params' => array($array, $array2)


        );
        $client = new GuzzleHttp\Client();


        $res = $client->post(env('BASE_URL') . '/pay_bills/account_preauth', ['json' => $data]);

        echo $res->getBody();


    }

    public function payBillConfirmAccount(Request $request)
    {
        $imei = $request->input('imei');
        $amount = $request->input('amount');
        $product_id = $request->input('product_id');
        $employee_code = $request->input('employee_code');
        $reference = $request->input('reference');
        $auth_id = $request->input('auth_id');
        $mobile = $request->input('mobile');
        $pin = $request->input('pin');
        $OTP = $request->input('OTP');
        $agent_id = $request->input('agent_id');


        $array = array_add(["mParameterName" => "bill_id"], "mParameterValue", $reference);
        $array2 = array_add(["mParameterName" => "amount"], "mParameterValue", $amount);
        $data = array(
            'imei' => $imei,
            'auth_id' => $auth_id,
            'amount' => $amount,
            'product_id' => (int)$product_id,
            'employee_code' => $employee_code,
            'mobile' => $mobile,
            'pin' => $pin,
            'OTP' => $OTP,
            'channel' => 'web',
            'agent_id' => $agent_id,

            'php_params' => array($array, $array2)
        );
        //return $data;
        $client = new GuzzleHttp\Client();


        $res = $client->post(env('BASE_URL') . '/pay_bills/account', ['json' => $data]);

        echo $res->getBody();


    }

    public function payBillPreauthPersonal(Request $request)
    {
        $imei = $request->input('imei');
        $amount = $request->input('amount');
        $product_id = $request->input('product_id');
        $employee_code = $request->input('employee_code');
        $reference = $request->input('reference');
        $agent_id = $request->input('agent_id');


        $array = array_add(["mParameterName" => "bill_id"], "mParameterValue", $reference);
        $array2 = array_add(["mParameterName" => "amount"], "mParameterValue", $amount);
        $data = array(
            'imei' => $imei,
            'amount' => $amount,
            'product_id' => $product_id,
            'employee_code' => $employee_code,
            'channel' => 'web',
            'agent_id' => $agent_id,

            'php_params' => array($array, $array2)


        );
        $client = new GuzzleHttp\Client();


        $res = $client->post(env('BASE_URL') . '/pay_bills/personal_preauth', ['json' => $data]);

        echo $res->getBody();


    }

    public function payBillConfirmPersonal(Request $request)
    {
        $imei = $request->input('imei');
        $amount = $request->input('amount');
        $product_id = $request->input('product_id');
        $employee_code = $request->input('employee_code');
        $reference = $request->input('reference');
        $auth_id = $request->input('auth_id');
        $agent_id = $request->input('agent_id');


        $array = array_add(["mParameterName" => "bill_id"], "mParameterValue", $reference);
        $array2 = array_add(["mParameterName" => "amount"], "mParameterValue", $amount);
        $data = array(
            'imei' => $imei,
            'auth_id' => $auth_id,
            'amount' => $amount,
            'product_id' => $product_id,
            'employee_code' => $employee_code,
            'channel' => 'web',
            'agent_id' => $agent_id,

            'php_params' => array($array, $array2)


        );
        $client = new GuzzleHttp\Client();


        $res = $client->post(env('BASE_URL') . '/pay_bills/personal', ['json' => $data]);

        echo $res->getBody();


    }

    public function printZesaReceipt(Request $request)
    {


        $token_number = $request->input('token_number');
        $meter_number = $request->input('meter_number');
        $receipt_number = $request->input('receipt_number');
        $customer_name = $request->input('customer_name');
        $house_number = $request->input('house_number');
        $suburb = $request->input('suburb');
        $town = $request->input('town');
        $tariff = $request->input('tariff');
        $energy_bought = $request->input('energy_bought');
        $tendered_amount = $request->input('tendered_amount');
        $energy_charge = $request->input('energy_charge');
        $debt_collected = $request->input('debt_collected');
        $re_levy = $request->input('re_levy');
        $re_levy_percentage = $request->input('re_levy_percentage');
        $vat = $request->input('vat');
        $vat_percentage = $request->input('vat_percentage');
        $tariff_index = $request->input('tariff_index');
        $supply_group = $request->input('supply_group');
        $key_rev_number = $request->input('key_rev_number');
        $total_paid = $request->input('total_paid');
        $debt_before_transaction = $request->input('debt_before_transaction');
        $debt_after_transaction = $request->input('debt_after_transaction');
        $vendor_ref = $request->input('vendor_reference');
        $transmission_date = $request->input('transmission_date');
        $transmission = Carbon::parse($transmission_date)->format('d-m-Y h:i:sa');

        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $fpdf->Image('img/zetdc.png', 95, 5, 20);
        $fpdf->ln(20);
        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(5, 0, 'BPN:200019701', 0, 0, 'L', false, '');
        $fpdf->Cell(177, 0, 'VAT No: 10001539', 0, 1, 'R');
        $fpdf->ln(10);
        $fpdf->Cell(185, 0, 'ZIMBABWE ELECTRICITY TRANSMISSION AND DISTRIBUTION COMPANY', 0, 1, 'C');
        $fpdf->ln(4);
        $fpdf->Cell(185, 0, '25 SAMORA MACHEL AVENUE, ELECTRICITY CENTRE', 0, 1, 'C');
        $fpdf->ln(4);
        $fpdf->Cell(185, 0, 'HARARE. TEL: 263-4-773300/40', 0, 1, 'C');
        $fpdf->ln(4);
        $fpdf->Cell(185, 0, 'REG#: 2292/2009', 0, 1, 'C');
        $fpdf->ln(4);
        $fpdf->Cell(185, 0, 'TAX INVOICE', 0, 1, 'C');
        $fpdf->ln(8);
        $fpdf->Cell(5, 0, 'FS: 9999999', 0, 1, 'L');
        $fpdf->Cell(177, 0, $transmission, 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'TAX No: 9999999', 0, 1, 'L');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, '......................................................................................................................................................................................', 0, 1, 'L');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Receipt no.:', 0, 1, 'L');
        $fpdf->Cell(177, 0, $receipt_number, 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Meter no.:', 0, 1, 'L');
        $fpdf->Cell(177, 0, $meter_number, 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Electricity Pre-paid', 0, 1, 'L');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Customer Name: ' . $customer_name, 0, 1, 'L');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, $house_number, 0, 1, 'L');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, $suburb, 0, 1, 'L');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, $town, 0, 1, 'L');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, '......................................................................................................................................................................................', 0, 1, 'L');
        $fpdf->ln(4);
        $fpdf->Cell(185, 0, 'ELECTRICITY TOKEN', 0, 1, 'C');
        $fpdf->ln(4);
        $fpdf->Cell(185, 0, 'Enter this code into your meter:', 0, 1, 'C');
        $fpdf->ln(8);
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->Cell(185, 0, $token_number, 0, 1, 'C');
        $fpdf->ln(8);
        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(5, 0, '......................................................................................................................................................................................', 0, 1, 'L');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Tariff: ' . $tariff, 0, 1, 'L');
        $fpdf->Cell(177, 0, '$', 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Energy Bought (kWh): ' . $energy_bought, 0, 1, 'L');
        $fpdf->Cell(177, 0, '', 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Tender Amount', 0, 1, 'L');
        $fpdf->Cell(177, 0, $tendered_amount, 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Energy Charge', 0, 1, 'L');
        $fpdf->Cell(177, 0, $energy_charge, 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Debt Collected', 0, 1, 'L');
        $fpdf->Cell(177, 0, $debt_collected, 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'RE Levy (' . $re_levy_percentage . ')', 0, 1, 'L');
        $fpdf->Cell(177, 0, $re_levy, 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'VAT (' . $vat_percentage . ')', 0, 1, 'L');
        $fpdf->Cell(177, 0, $vat, 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, '......................................................................................................................................................................................', 0, 1, 'L');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'TOTAL PAID', 0, 1, 'L');
        $fpdf->Cell(177, 0, $total_paid, 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Debt Balance B/fwd', 0, 1, 'L');
        $fpdf->Cell(177, 0, $debt_before_transaction, 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Debt Bce-After Payment', 0, 1, 'L');
        $fpdf->Cell(177, 0, $debt_after_transaction, 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, '......................................................................................................................................................................................', 0, 1, 'L');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Vendor No. and Name:', 0, 1, 'L');
        $fpdf->Cell(177, 0, 'Powertel Communications Pvt Ltd - 600021', 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, '10th Floor Joina City,', 0, 1, 'L');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Jason Moyo Avenue, Harare', 0, 1, 'L');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Phone: 0861120822 - 6', 0, 1, 'L');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Email: callcenter@powertel.co.zw', 0, 1, 'L');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Vendor Transaction Ref:', 0, 1, 'L');
        $fpdf->Cell(177, 0, $vendor_ref, 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Tariff Index:', 0, 1, 'L');
        $fpdf->Cell(177, 0, $tariff_index, 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Supply Group Code:', 0, 1, 'L');
        $fpdf->Cell(177, 0, $supply_group, 0, 1, 'R');
        $fpdf->ln(4);
        $fpdf->Cell(5, 0, 'Key Rev. Number::', 0, 1, 'L');
        $fpdf->Cell(177, 0, $key_rev_number, 0, 1, 'R');
        //$fpdf->Output();
        return response()->file($fpdf->Output());

    }

    public function payMerchantPreauth(Request $request)
    {
        $imei = $request->input('imei');

        $mobile = $request->input('mobile');
        $amount = $request->input('amount');
        $type = $request->input('type');
        $pin = $request->input('pin');
        $agent_id = $request->input('agent_id');
        $agent = $request->input('agent');

        $data = array(
            'imei' => $imei,
            'mobile' => $mobile,
            'amount' => $amount,
            'type' => $type,
            'pin' => $pin,
            'agent_id' => $agent_id,
            'agent' => $agent,
        );


        $client = new GuzzleHttp\Client();

        $res = $client->post(env('BASE_URL') . '/pay_merchant/preauth', ['json' => $data]);

        echo $res->getBody();


    }

    public function payMerchantConfirm(Request $request)
    {
        $imei = $request->input('imei');
        $mobile = $request->input('mobile');
        $amount = $request->input('amount');
        $type = $request->input('type');
        $pin = $request->input('pin');
        $agent_id = $request->input('agent_id');
        $auth_id = $request->input('auth_id');
        $employee_code = $request->input('employee_code');
        $agent = $request->input('agent');


        $data = array(
            'imei' => $imei,
            'mobile' => $mobile,
            'amount' => $amount,
            'type' => $type,
            'pin' => $pin,
            'agent_id' => $agent_id,
            'auth_id' => $auth_id,
            'employee_code' => $employee_code,
            'agent' => $agent,
            'channel' => 'web'


        );


        $client = new GuzzleHttp\Client();

        $res = $client->post(env('BASE_URL') . '/pay_merchant/agent', ['json' => $data]);

        echo $res->getBody();


    }

    public function getBusinessTransactions(Request $request)
    {
        $id = $request->input('id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $client = new GuzzleHttp\Client();
        $res = $client->post(env('BASE_URL') . '/agent_crud/get_transaction_history', ['json' => [
            'agent_id' => $id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'channel' => 'web'


        ]]);
        echo $res->getBody();

    }

    public function getBusinessEmployees(Request $request)
    {
        $id = $request->input('id');
        $client = new GuzzleHttp\Client();
        $res = $client->post('http://192.168.1.162:8080/Project_X/webresources/agent_crud/get_employees', ['json' => [
            'agent_id' => $id,
            "admin_id" => Auth::user()->id

        ]]);
        echo $res->getBody();

    }

    public function getEmployeeTransactions(Request $request)
    {
        $id = $request->input('id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $client = new GuzzleHttp\Client();
        $res = $client->post('http://192.168.1.162:8080/Project_X/webresources/employee_crud/get_transaction_history', ['json' => [
            'employee_id' => (int)$id,
            'start_date' => $start_date,
            'end_date' => $end_date,

        ]]);
        echo $res->getBody();

    }

    public function activateCard(Request $request)
    {
        $cardNumber = $request->input('cardNumber');
        $mobile = $request->input('mobile');
        $pin = $request->input('pin');
        $type = $request->input('type');
        //return $pin;

        $client = new GuzzleHttp\Client();
        $res = $client->post(env('BASE_URL') . '/device/activate_card', ['json' => [
            'pin' => $pin,
            'mobile' => $mobile,
            'cardNumber' => $cardNumber,
            'type' => $type,
            'channel' => 'web'
        ]]);
        echo $res->getBody();

    }


}