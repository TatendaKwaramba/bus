<?php
use Illuminate\Http\Request;
use Anouar\Fpdf\Fpdf;



Route::get('/', 'HomeController@index')->name('home');
Route::post('/confirm-payment', 'ConfirmPayment@index');
Route::get('/confirm-payment', 'ConfirmPayment@index');
Route::get('/privacy', 'Controller@privacy');


Route::any('/web-access', 'WebAccessController@grantWebAccess');


Route::post('/confirm-payment/process/preauth', 'ConfirmPayment@processPreauth');
Route::post('/confirm-payment/process', 'ConfirmPayment@process');




Auth::routes();

Route::group(['middleware' => ['auth']], function () {


    Route::get('/api/agents/get', 'APICallsController@getAgents');

    Route::get('/api/classofservice/get', 'APICallsController@getClassOfService');


    Route::post('/api/subscriber/add', 'APICallsController@addSubscriber');

    Route::get('/api/products/get', 'APICallsController@getProducts');

    Route::post('/api/paybill/cash/preauth', 'APICallsController@payBillPreauthCash');
    Route::post('/api/paybill/cash/confirm', 'APICallsController@payBillConfirmCash');

    Route::post('/api/paybill/personal/preauth', 'APICallsController@payBillPreauthPersonal');
    Route::post('/api/paybill/personal/confirm', 'APICallsController@payBillConfirmPersonal');

    Route::post('/api/paybill/account/preauth', 'APICallsController@payBillPreauthAccount');
    Route::post('/api/paybill/account/confirm', 'APICallsController@payBillConfirmAccount');

    Route::post('/api/business/transactions', 'APICallsController@getBusinessTransactions');

    Route::post('/api/receive_payment/preauth','APICallsController@payMerchantPreauth' );
    Route::post('/api/receive_payment/confirm','APICallsController@payMerchantConfirm' );


    Route::post('/api/make_payment','APICallsController@getBusinessTransactions' );


    Route::any('/api/ai', 'APICallsController@getAgentInformation');
    Route::any('/api/ai/agent_number', 'APICallsController@getSuperAgentInformation');


    Route::post('/api/business/employees', 'APICallsController@getBusinessEmployees');
    Route::post('/api/business/employees/transactions', 'APICallsController@getEmployeeTransactions');

    Route::get('/api/ai/logout', 'APICallsController@aiLogout');

    Route::post('/api/cardActivation', 'APICallsController@activateCard');




    Route::get('/home', 'HomeController@index');

    Route::get('/subscriber/add', 'SubscriberController@subscriberview');

    Route::get('/airtime', 'AirtimeController@airtimeview');

    Route::get('/banking', 'BankingController@bankview');

    Route::get('/pay-bills', 'PayBillsController@viewpaybills');

    Route::get('/pay-merchant', 'PayMerchantsController@viewpaymerchants');

    Route::get('/employees', 'EmployeesController@viewEmployees');

    Route::get('/disbursements', 'DisbursementsController@viewdisbursements');

    Route::get('/card-activation', 'CardsController@viewCardActivation');

    Route::get('/pdf', 'APICallsController@printZesaReceipt');

    Route::get('/transactions', 'BusinessWalletController@viewBusinessWallet');

    Route::get('/agents', 'BusinessWalletController@viewSuperAgent');

    Route::get('/change-pin', 'BusinessWalletController@viewChangePin');

    Route::post('/change-pin', 'ChangePinController@postCredentials');


});