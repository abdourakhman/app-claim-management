
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
            <section class="content mt-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{$numberCustumer}}</h3>
                                    <p>Clients</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users "></i>
                                </div>
                                <a href="http://127.0.0.1:8000/admin/search?term=client" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>   
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>{{$numberManager}}</h3>
                                    <p>Managers</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <a href="http://127.0.0.1:8000/admin/search?term=gestionnaire" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>                

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$numberTechnician}}</h3>
                                    <p>Techniciens</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-wrench"></i>
                                </div>
                                <a href="http://127.0.0.1:8000/admin/search?term=technicien" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>   
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{$numberIntervention}}</h3>
                                    <p>Interventions</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-exclamation"></i>
                                </div>
                                <a href="#" class="small-box-footer"><i class="fas fa-info"></i></a>
                            </div>
                        </div>                
                    </div>       
                    
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="">
                                <canvas id="myChart" ></canvas>
                            </div>
                              @php
                                $moisAnnees = [];
                                $nombreClients = [];

                                foreach ($registrations as $registration) {
                                    $moisAnnees[] = $registration->mois_annee;
                                    $nombreClients[] = $registration->nombre_clients;
                                }
                            @endphp
                              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                              
                              <script>
                                var moisAnnees = @json($moisAnnees);
                                var nombreClients = @json($nombreClients);
                                var maxNombreClients = Math.max(...nombreClients);
                                const ctx = document.getElementById('myChart');
                                
                                new Chart(ctx, {
                                  type: 'line',
                                  data: {
                                    labels: moisAnnees,
                                    datasets: [{
                                      label: 'EVOLUTION DES ABONNES AU COURS DES DERNIERS MOIS',
                                      data: nombreClients,
                                      borderWidth: 1,
                                      fill: true,
                                      pointBackgroundColor:'red',
                                      borderColor: '1A202C',
                                      backgroundColor:'#dfe3ec',
                                      tension: 0.5
                                    }]
                                  },
                                  options: {
                                    scales: {
                                      y: {
                                        beginAtZero: true,
                                        suggestedMax:maxNombreClients+1 ,
                                        ticks: {
                                                stepSize: 1,
                                                precision: 0
                                            }
                                      }
                                    }
                                  }
                                });
                              </script> 
                        </div>
                      </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
