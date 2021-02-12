<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\ModelBindingHelper; 
use App\Helpers\HesabeCrypt;
use App\Order;
use App\Transaction;
use App\Cart;

class PaymentGatewayController extends Controller
{
    public $paymentApiUrl;
    public $secretKey;
    public $ivKey;
    public $accessCode;
    public $modelBindingHelper;
    public $hesabeCrypt;

    public function __construct()
    {
        $this->paymentApiUrl = env('PAYMENT_API_URL');
        // Get all three values from Merchant Panel, Profile section
        $this->secretKey = env('MERCHANT_SECRET_KEY'); // Use Secret key
        $this->ivKey = env('MERCHANT_IV');              // Use Iv Key
        $this->accessCode = env('ACCESS_CODE');// Use Access Code
        $this->modelBindingHelper = new ModelBindingHelper();
        $this->hesabeCrypt = new HesabeCrypt();   // instance of Hesabe Crypt library
    }
   

public function successPayment() {
    $cart=Cart::where('user_id',auth()->user()->id)->first();
    $cart->delete();
    $orderId = $_GET['id'];
    $responseData = $_GET['data'];
    $decryptResponse = $this->hesabeCrypt::decrypt($responseData, $this->secretKey, $this->ivKey);
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
    $message3 = $decryptedResponse->message;
    return view('payment.index', compact('message3'));
    
    
}

public function failurePayment() {
    
    $orderId = $_GET['id'];
    $responseData = $_GET['data'];
    $decryptResponse = $this->hesabeCrypt::decrypt($responseData, $this->secretKey, $this->ivKey);
    $decryptedResponse = $this->getPaymentResponse($responseData);
    $message3 = $decryptedResponse->message;
    return view('payment.index', compact('message3'));
    
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

   
}
