@extends('layouts.guest')

@section('title')
    <title>Websockets - connexion</title>
@endsection

@section('content')
       <div class="container" style="height: 80vh !important; display: flex; flex-content: center; align-items: center;">
       <form id="loginForm" class="mx-auto p-3 rounded" style="min-width: 350px;">
            <h4 class="text-danger text-center fw-bold"> Connexion </h4>
            <input type="email" id="email" class="form-control mb-3 mt-5" placeholder="ex: j.doe@gmail.com">
            <input type="password" id="password" class="form-control mb-4" placeholder="*****">
            <div class="d-flex justify-content-end">
                <a href="{{ route('register') }}" class="btn btn-secondary py-1 mx-2 w-50"> Inscription </a>
                <button type="submit" class="btn btn-primary py-1 mx-2 w-50"> Connexion </button>
            </div>
       </form>
    </div>
@endsection

@section('script')
    <script src="{{ asset("js/connect.js") }}" type="module"></script>
@endsection