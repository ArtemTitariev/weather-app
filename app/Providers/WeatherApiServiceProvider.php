<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WeatherApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\ApiClient::class, function ($app) {
            return new \App\Services\ApiClient(
                new \GuzzleHttp\Client(
                    [
                        'base_uri' => env('WEATHER_API_BASE_URI', 'http://localhost:8080/api/v1/'),
                        'headers' => [
                            'Accept' => 'application/json',
                        ],
                    ]
                )
            );
        });

        // $this->app->singleton(Client::class, function ($app) {
        //     return new Client([
        //         'base_uri' => env('WEATHER_API_BASE_URI', 'http://localhost:8080/api/v1/'),
        //         'headers' => [
        //             'Accept' => 'application/json',
        //         ],
        //     ]);
        // });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
