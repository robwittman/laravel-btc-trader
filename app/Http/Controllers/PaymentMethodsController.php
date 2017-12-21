<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GDAX\Clients\AuthenticatedClient;
use GDAX\Types\Response\Authenticated\PaymentMethod;
use GDAX\Types\Request\Authenticated\PaymentMethod as RequestPaymentMethod;

class PaymentMethodsController extends Controller
{
    protected $client;

    public function __construct(AuthenticatedClient $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        $methods = $this->client->getPaymentMethods();
        return response()->json(array_map(function($method) {
            return $this->transformPaymentMethod($method);
        }, $methods));
    }

    public function show($methodId)
    {
        $method = $this->client->getPaymentMethod(
            (new RequestPaymentMethod())->setId($methodId)
        );
        return response()->json($this->transformPaymentMethod($method));
    }


    protected function transformPaymentMethod(PaymentMethod $method)
    {
        return array(

        );
    }
}
