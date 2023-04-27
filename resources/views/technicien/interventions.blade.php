@extends('layouts.master')
@include('partials.navbar')
@include('partials.sidebar')
@section('content')
<div class="content-wrapper" style="min-height:112px;">
    <section class="content">
        <h1 class="titre mb-3 badge badge-info">LISTE DES INTERVENTIONS</h1>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-12 d-flex align-items-stretch flex-column">
                   @foreach ($technicien->interventions as $intervention)     
                   <div class="card bg-light d-flex flex-fill">
                       <div class="card-header text-muted border-bottom-0">
                        <span>{{$intervention->reclamation->designation}}  </span>
                        <span class="badge badge-danger"> ITV{{date('Ymd')}} </span> //
                        <span class="badge badge-primary px-3">
                            {{$intervention->statut}}
                        </span>
                       </div>
                       <div class="float-right">
                        
                       </div>
                       <div class="card-body pt-0">
                           <div class="row">
                               <div class="col-9">
                                   <h2 class="lead"><b>{{$intervention->reclamation->client->user->prenom}} {{$intervention->reclamation->client->user->nom}}    
                                </b></h2>
                                   <p class="text-muted text-sm"><b>Description: </b> {{$intervention->reclamation->description}}  </p>
                                   <ul class="ml-4 mb-0 fa-ul text-muted">
                                       <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Adresse: {{$intervention->reclamation->client->user->adresse}}  </li>
                                       <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mobile"></i></span>{{$intervention->reclamation->client->user->telephone}}  </li>
                                   </ul>
                               </div>
                               <div class="col-3 text-center">
                                <img src="{{Storage::url($intervention->reclamation->client->user->photo_url)}}" class="img-circle elevation-2" alt="User Image" style="max-width:80px;"> 
                            </div>
                           </div>
                       </div>
                       <div class="card-footer">
                           <div class="text-right">
                            @if ($intervention->statut == "en attente")
                            <a href="{{route('technicien.claim.solve',$intervention->id)}}" class="btn btn-sm btn-primary">
                                <i class="fas fa-thumbs-up"></i> Entammer l'intervention
                            </a>
                            @endif
                           </div>
                       </div>
                   </div>
                   @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
