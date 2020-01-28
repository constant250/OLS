@extends('layouts.admin')

@section('content')

    <div id="app">
        <subdiscipline-list></subdiscipline-list>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection