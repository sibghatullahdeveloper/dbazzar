<!doctype html>
<html lang="en">
   <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>dBazzar</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('css/icons/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
       <script src="{{asset('js/plugins/forms/styling/switch.min.js')}}"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	<!-- Core JS files -->
	<script src="{{asset('js/main/jquery.min.js')}}"></script>
	<script src="{{asset('js/main/bootstrap.bundle.min.js')}}" ></script>
	<script src="{{asset('js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->
<script src="{{asset('js/demo_pages/form_checkboxes_radios.js')}}"></script>
	<!-- Theme JS files -->
	<script src="{{asset('js/plugins/pickers/anytime.min.js')}}"></script>
	<script src="{{asset('js/plugins/visualization/d3/d3.min.js')}}"></script>
	<script src="{{asset('js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
	<script src="{{asset('js/plugins/forms/styling/switchery.min.js')}}"></script>
	<script src="{{asset('js/plugins/ui/moment/moment.min.js')}}"></script>
	<script src="{{asset('js/plugins/pickers/daterangepicker.js')}}"></script>
	<script src="{{asset('js/plugins/ui/perfect_scrollbar.min.js')}}"></script>
    <script src="{{asset('js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{asset('plugins/notifications/bootbox.min.js')}}"></script>
	<script src="{{asset('assets/js/app.js')}}"></script>
    <script src="{{asset('js/demo_pages/components_modals.js')}}"></script>
    <script src="{{asset('js/demo_pages/datatables_basic.js')}}"></script>
	<script src="{{asset('js/demo_pages/dashboard.js')}}"></script>
	<script src="{{asset('js/demo_pages/layout_fixed_sidebar_custom.js')}}"></script>
	<script src="{{asset('js/demo_charts/pages/dashboard/dark/streamgraph.js')}}"></script>
	<script src="{{asset('js/demo_charts/pages/dashboard/dark/sparklines.js')}}"></script>
	<script src="{{asset('js/demo_charts/pages/dashboard/dark/lines.js')}}"></script>
	<script src="{{asset('js/demo_charts/pages/dashboard/dark/areas.js')}}"></script>
	<script src="{{asset('js/demo_charts/pages/dashboard/dark/donuts.js')}}"></script>
	<script src="{{asset('js/demo_charts/pages/dashboard/dark/bars.js')}}"></script>
	<script src="{{asset('js/demo_charts/pages/dashboard/dark/progress.js')}}"></script>
	<script src="{{asset('js/demo_charts/pages/dashboard/dark/heatmaps.js')}}"></script>
	<script src="{{asset('js/demo_charts/pages/dashboard/dark/pies.js')}}"></script>
	<script src="{{asset('js/demo_charts/pages/dashboard/dark/bullets.js')}}"></script>
    <script src="{{asset('js/demo_pages/form_select2.js')}}"></script>
    <script src="{{asset('js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script src="{{asset('js/demo_pages/form_layouts.js')}}"></script>
	<!-- /theme JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('js/plugins/ui/moment/moment.min.js')}}"></script>
	<script src="{{asset('js/plugins/pickers/daterangepicker.')}}"></script>
	<script src="{{asset('js/plugins/pickers/anytime.min.js')}}"></script>
	<script src="{{asset('js/plugins/pickers/pickadate/picker.js')}}"></script>
	<script src="{{asset('js/plugins/pickers/pickadate/picker.date.js')}}"></script>
	<script src="{{asset('js/plugins/pickers/pickadate/picker.time.js')}}"></script>
	<script src="{{asset('js/plugins/pickers/pickadate/legacy.js')}}"></script>
	<script src="{{asset('js/plugins/notifications/jgrowl.min.js')}}"></script>
	<script src="{{asset('js/demo_pages/picker_date.js')}}"></script>
	<script src="{{asset('js/plugins/extensions/jquery_ui/interactions.min.js')}}"></script>
	<!-- /theme JS files -->

	
    <script src="{{asset('js/plugins/editors/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('js/demo_pages/editor_ckeditor_dark.js')}}"></script>

       <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcYAtQ0zbpWdSyvTOBiwsJeFDAnNv2gJQ&libraries=drawing"></script>

       <script src="{{asset('assets/js/app.js')}}"></script>
       <script src="{{asset('js/demo_maps/google/basic/basic.js')}}"></script>
       <script src="{{asset('js/demo_maps/google/basic/geolocation.js')}}"></script>
       <script src="{{asset('js/demo_maps/google/basic/coordinates.js')}}"></script>
       <script src="{{asset('js/demo_maps/google/basic/click_event.js')}}"></script>


</head>

    <body class="navbar-top">
        @include('Entity::layouts.top_header')

       <div class="page-content">


            <!-- Sidebar -->

            @include('Entity::layouts.side_bar')

            <!-- END Sidebar -->
                <!-- Page Content -->

                <div class="col-md-9">
                    @yield('content')
                    @include('Entity::layouts.footer')
                </div>
                <!-- END Page Content -->
            </div>
            <!-- END Main Container -->
            <!-- Footer -->

            <!-- END Footer -->

        <!-- END Page Container -->


        @yield('js_after')
    </body>
</html>
