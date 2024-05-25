<div class="mt-8">
    <h2 class="text-2xl font-bold text-center text-primary mb-4">{{ __('Features') }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="flex flex-col justify-center items-center space-y-8">
            <x-home.feature-card title="{{ __('Accurate Data') }}" description="{{ __('Get precise historical weather data for cities.') }}" />
            <x-home.feature-card title="{{ __('User-friendly Interface') }}" description="{{ __('Navigate through the app with ease and efficiency.') }}" />
            <x-home.feature-card title="{{ __('Detailed Reports') }}" description="{{ __('Access detailed weather reports and analysis.') }}" />
        </div>
        <div class="flex flex-col justify-center items-center ">
            <div class="mb-8">
                <img alt="Screenshot 1" class="rounded-lg shadow-md mb-4 max-w-full h-auto" src="{{ asset('images/feature1.png') }}">
                <p class="text-secondary text-center text-xl">{{ __('Weather data') }}</p>
            </div>
            <div class="mb-8">
                <img alt="Screenshot 2" class="rounded-lg shadow-md mb-4 max-w-full h-auto" src="{{ asset('images/feature2.png') }}">
                <p class="text-secondary text-center text-xl">{{ __('Graphic representation') }}</p>
            </div>
        </div>
    </div>
</div>
