@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/login.js') }}" type="text/javascript"></script>
@endpush

@section('content')
    <div class="content">
        <form onsubmit="checkLogin()">
            <input type="text" name="username" id="username">
            <input type="password" name="password" id="password">
            <button name="login-button" class="login-button">
                <span>
                    Login
                </span>
            </button>
        </form>
    </div>
@endsection
    

