
@extends('layouts.master')
@include('partials.navbar')
@include('partials.sidebar')
@section('content')
<div class="content-wrapper">
    <div class="text-center">
        <img class="img-circle" style="width: 10%;" src="{{asset('img/images/logo.png')}}" alt="logo">
    </div>
    <hr class="w-50">
    <div class="row justify-content-center">
        <div class="col-md-11">
            @forelse ($claims as $claim)
            {{ $claim->designation}}
            @empty
                <h1>Aucune réclamation n'a été déposée !</h1>
            @endforelse
        </div>
    </div>
</div>
@endsection
