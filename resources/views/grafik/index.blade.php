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
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Soil PH</div>
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
                <div class="card-title">Soil Humidity</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="MoistureChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Light Intensity</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="LightChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Wind Speed</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="WindChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script src="{{ asset('template/assets/js/plugin/chart.js/chart.min.js') }}"></script> --}}
<script>

    setInterval(function(){

        var temp            = @json($temp);
        var humd            = @json($humd);
        var soilPH          = @json($soilPH);
        var soilMoisture    = @json($soilMoisture);
        var light           = @json($lightIntensity);
        var windspeed       = @json($windSpeed);
        var time            = @json($time);


        function getRandomInt(max) {
            return Math.floor(Math.random() * max);
        }

        function getTime() {
            var today = new Date();
            var time = today.getHours() + ":" + today.getMinutes();
            return time;
        }

        var temperatureChart    = document.getElementById('temperatureChart').getContext('2d')
        var humidityChart       = document.getElementById('humidityChart').getContext('2d')
        var PHChart             = document.getElementById('PHChart').getContext('2d')
        var MoistureChart       = document.getElementById('MoistureChart').getContext('2d')
        var LightChart          = document.getElementById('LightChart').getContext('2d')
        var WindChart           = document.getElementById('WindChart').getContext('2d')

        var temperature = new Chart(temperatureChart, {
            type: 'line',
            data: {
                labels: time,
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
                    data:humd
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
                    label: "Soil Ph",
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

        var Moisture = new Chart(MoistureChart, {
            type: 'line',
            data: {
                labels: time,
                datasets: [{
                    label: "Soil Humidity",
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
                    label: "Light Intensity",
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
                    label: "Wind Speed",
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

    }, 10000);


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


    // var client = mqtt.connect("ws://test.mosquitto.org:8081", {
    //     clientId: "mqtt-tester"
    // });
    // client.subscribe("esp32/temphum");
    // client.on('message', function(topic, message) {

    //     try {

    //         console.log("message is: " + message);
    //         let data = JSON.parse(message)
    //         // temperature.data.datasets[0].data.push(data.temperature);
    //         // temperature.data.labels.push(getTime());
    //         // humidity.data.datasets[0].data.push(data.humidity);
    //         // humidity.data.labels.push(getTime());
    //         // temperature.update();
    //         // humidity.update();
    //         $.ajax({
    //             type: "get",
    //             url: "{{ url('store_detail')}}",
    //             data: {
    //                 device_id       : data.device_id,
    //                 temperature     : data.temperature,
    //                 humidity        : data.humidity,
    //                 soil_moisture   : data.soil_moisture,
    //                 ph              : data.soil_ph,
    //                 light_intensity : data.light_intensity,
    //                 wind_speed      : data.wind_speed,
    //                 wind_direction  : data.wind_direction
    //             }
    //         });

    //     } catch (error) {
    //         console.log("Data error");
    //     }

    // });


</script>
