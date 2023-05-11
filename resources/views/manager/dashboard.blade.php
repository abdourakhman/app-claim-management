
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
                              
                              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                              
                              <script>
                                const ctx = document.getElementById('myChart');
                              
                                new Chart(ctx, {
                                  type: 'polarArea',
                                  data: {
                                    labels: ['Red', 'Blue', 'Yellow', 'Green'],
                                    datasets: [{
                                      label: 'INTERVENTION AGENTS',
                                      data: [12, 15, 3, 5],
                                      borderWidth: 1
                                    }]
                                  },
                                  options: {
                                    scales: {
                                      y: {
                                        beginAtZero: true
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
                              
                              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                              
                              <script>
                                const ctx2 = document.getElementById('myChart2');
                              
                                new Chart(ctx2, {
                                  type: 'radar',
                                  data: {
                                    labels: ['Red', 'Blue', 'Yellow', 'Green'],
                                    datasets: [{
                                      label: 'INTERVENTION AGENTS',
                                      data: [12, 15, 3, 5, ],
                                      borderWidth: 1
                                    }]
                                  },
                                  options: {
                                    scales: {
                                      y: {
                                        beginAtZero: true
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
                              
                              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                              
                              <script>
                                const ctx3 = document.getElementById('myChart3');
                              
                                new Chart(ctx3, {
                                  type: 'line',
                                  data: {
                                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                                    datasets: [{
                                      label: 'INTERVENTION AGENTS',
                                      data: [12, 19, 3, 5, 2, 3],
                                      borderWidth: 1
                                    }]
                                  },
                                  options: {
                                    scales: {
                                      y: {
                                        beginAtZero: true
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
                              
                              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                              
                              <script>
                                const ctx4 = document.getElementById('myChart4');
                              
                                new Chart(ctx4, {
                                  type: 'bar',
                                  data: {
                                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                                    datasets: [{
                                      label: 'INTERVENTION AGENTS',
                                      data: [12, 19, 3, 5, 2, 3],
                                      borderWidth: 1
                                    }]
                                  },
                                  options: {
                                    scales: {
                                      y: {
                                        beginAtZero: true
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
