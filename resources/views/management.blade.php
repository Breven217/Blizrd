@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/management.css') }}" rel="stylesheet">
@endpush

@section('scripts')
    <script src="{{ asset('js/management.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="content">
        <div>        
            <form onsubmit="checkLogin(event)" method="POST">
                <input type="text" name="query" id="search-bar">
                <button id="add-user-button" class="management-button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>

            <button id="add-user-button" class="management-button">
                Add Employee
            </button>
        </div>
    </div>
@endsection
    

