
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
                <div class="card-header text-center text-gray font-weight-bold">{{ __('AFFECTATION RECLAMATION') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('manager.claim.affect') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$claim->id}}" name='id'>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control " name="designation" value="{{ $claim->designation }}" readonly >
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-hashtag"></span>
                                </div>
                            </div>
                        </div>


                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="description" value="{{ $claim->description }}" readonly>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-info-circle"></span>
                                </div>
                            </div>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" readonly class="form-control " name="date" value="{{ $claim->date}}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-calendar"></span>
                                </div>
                            </div>
                        </div>
                        <hr style="height:10px; border:10px solid rgb(37 58 99); background-color:white;">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="inputGroupSelect01">Techniciens</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01" name=technicien>
                              @foreach ($techniciens as $technicien)
                                <option value="{{$technicien->id}}">
                                    {{$technicien->user->prenom}}
                                    {{$technicien->user->nom}} <br><br>
                                    -----  specialité:
                                    @foreach ($technicien->types as $type)
                                    {{$type->nom}}
                                    @endforeach
                                </option>
                              @endforeach
                            </select>
                          </div>
                        <div class="row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-block text-light" style="background-color: rgb(37 58 99);">
                                    {{ __("Affecter") }}
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
