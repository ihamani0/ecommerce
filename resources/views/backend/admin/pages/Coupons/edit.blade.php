@extends("backend.admin.layout.master")

@section("title")
    Coupon | Edit
@endsection


@section("admin")
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Form :</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route(Constants::Admin_DASHBOARD)}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Coupon Edit</li>
                    </ol>
                </nav>
            </div>


        </div>
        <!--end breadcrumb-->


        {{--ADD Brand--}}

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Coupon Edit</h5>

                <hr/>

                @if ($errors->any())
                    <div class="row mb-3 alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-body mt-4">
                    <form  id="myForm" method="post" action="{{route(App\Constants\Constants::Admin_Coupon_UPDATE)}}"  enctype="multipart/form-data">
                        @csrf

                        <input  name="coupon_uuid" type="hidden" value="{{$Coupon->coupon_uuid}}"/>
                        <div class="row">
                            <div class="col-xl-7 ">


                                <div class="card-body">

                                    <div class="mb-3" >
                                        <label for="inputLastName1" class="form-label text-heading">Coupon Name</label>
                                        <div class="input-group">
                                            <input class="form-control mb-3" type="text" placeholder="Name Her...."
                                                   aria-label="default input example" name="coupon_name" value="{{$Coupon->coupon_name}}" required>
                                        </div>
                                    </div>


                                    <div class="mb-3" >
                                        <label for="inputLastName1" class="form-label text-heading">Coupon Discount(%)</label>
                                        <div class="input-group">
                                            <input class="form-control mb-3" type="text" placeholder="Discount" value="{{$Coupon->coupon_discount}}"
                                                   aria-label="default input example" name="coupon_discount" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-heading">Date time:</label>
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" value="{{$Coupon->coupon_validate}}"
                                                   name="coupon_validate" min="{{ now()->format('Y-m-d\TH:i') }}">
                                        </div>

                                    </div>




                                    <div class="col-12">
                                        <button type="submit" class="btn btn-outline-success px-5">Edit Coupon</button>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        {{--End Brand --}}
    </div>
@endsection


