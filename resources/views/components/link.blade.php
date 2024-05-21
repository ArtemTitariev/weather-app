@props([
    'href' => '#',
    'class' => 'text-primary hover:text-accent',
])

<a href="{{ $href }}" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</a>
