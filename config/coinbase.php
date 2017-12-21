<?php

return array(
    /* API Key provided by Coinbase / GDAX */
    'api_key' => env('COINBASE_API_KEY', ''),

    /* API Secret provided by Coinbase / GDAX */
    'api_secret' => env("COINBASE_API_SECRET", ''),

    /* API Passphrase provided by Coinbase / GDAX */
    'passphrase' => env("COINBASE_API_PASSPHRASE", ''),

    /* URL For API calls, used to direct to sandbox */
    'api_url' => env("COINBASE_API_URL", \GDAX\Utilities\GDAXConstants::GDAX_API_URL),

    /* URL for Websocket feed. Override to use sandbox */
    'websocket_url' => env("COINBASE_WEBSOCKET_URL", 'wss://ws-feed.gdax.com')
);
