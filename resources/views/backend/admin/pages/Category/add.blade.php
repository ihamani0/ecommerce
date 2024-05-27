@extends("backend.admin.layout.master")

@section("title")
    Category | Add
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
                        <li class="breadcrumb-item active" aria-current="page">Category Add</li>
                    </ol>
                </nav>
            </div>


        </div>
        <!--end breadcrumb-->


        {{--ADD Brand--}}

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New Category</h5>



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
                    <form  id="myForm" method="post" action="{{route(App\Constants\Constants::Admin_Category_STORE)}}"  enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3 form-group" >
                                        <label for="inputProductTitle" class="form-label">Category Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="category_name" id="inputProductTitle" placeholder="Enter product title" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Category Images<span class="text-danger">*</span></label>
                                        <div class="text-secondary">
                                            <input type="file" class="form-control" id="image" name="category_image" accept="image/*" required>
                                        </div>
                                    </div>

                                    <div class="mb-3 text-secondary">
                                        <img
                                            src="{{ url("upload/no_image.jpg") }}"
                                            id="showImage" alt="avatar" style="width:150px;height:150px"  class="rounded-circle  bg-dark">
                                    </div>

                                    <div class=" mb-3 text-secondary">
                                        <input type="submit" class="btn btn-outline-success px-4" value="Add Category" />
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


        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    brand_name: {
                        required : true,
                    },
                },
                messages :{
                    brand_name: {
                        required : 'Please Enter Brand Name',
                    },
                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });

    </script>

@endpush

