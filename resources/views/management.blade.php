@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endpush

@section('scripts')
    <script src="{{ asset('js/home.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="content">
        this is the management page
    </div>
@endsection
    

