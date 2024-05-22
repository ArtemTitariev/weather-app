@props(['route', ])

<a {{ $attributes->merge([
    'href' => '#',
    'class' => "text-gray-700 hover:text-primary mx-2 @php request()->routeIs($route) ? 'text-primary font-semibold' : ''@endphp "
    ]) }} >
    {{ $slot }}
</a>