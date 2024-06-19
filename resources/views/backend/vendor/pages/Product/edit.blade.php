@extends("backend.vendor.layout.master")

@section("title")
    Product | Edit
@endsection

@push('style')
    <link href="{{ asset('backend/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
@endpush

@section("vendor")
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Form :</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route(\App\Constants\Constants::VENDOR_DASHBOARD)}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Product </li>
                    </ol>
                </nav>
            </div>


        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Product</h5>
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
                <div class="card-body p-4">

                    <h5 class="card-title">Edit Product</h5>
                    <hr>
                    <div class="form-body mt-4">
                        {{--Form--}}
                        <form id="MyForm" method="post" action="{{route(\App\Constants\Constants::Vendor_Products_UPDATE)}}">
                            @csrf

                            {{-- THis input hidden for vendor Id  --}}
                            <input type="hidden" name="vendor_id" value="{{auth()->user()->id}}">
                            <div class="row">

                                {{--First Column--}}
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">

                                        <input type="hidden" name="product_uuid" value="{{$product->products_uuid}}" >
                                        <div class="form-group mb-3">
                                            <label for="inputProductTitle" class="form-label">Product Title</label>
                                            <input type="text" class="form-control" name="product_name" id="inputProductTitle" placeholder="Enter product title"
                                                    value="{{ $product->product_name}}" >
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="inputProductTitle" class="form-label">Product tags</label>
                                            <input type="text" class="form-control visually-hidden" name="product_tags" data-role="tagsinput"
                                                    value="{{$product->product_tags}}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="inputProductTitle" class="form-label">Product Size</label>
                                            <input type="text" class="form-control visually-hidden"  name="product_size" data-role="tagsinput"
                                                    value="{{$product->product_size}}">
                                        </div>

                                        <div class="form-group mb-5">
                                            <label for="inputProductTitle" class="form-label">Product Color</label>
                                            <input type="text" class="form-control visually-hidden"  name="product_color" data-role="tagsinput"
                                                    value="{{$product->product_color}}">
                                        </div>


                                        <div class="form-group mb-3">
                                            <label for="inputProductDescription" class="form-label">Short Description</label>
                                            <textarea class="form-control" id="inputProductDescription"  name="short_description" rows="3">
                                                {{$product->short_description}}
                                            </textarea>
                                        </div>

                                        <div class="form-group mb-5">
                                            <label for="inputProductDescription" class="form-label">Long Description</label>
                                            <textarea id="Long_desc" name="long_description">{{$product->long_description}}</textarea>
                                        </div>

                                    </div>
                                </div>

                                {{--Seconde Col--}}
                                <div class="col-lg-4">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            <div class="form-group col-md-6">
                                                <label for="inputPrice" class="form-label">Product Price</label>
                                                <input type="text" class="form-control" id="inputPrice" placeholder="00.00" name="selling_price"
                                                        value="{{$product->selling_price}}" >
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="inputCompareatprice" class="form-label">Discount Price</label>
                                                <input type="text" class="form-control" id="inputCompareatprice" placeholder="00.00" name="discount_price"
                                                       value="@php if($product->discount_price){$dif= $product->selling_price * ((100 - $product->discount_price)/100);echo $dif;} @endphp">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                                <input type="text" class="form-control" id="inputCostPerPrice" placeholder="XXXX" name="product_code"
                                                        value="{{$product->product_code}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputStarPoints" class="form-label">Product Quantity</label>
                                                <input type="text" class="form-control" id="inputStarPoints" placeholder="00" name="product_Qty"
                                                        value="{{$product->product_Qty}}">
                                            </div>
                                            @if($product->brand_id)
                                                <div class=" form-group col-12">
                                                    <label for="inputProductType" class="form-label">Product Brand</label>
                                                    <select name="brand_id" class="form-select" id="inputProductType">
                                                        <option value="{{$product->brand->id}}" selected>{{$product->brand->brand_name}}</option>
                                                        @foreach($Brands as $item)
                                                            <option value="{{$item->id}}">{{$item->brand_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif

                                            <div class="form-group col-12">
                                                <label for="inputProductType" class="form-label">Product Category</label>
                                                <select class="form-select" id="ProductCategory" name="category_id">
                                                    <option value="{{$product->category->id}}" selected>{{$product->category->category_name}}</option>
                                                    @foreach($Categories as $item)
                                                        <option value="{{$item->id}}">{{$item->category_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-12">
                                                <label for="inputProductType" class="form-label">Product Subcategory</label>
                                                <select class="form-select" id="ProductSubcategory" name="subcategory_id">
                                                    <option value="{{$product->subcategory->id}}" selected>{{$product->subcategory->subcategory_name}}</option>

                                                </select>
                                            </div>

                                            <div class="col-12">

                                                <div class="row g-3">

                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault"
                                                            @if($product->hot_deals) checked @endif>
                                                            <label class="form-check-label" for="flexCheckDefault"> Hot Deals</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="featured" type="checkbox" value="1" id="flexCheckDefault"
                                                                @if($product->featured) checked @endif>
                                                            <label class="form-check-label" for="flexCheckDefault">Featured</label>
                                                        </div>
                                                    </div>




                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="special_offer" type="checkbox" value="1" id="flexCheckDefault"
                                                                    @if($product->special_offer) checked @endif>
                                                            <label class="form-check-label" for="flexCheckDefault">Special Offer</label>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="special_deals" type="checkbox" value="1" id="flexCheckDefault"
                                                                    @if($product->special_deals) checked @endif>
                                                            <label class="form-check-label" for="flexCheckDefault">Special Deals</label>
                                                        </div>
                                                    </div>



                                                </div> <!-- // end row  -->

                                            </div>

                                            <hr>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-outline-secondary">Save Product</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end row-->
                        </form>
                    </div>
                </div>

            </div>
        </div>

        {{--end card --}}

        {{--card for main Image--}}
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Main image</h5>
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
                <div class="card-body p-4">
                    <div class="form-body mt-4">
                        {{--Form--}}
                        <form id="FormMainImg" method="post" action="{{route(\App\Constants\Constants::Vendor_Products_UPDATE_Img)}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_uuid" value="{{$product->products_uuid}}">
                            <input type="hidden" name="category_id" value="{{$product->category_id}}">

                            <div class="form-group mb-5">
                                <label for="formFile" class="form-label">Main Image</label>
                                <input class="form-control mb-3" type="file" id="mainImage"  name="product_thumbnail" >
                            </div>
                            <div class="col-12 mb-3">
                                <img  id="mainThmb" src="{{\Illuminate\Support\Facades\Storage::url($product->product_thumbnail)}}" alt="Image Preview"
                                        class="rounded mb-5" style="width:100px;height:100px;">
                            </div>

                            <hr>
                            <div class="col-3">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-outline-secondary">Save Image</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{--end cared main image--}}


        {{--card for Multiple Image--}}
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Multiple images Product</h5>
                <hr/>

                <div class="card-body p-4">
                    <div class="form-body mt-4">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>index</th>
                                    <th>Images</th>
                                    <th>Change Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <form id="MultipleImgForm" method="post" action="{{route(\App\Constants\Constants::Vendor_Products_UPDATE_MultiImg)}}"
                                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="product_uuid" value="{{$product->products_uuid}}">
                                    <input type="hidden" name="category_id" value="{{$product->category_id}}">

                                    <tbody>
                                    @foreach($product->MultiplImg as $img )
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    <div class="recent-product-img">
                                                        <img  class="smallImg cursor-pointer" src="{{ \Illuminate\Support\Facades\Storage::url($img->product_img_name) }}" alt="" >
                                                    </div>
                                                </td>
                                                <td>
                                                        <input id="imgMultiple" class="form-control mb-3 " type="file"  name="multiple_images[{{$img->id}}]">
                                                </td>
                                                <td>
                                                    <div class="d-flex order-actions">
                                                        <a href="{{route(\App\Constants\Constants::Vendor_Products_DESTORY_MultiImg , [$img->id , $product->products_uuid ])}}"
                                                            class="ms-4" title="Delete" id="btnDelete"><i class="bx bx-trash"></i></a>
                                                        <a href="" class="ms-4 updateImg"   title="update"><i class="bx bx-up-arrow-alt"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                    @endforeach
                                    </tbody>
                                </form>
                            </table>
                    </div>
                </div>
            </div>
        </div>
        {{--end cared Multiple image--}}

        <!-- Modal -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Image Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body text-center">
                        <img id="largeImage" src="" alt="Large Image" style="width: 180px; height: 180px;">
                    </div>
                </div>
            </div>
        </div>


        {{--card for Add multiple Images--}}
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add  Multiple Images</h5>
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
                <div class="card-body p-4">
                    <div class="form-body mt-4">
                        {{--Form--}}
                        <form id="addMultipleImgForm" method="post" action="{{route(\App\Constants\Constants::Vendor_Products_Add_MultiImg)}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_uuid" value="{{$product->products_uuid}}">
                            <input type="hidden" name="category_id" value="{{$product->category_id}}">

                            <div class="form-group mb-5">
                                <label for="inputProductDescription" class="form-label">Multiple  Images</label>
                                <input class="form-control" type="file" id="multiImg" multiple=""  name="multiple_images[]">
                            </div>
                            <div id="preview_img" class="mb-3">

                            </div>

                            <hr>
                            <div class="col-3">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-outline-secondary">Add Images</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{--end cared Add multiple Images--}}


    </div>
@endsection

@push('script')

    {{--Sweete Alret--}}
    <script>
        $(function(){
            $(document).on('click','#btnDelete',function(e){
                e.preventDefault();
                let link = $(this).attr("href");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want Delete Record?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                            'Disable!',
                            'Your Record has been Delete it.',
                            'success'
                        )
                    }
                })


            });

        });
    </script>
    {{--Pop up a image in real size--}}
    <script>
        $(document).ready(function() {
            $('.smallImg').on('click', function() {
                let src = $(this).attr('src');
                $('#largeImage').attr('src', src);
                $('#imageModal').modal('show');
            });
        });
    </script>

    {{--submit form for multiple images update --}}
    <script>
        $(".updateImg").on("click", (e)=>{
            e.preventDefault();
            $('#MultipleImgForm').submit();
        });
    </script>
    {{--Validation fields--}}
    <script>
        $(document).ready( function (){
            $("#MyForm").validate({
                rules: {
                    product_name: {
                        required : true,
                    },

                    product_thumbnail: {
                        required : true,
                        extension: "jpg|jpeg|png"
                    },

                    short_description: {
                        required : true,
                    },

                    selling_price: {
                        required : true,
                    },

                    product_code: {
                        required : true,
                    },

                    product_Qty: {
                        required : true,
                    },
                    brand_id: {
                        required : true,
                    },
                    category_id: {
                        required : true,
                    },
                    subcategory_id: {
                        required : true,
                    },
                    vendor_id: {
                        required : true,
                    },
                } ,
                messages:{
                    product_name: {
                        required :  'Please Enter Product Name',
                    },

                    product_thumbnail: {
                        required : 'Please Insert main image' ,
                    },

                    short_description: {
                        required : 'Please Enter Short Description',
                    },

                    selling_price: {
                        required : 'Please insert Price of Product',
                    },

                    product_code: {
                        required : 'Please insert The Code of Product',
                    },

                    product_Qty: {
                        required : 'Please insert The Quantity of Product',
                    },

                    brand_id: {
                        required : 'Please insert The Brand of Product',
                    },
                    category_id: {
                        required : 'Please insert The Category of Product',
                    },
                    subcategory_id: {
                        required : 'Please insert The Subcategory of Product',
                    },
                    vendor_id: {
                        required : 'Please insert The Vendor of Product',
                    },
                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element){
                    $(element).removeClass('is-invalid');
                },

            });

            $("#FormMainImg").validate({
                rules: {
                    product_thumbnail:{
                        required : true,
                    }
                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element){
                    $(element).removeClass('is-invalid');
                },

            });

            {{--Validation fields of multiple image--}}
            $("#addMultipleImgForm").validate({
                    rules :{
                        "multiple_images[]": {
                            required : true,
                            extension: "jpg|jpeg|png"
                        },
                    } ,
                    message : {
                        "multiple_images[]": {
                            required : 'Please insert images of the product ',
                            extension : "Please upload file having extensions .jpeg/.jpg/.png only."
                        },
                    },
                    errorElement : 'span',
                    errorPlacement: function (error,element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight : function(element){
                        $(element).addClass('is-invalid');
                    },
                    unhighlight : function(element){
                        $(element).removeClass('is-invalid');
                    },
                }) ;
        });
    </script>




    {{--Script show Image--}}
    <script>
        $("#mainImage").on("change" , function () {
            var inputField = this;
            if(inputField.files && inputField.files[0]){
                var reader = new FileReader();
                reader.onload = function (e){
                    $("#mainThmb").attr("src" , e.target.result).width(80).height(80).show();
                }
                reader.readAsDataURL(inputField.files[0]);
            }

        });
    </script>

    {{--For multiple image Display--}}
    <script>
        $(document).ready(function(){
            $('#multiImg').on('change', function(){

                // Clear previous images
                $('#preview_img').empty();

                // Check if the browser supports File API
                if (window.File && window.FileReader && window.FileList && window.Blob) {
                    var files = $(this)[0].files; // Get selected files

                    // Loop through each selected file
                    $.each(files, function(index, file){
                        // Check if the file is an image (GIF, JPEG, PNG)
                        if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){
                            var fileReader = new FileReader(); // Create a FileReader

                            // When the file is successfully read
                            fileReader.onload = (function(file){
                                return function(e) {
                                    // Create an image element
                                    var img = $('<img/>')
                                        .addClass('thumb m-2 rounded')
                                        .attr('src', e.target.result)
                                        .width(100)
                                        .height(80);
                                    // Add the image to the preview area
                                    $('#preview_img').append(img);
                                };
                            })(file);

                            // Read the file as a data URL
                            fileReader.readAsDataURL(file);
                        }
                    });
                } else {
                    // Alert if the browser doesn't support File API
                    alert("Your browser doesn't support File API!");
                }
            });
        });

    </script>

    {{--Fetch subcategory script--}}
    <script type="text/javascript">

        $(document).ready(function(){
            $('#ProductCategory').on('change', function(){
                var category_id = $(this).val();

                if (category_id) {
                    $.ajax({
                        url: "{{url("/api/vendor/subcategory")}}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data){

                            var $subcategory = $('#ProductSubcategory');
                            $subcategory.empty();

                            $.each(data, function(key, value){
                                $subcategory.append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                            });
                        },
                        error: function() {
                            alert('An error occurred while fetching subcategories.');
                        }
                    });
                } else {
                    alert('Please select a category.');
                }
            });
        });



    </script>

    {{--<script src="https://cdn.tiny.cloud/1/yy6b6yspza1mbcpmipy6mbs6s2kuof76k3c9uqfvm14uwl5q/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>--}}
    <script src="{{asset("backend/assets/plugins/tinymce/tinymce.min.js")}}"></script>
    <script>
        tinymce.init({
            selector: '#Long_desc'
        });
    </script>
    <!--------------------------------------->

    <script src="{{ asset('backend/assets/plugins/input-tags/js/tagsinput.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
@endpush

