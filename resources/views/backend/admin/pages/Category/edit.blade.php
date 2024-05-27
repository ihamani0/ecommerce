@extends("backend.admin.layout.master")

@section("title")
    Category | Edit
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
                        <li class="breadcrumb-item active" aria-current="page">Category Edit</li>
                    </ol>
                </nav>
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
                    <form  method="post" action="{{route('admin.category.update')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="uuid_category" value="{{$category->uuid_category}}"/>
                        {{--<input type="hidden" name="image_name" value="{{$category->category_img}}"/>--}}
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3 form-group">
                                        <label for="inputProductTitle" class="form-label">Category Name</label>
                                        <input name="category_name" type="text" class="form-control" id="inputProductTitle"
                                               placeholder="Enter Category title" value="{{$category->category_name}}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Category Images </label>
                                        <div class="text-secondary">
                                            <input type="file" class="form-control" id="image" name="category_image" accept="image/*" >
                                        </div>
                                    </div>

                                    <div class="mb-3 text-secondary">
                                        <img
                                            src="{{ ($category->category_img) ? Storage::url($category->category_img) :  url("upload/no_image2.jpg") }}"
                                            id="showImage" alt="avatar" style="width:100px;height:100px"  >
                                    </div>

                                    <div class=" mb-3 text-secondary">
                                        <input type="submit" class="btn btn-outline-success px-4" value="Edit Category" />
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

