@extends('layouts.admin')

@section('content')

    <div id="app">
        <project-list></project-list>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection