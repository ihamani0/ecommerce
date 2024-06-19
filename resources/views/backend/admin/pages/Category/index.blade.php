@extends("backend.admin.layout.master")

@section("title")
    Category | List
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
                <a  href="{{route(App\Constants\Constants::Admin_Category_ADD)}}" type="button" class="btn btn-outline-primary">Add Category</a>
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
                        <th>Name Category</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categorys as  $key => $item)
                        <tr>

                            <td> {{ $key+1 }} </td>
                            <td>{{ $item->category_name }}</td>
                            <td><img src="{{  Storage::url($item->category_img) }}" style="width: 70px; height:40px;" alt="Image" >  </td>
                            <td>
                                <a  href="{{route(\App\Constants\Constants::Admin_Category_EDIT,$item->uuid_category)}}" class="btn btn-outline-secondary" id="edit"><i class="fa-duotone fa-pen-nib"></i>
                                </a>
                                <a href="{{route(Constants::Admin_Category_DESTORY,$item->uuid_category)}}"  type="button" class="btn btn-outline-danger" id="deleteBtn"><i class="fa-duotone fa-trash"></i>
                                </a>

                            </td>

                        </tr>
                    @endforeach



                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Num</th>
                        <th>Name Brand</th>
                        <th>Logo</th>
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
