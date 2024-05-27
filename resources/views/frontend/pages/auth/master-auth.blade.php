<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />

    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("frontend/assets/imgs/theme/favicon.svg")}}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset("frontend/assets/css/plugins/animate.min.css")}}" />
    <link rel="stylesheet" href="{{asset("frontend/assets/css/main.css?v=5.3")}}" />

    {{--@vite('resources/css/app.css')--}}


    <title>@yield("title" , "eCommerce - MultiVendor eCommerce - Setif")</title>
</head>

{{--Start Body--}}
<body>




<main class="main">

    @yield("auth")

</main>


<!-- Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center">
                <img src="{{asset("frontend/assets/imgs/theme/loading.gif")}}" alt="" />
            </div>
        </div>
    </div>
</div>




{{--footer--}}
@include("frontend.components.footer")
{{--SCript section--}}
@include("frontend.components.scriptefooter")
{{--End Body--}}

<script>
    function generateSecurityCode() {
        return Math.floor(Math.random() * 1000) + 1000;
    }

    if(window.onload){
        const random = generateSecurityCode();
        document.getElementById("securityCode").value =  random ;

        let array_number = random.toString().split('');

        document.getElementById("new").textContent = array_number[0];
        document.getElementById("hot").textContent = array_number[1];
        document.getElementById("sale").textContent = array_number[2];
        document.getElementById("best").textContent = array_number[3];

    }

    /*const generatedCode = generateSecurityCode();
    console.log(generatedCode);*/


        document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('logoutLink').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('logoutForm').submit();
            });
        });


</script>

</body>
</html>
