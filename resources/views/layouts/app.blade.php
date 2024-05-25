<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    @vite('resources/css/app.css')
    <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @yield('resources')
</head>
<body class="bg-light font-sans min-h-screen flex flex-col">
    <x-navbar />
    
    <main class="flex-grow">
        @yield('content') 
    </main>
    <x-footer/>
    @vite('resources/js/app.js')
    @yield('scripts')
</body>
</html>