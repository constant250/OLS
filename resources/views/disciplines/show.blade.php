@extends('layouts.admin')

@section('content')


    <div id="app">
       <discipline-detail></discipline-detail>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection