@extends('layouts.app')

@section('title'){{ __('Home') }}@endsection

@section('content')
@if (session('user'))
    <p>{{ session('api_token') }}</p>
    <p>{{ session('user')->name }}</p>
@endif
<div class="container mx-auto p-4">
    <h1 class="text-primary font-serif">Welcome to Laravel with Tailwind CSS</h1>
    <p class="font-mono">This is a paragraph with a monospace font.</p>
    <button class="bg-primary text-white py-2 px-4 rounded hover:bg-accent">Primary Button</button>
    <button class="bg-secondary text-white py-2 px-4 rounded hover:bg-secondary-dark">Secondary Button</button>
</div>
@endsection
