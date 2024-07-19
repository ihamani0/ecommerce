@extends("backend.admin.layout.master")

@section("title")
    Report | Search
@endsection


@section("admin")
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">Report</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route(Constants::Admin_DASHBOARD)}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Report  Search</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <hr>

        <div class="card p-4">
            <h5 class="card-title">Report search :</h5>
            <div class="card-body p-4">

                <div class="container">

                    <div class="row justify-content-center ">
                        <div class=" col-lg-6 col-xl-6">
                            <div class="shadow card">
                                <div class="card-body">
                                <form id="dateTimeForm">
                                    <div class="mb-3 form-group">
                                        <label for="byDate" class="form-label text-heading">Date time:</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="byDate" id="byDate">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-secondary" id="searchDateTimeButton">Search</button>
                                </form>


                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6">
                            <div class="shadow  card">
                                <div class="card-body">

                                    <form method="POST"  id="weekForm">
                                        <div class="mb-3 ">
                                            <label for="byWeek" class="form-label">By Week:</label>
                                            <input type="week" class="form-control" id="byWeek" min="{{App\Constants\Constants::CreatedApp}}-W01" >
                                        </div>
                                        <button  type="submit" class="btn btn-outline-secondary" id="searchWeekButton">Search</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-center ">
                        <div class=" col-lg-6 col-xl-6">
                            <div class="shadow card">
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="mb-3">
                                            <label for="byMount" class="form-label">By Month:</label>
                                            <input type="month" class="form-control" id="byMonth" min="{{App\Constants\Constants::CreatedApp}}-01">
                                        </div>

                                        <button  type="submit" class="btn btn-outline-secondary" id="searchMonthButton">Search</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xl-6">
                            <div class="shadow  card">
                                <div class="card-body">

                                    <form method="POST">
                                        <div class="mb-3 form-group">
                                            <label for="byMount" class="form-label">By Year:</label>
                                            <select class="form-select mb-3" id="byYear" aria-label="Default select example">
                                                @foreach($Years as $year)
                                                    <option value={{$year}}>{{$year}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <button  type="submit" class="btn btn-outline-secondary"  id="searchYearButton">Search</button>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <hr>

        <div id="ResultSection">



            <div id="card"></div>
            {{--Ajax Her--}}
            <div id="table"></div>
        </div>


        </div>

    </div>


@endsection
@push('script')

    <script>
        $(document).ready(function() {

            function handleSearch(inputId, routeName) {
                $("#ResultSection").hide()

                let inputVal = $(inputId).val();
                // Remove existing error message if present
                $('.invalid-feedback').remove();

                if(inputVal === ''){
                    let error = $('<span>', {
                        class: 'invalid-feedback',
                        text: 'Please fill out the date field.'
                    });

                    // Add error class and append the error message
                    $(inputId).addClass('is-invalid');
                    $(inputId).closest('.form-group').append(error);
                } else {
                    $(inputId).removeClass('is-invalid');
                    let baseUrl = `${routeName}`;
                    console.log(routeName);
                    $.ajax({
                        url: baseUrl,
                        type: 'POST',
                        data: {
                            date: inputVal,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {

                            $("#ResultSection").show()

                            console.log(response)
                            setResponse(response)

                        },
                        error: function(error) {
                            console.error('Error submitting form');
                            // Handle error response
                        }
                    });
                }

            }






            $('#searchDateTimeButton').on('click', function(event) {
                event.preventDefault();
                handleSearch('#byDate', "{{route(\App\Constants\Constants::Admin_Report_SearchByDate)}}");
            });

            $('#searchWeekButton').on('click', function(event) {
                event.preventDefault();
                handleSearch('#byWeek', "{{route(\App\Constants\Constants::Admin_Report_SearchByWeek)}}");
            });

            $('#searchMonthButton').on('click', function(event) {
                event.preventDefault();
                handleSearch('#byMonth', "{{route(\App\Constants\Constants::Admin_Report_SearchByMonth)}}");
            });

            $('#searchYearButton').on('click', function(event) {
                event.preventDefault();
                handleSearch('#byYear', "{{route(\App\Constants\Constants::Admin_Report_SearchByYear)}}");
            });


            function setResponse(response){

                let row='';
                $.each( response.order , (index,item)=>{

                    row +=`
                        <tr>
                            <td>${item.order_number}</td>
                            <td>${item.name}</td>
                            <td>${item.amount} ${item.currency}</td>
                            <td>${item.invoice_number}</td>
                        </tr>
                    `
                })

                let card = `
                <h5 class="header p-3">Report result</h5>
               <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">{{--Total Order--}}

                    {{--Total order--}}
                    <div class="col">
                        <div class="card radius-10 bg-gradient-deepblue">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h5 class="mb-0 text-white">${response.total_orders}</h5>
                                    <div class="ms-auto">
                                        <i class='bx bx-cart fs-3 text-white'></i>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-white">
                                    <p class="mb-0">Total Orders</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    {{--Total Amount--}}
                    <div class="col">
                        <div class="card radius-10 bg-gradient-orange">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h5 class="mb-0 text-white">${response.total_amount}</h5>
                                    <div class="ms-auto">
                                        <i class='bx bx-dollar fs-3 text-white'></i>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-white">
                                    <p class="mb-0">Total Amount</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{--Total Users--}}
                    <div class="col">
                        <div class="card radius-10 bg-gradient-ohhappiness">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h5 class="mb-0 text-white" >${response.total_customers}</h5>
                                    <div class="ms-auto">
                                        <i class='bx bx-group fs-3 text-white'></i>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-white">
                                    <p class="mb-0">Number Customer</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{--Total Sales--}}
                        <div class="col">
                            <div class="card radius-10 bg-gradient-ibiza">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <h5 class="mb-0 text-white">${response.total_sales}</h5>
                                        <div class="ms-auto">
                                            <i class='bx bx-envelope fs-3 text-white'></i>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center text-white">
                                        <p class="mb-0">Total Sales</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>

                `
                let table = `
                                <div class="card"  id="cardSection"  >
                                    <div class="card-body p-4">
                                        <hr>
                                        <div class="table-responsive">
                                            <table  id="example" class="table table-striped table-bordered dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                                                <thead>
                                                    <tr>
                                                        <th>Order#</th>
                                                        <th> Name </th>
                                                        <th>Total </th>
                                                        <th>Invoice Number</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    ${row}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                `
                $("#card").html(card)
                $("#table").html(table)

            }

        });


    </script>
@endpush

