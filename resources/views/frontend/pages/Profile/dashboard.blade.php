@extends('frontend.pages.account')

@section('account')
    {{--dashboard--}}
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Welcome back
                <a href="#">{{\Illuminate\Support\Facades\Auth::user()->name}}</a></h3>
            </div>
            <div class="card-body">
                <p>
                    From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>,<br />
                    manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a>
                </p>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        $("#dashboard-tab").addClass('active');
    </script>
@endpush
