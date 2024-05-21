<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Register') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-light font-sans">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center text-primary">{{ __('Register') }}</h1>
            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">{{ __('Name') }}</label>
                    <input type="text" id="name" name="name" class="w-full p-2 border rounded mt-1 @error('name') border-danger @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">{{ __('Email') }}</label>
                    <input type="email" id="email" name="email" class="w-full p-2 border rounded mt-1 @error('email') border-danger @enderror" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">{{ __('Password') }}</label>
                    <input type="password" id="password" name="password" class="w-full p-2 border rounded mt-1 @error('password') border-danger @enderror" required>
                    @error('password')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700">{{ __('Confirm password') }}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-2 border rounded mt-1 @error('password_confirmation') border-danger @enderror" required>
                    @error('password_confirmation')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <button type="submit" class="w-full bg-primary text-white p-2 rounded hover:bg-accent transition">{{ __('Register') }}</button>
            </form>
            <p class="mt-4 text-center text-gray-600">{{ __('Already have an account?') }} <a href="{{ route('login') }}" class="text-primary hover:text-accent">{{ __('Login') }}</a></p>
        </div>
    </div>
</body>
</html>
