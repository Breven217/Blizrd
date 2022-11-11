@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endpush

@section('content')
    <h2>Login</h2>
    <form>
        <input type="text" name="username" id="username">
        <input type="password" name="password" id="password">
        <input type="button" value="Login" name="login-button">
    </form>
@endsection
    

