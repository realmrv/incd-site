<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class JsonRpcClient
{
    public const JSON_RPC_VERSION = '2.0';

    public const JSON_RPC_URI = 'v1/rpc';

    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
            'base_uri' => config('services.data.base_uri'),
            'auth' => [config('services.data.username'), config('services.data.password')]
        ]);
    }

    public function send(string $method, array $params): array
    {
        $response = $this->client
            ->post(self::JSON_RPC_URI, [
                RequestOptions::JSON => [
                    'jsonrpc' => self::JSON_RPC_VERSION,
                    'id' => time(),
                    'method' => $method,
                    'params' => $params
                ]
            ])->getBody()->getContents();

        return json_decode($response, true);
    }
}
