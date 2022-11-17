@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endpush

@section('scripts')
    <script src="{{ asset('js/login.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="content">
        <form onsubmit="checkLogin(event)" method="POST">
            @csrf
            <div class="tooltip">
                <span class="tooltiptext">Tooltip text</span>
                <input type="text" name="username" id="username">
            </div>
            <div class="tooltip">
                <span class="tooltiptext">Tooltip text</span>
                <input type="password" name="password" id="password">
            </div>
            <button name="login-button" class="login-button">
                <span>
                    Login
                </span>
            </button>
        </form>
    </div>
@endsection
    

