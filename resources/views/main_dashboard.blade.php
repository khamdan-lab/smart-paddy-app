@extends('layouts.main')
@section('content')
    <div class="content">
        <div class="panel-header bg-success-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Temperature</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="temperatureChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Humidity</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="humidityChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">PH</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="PHChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@push('css')
    <style>
        .circles-text {
            font-size: 15pt !important;
        }

    </style>
@endpush


@push('dashboard')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mqtt/4.3.7/mqtt.min.js"
        integrity="sha512-tc5xpAPaQDl/Uxd7ZVbV66v94Lys0IefMJSdlABPuzyCv0IXmr9TkqEQvZiWKRoXMSlP5YPRwpq2a+v5q2uzMg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>

    <script>
        function getRandomInt(max) {
            return Math.floor(Math.random() * max);
        }

        function getTime() {
            var today = new Date();
            var time = today.getHours() + ":" + today.getMinutes();
            return time;
        }
        var temperatureChart = document.getElementById('temperatureChart').getContext('2d')
        var humidityChart = document.getElementById('humidityChart').getContext('2d')
        // var PHChart = document.getElementById('PHChart').getContext('2d')
        var temperature = new Chart(temperatureChart, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: "temperature :",
                    borderColor: "#1d7af3",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#1d7af3",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    backgroundColor: 'transparent',
                    fill: true,
                    borderWidth: 2,
                    data: []
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 10,
                        fontColor: '#1d7af3',
                    }
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                layout: {
                    padding: {
                        left: 15,
                        right: 15,
                        top: 15,
                        bottom: 15
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        var humidity = new Chart(humidityChart, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: "humidity",
                    borderColor: "#1d7af3",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#1d7af3",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    backgroundColor: 'transparent',
                    fill: true,
                    borderWidth: 2,
                    data: []
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 10,
                        fontColor: '#1d7af3',
                    }
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                layout: {
                    padding: {
                        left: 15,
                        right: 15,
                        top: 15,
                        bottom: 15
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        // var PH = new Chart(PHChart, {
        //     type: 'line',
        //     data: {
        //         labels: [],
        //         datasets: [{
        //             label: "humidity",
        //             borderColor: "#1d7af3",
        //             pointBorderColor: "#FFF",
        //             pointBackgroundColor: "#1d7af3",
        //             pointBorderWidth: 2,
        //             pointHoverRadius: 4,
        //             pointHoverBorderWidth: 1,
        //             pointRadius: 4,
        //             backgroundColor: 'transparent',
        //             fill: true,
        //             borderWidth: 2,
        //             data: []
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         legend: {
        //             position: 'bottom',
        //             labels: {
        //                 padding: 10,
        //                 fontColor: '#1d7af3',
        //             }
        //         },
        //         tooltips: {
        //             bodySpacing: 4,
        //             mode: "nearest",
        //             intersect: 0,
        //             position: "nearest",
        //             xPadding: 10,
        //             yPadding: 10,
        //             caretPadding: 10
        //         },
        //         layout: {
        //             padding: {
        //                 left: 15,
        //                 right: 15,
        //                 top: 15,
        //                 bottom: 15
        //             }
        //         },
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });

        // setInterval(function() {
        //     temperature.data.datasets[0].data.push(getRandomInt(20));
        //     temperature.data.labels.push(getTime());
        //     humidity.data.datasets[0].data.push(getRandomInt(20));
        //     humidity.data.labels.push(getTime());
        //     PH.data.datasets[0].data.push(getRandomInt(20));
        //     PH.data.labels.push(getTime());
        //     // console.log(temperature.data.datasets[0].data);
        //     temperature.update();
        //     humidity.update();
        //     PH.update();
        // }, 10000);

        var client = mqtt.connect("ws://test.mosquitto.org:8081", {
            clientId: "mqtt-tester"
        });
        client.subscribe("esp32/temphum");
        client.on('message', function(topic, message) {
            console.log("message is: " + message);
            // console.log(message.length);
            let data = JSON.parse(message)
            temperature.data.datasets[0].data.push(data.temperature);
            temperature.data.labels.push(getTime());
            humidity.data.datasets[0].data.push(data.humidity);
            humidity.data.labels.push(getTime());
            temperature.update();
            humidity.update();
            // console.log(data.soil_ph, data.soil_moisture, data.temperature, data.humidity)
        });


    </script>
@endpush
