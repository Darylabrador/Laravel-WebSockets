@extends('layouts.app')

@section('title')
    <title>Websockets</title>
@endsection

@section('content')
    <div id="messagerie"></div>
@endsection

@section('script')
    <script src="{{ asset("js/app.js") }}"></script>
    <script src="{{ asset("js/account/disconnect.js") }}"></script>
    <script src="{{ asset("js/account/websockets.js") }}" type="module"></script>
@endsection