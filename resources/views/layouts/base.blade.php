<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    @vite('resources/css/app.css')
    @yield('resources')
</head>
<body class="bg-light font-sans min-h-screen flex flex-col">
    <main class="flex-grow">

        @yield('content')

    </main>

    @vite('resources/js/app.js')
    @yield('scripts')
</body>
</html>
