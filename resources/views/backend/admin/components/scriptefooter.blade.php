
{{--Sweet alert--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset("backend/assets/js/sweetalert.js") }}"></script>
<!-- Validation -->
{{--<script src="{{ asset("backend/assets/js/validate.min.js") }}"></script>--}}
<!-- Bootstrap JS -->
<script src="{{ asset("backend/assets/js/bootstrap.bundle.min.js") }}"></script>
<!--plugins-->
<script src="{{ asset("backend/assets/js/jquery.min.js") }}"></script>
<script src="{{ asset("backend/assets/plugins/simplebar/js/simplebar.min.js") }}"></script>
<script src="{{ asset("backend/assets/plugins/metismenu/js/metisMenu.min.js") }}"></script>
<script src="{{ asset("backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js") }}"></script>
{{--<script src="{{ asset("backend/assets/plugins/chartjs/js/Chart.min.js") }}"></script>--}}
<script src="{{ asset("backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js") }}"></script>
<script src="{{ asset("backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js") }}"></script>
{{--<script src="{{ asset("backend/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js") }}"></script>--}}
<script src="{{ asset("backend/assets/plugins/sparkline-charts/jquery.sparkline.min.js") }}"></script>
<script src="{{ asset("backend/assets/plugins/jquery-knob/excanvas.js") }}"></script>
<script src="{{ asset("backend/assets/plugins/jquery-knob/jquery.knob.js") }}"></script>

{{--Image upload File--}}
{{--<script src="{{ asset("backend/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js") }}"></script>--}}
{{--Image upload File--}}

{{--Tag input --}}
<script src="{{asset("backend/assets/plugins/input-tags/js/tagsinput.js")}}"></script>
{{---- Tag input ----}}
<!--Datatable-->
<script src="{{ asset("backend/assets/plugins/datatable/js/jquery.dataTables.min.js") }}"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
<!--Datatable-->


  <script>
      $(function() {
          $(".knob").knob();
      });
  </script>

  <script src="{{ asset("backend/assets/js/index.js") }}"></script>
<!--app JS-->
<script src="{{ asset("backend/assets/js/app.js") }}"></script>


@stack('script')
