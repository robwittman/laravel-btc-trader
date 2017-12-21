<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GDAX\Clients\PublicClient;
use GDAX\Types\Request\Market\Product as RequestProduct;
use GDAX\Types\Response\Market\ProductHistoricRate;
use App\HistoricRate;

class DownloadDataset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dataset:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download GDAX dataset';

    /**
     * The public client for getting GDAX statistics
     *
     * @var PublicClient
     */
    protected $client;

    /**
     * The product we care about right now
     *
     * @var string
     */
    protected $productId = 'BTC-USD';

    protected $defaultStartDate = '-1 year';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PublicClient $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $startTime = (new \DateTime())->modify($this->defaultStartDate);
        $endTime = clone $startTime;
        $endTime->add(new \DateInterval('PT1H'));
        $intervalInSeconds = 60;
        $req = new RequestProduct();
        $req->setProductId($this->productId);
        while ($startTime < new \DateTime()) {
            $req->setStart($startTime);
            $req->setEnd($endTime);
            $req->setGranularity($intervalInSeconds);
            $stats = $this->client->getProductHistoricRates($req);
            if (!is_null($stats)) {
                foreach ($stats as $stat) {
                    $this->persistHistoricRate($stat);
                }
            } else {
                error_log("Stats were NULL for {$startTime->format('Y-m-d H:i:s')} - {$startTime->format('Y-m-d H:i:s')}");
            }
            $startTime->add(new \DateInterval('PT1H'));
            $endTime->add(new \DateInterval('PT1H'));
        }
    }

    public function persistHistoricRate(ProductHistoricRate $rate)
    {
        $historicRate = new HistoricRate();
        $historicRate->time = $rate->getTime()->getTimestamp();
        $historicRate->low = $rate->getLow();
        $historicRate->high = $rate->getHigh();
        $historicRate->open = $rate->getOpen();
        $historicRate->close = $rate->getClose();
        $historicRate->volume = $rate->getVolume();
        try {
            $historicRate->save();
        } catch (\Illuminate\Database\QueryException $e) { }
    }
}
