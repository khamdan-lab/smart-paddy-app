@extends('layouts.main')
@section('content')
    <div class="content">

        <div class="panel-header bg-success-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">Dashboard</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Hari</div>
                            </div>
                            <input type="date" class="form-control" id="day">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Bulan</div>
                            </div>
                            <input type="month" class="form-control" id="month">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary" onclick="filter()"><b>Filter</b></button>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5" id="konten">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Suhu (°C)</div>
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
                            <div class="card-title">Kelembaban (%)</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="humidityChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">PH Tanah (pH)</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="PHChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">PH Air (pH)</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="PHWaterChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Kelembaban Tanah (%)</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="MoistureChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Intensitas Cahaya (Lux)</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="LightChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Kecepatan Angin (m/s)</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="WindChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Curah Hujan (mm)</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="RainfallChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var temp = @json($temp);
        var humd = @json($humd);
        var soilPH = @json($soilPH);
        var waterPH = @json($waterPH);
        var soilMoisture = @json($soilMoisture);
        var light = @json($lightIntensity);
        var windspeed = @json($windSpeed);
        var rainfall = @json($rainfall);
        var time = @json($time);


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
        var PHChart = document.getElementById('PHChart').getContext('2d')
        var PHWaterChart = document.getElementById('PHWaterChart').getContext('2d')
        var MoistureChart = document.getElementById('MoistureChart').getContext('2d')
        var LightChart = document.getElementById('LightChart').getContext('2d')
        var WindChart = document.getElementById('WindChart').getContext('2d')
        var RainChart = document.getElementById('RainfallChart').getContext('2d')

        var temperature = new Chart(temperatureChart, {
            type: 'line',
            data: {
                labels: time,
                datasets: [{
                    label: "Suhu :",
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
                    data: temp
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
                labels: time,
                datasets: [{
                    label: "Kelembaban",
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
                    data: humd
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

        var PH = new Chart(PHChart, {
            type: 'line',
            data: {
                labels: time,
                datasets: [{
                    label: "PH Tanah",
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
                    data: soilPH
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


        var PHWater = new Chart(PHWaterChart, {
            type: 'line',
            data: {
                labels: time,
                datasets: [{
                    label: "PH Air",
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
                    data: waterPH
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

        var Moisture = new Chart(MoistureChart, {
            type: 'line',
            data: {
                labels: time,
                datasets: [{
                    label: "Kelembaban Tanah",
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
                    data: soilMoisture
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

        var Light = new Chart(LightChart, {
            type: 'line',
            data: {
                labels: time,
                datasets: [{
                    label: "Intensitas Cahaya",
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
                    data: light
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

        var Wind = new Chart(WindChart, {
            type: 'line',
            data: {
                labels: time,
                datasets: [{
                    label: "Kecapatan Angin",
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
                    data: windspeed
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

        var Rain = new Chart(RainChart, {
            type: 'line',
            data: {
                labels: time,
                datasets: [{
                    label: "Curah Hujan",
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
                    data: rainfall
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

        const options = {
            clean: true,
            connectTimeout: 4000,
            clientId: 'test',
            // username: 'khamdan',
            // password: 'khamdan123',
        }
        var host = '{{ env('MQTT_HOST') }}';
        topic = '{{ env('MQTT_TOPIC') }}';

        const client = mqtt.connect('{{ env('MQTT_PROTOCOL') }}://' + host + ':{{ env('MQTT_PORT') }}', options)
        client.on('connect', function() {
            // console.log('Websoket Connected')
            client.subscribe(topic)
        })

        client.on('message', function(topic, message) {
            let data = message.toString().split(",")
            console.log(data);

            temp.push(data[1]);
            humd.push(data[2]);
            soilMoisture.push(data[3]);
            soilPH.push(data[4]);
            waterPH.push(data[5]);
            light.push(data[6]);
            windspeed.push(data[7]);
            rainfall.push(data[8]);
            time.push(getTime());

            temperature.update();
            humidity.update();
            PH.update();
            PHWater.update();
            Moisture.update();
            Light.update();
            Wind.update();
            Rain.update();

            if (data[1] >= 30) {
                var notification_temp = alertify.notify('Suhu  tinggi segera lakukan pengairan', 'success', 3600, function(){  console.log('dismissed'); });
            }

            if (data[3] <= 40 ) {
                var notification_soilPh = alertify.notify('Kelembaban tanah rendah lakukan pengairan', 'success', 3600, function(){  console.log('dismissed'); });
            }

            if (data[4] <= 6.00) {
                var notification_soilMoisture = alertify.notify('PH tanah rendah', 'success', 3600, function(){  console.log('dismissed'); });
            }

            


        })

        function filter() {

            var date = $('#day').val();
            var data = new Date($('#month').val());
            var month = data.getMonth() + 1;
            var year = data.getFullYear();
            if (date != "" && data == "Invalid Date") {
                $.ajax({
                    url: "{{ url('/filterHari') }}",
                    data: {
                        date: date
                    },
                    success: function(data) {
                        $('#konten').html(data);
                    }
                });
            } else if (date == "" && data != "Invalid Date") {
                $.ajax({
                    url: "{{ url('/filterBulan') }}",
                    data: {
                        month: month,
                        year: year
                    },
                    success: function(data) {
                        $('#konten').html(data);
                        // console.log(data);
                    }
                });
            } else if (date == "" && data == "Invalid Date") {
                $.notify("Pilih terlebih dahulu filter hari atau bulan")
            } else if (date != "" && data != "Invalid Date") {
                $.notify("Pilih salah satu filter hari atau bulan")
            }

        }
        var message = []

        console.log(message);

        $("#bell").click(function() {
            alertify.confirm('Pemberitahuan', 'Confirm Message', function(){ alertify.success('Ok') }
                , function(){ alertify.error('Cancel')});
        });

    </script>
@endpush
