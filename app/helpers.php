<?php

use App\ExternalServices\CurrencyExchange;

if (! function_exists('convert_currency')) {
    function convert_currency($amount, $fromCurrency, $toCurrency) {
        $fromCurrency = strtoupper($fromCurrency);
        $toCurrency = strtoupper($toCurrency);

        if(\Illuminate\Support\Facades\Redis::exists('currencyRatesToBaseEUR')) {
            $currencyRatesToBaseEUR = json_decode(\Illuminate\Support\Facades\Redis::get('currencyRatesToBaseEUR'), true);
        } else {
            $currencyExchangeData = CurrencyExchange::getCurrencyExchangeData();
            if(! is_null($currencyExchangeData) && $currencyExchangeData['success'] && isset($currencyExchangeData['rates'])) {
                $currencyRatesToBaseEUR = $currencyExchangeData['rates'];
            }
        }


        if(isset($currencyRatesToBaseEUR) && array_key_exists($fromCurrency, $currencyRatesToBaseEUR) && array_key_exists($toCurrency, $currencyRatesToBaseEUR)) {
            return (floatval($amount) / floatval($currencyRatesToBaseEUR[$fromCurrency])) * floatval($currencyRatesToBaseEUR[$toCurrency]);
        }

        throw new Exception("Problem with currency conversion");
    }
}
