@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/management.css') }}" rel="stylesheet">
@endpush

@section('scripts')
    <script src="{{ asset('js/management.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="content">
        <div id="search-container"> 
            <button id="add-user-button" class="management-button">
                Add Employee
            </button>       

            <form onsubmit="">
                <input type="text" name="query" id="search-bar">
                <button id="add-user-button" class="management-button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        
        <div id="employee-table" style="background-color: aqua;">
            Search for employee/user above
        </div>
    </div>
@endsection
    

