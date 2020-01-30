@extends('layouts.admin')

@section('content')

    <div id="app">
        <familytype-list></familytype-list>
    </div>

@endsection

@section('custom-js')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection