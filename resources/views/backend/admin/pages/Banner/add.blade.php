@extends("backend.admin.layout.master")

@section("title")
    Banner | Add
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
                        <li class="breadcrumb-item active" aria-current="page">Banner Add</li>
                    </ol>
                </nav>
            </div>


        </div>
        <!--end breadcrumb-->


        {{--ADD Brand--}}

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New Banner</h5>



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
                    <form  id="myForm" method="post" action="{{route(App\Constants\Constants::Admin_Banner_STORE)}}"  enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3 form-group" >
                                        <label for="inputProductTitle" class="form-label">Banner Title<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="banner_title" id="inputProductTitle" placeholder="Enter product title" >
                                    </div>

                                    <div class="mb-3 form-group" >
                                        <label for="inputProductTitle" class="form-label">Banner Link<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="banner_url" id="inputProductTitle" placeholder="Enter product title" >
                                    </div>

                                    <div class="mb-3 form-group">
                                        <label for="inputProductDescription" class="form-label">Banner Images<span class="text-danger">*</span></label>
                                        <div class="text-secondary">
                                            <input type="file" class="form-control" id="image" name="banner_image"  >
                                        </div>
                                    </div>

                                    <div class="mb-3 text-secondary " id="setImage">
                                        <svg id="svgIcon" height="100px" width="100px" aria-hidden="true" focusable="false" data-prefix="fa-solid" data-icon="image-slash" class="svg-inline--fa fa-image-slash fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M630.812 469.109L574.865 425.26C575.322 422.195 575.986 419.195 575.986 416V96C575.986 60.654 547.331 32 511.986 32H127.986C113.552 32 100.429 36.98 89.777 45.059L38.812 5.113C28.343 -3.059 13.312 -1.246 5.109 9.191C-3.063 19.629 -1.235 34.723 9.187 42.895L601.187 506.891C605.593 510.328 610.796 512 615.984 512C623.109 512 630.156 508.844 634.89 502.812C643.062 492.375 641.234 477.281 630.812 469.109ZM223.14 149.586L158.853 99.197C164.169 97.146 169.933 96 175.986 96C202.496 96 223.986 117.492 223.986 144C223.986 145.945 223.365 147.701 223.14 149.586ZM331.234 234.307L354.687 199.125C357.654 194.672 362.65 192 367.999 192S378.345 194.672 381.312 199.125L485.236 355.01L331.234 234.307ZM145.999 416C139.978 416 134.466 412.621 131.738 407.25C129.007 401.883 129.523 395.438 133.072 390.574L203.072 294.574C206.083 290.441 210.888 288 215.999 288S225.915 290.441 228.927 294.574L261.382 339.086L277.814 314.439L63.986 146.846V416C63.986 451.346 92.64 480 127.986 480H489.048L407.392 416H145.999Z" fill="currentColor"/></svg>
                                    </div>

                                    <div class=" mb-3 text-secondary">
                                        <input type="submit" class="btn btn-outline-success px-4" value="Add Banner" />
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
                    const setImageDiv = document.getElementById('setImage');
                    const imgElement = document.createElement('img');

                    const svg = document.getElementById("svgIcon");
                    svg.style.display = 'none';
                    imgElement.src = event.target.result;
                    imgElement.style.width = '200px';  // Replace with desired width
                    imgElement.style.height = '100px';
                    imgElement.className = "rounded-1"
                    setImageDiv.appendChild(imgElement);
                };

                reader.readAsDataURL(event.target.files[0]);
            });
        });


        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    banner_title: {
                        required : true,
                    },
                    banner_url: {
                        required : true,
                    },
                    banner_image: {
                        required : true,
                    },
                },
                messages :{
                    banner_title: {
                        required : 'Please Enter Title of the Banner',
                    },
                    banner_url: {
                        required : 'Please Enter text of the Banner',
                    },
                    banner_image: {
                        required : 'Please Enter The image',
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

@endpush

