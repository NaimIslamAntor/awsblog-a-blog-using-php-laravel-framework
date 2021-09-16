@extends('layouts.admin')


@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js" integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg==" crossorigin="anonymous"></script>

    <div class="admin__dashboard">
        {{-- <h2 class="dashboard__title">Welcome back <br>{{auth()->user()->fname}}</h2> --}}

        <canvas class="mx-auto" id="myChart" style="width: 600px; height: 300px"></canvas>
    </div>

    <script>
        let ctx = document.getElementById('myChart').getContext('2d');

        let chart = new Chart(ctx, {
            type: "bar", //bar, horizontalBar, pie, donut, area, line, rodar
            data: {
                labels: ['Dhaka', 'Chattogram', 'Khulna', 'Rajshahi', 'Rangpur'],
                datasets: [{
                    label: "Population of BD top 5 sections",
                    data: [
                        21741000,
                        5133000,
                        949000,
                        924000,
                        416000
                    ],
                    backgroundColor: ["green", "pink", "orange", "skyblue", 'red'],
                    borderColor: ["black", "green", "pink", "orange", "grey"],
                    borderWidth: 1,
                    hoverBorderWidth: 3,
                    hoverBorderColor: 'red'
                    
                }]
            },
            options: {
                plugins: {
                title: {
                    display: true,
                    text: 'Largest cities in BD',
                    fontSize: 30,
                    color: 'green',
                },
                legend: {
                    display: true,
                   // position: 'right'
                  fontColor: '#333',
                //   labels: {
                //     color: "red"
                //   }
              
                },
                tooltip: {
                    enabled: true
                }
              }
              ,
                // layout: {
                //     padding:{
                //         left: 20
                //     }
                // }

              
            }

        });
    </script>
@endsection