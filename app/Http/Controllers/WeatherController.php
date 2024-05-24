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
        $weatherData = [
            [
                "id" => 241,
                "date" => "2023-01-01T00:00:00.000000Z",
                "city_id" => 1,
                "temperature" => -4,
                "wind_speed" => 3.5,
                "clouds" => 50,
                "humidity" => 80,
                "pressure" => 1012,
            ],
            [
                "id" => 242,
                "date" => "2023-01-02T00:00:00.000000Z",
                "city_id" => 1,
                "temperature" => -3,
                "wind_speed" => 3.7,
                "clouds" => 45,
                "humidity" => 78,
                "pressure" => 1011,
            ],
            [
                "id" => 243,
                "date" => "2023-01-03T00:00:00.000000Z",
                "city_id" => 1,
                "temperature" => -2,
                "wind_speed" => 3.9,
                "clouds" => 40,
                "humidity" => 76,
                "pressure" => 1010,
            ],
            [
                "id" => 244,
                "date" => "2023-01-04T00:00:00.000000Z",
                "city_id" => 1,
                "temperature" => -1,
                "wind_speed" => 4.1,
                "clouds" => 35,
                "humidity" => 74,
                "pressure" => 1009,
            ],
            [
                "id" => 245,
                "date" => "2023-01-05T00:00:00.000000Z",
                "city_id" => 1,
                "temperature" => 0,
                "wind_speed" => 4.3,
                "clouds" => 30,
                "humidity" => 72,
                "pressure" => 1008,
            ],
            [
                "id" => 246,
                "date" => "2023-01-06T00:00:00.000000Z",
                "city_id" => 1,
                "temperature" => 1,
                "wind_speed" => 4.5,
                "clouds" => 25,
                "humidity" => 70,
                "pressure" => 1007,
            ],
            [
                "id" => 247,
                "date" => "2023-01-07T00:00:00.000000Z",
                "city_id" => 1,
                "temperature" => 2,
                "wind_speed" => 4.7,
                "clouds" => 20,
                "humidity" => 68,
                "pressure" => 1006,
            ],
            [
                "id" => 248,
                "date" => "2023-01-08T00:00:00.000000Z",
                "city_id" => 1,
                "temperature" => 3,
                "wind_speed" => 4.9,
                "clouds" => 15,
                "humidity" => 66,
                "pressure" => 1005,
            ],
            [
                "id" => 249,
                "date" => "2023-01-09T00:00:00.000000Z",
                "city_id" => 1,
                "temperature" => 4,
                "wind_speed" => 5.1,
                "clouds" => 10,
                "humidity" => 64,
                "pressure" => 1004,
            ],
            [
                "id" => 250,
                "date" => "2023-01-10T00:00:00.000000Z",
                "city_id" => 1,
                "temperature" => 5,
                "wind_speed" => 5.3,
                "clouds" => 5,
                "humidity" => 62,
                "pressure" => 1003,
            ],
            [
                "id" => 251,
                "date" => "2023-01-11T00:00:00.000000Z",
                "city_id" => 1,
                "temperature" => 6,
                "wind_speed" => 5.5,
                "clouds" => 0,
                "humidity" => 60,
                "pressure" => 1002,
            ],
            [
                "id" => 252,
                "date" => "2023-01-12T00:00:00.000000Z",
                "city_id" => 1,
                "temperature" => 7,
                "wind_speed" => 5.7,
                "clouds" => 0,
                "humidity" => 58,
                "pressure" => 1001,
            ],
            [
                "id" => 253,
                "date" => "2023-01-13T00:00:00.000000Z",
                "city_id" => 1,
                "temperature" => 8,
                "wind_speed" => 5.9,
                "clouds" => 0,
                "humidity" => 56,
                "pressure" => 1000,
            ],
            [
                "id" => 254,
                "date" => "2023-01-14T00:00:00.000000Z",
                "city_id" => 1,
                "temperature" => 9,
                "wind_speed" => 6.1,
                "clouds" => 0,
                "humidity" => 54,
                "pressure" => 999,
            ],
        ];
        
            
        return view('weather.index', compact('city', 'weatherData'));
    }
}

