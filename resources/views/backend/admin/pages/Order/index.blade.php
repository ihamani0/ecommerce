@extends("backend.admin.layout.master")

@section("title")
    Order | List
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
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <td>Num</td>
                        <th>Date </th>
                        <th>Invoice </th>
                        <th>Amount </th>
                        <th>Payment </th>
                        <th>State </th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Orders as  $order)
                        <tr>

                            <td> {{ $loop->iteration }} </td>
                            <td>  {{$order->created_at->format('Y-m-d') }} </td>
                            <td>{{ $order->invoice_number }}</td>
                            <td>{{ $order->amount }} {{ $order->currency }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td>
                                <span class="badge rounded-pill bg-danger">
                                    {{ $order->status }}</span>
                            </td>

                            <td>
                                <a  href="#" class="btn btn-outline-secondary" id="details">
                                    <i class="fa-duotone fa-eye"></i></a>

                            </td>

                        </tr>
                    @endforeach



                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Num</th>
                        <th>Date </th>
                        <th>Invoice </th>
                        <th>Amount </th>
                        <th>Payment </th>
                        <th>State </th>
                        <th>Action</th>
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

