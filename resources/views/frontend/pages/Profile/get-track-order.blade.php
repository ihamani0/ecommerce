@extends("frontend.layout.master")
@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .card-stepper {
        z-index: 0
    }

    #progressbar-2 {
        color: #455A64;
    }

    #progressbar-2 li {
        list-style-type: none;
        font-size: 13px;
        width: 33.33%;
        float: left;
        position: relative;
    }

    #progressbar-2 #step1:before {
        content: '\f058';
        font-family: "Font Awesome 5 Free";
        color: #fff;
        width: 37px;
        margin-left: 0px;
        padding-left: 0px;
    }

    #progressbar-2 #step2:before {
        content: '\f058';
        font-family: "Font Awesome 5 Free";
        color: #fff;
        width: 37px;
    }

    #progressbar-2 #step3:before {
        content: '\f058';
        font-family: "Font Awesome 5 Free";
        color: #fff;
        width: 37px;
        margin-right: 0;
        text-align: center;
    }

    #progressbar-2 #step4:before {
        content: '\f111';
        font-family: "Font Awesome 5 Free";
        color: #fff;
        width: 37px;
        margin-right: 0;
        text-align: center;
    }

    #progressbar-2 li:before {
        line-height: 37px;
        display: block;
        font-size: 12px;
        background: #c5cae9;
        border-radius: 50%;
    }

    #progressbar-2 li:after {
        content: '';
        width: 100%;
        height: 10px;
        /*background: #c5cae9;*/
        position: absolute;
        left: 0%;
        right: 0%;
        top: 15px;
        z-index: -1;
    }

    #progressbar-2 li:nth-child(1):after {
        left: 1%;
        width: 100%
    }

    #progressbar-2 li:nth-child(2):after {
        left: 1%;
        width: 100%;
    }

    #progressbar-2 li:nth-child(3):after {
        left: 1%;
        width: 100%;
    }

    #progressbar-2 li:nth-child(4) {
        left: 0;
        width: 37px;
    }

    #progressbar-2 li:nth-child(4):after {
        left: 1%;
        width: 100%;
    }
    #progressbar-2 li.active:before,
    #progressbar-2 li.active:after {
        background: #3BB77E;
    }
</style>
@endpush
@section("main")
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card card-stepper" style="border-radius: 16px;">
                        <div class="card-body p-5 ">

                            <div class="card mb-3 shadow-sm">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <div>
                                            <h5 class="mb-0">INVOICE <span class="text-primary font-weight-bold">{{$Order?->invoice_number}}</span>  @if($Order?->status == 'completed')
                                                    <span class="text-danger font-weight-bold"> Return </span>
                                                @endif

                                            </h5>
                                        </div>
                                        <div class="text-end">
                                            <p class="mb-0">Date Command :  <span>{{$Order?->created_at->format('Y/m/d')}}</span></p>
                                            <p class="mb-0">Order Nu: <span class="font-weight-bold">{{$Order?->order_number}}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <ul id="progressbar-2" class="d-flex justify-content-between mx-0 mt-lg-3 mb-5 px-0 pt-0 pb-2">
                                @if($Order?->status == 'pending')
                                    <li class="step0 active text-center" id="step1"></li><li class="step0 text-center" id="step2"></li><li class="step0  text-center" id="step3"></li><li class="step0 text-muted text-end" id="step4"></li>
                                @elseif($Order?->status == 'processing')
                                    <li class="step0 active text-center" id="step1"></li><li class="step0 active text-center" id="step2"></li><li class="step0  text-center" id="step3"></li><li class="step0 text-muted text-end" id="step4"></li>
                                @elseif($Order?->status == 'confirmed')
                                    <li class="step0 active text-center" id="step1"></li><li class="step0 active text-center" id="step2"></li><li class="step0 active text-center" id="step3"></li><li class="step0 text-muted text-end" id="step4"></li>
                                @elseif($Order?->status == 'delivered')
                                    <li class="step0 active text-center" id="step1"></li><li class="step0 active text-center" id="step2"></li><li class="step0 active text-center" id="step3"></li><li class="step0 active text-center" id="step4"></li>
                                @else
                                    <li class="step0  text-center" id="step1"></li><li class="step0  text-center" id="step2"></li><li class="step0  text-center" id="step3"></li><li class="step0 text-muted text-end" id="step4"></li>
                                @endif

                            </ul>

                            <div class="d-flex justify-content-between">
                                <div class="d-lg-flex align-items-center">
                                    <i class="fa-light fa-clipboard fa-xl me-lg-4 mb-3 mb-lg-0"></i>
                                    <div>
                                        <p class="fw-bold mb-1 fs-6">Order</p>
                                        <p class="fw-bold mb-0">Pending</p>
                                    </div>
                                </div>
                                <div class="d-lg-flex align-items-center">
                                    <i class="fa-light fa-box-open  fa-xl me-lg-4 mb-3 mb-lg-0"></i>
                                    <div>
                                        <p class="fw-bold mb-1">Order</p>
                                        <p class="fw-bold mb-0">Processing</p>
                                    </div>
                                </div>
                                <div class="d-lg-flex align-items-center">
                                    <i class="fa-light fa-shipping-fast fa-xl me-lg-4 mb-3 mb-lg-0"></i>
                                    <div>
                                        <p class="fw-bold mb-1">Order</p>
                                        <p class="fw-bold mb-0">Confirmed</p>
                                    </div>
                                </div>
                                <div class="d-lg-flex align-items-center">
                                    <i class="fa-light fa-home fa-xl me-lg-4 mb-3 mb-lg-0"></i>
                                    <div>
                                        <p class="fw-bold mb-1">Order</p>
                                        <p class="fw-bold mb-0">Delivered</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@push('script')

@endpush
