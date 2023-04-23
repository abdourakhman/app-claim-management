
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
            @if($clients->count() !=0 )
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-12">
                            <h1 class="titre">Liste des réclamations en attente </h1>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content mt-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="timeline">
                                @foreach($clients as $client) 
                                @if ($reclamations->where('client_id',$client->id)->count() !=0 )   
                                <div class="time-label">
                                    <img src="{{Storage::url($client->photo_url)}}" class="img-circle elevation-2" alt="User Image" style="max-width:50px; heigth:10px;"> 
                                    <h5 class="text-secondary">{{$client->prenom}} {{$client->nom}} </h5>   
                                </div>
                                @endif    
                                @foreach ($reclamations->where('client_id', $client->id) as $claim)
                                    <div>
                                        <i class="fas fa-exclamation bg-red"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock">{{$claim->created_at}}</i> </span>
                                            <h3 class="timeline-header"><a href="#">{{$claim->designation}}</a></h3>
                                            <div class="timeline-body">
                                                <div><span class="badge badge-danger float-right">{{$claim->statut}}</span></div>
                                                {{$claim->description}}
                                            </div>
                                            <div class="timeline-footer">
                                                @if ($claim->statut == "en attente")    
                                                <a class=" btn btn-primary btn-success btn-sm" href="{{route('manager.claim.getFormAffect',$claim->claim_id)}}">Affecter à un technicien</a>
                                                @endif 
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                            
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif
            @if ($reclamations->where('client_id',$client->id)->count() ==0 )   
                <h1 class="titre mr-5 px-5">Aucune réclamation en attente de validation !</h1>
            @endif
        </div>
    </div>
</div>
@endsection
