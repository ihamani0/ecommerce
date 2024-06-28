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


    <div class="container mb-30 mt-50">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="mb-50">
                    <h1 class="heading-2 mb-10">Your Wishlist</h1>
                    <h6 class="text-body">There are <span class="text-brand">{{count($user->wishlist)}}</span> products in this list</h6>
                </div>
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                        <tr class="main-heading">
                            <th scope="col" class="custome-checkbox start pl-30" > # </th>
                            <th scope="col" colspan="2">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock Status</th>
                            <th scope="col">Action</th>
                            <th scope="col" class="end">Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->wishlist as $product)


                            <tr class="pt-30">
                                <td class="custome-checkbox pl-30">
                                    {{$loop->iteration}}
                                </td>
                                <td class="image product-thumbnail pt-40">
                                    <img src="{{\Illuminate\Support\Facades\Storage::url($product->product_thumbnail)}}" alt="#" />
                                </td>

                                <td class="product-des product-name">
                                    <h6><a class="product-name mb-10"
                                           href="{{route(App\Constants\Constants::WEB_Products_Details , ['uuid' =>$product->products_uuid , 'slug' => $product->product_slug ])}}">
                                            {{$product->product_name}}</a></h6>

                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>

                                </td>

                                <td class="price" data-title="Price">
                                    @if($product->discount_price)
                                        <h3 class="text-brand">{{ $product->selling_price *   ($product->discount_price / 100)}} Dz</h3>
                                    @else
                                        <h3 class="text-brand">{{$product->selling_price}} Dz</h3>
                                    @endif

                                </td>

                                <td class="text-center detail-info" data-title="Stock">
                                    @if($product->product_Qty > 0)
                                        <span class="stock-status in-stock mb-0"> In Stock </span>
                                    @else
                                        <span class="stock-status out-stock mb-0"> Out Stock </span>
                                    @endif

                                </td>

                                <td class="action text-center" data-title="Remove">

                                   <a  href="{{route(\App\Constants\Constants::USER_WISHLIST_DESTROY_PRODUCT , $product->id)}}" class="text-body" >
                                       <i class="fi-rs-trash"></i></a>

                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')

@endpush
