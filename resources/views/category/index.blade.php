@extends('layouts.admin')

@section('content')

    <div id="app">
        <category-list></category-list>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection