@props(['message'])

<p {{ $attributes->merge([
    'class' => 'text-danger text-sm mt-1'
    ]) }}>
    {{ $message }}
</p>
