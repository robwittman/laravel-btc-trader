<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GDAX\Clients\AuthenticatedClient;
use GDAX\Types\Response\Authenticated\Account;
use GDAX\Types\Request\Authenticated\Account as RequestAccount;

class AccountsController extends Controller
{
    protected $client;

    public function __construct(AuthenticatedClient $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        $accounts = $this->client->getAccounts();
        return response()->json(array_map(function($account) {
            return $this->transformAccount($account);
        }, $accounts));
    }

    public function show($accountId)
    {
        $account = $this->client->getAccount(
            (new RequestAccount())->setId($accountId)
        );
        return response()->json($this->transformAccount($account));
    }


    protected function transformAccount(Account $account)
    {
        return array(
            'id' => $account->getId(),
            'currency' => $account->getCurrency(),
            'balance' => $account->getBalance(),
            'available' => $account->getAvailable(),
            'hold' => $account->getHold(),
            'profile_id' => $account->getProfileId()
        );
    }
}
