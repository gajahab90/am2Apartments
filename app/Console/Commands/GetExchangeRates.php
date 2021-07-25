<?php

namespace App\Console\Commands;

use App\ExternalServices\CurrencyExchange;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class GetExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:exchange_rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches currency exchange rates and caches data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $currencyExchangeData = CurrencyExchange::getCurrencyExchangeData();

        if(! is_null($currencyExchangeData) && $currencyExchangeData['success'] && isset($currencyExchangeData['rates'])) {
            Redis::set('currencyRatesToBaseEUR' , json_encode($currencyExchangeData['rates']));

            echo "Success - fetching and saving currency rates to Redis"; // This could be written to logs too
            return;
        }

        echo "Failed - fetching and saving currency rates to Redis";  // This could be written to logs too
    }
}
