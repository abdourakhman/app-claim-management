@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card  card-outline " style="border-top: 6px solid rgb(47 65 117);">
                <div class="card-header text-center text-gray font-weight-bold">{{ __('Inscription') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
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
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-id-card"></span>
                                </div>
                            </div>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="photo" value="{{ old('photo') }}" required autocomplete="photo" autofocus>
                              <label class="custom-file-label" for="inputGroupFile01">Ajouter une photo</label>
                              @error('photo')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                          </div>

                       

                        <div class=" col-4 input-group mb-3" >
                          
                        </div>

                        <div class=" input-group mb-3">
                            <div class="mr-5">
                                <label for="homme" class="px-2">Homme</label>
                                <input type="radio" name="sexe" class="px-2" id="homme" value="H">
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
                        <div class="row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-block text-light" style="background-color: rgb(37 58 99);">
                                    {{ __("S'inscrire") }}
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
