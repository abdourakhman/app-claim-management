
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
                        <div class="col-lg-3 col-6 mx-3">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{$interventionResolue}}</h3>
                                    <p>Résolue(s)</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-check "></i>
                                </div>
                                <a href="http://127.0.0.1:8000/technicien/interventions" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>   
                        <div class="col-lg-3 col-6 mx-5">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{$interventionEchouee}}</h3>
                                    <p>Echouée(s)</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-times "></i>
                                </div>
                                <a href="http://127.0.0.1:8000/technicien/interventions" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>   
                        <div class="col-lg-3 col-6 mx-5">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$interventionEnAttente}}</h3>
                                    <p>En Attente</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-spinner "></i>
                                </div>
                                <a href="http://127.0.0.1:8000/technicien/interventions/pending" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>   
                        
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <div style="">
                                <canvas id="myChart"></canvas>
                              </div>
                              @php
                              $moisJour = [];
                              $nombreInterventions = [];

                              foreach ($interventions as $intervention) {
                                  $moisJour[] = $intervention->moisJour;
                                  $nombreInterventions[] = $intervention->nombreInterventions;
                              }
                               @endphp
                              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                              
                              <script>
                                let moisJour = @json($moisJour);
                                let nombreInterventions = @json($nombreInterventions);
                                let maxnombreInterventions = Math.max(...nombreInterventions);
                                const ctx = document.getElementById('myChart');

                                new Chart(ctx, {
                                  type: 'line',
                                  data: {
                                    labels: moisJour,
                                    datasets: [{
                                      label: 'EVOLUTION INTERVENTIONS PAR JOUR',
                                      data: nombreInterventions,
                                      borderWidth: 3,
                                      fill: true,
                                      pointBackgroundColor:'white',
                                      borderColor: 'green',
                                      backgroundColor:'#00264d',
                                      tension: 0.4
                                    }]
                                  },
                                  options: {
                                    scales: {
                                      y: {
                                        beginAtZero: true,
                                        suggestedMax:maxnombreInterventions+2 ,
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
                        <div class="col-5">
                            <div style="width:90%;">
                                <canvas id="myChart2"></canvas>
                              </div>
                              @php
                              $data = [$interventionResolue, $suggestions, $interventionEchouee]
                               @endphp
                              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                              
                              <script>
                                let donnees = @json($data);
                                
                                const ctx2 = document.getElementById('myChart2');
                                console.log(donnees);
                                new Chart(ctx2, {
                                  type: 'polarArea',
                                  data: {
                                    labels: ['Réussite', 'Suggestion', 'Echec'],
                                    datasets: [{
                                      data: donnees,
                                      borderWidth: 2,
                                      backgroundColor: [
                                        'rgb(0, 150, 0)',
                                        '#17a2b8',
                                        'rgb(250, 0, 0)',
                                    ]
                                    }]
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
