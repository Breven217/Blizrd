@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/installations.css') }}" rel="stylesheet">
@endpush

@section('scripts')
    <script src="{{ asset('js/installations.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="content">
       this is the installations page
    </div>
@endsection
    

