@extends('layouts.admin')

@section('content')

    <div id="app">
        <category-detail></category-detail>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection