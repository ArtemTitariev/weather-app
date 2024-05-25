@extends('layouts.app')

@section('title'){{ __('Weather') }}@endsection

@section('resources')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection


@section('content')
<x-container>
    <x-alert/>

    <div class="flex flex-wrap -mx-4">
        <div class="w-full lg:w-1/2 px-4 mb-4 lg:mb-0">
            <h2 class="text-2xl font-bold text-accent">{{ $city->name }}</h2>
            <h5 class="pt-4 text-xl font-semibold text-accent">
                {{ \Carbon\Carbon::parse($startDate)->format('d.m.Y') }} - 
                {{ \Carbon\Carbon::parse($endDate)->format('d.m.Y') }}
            </h5>
            {{-- <p>Координати: {{ $city->lat }}, {{ $city->lon }}</p> --}}
            <form method="GET" action="{{ route('weather.index') }}" class="mt-4">

                <input type="hidden" name="city_id" value="{{ $city->id }}">

                <x-forms.input-container>
                    <x-forms.label for="start_date" >{{ __('Start Date') }}</x-forms.label>
                    <x-forms.input type="date" id="start_date" name="start_date" value="{{ $startDate }}" required max="{{ date('Y-m-d') }}" />
                </x-forms.input-container>
                <x-forms.input-container>
                    <x-forms.label for="end_date" >{{ __('End Date') }}</x-forms.label>
                    <x-forms.input type="date" id="end_date" name="end_date" value="{{ $endDate }}" required max="{{ date('Y-m-d') }}" />
                </x-forms.input-container>
                <x-forms.input-container>
                <x-forms.button type="submit" {{-- class="bg-primary text-white py-2 px-4 rounded" --}}>{{ __('Show') }}</x-forms.button>
                </x-forms.input-container>

            </form>
        </div>

        <div class="w-full lg:w-1/2 px-4">
            @if ($groupedWeather->isEmpty())
                <x-warning title="{{ __('Notice') }}" message="{{ __('No average weather data available.') }}" class="mt-8" />
            @else
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-light p-4 rounded shadow flex items-center">
                        <img src="{{ asset('images/temperature-icon.png') }}" alt="Temperature" class="w-12 h-12 mr-4">
                        <div>
                            <h5 class="text-lg font-semibold text-secondary">{{ __('Average Temperature') }}</h5>
                            <p class="text-2xl">{{ $average["temperature"] }} °C</p>
                        </div>
                    </div>
                    <div class="bg-light p-4 rounded shadow flex items-center">
                        <img src="{{ asset('images/wind-speed-icon.png') }}" alt="Wind Speed" class="w-12 h-12 mr-4">
                        <div>
                            <h5 class="text-lg font-semibold text-secondary">{{ __('Average Wind Speed') }}</h5>
                            <p class="text-2xl">{{ $average["wind_speed"] }} {{ __('m/s') }}</p>
                        </div>
                    </div>
                    <div class="bg-light p-4 rounded shadow flex items-center">
                        <img src="{{ asset('images/clouds-icon.png') }}" alt="Clouds" class="w-12 h-12 mr-4">
                        <div>
                            <h5 class="text-lg font-semibold text-secondary">{{ __('Average Clouds') }}</h5>
                            <p class="text-2xl">{{ $average["clouds"] }} %</p>
                        </div>
                    </div>
                    <div class="bg-light p-4 rounded shadow flex items-center">
                        <img src="{{ asset('images/humidity-icon.png') }}" alt="Humidity" class="w-12 h-12 mr-4">
                        <div>
                            <h5 class="text-lg font-semibold text-secondary">{{ __('Average Humidity') }}</h5>
                            <p class="text-2xl">{{ $average["humidity"] }} %</p>
                        </div>
                    </div>
                    <div class="bg-light p-4 rounded shadow flex items-center">
                        <img src="{{ asset('images/pressure-icon.png') }}" alt="Pressure" class="w-12 h-12 mr-4">
                        <div>
                            <h5 class="text-lg font-semibold text-secondary">{{ __('Average Pressure') }}</h5>
                            <p class="text-2xl">{{ $average["pressure"] }}  {{ __('mmHg') }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>  
        
        
    </div>

    @if ($groupedWeather->isEmpty())
            <x-warning title="{{ __('Notice') }}" message="{{ __('No weather data available.') }}" class="mt-8" />
    @else
        <div class="w-full mt-8 flex justify-center">
            <canvas id="weatherChart" class="w-10/12 h-1/2"></canvas>
        </div>

        <div class="mt-8">
            @foreach($groupedWeather as $month => $weather)
                <h3 class="text-xl font-bold mt-6 text-secondary">{{ $month }}</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-4">
                    @foreach($weather as $day)
                        <div class="bg-gray-200 p-3 rounded shadow">
                            <div class="flex items-center mb-4">
                                <img src="{{ asset('images/clouds-icons/' . $day->icon) }}" alt="Cloud Icon" class="w-16 h-16 mr-4">
                                <h5 class="text-lg font-semibold text-accent">{{ \Carbon\Carbon::parse($day->date)->format('d.m.Y') }}</h5>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-1 gap-2">
                                <div class="flex items-center mb-2">
                                    <img src="{{ asset('images/temperature-icon.png') }}" alt="Temperature Icon" class="w-6 h-6 mr-2">
                                    <p>{{ __('Temperature') }}: {{ $day->temperature }} °C</p>
                                </div>
                                <div class="flex items-center mb-2">
                                    <img src="{{ asset('images/wind-speed-icon.png') }}" alt="Wind Speed Icon" class="w-6 h-6 mr-2">
                                    <p>{{ __('Wind Speed') }}: {{ $day->wind_speed }} {{ __('m/s') }}</p>
                                </div>
                                <div class="flex items-center mb-2">
                                    <img src="{{ asset('images/clouds-icon.png') }}" alt="Clouds Icon" class="w-6 h-6 mr-2">
                                    <p>{{ __('Clouds') }}: {{ $day->clouds }} %</p>
                                </div>
                                <div class="flex items-center mb-2">
                                    <img src="{{ asset('images/humidity-icon.png') }}" alt="Humidity Icon" class="w-6 h-6 mr-2">
                                    <p>{{ __('Humidity') }}: {{ $day->humidity }} %</p>
                                </div>
                                <div class="flex items-center mb-2">
                                    <img src="{{ asset('images/pressure-icon.png') }}" alt="Pressure Icon" class="w-6 h-6 mr-2">
                                    <p>{{ __('Pressure') }}: {{ $day->pressure }} {{ __('mmHg') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endif
</x-container>
    
@endsection

@section('scripts')
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    @if ($groupedWeather->isEmpty())
        showAlert(
            'warning', 
            '{{ __("No Weather Data Available") }}', 
            '{{ __("There is no weather data for the selected period. Please select a different date range.") }}',
            '{{ __("Ok") }}'
        );
    @endif
});

$(document).ready(function() {
    var ctx = document.getElementById('weatherChart').getContext('2d');
    var weatherChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($graphData["dates"]) !!},
            datasets: [
                {
                    label: "{{ __('Temperature') }} (°C)",
                    data: {!! json_encode($graphData["temperatures"]) !!},
                    borderColor: '#2563EB',
                    borderWidth: 3
                },
                {
                    label: "{{ __('Wind Speed') }} ({{ __('m/s')}})",
                    data: {!! json_encode($graphData["windSpeeds"]) !!},
                    borderColor: '#D97706',
                    borderWidth: 3
                    
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: '{{ __("Value") }}'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: '{{ __("Date") }}'
                    }
                }
            }
        }
    });
});
</script>
@endsection
