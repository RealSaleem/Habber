<?php

namespace App\Http\Controllers;
use App\Misc\Constants;
use Illuminate\Http\Request;
use App\Misc\PaymentHandler;
use App\Helpers\ModelBindingHelper;
use App\HesabeCheckoutResponseModel;
use Hesabe\Payment\HesabeCrypt; 
use App\Order;
use App\Transaction;

class PaymentGatewayController extends Controller
{
    public $paymentApiUrl;
    public $secretKey;
    public $ivKey;
    public $accessCode;
    public $hesabeCheckoutResponseModel;
    public $modelBindingHelper;
    public $hesabeCrypt;

    public function __construct()
    {
        $this->paymentApiUrl = Constants::PAYMENT_API_URL;
        // Get all three values from Merchant Panel, Profile section
        $this->secretKey = Constants::MERCHANT_SECRET_KEY;  // Use Secret key
        $this->ivKey = Constants::MERCHANT_IV;              // Use Iv Key
        $this->accessCode = Constants::ACCESS_CODE;         // Use Access Code
        $this->hesabeCheckoutResponseModel = new HesabeCheckoutResponseModel();
        $this->modelBindingHelper = new ModelBindingHelper();
        $this->hesabeCrypt = new HesabeCrypt();   // instance of Hesabe Crypt library
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

public function successPayment() {
    
    $orderId = $_GET['id'];
    $responseData = $_GET['data'];
    $decryptedResponse = $this->getPaymentResponse($responseData);
    $order = Order::find($orderId);
    $order->payment_status = $decryptedResponse->status;
    $order->payment_message = $decryptedResponse->message;
    $order->save();
    $trans = new Transaction();
    $trans->order_id = $orderId;
    $trans->code = $decryptedResponse->code;
    $trans->status = $decryptedResponse->status;
    $trans->message = $decryptedResponse->message;
    $trans->resultcode = $decryptedResponse->response['resultCode'];
    $trans->amount = $decryptedResponse->response['amount'];
    $trans->paymenttoken = $decryptedResponse->response['paymentToken'];
    $trans->paymentid = $decryptedResponse->response['paymentId'];
    $trans->paidOn = $decryptedResponse->response['paidOn'];
    $trans->orderreferencenumber = $decryptedResponse->response['orderReferenceNumber'];
    $trans->variable1 = $decryptedResponse->response['variable1'];
    $trans->variable2 = $decryptedResponse->response['variable2'];
    $trans->variable3 = $decryptedResponse->response['variable3'];
    $trans->variable4 = $decryptedResponse->response['variable4'];
    $trans->variable5 = $decryptedResponse->response['variable5'];
    $trans->method = $decryptedResponse->response['method'];
    $trans->administrativecharge =  $decryptedResponse->response['administrativeCharge'];
    $trans->save();
  // print_r($decryptedResponse);
    
    
}

public function failurePayment() {
    
    $orderId = $_GET['id'];
    $responseData = $_GET['data'];
    $decryptResponse = $this->hesabeCrypt::decrypt($responseData, $this->secretKey, $this->ivKey);
    print_r($decryptResponse);
    exit;
}


public function getPaymentResponse($responseData)
{
    //Decrypt the response received in the data query string
    $decryptResponse = $this->hesabeCrypt::decrypt($responseData, $this->secretKey, $this->ivKey);

    //De-serialize the decrypted response
    $decryptResponseData = json_decode($decryptResponse, true);

    //Binding the decrypted response data to the entity model
    $decryptedResponse = $this->modelBindingHelper->getPaymentResponseData($decryptResponseData);

    //return decrypted data
    return $decryptedResponse;
}

  

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
