@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endpush

@section('scripts')
    <script src="{{ asset('js/login.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="content">
        <form onsubmit="checkLogin()" method="POST">
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
    

