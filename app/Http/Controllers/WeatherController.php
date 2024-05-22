<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Services\ApiClient;
use Illuminate\Support\Facades\Session;

class WeatherController extends Controller
{
    protected $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function search()
    {
        try {
            // $response = $this->client->request('GET', 'cities');
            // $citiesData = json_decode($response->getBody(), true);
            $citiesData = [
                ['id' => 1, 'name' => 'Kyiv', 'lat' => 50.4501, 'lon' => 30.5234],
                ['id' => 2, 'name' => 'Lviv', 'lat' => 49.8397, 'lon' => 24.0297],
                ['id' => 3, 'name' => 'Odesa', 'lat' => 46.4825, 'lon' => 30.7233],
                ['id' => 4, 'name' => 'Kharkiv', 'lat' => 49.9935, 'lon' => 36.2304],
                ['id' => 5, 'name' => 'Dnipro', 'lat' => 48.4647, 'lon' => 35.0462],
            ];

            $cities = collect($citiesData)->map(function ($cityData) {
                return new City($cityData);
            });

            return view('weather.search', compact('cities'));
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $errorBody = json_decode($response->getBody()->getContents(), true);
            
            return back()->withErrors($errorBody['errors']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
        

        return view('weather.search', compact('cities'));
    }

    public function index(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'city_id' => 'required',
        ]);

        $cityResponse = $this->client->request('http://api.example.com/cities/' . $request->city_id);
        $cityData = json_decode($cityResponse->getBody(), true);
        $city = new City($cityData);

        $weatherResponse =$this->client->request('http://api.example.com/weather', [
            'query' => [
                'lat' => $city->lat,
                'lon' => $city->lon,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]
        ]);

        $weatherData = json_decode($weatherResponse->getBody(), true);

        return view('weather.index', compact('city', 'weatherData'));
    }
}

