@extends('layouts.admin')

@section('content')

    <div id="app">
       <discipline-list></discipline-list>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection