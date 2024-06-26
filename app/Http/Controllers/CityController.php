<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Services\ApiClient;

class CityController extends Controller
{
    protected $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        try {
            $response = $this->client->request('GET', 'cities');
            $citiesData = json_decode($response->getBody(), true)['data'];
            $cities = collect($citiesData)->map(function ($cityData) {
                return new City($cityData);
            });

            return view('weather.search', compact('cities'));

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $errorBody = json_decode($response->getBody()->getContents(), true);
            
            return $this->backWithError($errorBody);
        } catch (\Exception $e) {
            return $this->backWithUnknownError();
        }
    }

    public function show(Request $request, $cityId)
    {
        try {
            $response = $this->client->request('GET', 'cities/' . $cityId);
            $cityData = json_decode($response->getBody(), true)['data'];
            
            return new City($cityData);
           
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $errorBody = json_decode($response->getBody()->getContents(), true);
            
            return $this->backWithError($errorBody);
        } catch (\Exception $e) {
            return $this->backWithUnknownError();
        }
    }
}
