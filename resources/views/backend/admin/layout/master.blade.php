<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Ecoomerce bu hamani issam" />
    <meta name="author" content="issamhamani" />


	@include("backend.admin.components.head")

	<title>
        @yield("title" , "E-comme")
    </title>
</head>


    <div class="wrapper">
        {{-- <!--sidebar wrapper --> --}}
        @include("backend.admin.components.sidebar")

        {{-- navbar --}}
        @include("backend.admin.components.navbar")


        {{-- <!--start page wrapper --> --}}
        <div class="page-wrapper">

            @yield("admin")

        </div>
        {{-- <!--end page wrapper --> --}}


        <!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->


        {{-- footer with script and switcher --}}

        @include("backend.admin.components.footer")

    </div>

        {{-- <!--start switcher--> --}}
        @include("backend.admin.components.switcher")
        <!--end switcher-->


        @include("backend.admin.components.scriptefooter")

    </body>

    </html>
