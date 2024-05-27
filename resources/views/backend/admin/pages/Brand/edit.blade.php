@extends("backend.admin.layout.master")

@section("title")
    Brand | Edit
@endsection


@section("admin")
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route(Constants::Admin_DASHBOARD)}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Brand Add</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->


        {{--ADD Brand--}}

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Brand</h5>

                @if ($errors->any())
                    <div class="row mb-3 alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <hr/>
                <div class="form-body mt-4">
                    <form  id="myForm" method="post" action="{{route(App\Constants\Constants::Admin_BRAND_UPDATE)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="uuid_brand" value="{{$brand->uuid_brand}}"/>
                        <input type="hidden" name="image_name" value="{{$brand->brand_img}}"/>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3 form-group">
                                        <label for="inputProductTitle" class="form-label">Brand Name</label>
                                        <input name="brand_name" type="text" class="form-control" id="inputProductTitle" placeholder="Enter product title" value="{{$brand->brand_name}}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Brand Images </label>
                                        <div class="text-secondary">
                                            <input type="file" class="form-control" id="image" name="brand_image" accept="image/*" >
                                        </div>
                                    </div>

                                    <div class="mb-3 text-secondary">
                                        <img
                                            src="{{ ($brand->brand_img) ? url($brand->brand_img) :  url("upload/no_image2.jpg") }}"
                                            id="showImage" alt="avatar" style="width:120px;height:120px"   class="rounded-circle  bg-dark">
                                    </div>

                                    <div class=" mb-3 text-secondary">
                                        <input type="submit" class="btn btn-outline-success px-4" value="Add Brand" />
                                    </div>

                                </div>
                            </div>
                        </div><!--end row-->
                    </form>
                </div>
            </div>
        </div>


        {{--End Brand --}}
    </div>
@endsection
@push("script")

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');

            imageInput.addEventListener('change', function(event) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    const showImage = document.getElementById('showImage');
                    showImage.src = event.target.result;
                };

                reader.readAsDataURL(event.target.files[0]);
            });
        });

    </script>


@endpush

