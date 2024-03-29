<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Bitcoin: $<span class='realtime BTC-USD'>00.00</span></a></li>
        <li><a href="#">Ethereum: $<span class='realtime ETH-USD'>00.00</span></a></li>
        <li><a href="#">Litecoin: $<span class='realtime LTC-USD'>00.00</span></a></li>
      </ul>
    </div>
  </div>
</nav>
