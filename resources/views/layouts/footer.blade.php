    </div>
    <!-- Custom template | don't include it in your project! -->
		<div class="custom-template">
			<div class="title">Setup Device</div>
			<div class="custom-content">
				<div class="switcher">
					<div class="switch-block">
                        <div class="form-check pl-0">
                            <input id="stackedCheck1" class="form-check-input" type="checkbox" data-toggle="toggle" checked>
                            <label for="stackedCheck1" class="form-check-label">Enabled</label>
                        </div>
					</div>
				</div>
			</div>
			<div class="custom-toggle">
				<i class="flaticon-settings"></i>
			</div>
		</div>
<!-- End Custom template -->
</div>
<!--   Core JS Files   -->
<script src="{{asset('template/assets/js/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{asset('template/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('template/assets/js/core/bootstrap.min.js')}}"></script>

<!-- jQuery UI -->
<script src="{{asset('template/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{asset('template/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('template/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>


<!-- Chart JS -->
<script src="{{asset('template/assets/js/plugin/chart.js/chart.min.js')}}"></script>

<!-- jQuery Sparkline -->
<script src="{{asset('template/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Chart Circle -->
<script src="{{asset('template/assets/js/plugin/chart-circle/circles.min.js')}}"></script>

<!-- Datatables -->
<script src="{{asset('template/assets/js/plugin/datatables/datatables.min.js')}}"></script>

<!-- Bootstrap Notify -->
{{-- <script src="{{asset('template/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script> --}}

<!-- jQuery Vector Maps -->
<script src="{{asset('template/assets/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('template/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>

<!-- Sweet Alert -->
<script src="{{asset('template/assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

<!-- Atlantis JS -->
<script src="{{asset('template/assets/js/atlantis.min.js')}}"></script>

<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="{{asset('template/assets/js/setting-demo.js')}}"></script>
<script src="{{asset('template/assets/js/demo.js')}}"></script>
{{-- @yield('values') --}}

@stack('dashboard')
</body>
</html>
