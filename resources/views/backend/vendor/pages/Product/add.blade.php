@extends('backend.vendor.layout.master')

@section('title')
    Product | Add
@endsection

@push('style')
    <link href="{{ asset('backend/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
@endpush

@section('vendor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Form :</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route(Constants::VENDOR_DASHBOARD) }}"><i
                                    class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Product </li>
                    </ol>
                </nav>
            </div>


        </div>
        <!--end breadcrumb-->


        {{-- ADD Brand --}}

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add Product</h5>

                <hr />

                @if ($errors->any())
                    <div class="row mb-3 alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body p-4">

                    <h5 class="card-title">Add New Product</h5>
                    <hr>
                    <div class="form-body mt-4">
                        {{-- Form --}}
                        <form id="MyForm" method="post"
                            action="{{ route(\App\Constants\Constants::Vendor_Products_STORE) }}"
                            enctype="multipart/form-data">

                            @csrf

                            {{-- THis input hidden for vendor Id  --}}
                            <input type="hidden" name="vendor_id" value="{{auth()->user()->id}}">
                            <div class="row">
                                {{-- First Column --}}
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">

                                        <div class="form-group mb-3">
                                            <label for="inputProductTitle" class="form-label">Product Title</label>
                                            <input type="text" class="form-control" name="product_name"
                                                id="inputProductTitle" placeholder="Enter product title"
                                                value="{{ old('product_name') }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="inputProductTitle" class="form-label">Product tags</label>
                                            <input type="text" class="form-control visually-hidden" name="product_tags"
                                                data-role="tagsinput" value="new product">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="inputProductTitle" class="form-label">Product Size</label>
                                            <input type="text" class="form-control visually-hidden" name="product_size"
                                                data-role="tagsinput" value="XS,S">
                                        </div>

                                        <div class="form-group mb-5">
                                            <label for="inputProductTitle" class="form-label">Product Color</label>
                                            <input type="text" class="form-control visually-hidden" name="product_color"
                                                data-role="tagsinput" value="white">
                                        </div>


                                        <div class="form-group mb-3">
                                            <label for="inputProductDescription" class="form-label">Short
                                                Description</label>
                                            <textarea class="form-control" id="inputProductDescription" name="short_description" rows="3"></textarea>
                                        </div>

                                        <div class="form-group mb-5">
                                            <label for="inputProductDescription" class="form-label">Long Description</label>
                                            <textarea id="Long_desc" name="long_description"> </textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="formFile" class="form-label">Main Image</label>
                                            <input class="form-control mb-3" type="file" id="mainImage"
                                                name="product_thumbnail">
                                            <img id="mainThmb" src="" alt="Image Preview" class="rounded mb-5"
                                                style="display: none;">
                                        </div>

                                        <div class="form-group mb-5">
                                            <label for="inputProductDescription" class="form-label">Multiple Images</label>
                                            <input class="form-control" type="file" id="multiImg" multiple=""
                                                name="multiple_images[]">
                                        </div>
                                        <div id="preview_img" class="mb-3">

                                        </div>

                                    </div>
                                </div>

                                {{-- Seconde Col --}}
                                <div class="col-lg-4">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            <div class="form-group col-md-6">
                                                <label for="inputPrice" class="form-label">Product Price</label>
                                                <input type="text" class="form-control" id="inputPrice"
                                                    placeholder="00.00" name="selling_price"
                                                    value="{{ old('selling_price') }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputCompareatprice" class="form-label">Discount Price</label>
                                                <input type="text" class="form-control" id="inputCompareatprice"
                                                    placeholder="00.00" name="discount_price"
                                                    value="{{ old('discount_price') }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                                <input type="text" class="form-control" id="inputCostPerPrice"
                                                    placeholder="XXXX" name="product_code"
                                                    value="{{ old('product_code') }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputStarPoints" class="form-label">Product Quantity</label>
                                                <input type="text" class="form-control" id="inputStarPoints"
                                                    placeholder="00" name="product_Qty" value="{{ old('product_Qty') }}">
                                            </div>
                                            <div class=" form-group col-12">
                                                <label for="inputProductType" class="form-label">Product Brand</label>
                                                <select name="brand_id" class="form-select" id="inputProductType">
                                                    <option disabled selected>Brands</option>
                                                    @foreach ($Brands as $item)
                                                        <option value="{{ $item->id }}">{{ $item->brand_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-12">
                                                <label for="inputProductType" class="form-label">Product Category</label>
                                                <select class="form-select" id="ProductCategory" name="category_id">
                                                    <option disabled selected>Categories</option>
                                                    @foreach ($Categories as $item)
                                                        <option value="{{ $item->id }}">{{ $item->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group col-12">
                                                <label for="inputProductType" class="form-label">Product
                                                    Subcategory</label>
                                                <select class="form-select" id="ProductSubcategory"
                                                    name="subcategory_id">
                                                    <option disabled selected>Subcategories</option>

                                                </select>
                                            </div>

                                            <div class="col-12">

                                                <div class="row g-3">

                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="hot_deals"
                                                                type="checkbox" value="1" id="flexCheckDefault">
                                                            <label class="form-check-label" for="flexCheckDefault"> Hot
                                                                Deals</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="featured"
                                                                type="checkbox" value="1" id="flexCheckDefault">
                                                            <label class="form-check-label"
                                                                for="flexCheckDefault">Featured</label>
                                                        </div>
                                                    </div>




                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="special_offer"
                                                                type="checkbox" value="1" id="flexCheckDefault">
                                                            <label class="form-check-label" for="flexCheckDefault">Special
                                                                Offer</label>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="special_deals"
                                                                type="checkbox" value="1" id="flexCheckDefault">
                                                            <label class="form-check-label" for="flexCheckDefault">Special
                                                                Deals</label>
                                                        </div>
                                                    </div>



                                                </div> <!-- // end row  -->

                                            </div>

                                            <hr>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-outline-secondary">Save
                                                        Product</button>
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


        {{-- End Brand --}}
    </div>
@endsection

@push('script')
    {{-- Validation fields --}}
    <script>
        $(document).ready(function() {
            $("#MyForm").validate({
                rules: {
                    product_name: {
                        required: true,
                    },

                    product_thumbnail: {
                        required: true,
                    },

                    short_description: {
                        required: true,
                    },

                    "multiple_images[]": {
                        required: true,
                    },

                    selling_price: {
                        required: true,
                    },

                    product_code: {
                        required: true,
                    },

                    product_Qty: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    subcategory_id: {
                        required: true,
                    },
                    vendor_id: {
                        required: true,
                    },
                },
                messages: {
                    product_name: {
                        required: 'Please Enter Product Name',
                    },

                    product_thumbnail: {
                        required: 'Please Insert main image',
                    },

                    short_description: {
                        required: 'Please Enter Short Description',
                    },

                    "multiple_images[]": {
                        required: 'Please insert imgaes of the product ',
                    },

                    selling_price: {
                        required: 'Please insert Price of Product',
                    },

                    product_code: {
                        required: 'Please insert The Code of Product',
                    },

                    product_Qty: {
                        required: 'Please insert The Quantity of Product',
                    },
                    category_id: {
                        required: 'Please insert The Category of Product',
                    },
                    subcategory_id: {
                        required: 'Please insert The Subcategory of Product',
                    },
                    vendor_id: {
                        required: 'Please insert The Vendor of Product',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                },

            });
        });
    </script>

    {{-- Script show Image --}}
    <script>
        $("#mainImage").on("change", function() {
            var inputField = this;
            if (inputField.files && inputField.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#mainThmb").attr("src", e.target.result).width(80).height(80).show();
                }
                reader.readAsDataURL(inputField.files[0]);
            }

        });
    </script>

    {{-- For multiple image Display --}}
    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() {

                // Clear previous images
                $('#preview_img').empty();

                // Check if the browser supports File API
                if (window.File && window.FileReader && window.FileList && window.Blob) {
                    var files = $(this)[0].files; // Get selected files

                    // Loop through each selected file
                    $.each(files, function(index, file) {
                        // Check if the file is an image (GIF, JPEG, PNG)
                        if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                            var fileReader = new FileReader(); // Create a FileReader

                            // When the file is successfully read
                            fileReader.onload = (function(file) {
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

    {{-- Fetch subcategory script --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#ProductCategory').on('change', function() {
                var category_id = $(this).val();

                if (category_id) {
                    $.ajax({
                        url: "{{ url('/api/vendor/subcategory') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {

                            var $subcategory = $('#ProductSubcategory');
                            $subcategory.empty();

                            $.each(data, function(key, value) {
                                $subcategory.append('<option value="' + value.id +
                                    '">' + value.subcategory_name + '</option>');
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

    {{-- <script src="https://cdn.tiny.cloud/1/yy6b6yspza1mbcpmipy6mbs6s2kuof76k3c9uqfvm14uwl5q/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> --}}
    <script src="{{ asset('backend/assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#Long_desc'
        });
    </script>
    <!--------------------------------------->

    <script src="{{ asset('backend/assets/plugins/input-tags/js/tagsinput.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
@endpush
