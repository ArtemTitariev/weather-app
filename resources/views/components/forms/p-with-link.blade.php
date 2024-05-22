@props([
    'text' => '',
    'linkText' => '',
    'href' => '#',
])

<p {{ $attributes->merge([
    'class' => 'mt-4 text-center text-gray-600'
    ]) }}>
    {{ $text }} <x-link :href="$href">{{ $linkText }}</x-link>
</p>
