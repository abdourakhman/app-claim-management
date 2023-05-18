
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
            @if($claims->count() !=0 )
            <section class="content-header mt-0">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Historique</h1>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content mt-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="timeline">
                                @foreach($claimsDay as $claimDay)     
                                <div class="time-label">
                                    <span class="bg-red">{{$claimDay->date}}</span>
                                </div>
                                @foreach ($claims as $claim)
                                @if ($claim->date == $claimDay->date)
                                    <div>
                                        <i class="fas fa-envelope bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock">{{$claim->created_at}}</i> </span>
                                            <h3 class="timeline-header"><a href="#">{{$claim->designation}} <p class="text-end p-0 m-0 "><a href="#" class="badge badge-secondary">{{$claim->statut}}</a></a></p></h3>
                                            <div class="timeline-body">
                                                {{$claim->description}}
                                            </div>
                                            @if ($claim->statut == 'en attente')    
                                            <div class="timeline-footer">
                                                <a href="{{route('customer.claim.abort',$claim->id)}}" class="btn btn-danger btn-sm offset-11">Annuler</a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="pagination">{{$claims->links()}}</div>
                </div>
            </section>
            @endif
            @if($claims->count() == 0)
                <h1 class="titre mr-5 px-5">Aucune réclamation n'a été déposée !</h1>
            @endif
        </div>
    </div>
</div>
@endsection
