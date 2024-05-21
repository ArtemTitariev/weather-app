<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Login') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-light font-sans">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center text-primary">{{ __('Login') }}</h1>
            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">{{ __('Email') }}</label>
                    <input type="email" id="email" name="email" class="w-full p-2 border rounded mt-1 @error('email') border-danger @enderror" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">{{ __('Password') }}</label>
                    <input type="password" id="password" name="password" class="w-full p-2 border  rounded mt-1 @error('email') border-danger @enderror" required>
                    @error('email')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full bg-primary text-white p-2 rounded hover:bg-accent transition">{{ __('Login') }}</button>
            </form>
            <p class="mt-4 text-center text-gray-600">{{ __("Don't have an account?") }} <a href="{{ route('register') }}" class="text-primary hover:text-accent">{{ __('Register') }}</a></p>
        </div>
    </div>
</body>
</html>
