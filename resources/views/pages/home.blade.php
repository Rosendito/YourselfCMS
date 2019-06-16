@extends('layouts.app')

@section('styles')

    <style>
        .hero{ background-image: url("{{ asset('img/home-hero.jpg') }}") }
    </style>

@endsection

@section('content')

    @include('layouts.header')

    @include('pages.home_parts.hero')

    @include('pages.home_parts.news', ['articles' => $articles])

    <div class="container"><i class="separator"></i></div>

    @include('pages.home_parts.events', ['events' => $events])
    
    <div class="container"><i class="separator"></i></div>

    @include('pages.home_parts.academics')

    @include('pages.home_parts.newletter')

    @include('layouts.footer')

@endsection
