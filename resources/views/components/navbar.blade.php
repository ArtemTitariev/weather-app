<nav class="bg-white shadow-md p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-primary font-bold text-xl">{{ env('APP_NAME') }}</a>
        <div>
            <x-navbar-link href="{{ route('home') }}" route="home">{{ __('Home') }}</x-navbar-link>
            @guest
                <x-navbar-link href="{{ route('login') }}" route="login">{{ __('Login') }}</x-navbar-link>
                <x-navbar-link href="{{ route('register') }}" route="register">{{ __('Register') }}</x-navbar-link>
            @endguest
            @auth
                <x-navbar-link href="{{ route('logout') }}" route="logout">{{ __('Cities') }}</x-navbar-link>
                <x-navbar-link href="{{ route('logout') }}" route="logout">{{ __('Weather') }}</x-navbar-link>
                <x-navbar-link href="{{ route('logout') }}" route="logout">{{ __('Logout') }}</x-navbar-link>
            @endauth
        </div>
    </div>
</nav>
