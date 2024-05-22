@extends('layouts.app')

@section('title'){{ __('Home page') }}@endsection

@section('content')

<div class="container mx-auto mt-8">
    <x-home.banner />
    <x-home.features />
    <x-home.call-to-action />
</div>

@endsection
