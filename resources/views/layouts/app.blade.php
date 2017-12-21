<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" integrity="sha256-fmMNkMcjSw3xcp9iuPnku/ryk9kaWgrEbfJfKmdZ45o=" crossorigin="anonymous" />
    </head>
    <body>
        @include('layouts/navbar')
        @include('layouts/sidebar')

        @yield('content')
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
</html>

<style media="screen">
    .sidebar-container {
        background-color:;
        z-index: 1;
        position: fixed;
        bottom: 0;
        left:0;
        top: 51px;
        width: 24rem;
        border-right: 1px solid #e7e7e7;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        var socket = new WebSocket('wss://ws-feed.gdax.com');
        socket.onopen = function(event) {
            var msg = {
                type: 'subscribe',
                product_ids: [
                    'BTC-USD',
                    'LTC-USD',
                    'ETH-USD'
                ],
                channels: [
                    'ticker',
                    'heartbeat'
                ]
            }
            socket.send(JSON.stringify(msg));
        }

        socket.onmessage = function(event) {
            var data = JSON.parse(event.data);
            if (data.type == 'ticker') {
                switch(data.product_id) {
                    case 'BTC-USD':
                    case 'LTC-USD':
                    case 'ETH-USD':
                        $('.realtime.'+data.product_id).each(function(index) {
                            $(this).text(Math.round(data.price));
                        });
                        break;
                }
            }
        }


    });
</script>
