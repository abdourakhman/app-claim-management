
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
                <div class="card-header text-center text-gray font-weight-bold">{{ __('DEPOT RECLAMATION') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('customer.claim.save') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" placeholder="Désignation" class="form-control " name="designation" value="{{old('designation')}}" required autocomplete="designation" autofocus>
                        </div>


                        <div class="input-group mb-3">
                            <textarea name="description"  class="form-control" value="{{old('description')}}" id="description" cols="30" rows="10" placeholder="Ajouter une description...."></textarea>
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
                                    {{ __("Envoyer la réclamation") }}
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
