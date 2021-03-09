@extends('layouts.guest')

@section('title')
    <title>Websockets - inscription</title>
@endsection

@section('content')
    <div class="container" style="height: 80vh !important; display: flex; flex-content: center; align-items: center;">
        <form id="inscriptionForm" class="w-50 mx-auto p-3 rounded">
            <h4 class="text-danger text-center fw-bold"> Inscription </h4>
            <input type="text" id="identity" class="form-control mt-5 mb-3" placeholder="Nom Prénom">
            <input type="email" id="email" class="form-control mb-3" placeholder="ex: j.doe@gmail.com">
            <input type="password" id="password" class="form-control mb-3" placeholder="*****">
            <input type="password" id="passwordConfirm" class="form-control mb-4" placeholder="*****">
            <div class="d-flex justify-content-end">
                <a href="{{ route('login') }}" class="btn btn-secondary py-1 mx-2"> Retour </a>
                <button type="submit" class="btn btn-primary py-1 mx-2"> Inscription </button>
            </div>
        </form>
   </div>
@endsection

@section('script')
    <script src="{{ asset("js/register.js") }}" type="module"></script>
@endsection