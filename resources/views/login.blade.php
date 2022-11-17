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
            <div class="tooltip" id="username">
                <input type="text" name="username">
                <span class="tooltiptext">Tooltip text</span>
            </div>
            <input type="password" name="password" id="password">
            <button name="login-button" class="login-button">
                <span>
                    Login
                </span>
            </button>
        </form>
    </div>
@endsection
    

