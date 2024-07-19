@extends("backend.vendor.layout.master")

@section("title")
    Order | View
@endsection


@section("vendor")
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route(\App\Constants\Constants::VENDOR_DASHBOARD)}}"><i class="bx bx-home-alt"></i></a>
                        </li>

                        <li class="breadcrumb-item" aria-current="page"><a href="">
                                Orders View</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Orders View</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="header"><h4>Shipping Details</h4> </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table" style="background:#F4F6FA;font-weight: 600;">
                                <tr>
                                    <th>Shipping Name:</th>
                                    <th>{{ $order->name }}</th>
                                </tr>
                                <tr>
                                    <th>Shipping Email:</th>
                                    <th>{{ $order->email }}</th>
                                </tr>

                                <tr>
                                    <th>Shipping Phone:</th>
                                    <th>{{ $order->phone_number }}</th>
                                </tr>

                                <tr>
                                    <th>Shipping Email:</th>
                                    <th>{{ $order->email }}</th>
                                </tr>

                                <tr>
                                    <th>Shipping Address:</th>
                                    <th>{{ $order->address }}</th>
                                </tr>
                                <tr>
                                    <th>City:</th>
                                    <th>{{ $order->city }}</th>
                                </tr>

                                <tr>
                                    <th>State :</th>
                                    <th>{{ $order->state}}</th>
                                </tr>

                                <tr>
                                    <th>Post Code  :</th>
                                    <th>{{ $order->code_post }}</th>
                                </tr>

                                <tr>
                                    <th>Order Date   :</th>
                                    <th>{{ $date }}</th>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="header"><h4>Order  Details <span class="text-danger">Invoice : {{ $order->invoice_number}} </span></h4>

                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table" style="background:#F3F3F3;font-weight: 600;">
                                <tr>
                                    <th> Name :</th>
                                    <th>{{ $order->user->name }}</th>
                                </tr>

                                <tr>
                                    <th>Phone :</th>
                                    <th>{{ $order->user->phone_number }}</th>
                                </tr>

                                <tr>
                                    <th>Payment Type:</th>
                                    <th>{{ $order->payment_method }}</th>
                                </tr>


                                <tr>
                                    <th>Order ID:</th>
                                    <th>{{ $order->order_number }}</th>
                                </tr>

                                <tr>
                                    <th>Invoice:</th>
                                    <th class="text-danger">{{ $order->invoice_number }}</th>
                                </tr>

                                <tr>
                                    <th>Order Amonut:</th>
                                    <th>{{ $order->amount }} {{ $order->currency }} </th>
                                </tr>

                                <tr>
                                    <th>Order Status:</th>
                                    <th>
                                        @if($order->return_status)
                                            @if($order->status=='completed')
                                                <div class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3">{{$order->status}}</div>
                                            @else
                                                <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">Return</div>
                                            @endif

                                        @else
                                            @switch($order->status)
                                                @case('pending')
                                                <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                                    {{ $order->status }}
                                                </div>
                                                @break

                                                @case('processing')
                                                <div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3">
                                                    {{ $order->status }}
                                                </div>
                                                @break

                                                @case('delivered')
                                                <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                                    {{ $order->status }}
                                                </div>
                                                @break

                                                @case('confirm')
                                                <div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3">
                                                    {{ $order->status }}
                                                </div>
                                                @break
                                                @default
                                                <p>Unknown status</p>
                                            @endswitch
                                        @endif

                                    </th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>

                                        @if($order->return_status)
                                            @if($order->status!='completed')
                                                <a href="{{route(\App\Constants\Constants::Admin_Order_Change_Status ,
                                                    ['orderID' => $order->order_number , 'status' => 'completed'])}}"
                                                   class="btn btn-outline-primary">Completed Order</a>
                                            @endif

                                        @else
                                            @switch($order->status)
                                                @case('pending')
                                                <a href="{{route(\App\Constants\Constants::Vendor_Order_Change_Status ,
                                                        ['orderID' => $order->order_number , 'status' => 'processing'])}}"
                                                   class="btn btn-outline-warning">Processing Order</a>
                                                @break

                                                @case('processing')
                                                <a href="{{route(\App\Constants\Constants::Vendor_Order_Change_Status ,
                                                            ['orderID' => $order->order_number , 'status' => 'confirmed'])}}"
                                                   class="btn btn-outline-info">Confirmed Order</a>

                                                <a href="{{route(\App\Constants\Constants::Vendor_Order_Change_Status ,
                                                            ['orderID' => $order->order_number , 'status' => 'pending'])}}"
                                                   class="btn btn-outline-danger">Pending Order</a>
                                                @break

                                                @case('confirmed')
                                                <a href="{{route(\App\Constants\Constants::Vendor_Order_Change_Status ,
                                                            ['orderID' => $order->order_number , 'status' => 'delivered'])}}"
                                                   class="btn btn-outline-success">Delivered Order</a>

                                                <a href="{{route(\App\Constants\Constants::Vendor_Order_Change_Status ,
                                                            ['orderID' => $order->order_number , 'status' => 'processing'])}}"
                                                   class="btn btn-outline-warning">Processing Order</a>
                                                @break

                                                @default
                                                <p>N/A</p>
                                    @endswitch
                                    @endif

                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 ">
                <div class="card">
                    <div class="card-body">
                        <div class="header"><h4>Items Details</h4> </div>
                        <hr>
                        <div class="table-responsive">

                            <table class="table table-striped table-bordered dataTable"  >
                                <tbody>
                                <tr>
                                    <td class="col-md-1">
                                        <label>Image </label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>Product Name </label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>Vendor Name </label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>Product Code  </label>
                                    </td>
                                    <td class="col-md-1">
                                        <label>Color </label>
                                    </td>
                                    <td class="col-md-1">
                                        <label>Size </label>
                                    </td>
                                    <td class="col-md-1">
                                        <label>Quantity </label>
                                    </td>

                                    <td class="col-md-3">
                                        <label>Price  </label>
                                    </td>

                                </tr>


                                @foreach($orderItems as $item)
                                    <tr>
                                        <td class="col-md-1">
                                            <label><img src="{{ \Illuminate\Support\Facades\Storage::url($item->product->product_thumbnail)}}" style="width:50px; height:50px;"  alt=""> </label>
                                        </td>
                                        <td class="col-md-2">
                                            <label>{{ $item->product->product_name }}</label>
                                        </td>
                                        @if($item->vendor_id == NULL)
                                            <td class="col-md-2">
                                                <label>Owner </label>
                                            </td>
                                        @else
                                            <td class="col-md-2">
                                                <label>{{ $item->product->vendor->username }} </label>
                                            </td>
                                        @endif

                                        <td class="col-md-2">
                                            <label>{{ $item->product->product_code }} </label>
                                        </td>
                                        @if($item->color == NULL)
                                            <td class="col-md-1">
                                                <label>.</label>
                                            </td>
                                        @else
                                            <td class="col-md-1">
                                                <label>{{ $item->color }} </label>
                                            </td>
                                        @endif

                                        @if($item->size == NULL)
                                            <td class="col-md-1">
                                                <label>.</label>
                                            </td>
                                        @else
                                            <td class="col-md-1">
                                                <label>{{ $item->size }} </label>
                                            </td>
                                        @endif
                                        <td class="col-md-1">
                                            <label>{{ $item->qty }} </label>
                                        </td>

                                        <td class="col-md-3">
                                            <label>{{ $item->price }} {{$order->currency}}<br> <span class="fw-bold"> Total = ${{ $item->price * $item->qty }} {{$order->currency}} </span>   </label>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        @if($order->return_status)
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="header"><h4>Return Reason</h4> </div>
                            <hr>
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered dataTable"  >
                                    <tbody>
                                    <tr>

                                        <td class="col-md-2">
                                            <label> Name </label>
                                        </td>

                                        <td class="col-md-1">
                                            <label>Reason </label>
                                        </td>


                                    </tr>



                                    <tr>
                                        <td class="col-md-1">
                                            <label>{{ $order->name }} </label>
                                        </td>

                                        <td class="col-md-3">
                                            <label>{{ $order->return_reason}}</label>
                                        </td>
                                    </tr>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif
    </div>
@endsection
