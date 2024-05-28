@props(['src', 'alt', 'title', 'text'])

<div {{ $attributes->merge(['class' => 'bg-light p-4 rounded shadow flex items-center']) }}>
    <x-weather.avg.img :src="$src" :alt="$alt" />
    <div>
        <x-weather.avg.h>{{ $title }}</x-weather.avg.h>
        <x-weather.avg.p>{{ $text }}</x-weather.avg.p>
    </div>
</div>
