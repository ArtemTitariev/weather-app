<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Weather;
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
        if ($city instanceof \Illuminate\Http\RedirectResponse) {
            return $city;
        }

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Call weather endpoint
        $weatherData = [];
        try {
            $weatherResponse = $this->client->request('GET', "cities/{$city->id}/weather", [
                'query' => [
                    'city_id' => $city->id,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]
            ]);

            $weatherData = json_decode($weatherResponse->getBody(), true)['data'];
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $errorBody = json_decode($response->getBody()->getContents(), true);
            
            return $this->backWithError($errorBody);
        } catch (\Exception $e) {
            return $this->backWithUnknownError();
        }

        $dates = [];
        $temperatures = [];
        $windSpeeds = [];

        $average = [
            "temperature" => 0, 
            "wind_speed" => 0, 
            "clouds" => 0, 
            "humidity" => 0, 
            "pressure" => 0, 
        ];

        $weather = collect($weatherData)->map(function ($data) use (&$dates, &$temperatures, &$windSpeeds, &$average) {
            $dates[] = Carbon::parse($data["date"])->format('d.m');
            $temperatures[] = $data["temperature"];
            $windSpeeds[] = $data["wind_speed"];

            $weather = new Weather($data);
            if ($data["clouds"] >= 60) {
                $weather->icon = 'clouds.png';
            } elseif ($data["clouds"] >= 25 && $data["clouds"] < 60) {
                $weather->icon = 'cloudy.png';
            } else {
                $weather->icon = 'sun.png';
            }

            $average["temperature"] += $weather->temperature;
            $average["wind_speed"] += $weather->wind_speed;
            $average["clouds"] += $weather->clouds;
            $average["humidity"] += $weather->humidity;
            $average["pressure"] += $weather->pressure;
            
            return $weather;
        });

        $count = count($weatherData);

        if ($count > 0) {
            $average = array_map(function($value) use ($count) {
                return round($value / $count);
            }, $average);
        }
            
        return view('weather.index', compact('city', 'weather', 'startDate', 'endDate', 'average', 'dates', 'temperatures', 'windSpeeds'));
    }
}

