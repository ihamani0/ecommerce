@extends('backend.vendor.layout.master')

@section('title')
    Products | List
@endsection


@section('vendor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route(App\Constants\Constants::VENDOR_DASHBOARD) }}"><i
                                    class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Products List</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route(App\Constants\Constants::Vendor_Products_ADD) }}" type="button"
                        class="btn btn-outline-primary">Add Products</a>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->

        {{-- Table Data --}}
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="MyTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <td>Num</td>
                                <td>Image </td>
                                <td>Product Name </td>
                                <td>Price </td>
                                <td>QTY </td>
                                <td>Discount </td>
                                <td>Status </td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $item)
                                <tr>

                                    <td> {{ $key + 1 }} </td>
                                    <td> <img src="{{ \Illuminate\Support\Facades\Storage::url($item->product_thumbnail) }}"
                                            style="width:40px;height:40px;" class="rounded-2"
                                            alt="{{ $item->product_slug }}">
                                    </td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->selling_price }}</td>
                                    <td>{{ $item->product_Qty }}</td>
                                    <td>
                                        @if (!$item->discount_price)
                                            <span class="badge rounded-pill bg-secondary">No discount</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">{{ $item->discount_price }} %</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status)
                                            <span class="badge rounded-2 bg-success">available</span>
                                        @else
                                            <span class="badge bg-danger">not available</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route(\App\Constants\Constants::Vendor_Products_EDIT, $item->products_uuid) }}"
                                            class="btn btn-outline-secondary" id="edit">
                                            <i class="fa-duotone fa-pen-nib"></i></a>
                                        <a href="{{ route(\App\Constants\Constants::Vendor_Products_INDEX) }}"
                                            type="button" class="btn btn-outline-info" title="details">
                                            <i class="fa-duotone fa-eye"></i></a>
                                        <a href="{{ route(\App\Constants\Constants::Vendor_Products_DESTORY, $item->products_uuid) }}"
                                            type="button" class="btn btn-outline-danger" id="deleteBtn">
                                            <i class="fa-duotone fa-trash"></i></a>
                                        <a href="{{ route(\App\Constants\Constants::Vendor_Products_Status, $item->products_uuid) }}"
                                            type="button" class="btn btn-outline-success"
                                            title="@if ($item->status) inactive @else active @endif">
                                            <i
                                                class="fa-solid p-1 @if ($item->status) fa-stop @else fa-play @endif"></i>
                                        </a>


                                    </td>

                                </tr>
                            @endforeach



                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Num</th>
                                <th>Image </th>
                                <th>Product Name </th>
                                <th>Price </th>
                                <th>QTY </th>
                                <th>Discount </th>
                                <th>Status </th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        {{-- End table --}}
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            $(document).on('click', '#deleteBtn', function(e) {
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
