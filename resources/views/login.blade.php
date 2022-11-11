@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content">
        <h1>Login</h1>
        <form>
            <input type="text" name="username" id="username">
            <input type="password" name="password" id="password">
            <input type="button" value="Login" name="login-button" id="login-button">
        </form>
    </div>
@endsection
    

