
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
                        <div class="col-md-6">
                            <div>
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
                                      borderWidth: 2,
                                      fill: true,
                                      pointBackgroundColor:'green',
                                      borderColor: '#1A202C',
                                      backgroundColor:'#dfe3ec',
                                      tension: 0.5
                                    }]
                                  },
                                  options: {
                                    scales: {
                                      y: {
                                        beginAtZero: true,
                                        suggestedMax:maxnombreInterventions+1 ,
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
                        <div class="col-md-6">
                            <div>
                                <canvas id="myChart2"></canvas>
                            </div>
                              @php
                                $anneesSemaines = [];
                                $nombreReclamations = [];
                                foreach ($reclamations as $reclamation) {
                                    array_push($anneesSemaines, $reclamation->annee.'/'.$reclamation->semaine);
                                    array_push($nombreReclamations, $reclamation->nombreReclamations);
                                }
                              @endphp

                              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>    
                              <script>
                                let anneesSemaines = @json($anneesSemaines);
                                let nombreReclamations = @json($nombreReclamations);
                                let maxnombreReclamations = Math.max(...nombreReclamations);
                                const ctx2 = document.getElementById('myChart2');
                              
                                new Chart(ctx2, {
                                  type: 'line',
                                  data: {
                                    labels: anneesSemaines,
                                    datasets: [{
                                      label: 'EVOLUTION RECLAMATIONS PAR SEMAINE',
                                      data: nombreReclamations,
                                      borderWidth: 2,
                                      fill: true,
                                      pointBackgroundColor:'red',
                                      borderColor: '1A202C',
                                      backgroundColor:'#ff6666',
                                      tension: 0.6
                                    }]
                                  },
                                  options: {
                                    scales: {
                                      y: {
                                        beginAtZero: true,
                                        suggestedMax:maxnombreReclamations+1 ,
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
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <canvas id="myChart3"></canvas>
                              </div>
                              @php
                              $date = [];
                              $nombreAffectations = [];

                              foreach ($affectations as $affectation) {
                                  array_push($date, $affectation->date);
                                  array_push($nombreAffectations, $affectation->nombreAffectations);
                              }
                               @endphp
                              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                              <script>
                                let date = @json($date);
                                let nombreAffectations = @json($nombreAffectations);
                                let maxnombreAffectations = Math.max(...nombreAffectations);
                                const ctx3 = document.getElementById('myChart3');

                                new Chart(ctx3, {
                                  type: 'line',
                                  data: {
                                    labels: date,
                                    datasets: [{
                                      label: 'EVOLUTION AFFECTATIONS PAR JOUR',
                                      data: nombreAffectations,
                                      borderWidth: 2,
                                      fill: true,
                                      pointBackgroundColor:'green',
                                      borderColor: 'blue',
                                      backgroundColor:'yellow',
                                      tension: 0.5
                                    }]
                                  },
                                  options: {
                                    scales: {
                                      y: {
                                        beginAtZero: true,
                                        suggestedMax:maxnombreAffectations+1 ,
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
                        <div class="col-md-6">
                            <div>
                                <canvas id="myChart4"></canvas>
                              </div>
                              @php
                                $anneesSemaines = [];
                                $nombreReclamationResolues = [];
                                $nombreReclamationEchouees = [];
                                $nombreReclamationAnnulees = [];
                                $nombreReclamations = [];
                               
                                foreach ($reclamations as $reclamation) {
                                    array_push($anneesSemaines, 'week '.$reclamation->annee.'/'.$reclamation->semaine);
                                    array_push($nombreReclamations, $reclamation->nombreReclamations);
                                }
                                foreach ($reclamationResolues as $reclamation) {
                                    array_push($nombreReclamationResolues, $reclamation->nombreReclamationResolues);
                                }
                                foreach ($reclamationEchouees as $reclamation) {
                                    array_push($nombreReclamationEchouees, $reclamation->nombreReclamationEchouees);
                                }
                                foreach ($reclamationAnnulees as $reclamation) {
                                    array_push($nombreReclamationAnnulees, $reclamation->nombreReclamationAnnulees);
                                }
                              @endphp

                              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                              
                              <script>
                                let semaines = @json($anneesSemaines);
                                let nombreReclamationResolues = @json($nombreReclamationResolues);
                                let nombreReclamationEchouees = @json($nombreReclamationEchouees);
                                let nombreReclamationAnnulees = @json($nombreReclamationAnnulees);
                                let totalReclamations = Math.max(...nombreReclamations);
                                
                                const ctx4 = document.getElementById('myChart4');
                                new Chart(ctx4, {
                                  type: 'bar',
                                  data: data = {
                                            labels: semaines,
                                            datasets: [{
                                              label: 'Echouées',
                                              data: nombreReclamationEchouees,
                                              fill: true,
                                              backgroundColor: '#ff3333',
                                              borderColor: 'rgb(255, 99, 132)',
                                              pointBackgroundColor: 'rgb(255, 99, 132)',
                                              pointBorderColor: '#fff',
                                              pointHoverBackgroundColor: '#fff',
                                              pointHoverBorderColor: 'rgb(255, 99, 132)'
                                            }, {
                                              label: 'Réussies',
                                              data: nombreReclamationResolues,
                                              fill: true,
                                              backgroundColor: '#33ff33',
                                              borderColor: 'rgb(54, 162, 235)',
                                              pointBackgroundColor: 'rgb(54, 162, 235)',
                                              pointBorderColor: '#fff',
                                              pointHoverBackgroundColor: '#fff',
                                              pointHoverBorderColor: 'rgb(54, 162, 235)'
                                            },{
                                              label: 'Annulées',
                                              data: nombreReclamationAnnulees,
                                              fill: true,
                                              backgroundColor: '#ffff66',
                                              borderColor: 'rgb(54, 162, 235)',
                                              pointBackgroundColor: 'rgb(54, 162, 235)',
                                              pointBorderColor: '#fff',
                                              pointHoverBackgroundColor: '#fff',
                                              pointHoverBorderColor: 'rgb(54, 162, 235)'
                                            }]
                                          },
                                          options: {
                                            scales: {
                                              y: {
                                                beginAtZero: true,
                                                ticks: {
                                                        stepSize: 1,
                                                        precision: 0
                                                    }
                                              }
                                            },
                                            elements: {
                                              line: {
                                                borderWidth: 3
                                              }
                                            }
                                          },
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
