    </div>
    <!-- Custom template | don't include it in your project! -->
    <div class="custom-template">
        <div class="title">Setup Device</div>
        <div class="custom-content">
            <div class="row">
                <div class="col">
                    <h4>DHT</h4>
                </div>
                <div class="col">
                    <label class="switch">
                        <input type="checkbox" id="dht" value="off">
                        <div class="slider round">
                            <span class="on">Enable</span>
                            <span class="off">Disable</span>
                        </div>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4>Light Intensity</h4>
                </div>
                <div class="col">
                    <label class="switch">
                        <input type="checkbox" id="light_intensity" value="off">
                        <div class="slider round">
                            <span class="on">Enable</span>
                            <span class="off">Disable</span>
                        </div>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4>Soil Moisture</h4>
                </div>
                <div class="col">
                    <label class="switch">
                        <input type="checkbox" id="soil_moisture" value="off">
                        <div class="slider round">
                            <span class="on">Enable</span>
                            <span class="off">Disable</span>
                        </div>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4>PH Soil</h4>
                </div>
                <div class="col">
                    <label class="switch">
                        <input type="checkbox" id="ph_soil" value="off">
                        <div class="slider round">
                            <span class="on">Enable</span>
                            <span class="off">Disable</span>
                        </div>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4>PH Water</h4>
                </div>
                <div class="col">
                    <label class="switch">
                        <input type="checkbox" id="ph_water" value="off">
                        <div class="slider round">
                            <span class="on">Enable</span>
                            <span class="off">Disable</span>
                        </div>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4>Wind Speed</h4>
                </div>
                <div class="col">
                    <label class="switch">
                        <input type="checkbox" id="wind_speed" value="off">
                        <div class="slider round">
                            <span class="on">Enable</span>
                            <span class="off">Disable</span>
                        </div>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4>Wind Direction</h4>
                </div>
                <div class="col">
                    <label class="switch">
                        <input type="checkbox" id="wind_direction" value="off">
                        <div class="slider round">
                            <span class="on">Enable</span>
                            <span class="off">Disable</span>
                        </div>
                    </label>
                </div>
            </div>



            <div>
                <button class="btn btn-primary" id="save"> Save </button>
            </div>
        </div>
        {{-- <div class="custom-toggle">
            <i class="flaticon-settings"></i>
        </div> --}}
    </div>
    <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('template/assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('template/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('template/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>


    <!-- Chart JS -->
    <script src="{{ asset('template/assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('template/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('template/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('template/assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    {{-- <script src="{{asset('template/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script> --}}

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('template/assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('template/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Atlantis JS -->
    <script src="{{ asset('template/assets/js/atlantis.min.js') }}"></script>

    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="{{ asset('template/assets/js/setting-demo.js') }}"></script>
    <script src="{{ asset('template/assets/js/demo.js') }}"></script>
     {{-- notify --}}
     <script src="{{ asset('js/notify.js') }}"></script>
     <script src="{{ asset('js/notify.min.js') }}"></script>
    {{-- @yield('values') --}}

    <script>
        var dht = document.getElementById("dht")
        var light_intensity = document.getElementById("light_intensity")
        var soil_moisture = document.getElementById("soil_moisture")
        var ph_soil = document.getElementById("ph_soil")
        var ph_water = document.getElementById("ph_water")
        var wind_speed = document.getElementById("wind_speed")
        var wind_direction = document.getElementById("wind_direction")

        $('#save').click(function() {
            const setup = {
                "dht": dht.checked,
                "light_intensity": light_intensity.checked,
                "soil_moisture": soil_moisture.checked,
                "ph_soil": ph_soil.checked,
                "ph_water": ph_water.checked,
                "wind_speed": wind_speed.checked,
                "wind_direction": wind_direction.checked
            }

            var data = JSON.stringify(setup)

            var client = mqtt.connect("ws://test.mosquitto.org:8081", {
                clientId: "mqtt-tester"
            });
            client.publish("setupDevice" , data);
            console.log(data);
        });
    </script>

    @stack('dashboard')
    </body>

    </html>
