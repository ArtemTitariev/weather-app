@props(['class' => 'bg-white p-8 rounded-lg shadow-md w-full max-w-md'])

<div {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>

