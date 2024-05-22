<h1 {{ $attributes->merge([
    'class' => 'text-2xl font-bold mb-6 text-center text-primary'
    ]) }}>
    {{ $slot }}
</h1>