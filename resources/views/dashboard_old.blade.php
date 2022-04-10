@extends('layouts.main')
@section('content')

<div class="content">
    <div class="panel-header bg-primary-gradient">
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
                            <canvas id="lineChart"></canvas>
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
    var client = mqtt.connect("ws://test.mosquitto.org:8081", {clientId:"mqtt-tester"});
        client.subscribe("esp32/temphum");
        client.on('message', function(topic, message) {
        // console.log("message is: " + message);
        // console.log("topic is: " + topic);
        let data = JSON.parse(message)
        console.log(data.soil_ph,data.soil_moisture, data.temperature, data.humidity)
        // phCircle.update(data.soil_ph, 500)
        // humiditySoilCircle.update(data.soil_moisture, 500)
        temperatureCircle.update(data.temperature, 500)
        // humidityCircle.update(data.humidity, 500)
    });



    function getRandomInt(max) {
        return Math.floor(Math.random() * max);
    }

    setInterval(function(){
        phCircle.update(getRandomInt(10), 500)
        humiditySoilCircle.update(getRandomInt(100), 500)
        humidityCircle.update(getRandomInt(100), 500)
    }, 2000);

    let phCircle = Circles.create({
        id:'circles-1',
        radius:45,
        value:  0,
        maxValue:100,
        width:7,
        text: function(value){return value +'pH';},
        colors:['#f1f1f1', '#FF9E27'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    let humiditySoilCircle = Circles.create({
        id:'circles-2',
        radius:45,
        value:0,
        maxValue:100,
        width:7,
        text: function(value){return value +'%';},
        colors:['#f1f1f1', '#2BB930'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    let temperatureCircle = Circles.create({
        id:'circles-3',
        radius:45,
        value:0,
        maxValue:100,
        width:7,
        text: function(value){return value +'°C';},
        colors:['#f1f1f1', '#F25961'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    let humidityCircle = Circles.create({
        id:'circles-4',
        radius:45,
        value:0,
        maxValue:100,
        width:7,
        text: function(value){return value +'%';},
        colors:['#f1f1f1', '#F25961'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    var lineChart = document.getElementById('lineChart').getContext('2d')
    var myLineChart = new Chart(lineChart, {
			type: 'line',
			data: {
				labels: [],
				datasets: [{
					label: "temperature",
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
			options : {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					position: 'bottom',
					labels : {
						padding: 10,
						fontColor: '#1d7af3',
					}
				},
				tooltips: {
					bodySpacing: 4,
					mode:"nearest",
					intersect: 0,
					position:"nearest",
					xPadding:10,
					yPadding:10,
					caretPadding:10
				},
				layout:{
					padding:{left:15,right:15,top:15,bottom:15}
				},
                scales:{
                    y: {
                        beginAtZero:true
                    }
                }
			}
		});

        var today = new Date();
        var time = today.getHours() + ":" + today.getMinutes();
        var dateTime = time;

        setInterval(function(){
            myLineChart.data.datasets[0].data.push(getRandomInt(20));
            myLineChart.data.labels.push(time);
            console.log(myLineChart.data.datasets[0].data);
            myLineChart.update();
        }, 10000);




</script>

@endpush
