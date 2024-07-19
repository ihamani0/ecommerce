@extends("backend.vendor.layout.master")

@section("title")
    Order | List
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
                    <li class="breadcrumb-item active" aria-current="page">Orders List</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    {{--Table Data--}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="MyTable"  class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Order#</th>
                        <th> Name </th>
                        <th>Status </th>
                        <th>Total </th>
                        <th>Date </th>
                        <th>View Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($OrderItems as  $item)
                        <tr>

                            <td>#{{$item->order->order_number }} </td>
                            <td>{{$item->order->name }} </td>

                            <td>

                                @switch($item->order->status)
                                    @case('pending')
                                    <div class="badge rounded-pill text-secondary bg-light-primary p-2 text-uppercase px-3">
                                        <i class="bx bxs-circle me-1"></i>
                                        {{ $item->order->status }}
                                    </div>
                                    @break

                                    @case('processing')
                                    <div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3">
                                        <i class="bx bxs-circle me-1"></i>
                                        {{ $item->order->status }}
                                    </div>
                                    @break

                                    @case('delivered')
                                    <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                        <i class="bx bxs-circle me-1"></i>
                                        {{ $item->order->status }}
                                    </div>
                                    @break

                                    @case('confirmed')
                                    <div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3">
                                        <i class="bx bxs-circle me-1"></i>
                                        {{ $item->order->status  }}
                                    </div>
                                    @break

                                    @default
                                    <p>Unknown status</p>
                                @endswitch

                            </td>

                            <td>{{ $item->order->amount }} {{ $item->order->currency }}</td>
                            <td>  {{$item->order->created_at->format('l , d-m-Y') }} </td>

                            <td>
                                <a href="{{route(App\Constants\Constants::Vendor_ORDER_VIEW , $item->order->order_number)}}"
                                   class="btn btn-outline-secondary btn-sm radius-30 px-4">
                                    <i class="fa-duotone fa-eye"></i>
                                    Details</a>
                                @if($item->order->status == 'confirmed')
                                    <a href="{{route(App\Constants\Constants::DOWNLOAD_INVOICE , $item->order->order_number)}}"
                                       class="btn btn-outline-danger btn-sm radius-30 px-4">
                                        <i class="fa-duotone fa-download"></i>
                                        Invoice</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach



                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Order#</th>
                        <th> Name </th>
                        <th>Status </th>
                        <th>Total </th>
                        <th>Date </th>
                        <th>View Details</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    {{--End table--}}
</div>





@endsection

