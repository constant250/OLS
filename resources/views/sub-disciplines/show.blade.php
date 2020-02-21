@extends('layouts.admin')

@section('content')

    
    
    <div id="app">
        <subdiscipline-detail></subdiscipline-detail>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection