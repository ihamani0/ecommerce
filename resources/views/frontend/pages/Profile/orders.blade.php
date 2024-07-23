@extends('frontend.pages.account')

@push('style')
    <style>
        /* Hide scrollbar for Chrome, Safari, and Opera */
        .modal-dialog-scrollable .modal-body::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge, and Firefox */
        .modal-dialog-scrollable .modal-body {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }

        .accordion-button:focus{
            z-index: 3;
            border-color: #198754;
            outline: 0;
            box-shadow: 0 0 0 .25rem rgba(255, 255, 255, 0.25);
        }
        .accordion-button:not(.collapsed) {
            color: #ffffff;
            background-color: #198754;
        }
    </style>
@endpush

@section('account')
                {{--Orders--}}
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Your Orders</h3>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="table align-middle mb-0">
                            <table class="table table-responsive mb-0 table-hover">
                                <thead>
                                <tr>
                                    <th>n</th>
                                    <td>Num Order</td>
                                    <th>Date </th>
                                    <th>Amount </th>
                                    <th>Invoice </th>
                                    <th>State </th>
                                    <th>View</th>
                                    <th>Invoice</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($Orders as $order)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$order->order_number}}</td>
                                        <td>{{$order->created_at->format('l, d-m-Y')}}</td>
                                        <td>{{$order->amount}} {{$order->currency}}</td>
                                        <td>{{$order->invoice_number}}</td>
                                        <td>
                                            @if($order->status == 'pending')
                                                <span class="badge rounded-pill bg-warning">{{$order->status}}</span>
                                            @elseif($order->status == 'confirmed')
                                                <span class="badge rounded-pill bg-info">{{$order->status}}</span>
                                            @elseif($order->status == 'processing')
                                                <span class="badge rounded-pill bg-secondary">{{$order->status}}</span>
                                            @elseif($order->status == 'delivered')
                                                @if($order->return_status)
                                                    <span class="badge bg-danger">Return</span>
                                                @endif
                                                <span class="badge rounded-pill bg-success">Delivered</span>
                                            @endif
                                        </td>
                                        <td><a class="btn-sm btn-success" aria-label="Quick view" data-order-id="{{$order->order_number}}" onclick="fetchOrderDetails(this)"
                                               data-bs-toggle="modal" data-bs-target="#ViewModalOrder"><i class="fa-light fa-eye"></i></a>
                                            </td>
                                        <td><a href="{{route(\App\Constants\Constants::DOWNLOAD_INVOICE , $order->order_number)}}" class="btn-sm btn-warning"><i class="fa-light fa-download"></i></a></td>
                                    </tr>
                                @endforeach



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@push('script')
    <script>
        $("#orders-tab").addClass('active');
    </script>


@endpush
