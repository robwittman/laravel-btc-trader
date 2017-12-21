<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GDAX\Clients\PublicClient;
use GDAX\Clients\AuthenticatedClient;

class GDAXClientProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $apiUrl = config('coinbase.api_url');
        $this->app->singleton(PublicClient::class, function($app) use ($apiUrl) {
            $client = new PublicClient();
            $client->setBaseURL($apiUrl);
            return $client;
        });

        $this->app->singleton(AuthenticatedClient::class, function($app) use ($apiUrl) {
            $apiKey = config('coinbase.api_key');
            $apiSecret = config('coinbase.api_secret');
            $passphrase = config('coinbase.passphrase');
            $client = new AuthenticatedClient($apiKey, $apiSecret, $passphrase);
            $client->setBaseURL($apiUrl);
            return $client;
        });
    }
}
