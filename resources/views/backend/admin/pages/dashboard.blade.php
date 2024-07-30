@extends("backend.admin.layout.master")

@section("title")
    dashboard
@endsection

@push("style")
{{-- style her if you want  --}}

@endpush

@section("admin")
<div class="page-content">

    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-end">
                <span class="display-5 fs-5 fw-bold">Today : {{\Carbon\Carbon::today()->format('Y-m-d')}}</span>
            </div>
        </div>
    </div>

    <hr>

    @if(auth()->guard('admin')->user()->can('view.dashboard'))
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">

            <div class="col">
                <div class="card radius-10 bg-gradient-deepblue">
                 <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{$TotalOrders}}</h5>
                        <div class="ms-auto">
                            <i class='bx bx-cart fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Orders</p>
                        {{--<p class="mb-0 ms-auto">+4.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>--}}
                    </div>
                </div>
              </div>
            </div>

            <div class="col">
                <div class="card radius-10 bg-gradient-orange">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{$TotalRevenue}}</h5>
                        <div class="ms-auto">
                            <i class='fa-solid fa-d fs-5 text-white'></i><i class='fa-solid fa-z fs-5 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Revenue(day)</p>
                        {{--<p class="mb-0 ms-auto">+1.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>--}}
                    </div>
                </div>
              </div>
            </div>

            <div class="col">
                <div class="card radius-10 bg-gradient-moonlit">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{$Visit}}</h5>
                        <div class="ms-auto">
                            <i class='fa-light fa-eye fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Visitors(day)</p>

                    </div>
                </div>
            </div>
            </div>

            <div class="col">
                <div class="card radius-10 bg-gradient-ohhappiness">
                 <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{$OrderDelivered}}</h5>
                        <div class="ms-auto">
                            <i class='fa-light fa-truck-fast fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Orders Delivered</p>
                        {{--<p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>--}}
                    </div>
                </div>
             </div>
            </div>

        </div>
        <!--end row-->
        <div class="row  row-cols-1 row-cols-md-2 row-cols-xl-4 mt-3">

            <div class="col">
                <div class="card radius-10 bg-gradient-ibiza">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{$OrderReturn}}</h5>
                            <div class="ms-auto">
                                <i class="fa-solid fa-box-open-full fs-3 text-light"></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Orders Returned</p>
                            {{--<p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>--}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end row-->
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Orders Summary</h5>
                    </div>
                    <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order id</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Price</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($AllOrders->take(10) as $order)
                            <tr>
                                <td><a href="{{route(App\Constants\Constants::Admin_Order_VIEW , $order->order_number)}}">
                                        {{$order->order_number}}
                                    </a></td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->created_at->format('l, d-m-Y')}}</td>
                                <td>{{number_format($order->amount,2)}} {{$order->currency}}</td>
                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge rounded-pill bg-warning">{{$order->status}}</span>
                                    @elseif($order->status == 'confirmed')
                                        <span class="badge rounded-pill bg-info">{{$order->status}}</span>
                                    @elseif($order->status == 'processing')
                                        <span class="badge rounded-pill bg-secondary">{{$order->status}}</span>

                                    @elseif($order->status == 'delivered')
                                        @if($order->return_status)
                                            <span class="badge rounded-pill bg-warning">Processing</span>  <span class="badge rounded-pill bg-danger">Return</span>
                                        @else
                                            <span class="badge rounded-pill bg-success">Delivered</span>
                                        @endif

                                    @elseif($order->status == 'completed')
                                        <span class="badge rounded-pill bg-primary">Completed</span> <span class="badge rounded-pill bg-danger">Return</span>
                                    @endif

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @endif
</div>
@endsection


@push("script")
{{-- Script her if you want --}}

@endpush
