@extends('layouts.app')

@section('title')
    <title>Websockets</title>
@endsection

@section('content')
    <div class="mt-5 mx-auto container shadow p-3">
        <h6> <span id="userConnected"> </span> connecté(s)</h6>
        <div id="messagerie" class="p-2 border rounded border-dark" style="max-height: 300px !important; min-height: 300px !important;overflow-y: scroll;"></div>
        <form class="my-3" id="messageForm">  
            <textarea id="contentMessage" cols="30" rows="5" class="form-control" required></textarea>
            <div class="d-flex justify-content-end mt-3">
                <button id="cancelBtn" class="btn btn-outline-secondary mx-4" type="button"> Annuler </button>
                <button class="btn btn-outline-primary" type="submit"> Envoyer </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ asset("js/app.js") }}"></script>
    <script src="{{ asset("js/account/disconnect.js") }}"></script>
    <script src="{{ asset("js/account/websockets.js") }}" type="module"></script>
@endsection