<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Ecoomerce by hamani issam" />
    <meta name="author" content="issamhamani" />


	@include("backend.vendor.components.head")

	<title>
        @yield("title" , "E-comme")
    </title>
</head>

<body>
    <div class="wrapper">
        {{-- <!--sidebar wrapper --> --}}
        @include("backend.vendor.components.sidebar")

        {{-- navbar --}}
        @include("backend.vendor.components.navbar")


        {{-- <!--start page wrapper --> --}}
        <div class="page-wrapper">

            @yield("vendor")

        </div>
        {{-- <!--end page wrapper --> --}}


        <!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->


        {{-- footer with script and switcher --}}

        @include("backend.vendor.components.footer")

    </div>



        @include("backend.vendor.components.scriptefooter")

    </body>

</html>
