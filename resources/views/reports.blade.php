@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/reports.css') }}" rel="stylesheet">
@endpush

@section('scripts')
    <script src="{{ asset('js/reports.js') }}" type="text/javascript"></script>
@endsection

@section('content')
    <div class="content">
        <div class='reports-container'>
            <div class='report-buttons'>
                <button class="report-button" id="history-button" onclick="generateInstallationHistory()">
                    Installation History
                </button>
                <button class="report-button" id="performance-button" onclick="generateEmployeePerformance()">
                    Employee Performance
                </button>
            </div>
            <div id='report-content'>
            </div>
        </div>
    </div>
@endsection
    

