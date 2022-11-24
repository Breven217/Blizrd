@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/installations.css') }}" rel="stylesheet">
@endpush

@section('scripts')
    <script src="{{ asset('js/installations.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="content">
        <div class='installations-table'>
            <i class="fa-regular fa-snowflake fa-spin fa-4x vertical-center"></i>
        </div>
        <div class="installation-buttons">
            <button id="add-installation-button" onclick="">
                Add installation
            </button>
        </div>
    </div>
@endsection
    

