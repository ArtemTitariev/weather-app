@extends('layouts.app')

@section('title'){{ __('Cities') }}@endsection

@section('resources')
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-4 text-center">Search for Weather Data</h1>

    <div class="grid grid-cols-3 gap-4 mb-4">
        <div class="bg-blue-100 p-4 rounded text-center">
            <h2 class="font-bold text-xl">Крок 1</h2>
            <p>Оберіть дати</p>
        </div>
        <div class="bg-blue-100 p-4 rounded text-center">
            <h2 class="font-bold text-xl">Крок 2</h2>
            <p>Оберіть місто</p>
        </div>
        <div class="bg-blue-100 p-4 rounded text-center">
            <h2 class="font-bold text-xl">Крок 3</h2>
            <p>Виконайте пошук</p>
        </div>
    </div>

    <form method="GET" action="{{ route('weather.index') }}">
        @csrf
        <x-forms.input-container>
            <label for="start_date" class="block text-gray-700">Start Date</label>
            <input type="date" id="start_date" name="start_date" class="w-full p-2 border rounded mt-1" required>
        </x-forms.input-container>

        <x-forms.input-container>
            <label for="end_date" class="block text-gray-700">End Date</label>
            <input type="date" id="end_date" name="end_date" class="w-full p-2 border rounded mt-1" required>
        </x-forms.input-container>

        <x-forms.input-container>
            <label for="city_search" class="block text-gray-700">Search City</label>
            <input type="text" id="city_search" class="w-full p-2 border rounded mt-1" onkeyup="filterCities()" placeholder="Type to search...">
        </x-forms.input-container>

        <x-forms.button type="submit" class="mb-4">Search</x-forms.button>

        <div id="cities_list" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($cities as $city)
                <label class="city-card p-4 border rounded bg-white shadow block cursor-pointer">
                    <h2 class="text-xl font-bold">{{ $city->name }}</h2>
                    <p>Latitude: {{ $city->lat }}</p>
                    <p>Longitude: {{ $city->lon }}</p>
                    <input type="radio" name="city_id" value="{{ $city->id }}" required class="hidden">
                </label>
            @endforeach
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.city-card').click(function() {
            $('.city-card').removeClass('bg-blue-200 border-blue-500');
            $(this).addClass('bg-blue-200 border-blue-500');
        });

        $('#city_search').keyup(function() {
            let filter = $(this).val().toLowerCase();
            $('.city-card').each(function() {
                let city = $(this).text().toLowerCase();
                if (city.includes(filter)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
@endsection
