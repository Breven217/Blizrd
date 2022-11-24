@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endpush

@section('scripts')
    <script src="{{ asset('js/login.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="content">
        <div id="login-error">
            Invalid username or password 
        </div>
        <form onsubmit="checkLogin(event)" method="POST">
            @csrf
            <input type="text" name="username" id="username" required>
            <input type="password" name="password" id="password" required>
            <button name="login-button" class="login-button">
                <span>
                    Login
                </span>
            </button>
        </form>
    </div>
@endsection
    

