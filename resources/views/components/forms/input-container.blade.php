@props(['class' => 'mb-4'])

<div {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>
