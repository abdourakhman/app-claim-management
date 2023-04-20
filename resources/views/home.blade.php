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
          <a class="btn btn-primary btn-lg badge" href="{{route('customer.claim.create')}}" role="button">Déposer une réclamation</a>
        </p>
        @endcan
    </div>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>L'opération a bien été prise en compte !</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    {{-- END ENTETE CONTENU --}}

    {{-- BODY CONTENU --}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title card-primary card-outline"><strong>Notre vision</strong></h5>
                            <p class="card-text">
                                Apporter au quotidien des services essentiels de qualité aux citoyens et aux acteurs économiques dans un esprit d'efficience, d'innovation et de partenariat pour contribuer au développement durable de notre territoire d'ancrage.
                            </p>
                            <a href="https://client.lydec.ma/site/notre-vision" class="card-link">Plus d'informations...</a>
                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Notre mission</strong> </h5>
                            <p class="card-text">
                                Lydec est un opérateur de services publics qui gère la distribution d'eau et d'électricité, la collecte des eaux usées et pluviales et l'éclairage public pour 4,2 millions d'habitants de la région du Grand Casablanca (Maroc). Ces missions lui ont été confiées dans le cadre d'un contrat de gestion déléguée signé en 1997 par l'Autorité Délégante (Communes urbaines de Casablanca, Mohammedia et Aïn Harrouda), l'Autorité de Tutelle (Ministère de l'Intérieur) et le Délégataire (Lydec).
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Nos clients</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Pour toute demande d'information ou de dépannage, plusieurs canaux de contact sont mis à la disposition de nos clients : le Centre de Relation clientèle, les agences Lydec, l'agence en ligne, le blog Lydec, l'application mobile Lydec.</p>
                            <a href="https://client.lydec.ma/site/nos-clients" class="btn btn-primary">Plus de détail...</a>
                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Featured</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">Nos valeurs</h6>
                            <p class="card-text">Lydec est à l'écoute des clients pour anticiper leurs attentes et répondre à leurs besoins afin de construire avec eux une relation de confiance.</p>
                            <a href="https://client.lydec.ma/site/nos-valeurs-1" class="btn btn-primary">En savoir d'avantage</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END BODY CONTENU --}}
</div>
@endsection