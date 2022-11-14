@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endpush

@section('scripts')
    <script src="{{ asset('js/login.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="content">
        <div>This is the home page!</div>
    </div>
@endsection
    

