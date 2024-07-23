@extends("frontend.layout.master")

@section("main")
    <main class="main pages">


        {{--Verify Verification Email--}}
        @if(! \Illuminate\Support\Facades\Auth::user()->hasVerifiedEmail())
            <div class="row shadow-lg p-3 mb-5 bg-body rounded ">
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <div>
                        Please Verify you email we send you verification
                    </div>
                </div>
            </div>
        @endif


        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route(\App\Constants\Constants::WELCOME)}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12 m-auto">
                        <div class="row">

                            {{--Side Nav--}}
                            <div class="col-md-3">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a  class="nav-link" id="dashboard-tab"
                                                href="{{route(\App\Constants\Constants::USER_ACCOUNT_DASHBOARD)}}">
                                                <i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab"
                                               href="{{route(\App\Constants\Constants::USER_ACCOUNT_Orders)}}">
                                                <i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="return-orders-tab"
                                               href="{{route(\App\Constants\Constants::USER_ACCOUNT_INDEX_Return_Orders)}}">
                                                <i class="fi-rs-shopping-bag mr-10"></i>Orders Return</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="track-orders-tab"
                                               href="{{route(\App\Constants\Constants::USER_ACCOUNT_Track_Orders)}}">
                                                <i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="address-tab"
                                               href="{{route(\App\Constants\Constants::USER_ACCOUNT_ADDRESS_DETAILS)}}" >
                                                <i class="fi-rs-marker mr-10"></i>My Address</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-detail-tab"
                                               href="{{route(\App\Constants\Constants::USER_ACCOUNT_UPDATE_INDEX)}}" >
                                                <i class="fi-rs-user mr-10"></i>Account details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="change-password-tab"
                                               href="{{route(\App\Constants\Constants::USER_ACCOUNT_CHANGE_PASSWORD)}}" >
                                                <i class="fi-rs-lock mr-10"></i>Change password</a>
                                        </li>
                                        {{--delete-account-tab--}}
                                        <li class="nav-item">
                                            <a class="nav-link" id="delete-account-tab"
                                               href="{{route(\App\Constants\Constants::USER_ACCOUNT_DELETE_INDEX)}}">
                                                <i class="fi-rs-delete mr-10"></i>Delete Account</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" style="background-color: #f3f3f3" href="{{route(\App\Constants\Constants::USER_LOGOUT)}}">
                                                    <i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            {{--End Side Nav--}}
                            <div class="col-md-9">
                                <div class="tab-content account dashboard-content pl-50">

                                    @if ($errors->any())
                                        <div class="row mb-3 alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif



                                        {{--Slot Her --}}
                                        @yield("account")
                                        {{----}}
                                        {{--View THe Order--}}
                                        <!-- Quick view Order Modal-->
                                        <div class="modal fade custom-modal" id="ViewModalOrder" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal"></button>
                                                    <div class="modal-body">
                                                        {{--Row Table--}}
                                                        <div class="row">

                                                            <div class="col-12 col-lg-6 mb-3">
                                                                <div class="card">
                                                                    <div class="card-header"><h4>Order Details</h4> </div>
                                                                    <div class="card-body">
                                                                        <div class="table-responsive">
                                                                            <table id="tableShipping" class="mb-0 table-hover">
                                                                                {{--Fetch ajax--}}
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-lg-6 mb-3">
                                                                <div class="card">
                                                                    <div class="card-header"><h4>Order Details</h4> </div>
                                                                    <div class="card-body">
                                                                        <div class="table-responsive">
                                                                            <table id="tableOrder" class="mb-0 table-hover">
                                                                                {{--Fetch ajax--}}
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                                                <div class="card">
                                                                    <div class="card-header"><h4>Items  Details</h4> </div>
                                                                    <div class="card">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-hover">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>Image </th>
                                                                                    <th>Product Name </th>
                                                                                    <th>Size </th>
                                                                                    <th>color </th>
                                                                                    <th>QTY </th>
                                                                                    <td>Price </td>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody id="tableItems">

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row" id="SectionReturn" style="display: none">
                                                            <div class="col-12 ">
                                                                <div class="card">
                                                                    <div class="accordion" id="accordionPanelsStayOpenExample">
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                                                    Return Order
                                                                                </button>
                                                                            </h2>
                                                                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse " aria-labelledby="panelsStayOpen-headingOne">
                                                                                <div class="accordion-body">
                                                                                    <form method="post" action="{{route(\App\Constants\Constants::USER_ACCOUNT_Orders_Return)}}">

                                                                                        <input type="hidden" name="order_number" id="set_order_number_to_form_return">


                                                                                        <div class="card mb-3">

                                                                                            <div class="card-body shadow p-3 mb-4 bg-body rounded">
                                                                                                <p class="text-dark">Please Select The order That ou want to return it back and FeedBack</p>
                                                                                                <h5 class="card-title">Items</h5>
                                                                                                <button type="button" id="select-all" class="btn btn-outline-info btn-sm mb-3">Select All</button>


                                                                                                <div id="checkBoxItems" class="p-2">
                                                                                                    {{--Ajax her --}}
                                                                                                </div>


                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card shadow p-3 mb-4 bg-body rounded">
                                                                                            @csrf
                                                                                            <div class="card-title d-flex justify-content-between">
                                                                                                <h4>Return Order</h4>
                                                                                                <button class="btn  btn-danger btn-sm">Return</button>
                                                                                            </div>

                                                                                            <div class="form-floating">
                                                                                                <textarea class="form-control" name="return_reason" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                                                                                <label for="floatingTextarea2">Comments</label>
                                                                                            </div>

                                                                                        </div>

                                                                                    </form>


                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('script')
    <script>
        function fetchOrderDetails(element){
            let orderId = element.getAttribute('data-order-id');
            let baseUrl = '{{route('api.get.order.details')}}'
            let token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type : "POST" ,
                dataType : 'json' ,
                url :baseUrl ,
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: {
                    "orderId" : orderId,

                } ,
                success : (response)=>{

                    let tableShippingDetails = `
                    <thead>
                                                <tr>
                                                    <th>Shipping Name:</th>
                                                    <td>${response.order.name}</td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping Phone:</th><td>${response.order.phone_number}</td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping Email:</th><td>${response.order.email}</td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping City:</th><td>${response.order.city}</td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping State:</th><td>${response.order.state}</td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping Address:</th><td>${response.order.address}</td>
                                                </tr>
                                                <tr>
                                                    <th>Post Code:</th><td>${response.order.code_post}</td>
                                                </tr>
                                                <tr>
                                                    <th>Order Date:</th><td>${response.date}</td>
                                                </tr>
                                                </thead>
                    `;
                    $("#tableShipping").html(tableShippingDetails)

                    let ClassStatus = '';
                    switch (response.order.status) {
                        case 'pending' :  ClassStatus = 'bg-warning'; break;
                        case 'confirm' :  ClassStatus = 'bg-info'; break;
                        case 'processing' :  ClassStatus = 'bg-danger'; break;
                        case 'delivered' :  ClassStatus = 'bg-success'; break;
                    }
                    let tableOrderDetails = `
                    <thead>
                    <tr>
                        <th>Name :</th><td>${response.order.user.name}</td>
                    </tr>
                    <tr>
                        <th>Email:</th><td>${response.order.user.email}</td>
                    </tr>
                    <tr>
                        <th>Phone:</th><td>${response.order.user.phone_number}</td>
                    </tr>
                    <tr>
                        <th>Payment Method:</th><td>${response.order.payment_method}</td>
                    </tr>
                    <tr>
                        <th>Order ID:</th><td class="text-success" >${response.order.order_number}</td>
                    </tr>
                    <tr>
                        <th>Invoice</th><td  class="text-danger" >${response.order.invoice_number}</td>
                    </tr>

                    <tr>
                        <th>Order Amonut:</th><td>${response.order.amount}</td>
                    </tr>
                    <tr>
                        <th>Order Status:</th>
                            <td>
                                 ${response.order.return_status
                                    ? (response.order.status === 'completed'
                                        ? `<span class="badge rounded-pill bg-primary">Completed</span>`
                                        : `<span class="badge rounded-pill bg-danger">Return</span>`)
                                    : `<span class="badge rounded-pill bg-success">Delivered</span>`}
                            </td>
                    </tr>

                    </thead>
                    `;
                    $("#tableOrder").html(tableOrderDetails)



                    let Items = '';
                    $.each(response.orderItems , (index , item)=>{
                        //console.log(item);
                        Items +=`
                        <tr>
                            <td><img src="${item.img_url}" alt="Product Thumbnail" width="40" height="40"></td>
                            <td>${item.product.product_name}</td>
                            <td>${item.size ? item.size : '....'}</td>
                            <td>${item.color? item.color : '....'}</td>
                            <td>${item.qty}</td>
                            <td>${item.price} Dz <br> <span class="fw-900">Total : ${item.price * item.qty} Dz</span> </td>
                        </tr>
                        `
                    });

                    $("#tableItems").html(Items)

                    /*Return Status*/

                    if(response.order.status === 'delivered'){
                        //check if return status is false to show the form send return reason
                            if(!response.order.return_status){
                                $("#SectionReturn").show();
                                $("#set_order_number_to_form_return").val(response.order.order_number)
                            }
                    }else{
                        $("#SectionReturn").hide();
                        $("#set_order_number_to_form_return").val()
                    }
                    let checkBoxItem ='';
                    //
                    $.each(response.orderItems , (index , item)=>{
                        checkBoxItem += `
                             <div class="d-flex align-items-center mb-3">
                                <img src="${item.img_url}" alt="Product Thumbnail" width="40" height="40">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ItemsReturn[]" value="${item.product.products_uuid}" id="flexCheckDefault${item.id}">
                                    <label class="form-check-label fs-5 " for="flexCheckDefault${item.id}">
                                         ${item.product.product_name}
                                    </label>
                                </div>
                             </div>
                            `

                    });

                    $("#checkBoxItems").html(checkBoxItem);

                } ,
                error : (error)=>{
                    console.log(error)
                }
            }); // end ajax
        }

    </script>

    <script>
        $(document).ready(function() {
            $('#select-all').click(function() {
                $('input[name="ItemsReturn[]"]').prop('checked', true);
            });
        });
    </script>
@endpush
