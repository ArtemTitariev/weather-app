<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\City;
use App\Services\ApiClient;
use Carbon\Carbon;

class WeatherController extends Controller
{
    protected $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function index(Request $request)
    {
        $request->validate([
            'start_date' => [
                'required',
                'date',
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
                function ($attribute, $value, $fail) {
                    $startDate = request('start_date');
                    if ($startDate) {
                        $diffInMonths = Carbon::parse($startDate)->diffInMonths(Carbon::parse($value));
                        if ($diffInMonths > 3) {
                            $fail(__('The difference between the dates should not exceed 3 months'));
                        }
                    }
                },
            ],
            'city_id' => 'required',
        ]);


        $cityId = $request->input('city_id');

        $cityController = new CityController($this->client);
        $city = $cityController->show($request, $cityId);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        dd($city, $startDate, $endDate);

        // Call weather endpoint

        // $weatherResponse = $this->client->request('http://api.example.com/weather', [
        //     'query' => [
        //         'lat' => $city->lat,
        //         'lon' => $city->lon,
        //         'start_date' => $request->start_date,
        //         'end_date' => $request->end_date,
        //     ]
        // ]);

        // $weatherData = json_decode($weatherResponse->getBody(), true)['data'];

        // return view('weather.index', compact('city', 'weatherData'));
    }
}

