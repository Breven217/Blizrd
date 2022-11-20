@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endpush

@section('scripts')
    <script src="{{ asset('js/home.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="content">
        <script type="text/javascript">
            let currentWeatherData = loadWeather()
         </script>
        <div class="current-weather">
            @include('components.currentWeather')
        </div>
        <div class="forecast">
            @include('components.forecast')
        </div>
    </div>
@endsection
    

