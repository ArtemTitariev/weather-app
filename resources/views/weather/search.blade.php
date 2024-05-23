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
        <div id="step-1" class="bg-primary text-white p-4 rounded text-center">
            <h2 class="font-bold text-xl">Крок 1</h2>
            <p>Оберіть дати</p>
        </div>
        <div id="step-2" class="bg-primary text-white p-4 rounded text-center">
            <h2 class="font-bold text-xl">Крок 2</h2>
            <p>Оберіть місто</p>
        </div>
        <div id="step-3" class="bg-primary text-white p-4 rounded text-center">
            <h2 class="font-bold text-xl">Крок 3</h2>
            <p>Виконайте пошук</p>
        </div>
    </div>

    <form method="GET" action="{{ route('weather.index') }}" id="search-form" class="mb-4">
        @csrf
        <x-forms.input-container>
            <x-forms.label for="start_date" class="block text-gray-700">Start Date</x-forms.label>
            <x-forms.input type="date" id="start_date" name="start_date" required />
        </x-forms.input-container>

        <x-forms.input-container>
            <x-forms.label for="end_date" class="block text-gray">End Date</x-forms.label>
            <x-forms.input type="date" id="end_date" name="end_date" required />
        </x-forms.input-container>

        <x-forms.input-container>
            <x-forms.label for="city_search" class="block text-gray ">Search City</x-forms.label>
            <x-forms.input type="text" id="city_search" name="city_search" placeholder="Type to search..." />
        </x-forms.input-container>
        
        <x-forms.input-container>
            <x-forms.button type="submit" id="submit-button" disabled class="bg-primary text-white hover:bg-accent">Search</x-forms.button>
        </x-forms.input-container>

        <div id="cities_list" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($cities as $city)
                <label class="city-card p-4 border border-primary rounded bg-white shadow block cursor-pointer">
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

function checkRequiredFields(formId) {
    let isFormValid = true;

    $(`#${formId} [required]`).each(function() {
        const fieldType = $(this).attr('type');

        if (fieldType === 'radio' || fieldType === 'checkbox') {
            if (!$(`input[name="${$(this).attr('name')}"]:checked`).length) {
                isFormValid = false;
            }
        } else if ($(this).is('select')) {
            if ($(this).val() === null || $(this).val() === '') {
                isFormValid = false;
            }
        } else {
            if ($(this).is(':invalid') || $(this).val() === '') {
                isFormValid = false;
            }
        }
    });

    return isFormValid;
}

function checkFormValidity(formId) {
    let isFormValid = checkRequiredFields(formId);
    $(`#${formId} #submit-button`).prop('disabled', !isFormValid);

    if (isFormValid) {
        $(`#${formId} #submit-button`).removeClass('bg-gray cursor-not-allowed').addClass('bg-primary hover:bg-accent cursor-pointer');
    } else {
        $(`#${formId} #submit-button`).removeClass('bg-primary hover:bg-accent cursor-pointer').addClass('bg-gray cursor-not-allowed');
    }

    updateStepStyles(formId);
}

function updateStepStyles(formId) {
    if ($(`#${formId} #start_date`).val() && $(`#${formId} #end_date`).val()) {
        $('#step-1').removeClass('bg-primary').addClass('bg-secondary');
    } else {
        $('#step-1').removeClass('bg-secondary').addClass('bg-primary');
    }

    if ($(`#${formId} input[name="city_id"]:checked`).length > 0) {
        $('#step-2').removeClass('bg-primary').addClass('bg-secondary');
    } else {
        $('#step-2').removeClass('bg-secondary').addClass('bg-primary');
    }
}

function combined(formId) {
    checkFormValidity(formId);
    updateStepStyles(formId);
}

$(document).ready(function() {
    const formId = 'search-form';

    $('.city-card').click(function() {
        $('.city-card').removeClass('border-secondary').addClass('border-primary');
        $('.city-card h2').removeClass('text-secondary');

        $(this).removeClass('border-primary').addClass('border-secondary');
        $(this).find('h2').addClass('text-secondary');
        $(this).find('input[type="radio"]').prop('checked', true);
        // checkFormValidity(formId);
        combined(formId);
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

    checkFormValidity(formId);
    $(`#${formId} [required]`).on('change keyup', function() {
        combined(formId);
    });

});
</script>
@endsection
