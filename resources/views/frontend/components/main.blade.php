@extends("frontend.layout.master")



@section("main")
    <!--slider-->
        @include("frontend.components.MainColumn.home-slider")
    <!--End hero slider-->

        @include("frontend.components.MainColumn.popular-categories")

    <!--End category slider-->
        @include("frontend.components.MainColumn.banners")
    <!--End banners-->




    {{--product-tabs--}}

        @include("frontend.components.MainColumn.product-tabs")
    <!--End Products Tabs-->




        {{--Featured product--}}
        @include("frontend.components.MainColumn.Featured-product")
        <!--End Best Sales-->








        @include("frontend.components.MainColumn.category")




        @include("frontend.components.MainColumn.offer")





        <!--Vendor List -->

        @include("frontend.components.MainColumn.vendor-list")



        <!--End Vendor List -->


@endsection
