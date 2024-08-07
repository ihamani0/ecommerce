<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>eCommerce - MultiVendor eCommerce -Setif</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />

    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("frontend/assets/imgs/theme/favicon.svg")}}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset("frontend/assets/css/plugins/animate.min.css")}}" />
    <link rel="stylesheet" href="{{asset("frontend/assets/css/main.css?v=5.3")}}" />
    {{--@vite([asset("frontend/assets/css/main.css")])--}}

    <!--Font awesome-->
    <link   rel="stylesheet" href="{{ asset("backend/assets/font-awosome/css/all.css") }}" />

    <style>
        .search-style-2{
            position: relative;
        }
        .results-container {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: white;
            border: 1px solid #ccc;
            border-top: none;
            max-height: 300px;
            overflow-y: auto;
            display: none;
            z-index: 1000;
        }

        .result-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            margin-top: 10px;
        }

        .result-item:last-child {
            border-bottom: none;
        }

        .result-item:hover {
            background-color: #f0f0f0;
            cursor: pointer;
        }

        .result-thumbnail {
            width: 50px;
            height: 50px;
            object-fit: cover;
            margin-right: 10px;
        }

        .result-details {
            display: flex;
            flex-direction: column;
        }

        .result-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .result-price {
            color: #888;
            margin: 0;
        }
    </style>

    @stack('style')
</head>

{{--Start Body--}}
<body>

{{--Quick view Modal--}}
@include("frontend.components.quickViewModal")

<!-- Strat Header  -->
@include("frontend.components.header")
<!-- End Header  -->


<main class="main">

@yield("main")

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
@stack('script')
</body>
</html>
