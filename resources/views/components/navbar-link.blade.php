@props(['href' => '#', 'route', ])

<a href="{{ $href }}" class="text-gray-700 hover:text-primary mx-2 {{ request()->routeIs($route) ? 'text-primary font-semibold' : ''}} ">
    {{ $slot }}
</a>