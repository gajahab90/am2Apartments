<?php


namespace App\ExternalServices;


class CurrencyExchange {
    public static function getCurrencyExchangeData() {
        $client = new \GuzzleHttp\Client();

        $request = $client->get(env('FIXER_API_PATH') , [
            'query' => [
                'access_key' => env('FIXER_API_KEY')
            ]
        ]);

        return json_decode($request->getBody(), true);
    }
}
