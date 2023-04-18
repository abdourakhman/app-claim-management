
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
                <div class="card-header text-center text-gray font-weight-bold">{{ __('CREATION UTILISATEUR') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" placeholder="prenom" class="form-control " name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>
                            <input type="text" placeholder="nom" class="form-control " name="nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>


                        <div class="input-group mb-3">
                            <input type="email" placeholder="Adresse e-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password"  placeholder="Mot de passe" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <input id="password-confirm" placeholder="Confirmez le mot de passe" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" placeholder="adresse" class="form-control " name="adresse" value="{{ old('adresse') }}" required autocomplete="adresse" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-home"></span>
                                </div>
                            </div>
                            <input type="text" placeholder="telephone" class="form-control " name="telephone" value="{{ old('telephone') }}" required autocomplete="telephone" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="inputGroupSelect01">Profil</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01" name=profil>
                              <option selected>Choisir un profil</option>
                              <option value="admin">Administrateur</option>
                              <option value="gestionnaire">Manager</option>
                              <option value="client">Client</option>
                            </select>
                          </div>

                        
                        
                        <div class=" input-group mb-3">
                            <div class="mr-5">
                                <label for="homme" class="px-2">Homme</label>
                                <input type="radio" name="sexe" class="px-2" id="homme" value="H" checked>
                                <label for="femme" class="px-2 col-form-label">Femme</label>
                                <input class="px-2"  type="radio" name="sexe" id="femme" value="F">
                            </div>
                            <label for="naissance" class=" col-form-label px-2 @error('naissance') is-invalid @enderror" name="naissance">{{ __('Date Naissance') }}</label>
                            <input type="date" placeholder="Date de naissance" class="form-control" name="naissance" value="{{ old('naissance') }}" required autocomplete="naissance" autofocus>
                            @error('naissance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3 w-100">
                            <input type="file" style="width:94%;" class="form-control-file px-0 border  @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}" autofocus>
                            <div class="input-group-append" style="width:6%;">
                                <div class="input-group-text">
                                    <span class="fas fa-id-card"></span>
                                </div>
                            </div>
                            @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-block text-light" style="background-color: rgb(37 58 99);">
                                    {{ __("Créer l'utilisateur") }}
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
