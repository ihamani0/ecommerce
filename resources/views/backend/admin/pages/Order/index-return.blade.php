@extends("backend.admin.layout.master")

@section("title")
    Return | List
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
                        <li class="breadcrumb-item active" aria-current="page">Return List</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        {{--Table Data--}}
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Order#</th>
                            <th> Name </th>
                            <th>Status </th>
                            <th>Total </th>
                            <th>Date </th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Orders as  $order)
                            <tr>

                                <td>#{{ $order->order_number }}</td>
                                <td> {{ $order->name }} </td>
                                <td>
                                    @if($order->status == "completed")
                                        <div class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3">
                                            <i class="bx bxs-circle me-1"></i>Complete
                                        </div>
                                    @else
                                        <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                            <i class="bx bxs-circle me-1"></i>Return
                                        </div>
                                    @endif
                                </td>

                                <td>{{ $order->amount }} {{ $order->currency }}</td>
                                <td>  {{$order->created_at->format('l , d-m-Y') }} </td>
                                <td>
                                    <a href="{{route(App\Constants\Constants::Admin_Order_VIEW , $order->order_number)}}"
                                       class="btn btn-outline-primary btn-sm radius-30 px-4">
                                        <i class="fa-light fa-eye"></i>
                                        Details</a>
                                    {{--@if($order->status != "complete-return-process")
                                    <a href="{{route(App\Constants\Constants::Admin_Order_Change_Status,
                                                    ["orderID" => $order->order_number , "status" => "complete-return-process" ])}}"
                                       class="btn btn-outline-success btn-sm radius-30 px-4">
                                        <i class="fa-light fa-check"></i>
                                        Complete Return</a>
                                    @endif--}}
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

@push('script')
    <script>
        $(function(){
            $(document).on('click','#deleteBtn',function(e){
                e.preventDefault();
                const link = $(this).attr("href");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })


            });

        });
    </script>
@endpush

