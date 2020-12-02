<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HesabeCheckoutRequestModel extends Model
{
    public $amount;
    public $currency;
    public $paymentType;
    public $orderReferenceNumber;
    public $version;
    public $variable1;
    public $variable2;
    public $variable3;
    public $variable4;
    public $variable5;
    public $merchantCode;
    public $responseUrl;
    public $failureUrl;
}
