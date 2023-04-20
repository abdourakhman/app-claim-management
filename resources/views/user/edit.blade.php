
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
                <div class="card-header text-center text-gray font-weight-bold">{{ __('MISE A JOUR UTILISATEUR') }}</div>

                <div class="card-body">
                    <form class="form-inline my-2 float-right ">
                            <input class="form-control mr-sm-2" type="search" placeholder="..." aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher</button>
                      </form>
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <table class="table">
                            <caption>LISTE DES UTILISATEURS</caption>
                            <thead>
                              <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">PROFIL</th>
                                <th scope="col">PRENOM</th>
                                <th scope="col">NOM</th>
                                <th scope="col">E-MAIL</th>
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)       
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td @if ($user->profil == 'admin')
                                        class ="badge badge-success mt-1"
                                        @elseif($user->profil == 'gestionnaire')
                                        class ="badge badge-primary mt-1"
                                    @endif>
                                        {{$user->profil}}
                                    </td>
                                    <td>{{$user->prenom}}</td>
                                    <td>{{$user->nom}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a href="{{route('admin.user.edit.form',$user->id)}}" class="btn btn-info badge">Mettre à jour</a>
                                    </td>
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