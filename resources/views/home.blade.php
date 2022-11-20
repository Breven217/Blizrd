@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endpush

@section('scripts')
    <script src="{{ asset('js/home.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="content">
        <div class="current-weather">
            <script type="text/javascript">
                let currentWeatherData = loadWeather()
             </script>
            @include('components.currentWeather')
        </div>
        <div class="alerts">
            @include('components.alerts')
        </div>
        <div class="forecast">
            @include('components.forecast')
        </div>
    </div>
@endsection
    

