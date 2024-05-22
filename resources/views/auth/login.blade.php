@extends('layouts.base')

@section('title'){{ __('Login') }}@endsection

@section('content')
<x-navbar />

<div class="min-h-screen flex items-center justify-center">
    <x-forms.container>
        <x-forms.header>{{ __('Login') }}</x-forms.header>

        <x-forms.error-list />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <x-forms.input-container>
                <x-forms.label for="email">{{ __('Email') }}</x-forms.label>
                <x-forms.input type="email" name="email" />
            </x-forms.input-container>

            <x-forms.input-container>
                <x-forms.label for="password">{{ __('Password') }}</x-forms.label>
                <x-forms.input type="password" name="password" />
            </x-forms.input-container>

            <x-forms.button>{{ __('Login') }}</x-forms.button>
        
        </form>
        <x-forms.p-with-link
            text="{{ __('Do not have an account?') }}"
            linkText="{{ __('Register') }}"
            href="{{ route('register') }}"
        />
    </x-forms.container>
</div>
@endsection
