@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endpush

@section('scripts')
    <script src="{{ asset('js/home.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="content">
        <div><i class="fa-regular fa-snowflake fa-spin fa-4x"></i></div>
    </div>
    <script type="text/javascript">
        loadWeather()
     </script>
@endsection
    

