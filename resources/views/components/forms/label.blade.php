@props(['for', 'class' => ''])

<label for="{{ $for }}" class="block text-gray-700 {{ $class }}">
    {{ $slot }}
</label>
