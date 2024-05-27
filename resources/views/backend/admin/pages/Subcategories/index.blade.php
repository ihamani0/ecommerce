@extends("backend.admin.layout.master")

@section("title")
    SubCategory | List
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
                    <li class="breadcrumb-item active" aria-current="page">Category List</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <div class="btn-group">
                <a  href="{{route(App\Constants\Constants::Admin_SubCategory_ADD)}}" type="button" class="btn btn-outline-primary">Add SubCategory</a>
            </div>
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
                        <th>Num</th>
                        <th>Category</th>
                        <th>SubCategory</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subcategorys as  $key => $item)
                        <tr>

                            <td> {{ $key+1 }} </td>
                            <td>{{ $item->category->category_name }}</td>
                            <td>{{ $item->subcategory_name }}</td>
                            <td>
                                <a  href="{{route(\App\Constants\Constants::Admin_SubCategory_EDIT,$item->uuid_subcategory)}}" class="btn btn-outline-secondary" id="edit"><i class="bx bx-pen me-0"></i></a>
                                <a href="{{route(Constants::Admin_SubCategory_DESTORY,$item->uuid_subcategory)}}"  type="button" class="btn btn-outline-danger" id="deleteBtn"><i class="bx bx-trash me-0"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach



                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Num</th>
                        <th>Category</th>
                        <th>SubCategory</th>
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
                var link = $(this).attr("href");

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
