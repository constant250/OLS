@extends('layouts.admin')

@section('content')
    
    <div id="app">
        <family-detail></family-detail>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection