@props(['message', 'class' => ''])

<p class="text-danger text-sm mt-1 {{ $class }}">
    {{ $message }}
</p>
