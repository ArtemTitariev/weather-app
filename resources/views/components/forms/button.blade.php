<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'w-full bg-primary text-white p-2 rounded hover:bg-accent transition'
    ]) }}>
    {{ $slot }}
</button>
