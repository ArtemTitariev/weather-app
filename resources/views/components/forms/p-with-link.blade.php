@props([
    'text' => '',
    'linkText' => '',
    'href' => '#',
    'class' => 'mt-4 text-center text-gray-600'
])

<p {{ $attributes->merge(['class' => $class]) }}>
    {{ $text }} <x-link :href="$href">{{ $linkText }}</x-link>
</p>
