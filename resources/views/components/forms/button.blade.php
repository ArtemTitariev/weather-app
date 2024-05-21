@props([
    'type' => 'submit',
    'class' => 'w-full bg-primary text-white p-2 rounded hover:bg-accent transition',
])

<button type="{{ $type }}" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</button>
