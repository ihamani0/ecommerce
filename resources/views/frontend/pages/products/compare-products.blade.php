@extends("frontend.layout.master")

@section("main")
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route(\App\Constants\Constants::WELCOME)}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop <span></span> Fillter
            </div>
        </div>
    </div>


    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <h1 class="heading-2 mb-10">Products Compare</h1>
                <h6 class="text-body mb-40">There are products to compare</h6>
                <div class="table-responsive">

                        <table class="table text-center table-compare">
                            <tbody>

                            <tr class="pr_image">
                                <td class="text-muted font-sm fw-600 font-heading mw-200">Preview</td>
                                @foreach($user->compare as $product)
                                <td class="row_img"><img src="{{\Illuminate\Support\Facades\Storage::url($product->product_thumbnail)}}" width="250" height="250" alt="compare-img" /></td>
                                @endforeach
                            </tr>
                            <tr class="pr_title">
                                <td class="text-muted font-sm fw-600 font-heading">Name</td>
                                @foreach($user->compare as $product)
                                    <td class="product_name">
                                        <h6><a href="{{route(\App\Constants\Constants::WEB_Products_Details,
                                                                ['uuid'=>$product->products_uuid , 'slug'=> $product->product_slug])}}" class="text-heading">
                                                {{$product->product_name}}</a></h6>
                                    </td>
                                @endforeach


                            </tr>
                            <tr class="pr_price">
                                <td class="text-muted font-sm fw-600 font-heading">Price</td>
                                @foreach($user->compare as $product)
                                    <td class="product_price">
                                        @if($product->discount_price)
                                            <h4 class="price text-brand">{{ $product->selling_price *  ($product->discount_price / 100) }} Dz</h4>
                                        @else
                                            <h4 class="price text-brand">{{$product->selling_price}} Dz</h4>
                                        @endif

                                    </td>
                                @endforeach


                            </tr>

                            <tr class="description">
                                <td class="text-muted font-sm fw-600 font-heading">Description</td>
                                @foreach($user->compare as $product)
                                    <td class="row_text font-xs">
                                        <p class="font-sm text-muted">{{$product->short_description}}</p>
                                    </td>
                                @endforeach

                            </tr>
                            <tr class="pr_stock">
                                <td class="text-muted font-sm fw-600 font-heading">Stock status</td>
                                @foreach($user->compare as $product)
                                    @if($product->product_Qty > 0 )
                                        <td class="row_stock"><span class="stock-status in-stock mb-0">In Stock</span></td>
                                    @else
                                        <td class="row_stock"><span class="stock-status out-stock mb-0">Out Stock</span></td>
                                    @endif

                                @endforeach


                            </tr>

                            <tr class="pr_add_to_cart">
                                <td class="text-muted font-sm fw-600 font-heading">Buy now</td>
                                @foreach($user->compare as $product)
                                    <td class="row_btn">
                                        @if($product->product_Qty > 0 )
                                            <a data-uuid="{{$product->products_uuid}}" onclick="addToCart(this)"
                                               class="btn btn-sm"><i class="fi-rs-shopping-bag mr-5"></i>Add to cart</a>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>


                            <tr class="pr_remove text-muted">
                                <td class="text-muted font-md fw-600"></td>
                                @foreach($user->compare as $product)
                                    <td class="row_remove">
                                        <a href="{{route(\App\Constants\Constants::USER_COMPARE_DESTROY_PRODUCT, $product->id)}}" class="text-muted"><i class="fi-rs-trash mr-5"></i><span>Remove</span> </a>
                                    </td>
                                @endforeach


                            </tr>

                            </tbody>
                        </table>


                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')

@endpush
