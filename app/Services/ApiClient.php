<?php
namespace App\Services;

use GuzzleHttp\Client;

class ApiClient
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function request($method, $uri = '', array $options = [])
    {
        if ($token = session('api_token')) {
            $options['headers']['Authorization'] = 'Bearer ' . $token;
        }

        return $this->client->request($method, $uri, $options);
    }
}
