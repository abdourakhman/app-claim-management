@extends('layouts.master')
@include('partials.navbar')
@include('partials.sidebar')
@section('content')
<div class="content-wrapper">
    {{-- ENTETE CONTENU --}}
    <div class="jumbotron py-2">
        <h1 class="display-4">Bienvenue, {{Auth::user()->prenom}}</h1>
        @can('client')    
        <p class="lead">
           <span> <Strong>LydecResolver</Strong> est une plateforme moderne développée suite à la demande de nos clients pour pouvoir leur apporter notre aide le plus rapidement possible
            et sans qu'ils aient à se déplacer...    
            </span>
        </p>
        <hr class="my-2">
        <p>Ici, vous pouvez déposer et suivre l'état de vos réclamations en toute simplicité... </p>
        <p class="lead">
          <a class="btn btn-primary btn-lg badge" href="#" role="button">Déposer une réclamation</a>
        </p>
        @endcan
    </div>
    {{-- END ENTETE CONTENU --}}

    {{-- BODY CONTENU --}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">
                                {{(Auth::user()->photo_url)}}
                            </p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">
                                Some quick example text to build on the card title and make up the bulk of the card's
                                content.
                            </p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Featured</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">Special title treatment</h6>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Featured</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">Special title treatment</h6>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END BODY CONTENU --}}
</div>
@endsection