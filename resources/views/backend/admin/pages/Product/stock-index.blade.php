@extends("backend.admin.layout.master")

@section("title")
    Stock | List
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
                        <li class="breadcrumb-item active" aria-current="page">Products List</li>
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
                            <th>#</th>
                            <th>Image </th>
                            <th>Product Name </th>
                            <th>QTY </th>
                            <th>Edit </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as  $item)
                            <tr>

                                <td> {{ $loop->iteration }} </td>
                                <td> <img src="{{ \Illuminate\Support\Facades\Storage::url($item->product_thumbnail) }}"
                                          style="width:40px;height:40px;" class="rounded-2" alt="{{$item->product_slug}}">
                                </td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->product_Qty }}</td>
                                <td>
                                    <a onclick="showModal(this)"  data-uuid="{{$item->products_uuid}}" class="btn btn-outline-warning" title="edit-stock">
                                      <i class="fa-duotone fa-pen"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach



                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Image </th>
                            <th>Product Name </th>
                            <th>QTY </th>
                            <th>Edit </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        {{--End table--}}
    </div>


    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg d-flex justify-content-center">
            <div class="modal-content w-75">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <form method="POST" action="{{route(\App\Constants\Constants::Admin_Stock_Change)}}">
                                @csrf
                                <input type="hidden" id="product_uuid" name="product_uuid" value="" >
                                <div data-mdb-input-init class="form-outline mb-4 ">
                                    <label for="inputProductTitle" class="form-label">Stock <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="qty" id="inputProductTitle" placeholder="Enter Stock Her " >
                                </div>

                                <button type="submit"  data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-secondary btn-block">Change</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
@push('script')
<script>
    function showModal(element){
        let uuid = element.getAttribute('data-uuid');
        $("#product_uuid").val(uuid);
        $('#Modal').modal('show');
    }
</script>
@endpush


