@extends("backend.admin.layout.master")

@section("title")
    Category | Edit
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
                        <li class="breadcrumb-item active" aria-current="page">SubCategory Add</li>
                    </ol>
                </nav>
            </div>


        </div>
        <!--end breadcrumb-->


        {{--ADD Brand--}}

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Subcategory</h5>

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
                    <form  id="myForm" method="post" action="{{route(App\Constants\Constants::Admin_SubCategory_UPDATE)}}"  enctype="multipart/form-data">
                        @csrf

                        <input  name="uuid_subcategory" type="hidden" value="{{$category->uuid_subcategory}}"/>
                        <div class="row">
                            <div class="col-xl-7 ">


                                <div class="card-body">

                                    <div class="mb-3" >
                                        <label for="inputLastName1" class="form-label text-heading">Subcategory Name</label>
                                        <div class="input-group">
                                            <input class="form-control mb-3" type="text" placeholder="Name Her...."
                                                   aria-label="default input example" name="subcategory_name" value="{{$category->subcategory_name}}" required>
                                        </div>
                                    </div>


                                    <div class="mb-5">
                                        <select  name="category_id" class="form-select mb-3" aria-label="Default select example" required>
                                            <option selected="" value="{{$category->category->id}}">{{$category->category->category_name}}</option>
                                            @foreach($categories as $item)
                                                <option value="{{$item->id}}">{{$item->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-12">
                                        <button type="submit" class="btn btn-outline-success px-5">Edit Subcategory</button>
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


