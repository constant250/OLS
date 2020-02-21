@extends('layouts.admin')

@section('content')
    
    <div id="app">
        <familytype-detail></familytype-detail>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection