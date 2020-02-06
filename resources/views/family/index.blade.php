@extends('layouts.admin')

@section('content')

    <div id="app">
        <family-list></family-list>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection