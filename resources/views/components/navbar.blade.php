<nav class="bg-white shadow-md p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-primary font-bold text-xl">{{ env('APP_NAME') }}</a>
        <div class="flex items-center">
            @if (Session::has('user')) 
                <p class="mr-4 text-accent"> {{ __('Hello, ') . Session::get('user')->name . '!' }} </p>
            @endif
            <x-navbar-link href="{{ route('home') }}" route="home">{{ __('Home') }}</x-navbar-link>
            @if (Session::get('user')?->access_token) 
                <x-navbar-link href="{{ route('weather.search') }}" route="weather.search">{{ __('Cities') }}</x-navbar-link>
                <x-navbar-link href="{{ route('logout') }}" route="logout">{{ __('Logout') }}</x-navbar-link>
            @else
                <x-navbar-link href="{{ route('login') }}" route="login">{{ __('Login') }}</x-navbar-link>
                <x-navbar-link href="{{ route('register') }}" route="register">{{ __('Register') }}</x-navbar-link>
            @endif
        </div>
    </div>
</nav>
