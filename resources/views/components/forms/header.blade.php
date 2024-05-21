@props(['class' => 'text-2xl font-bold mb-6 text-center text-primary'])

<h1 {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</h1>