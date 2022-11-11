@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endpush

@section('content')
    <h3>{{$gamer}}</h1>
    <div>Log me in baby</div>
@endsection
    

