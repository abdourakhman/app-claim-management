
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
            <div class="card  card-outline " style="border-top: 6px solid rgb(47 65 117);">
                <div class="card-header text-center text-gray font-weight-bold">FICHE INTERVENTION[{{$intervention->id}}]</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('technicien.save.fiche') }}">
                        @csrf
                        <input type="text"  name="user_id" hidden value="{{Auth::user()->id}}">
                        <input type="text"  name="intervention_id" hidden value="{{$intervention->id}}">
                        <div class="input-group mb-3">
                            <input type="text" placeholder="Désignation" class="form-control " name="designation" 
                            value="{{$intervention->reclamation->designation}} chez {{$intervention->reclamation->client->user->prenom}} {{$intervention->reclamation->client->user->nom}} à {{$intervention->reclamation->client->user->adresse}} "  readonly
                            >
                        </div>


                        <div class="input-group mb-3">
                            <textarea name="detail"   required class="form-control" value="{{old('description')}}" id="detail" cols="30" rows="4" autofocus placeholder="Donner les détails de l'intervention...."></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <textarea name="suggestion"  class="form-control" value="{{old('suggestion')}}" id="suggestion" cols="30" rows="4" placeholder="Suggérer une astuce pour une intervention de même nature..."></textarea>
                        </div>


                        <div class="input-group mb-3">
                            <input type="text"  class="form-control " name="date" value="<?= date('Y-m-d')?> "  readonly>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-calendar"></span>
                                </div>
                            </div>
                        </div>        
                        
                        <div class="row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-block text-light" style="background-color: rgb(37 58 99);">
                                    {{ __("Enregister") }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
