@extends('layouts.master')
@include('partials.navbar')
@include('partials.sidebar')
@section('content')
<div class="content-wrapper">
    <div class="text-center">
        <img class="img-circle" style="width: 10%;" src="{{asset('img/images/logo.png')}}" alt="logo">
    </div>
    <hr class="w-50">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">LISTE DES TECHNICIENS EN INTERVENTION</h3>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>PRENOM</th>
                                <th>NOM</th>
                                <th>GENRE</th>
                                <th>SPECIALITE</th>
                                <th>EMAIL</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($techniciens as $technicien)
                            <tr>         
                                <td>{{$technicien->user->prenom}}</td>
                                <td>{{$technicien->user->nom}}</td>
                                <td>{{$technicien->user->sexe}}</td>
                                <td>
                                    @foreach ($technicien->types as $type)
                                        {{$type->nom}}
                                    @endforeach
                                </td>
                                <td>{{$technicien->user->email}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection



