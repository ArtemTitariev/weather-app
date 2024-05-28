@props(['src', 'alt', 'text'])

<div {{ $attributes->merge(['class' => 'flex items-center mb-2']) }}>
    <x-weather.data.img :src="$src" :alt="$alt" />
    <x-weather.data.p>{{ $text }}</x-weather.data.p>
</div>
