
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
                <div class="card-header text-center text-gray font-weight-bold">{{ __('LES UTILISATEURS DU SYSTEME') }}</div>
                <div class="card-body">
                    <form class="form-inline my-2 float-right ">
                            <input class="form-control mr-sm-2" type="search" placeholder="..." aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher</button>
                      </form>
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <table class="table table-responsive">
                            <caption>LISTE DES UTILISATEURS</caption>
                            <thead>
                              <tr>
                                <th scope="col">photo</th>
                                <th scope="col">PROFIL</th>
                                <th scope="col">PRENOM</th>
                                <th scope="col">NOM</th>
                                <th scope="col">GENRE</th>
                                <th scope="col">TELEPHONE</th>
                                <th scope="col">ADRESSE</th>
                                <th scope="col">E-MAIL</th>
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)       
                                <tr>
                                    <th scope="row">
                                        <img src="{{Storage::url($user->photo_url)}}" class="img-circle elevation-2" alt="User Image" style="max-width:50px; heigth:10px;">    
                                    </th>
                                    <td @if ($user->profil == 'admin')
                                        class ="badge py-1 bg-danger  mt-3" style="padding-left:42px;padding-right:42px;"
                                        @elseif($user->profil == 'gestionnaire')
                                        class ="badge py-1 bg-primary px-4 mt-3"
                                        @elseif($user->profil == 'technicien')
                                        class ="badge py-1 bg-info mt-3" style="padding-left:30px;padding-right:30px;"
                                        @else
                                        class ="badge py-1 bg-secondary mt-3" style="padding-left:45px;padding-right:45px;"
                                    @endif>
                                        {{$user->profil}}
                                    </td>
                                    <td>{{$user->prenom}}</td>
                                    <td>{{$user->nom}}</td>
                                    <td class="text-center">{{$user->sexe}}</td>
                                    <td>{{$user->telephone}}</td>
                                    <td>{{$user->adresse}}</td>
                                    <td>{{$user->email}}</td>                                  
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
