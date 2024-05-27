<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class ApiClient
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function request($method, $uri = '', array $options = [])
    {
        if ($token = Session::get('user')->access_token ?? '') {
            $options['headers']['Authorization'] = 'Bearer ' . $token;
        }

        return $this->client->request($method, $uri, $options);
    }
}
