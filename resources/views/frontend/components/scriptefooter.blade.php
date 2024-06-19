

{{--tailwindcss--}}
{{--<script src="https://cdn.tailwindcss.com"></script>--}}

<!-- Vendor JS-->
<script src={{ asset("frontend/assets/js/vendor/modernizr-3.6.0.min.js") }}></script>
<script src="{{ asset("frontend/assets/js/vendor/jquery-3.6.0.min.js") }}"></script>
<script src="{{ asset("frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js") }}"></script>
<script src="{{ asset("frontend/assets/js/vendor/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/slick.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/jquery.syotimer.min.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/waypoints.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/wow.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/perfect-scrollbar.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/magnific-popup.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/slider-range.js")}}"></script>
<script src="{{ asset("frontend/assets/js/plugins/select2.min.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/counterup.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/jquery.countdown.min.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/images-loaded.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/isotope.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/scrollup.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/jquery.vticker-min.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/jquery.theia.sticky.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/jquery.elevatezoom.js") }}"></script>
<!-- Template  JS -->
<script src="{{ asset("frontend/assets/js/main.js?v=5.3") }}"></script>
<script src="{{ asset("frontend/assets/js/shop.js?v=5.3") }}"></script>


<script>
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    $.ajaxSetup({
        header:{
            'X-CSRF-Token': csrfToken
        }
    })
</script>


@stack('script')
