@extends('layouts.app')

@section('title'){{ __('Cities') }}@endsection

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-4 text-center">Search for Weather Data</h1>

    <form method="GET" action="{{ route('weather.index') }}">
        @csrf
        <div class="mb-4">
            <label for="start_date" class="block text-gray-700">Start Date</label>
            <input type="date" id="start_date" name="start_date" class="w-full p-2 border rounded mt-1" required>
        </div>

        <div class="mb-4">
            <label for="end_date" class="block text-gray-700">End Date</label>
            <input type="date" id="end_date" name="end_date" class="w-full p-2 border rounded mt-1" required>
        </div>

        <div class="mb-4">
            <label for="city_search" class="block text-gray-700">Search City</label>
            <input type="text" id="city_search" class="w-full p-2 border rounded mt-1" onkeyup="filterCities()" placeholder="Type to search...">
        </div>

        <div id="cities_list" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($cities as $city)
                <div class="city-card p-4 border rounded bg-white shadow">
                    <h2 class="text-xl font-bold">{{ $city->name }}</h2>
                    <p>Latitude: {{ $city->lat }}</p>
                    <p>Longitude: {{ $city->lon }}</p>
                    <input type="radio" name="city_id" value="{{ $city->id }}" required>
                </div>
            @endforeach
        </div>

        <button type="submit" class="w-full bg-primary text-white p-2 rounded hover:bg-accent mt-4 transition">Search</button>
    </form>
</div>

<script>
function filterCities() {
    let input = document.getElementById('city_search');
    let filter = input.value.toLowerCase();
    let nodes = document.getElementsByClassName('city-card');

    for (let i = 0; i < nodes.length; i++) {
        if (nodes[i].innerText.toLowerCase().includes(filter)) {
            nodes[i].style.display = "block";
        } else {
            nodes[i].style.display = "none";
        }
    }
}
</script>
@endsection
