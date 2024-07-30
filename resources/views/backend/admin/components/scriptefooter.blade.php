
{{--Sweet alert--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset("backend/assets/js/sweetalert.js") }}"></script>
<!-- Validation -->
{{--<script src="{{ asset("backend/assets/js/validate.min.js") }}"></script>--}}
<!-- Bootstrap JS -->
<script src="{{ asset("backend/assets/js/bootstrap.bundle.min.js") }}"></script>
<!--plugins-->
<script src="{{ asset("backend/assets/js/jquery.min.js") }}"></script>
<script src="{{ asset("backend/assets/plugins/simplebar/js/simplebar.min.js") }}"></script>
<script src="{{ asset("backend/assets/plugins/metismenu/js/metisMenu.min.js") }}"></script>
<script src="{{ asset("backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js") }}"></script>
{{--<script src="{{ asset("backend/assets/plugins/chartjs/js/Chart.min.js") }}"></script>--}}
<script src="{{ asset("backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js") }}"></script>
<script src="{{ asset("backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js") }}"></script>
{{--<script src="{{ asset("backend/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js") }}"></script>--}}
<script src="{{ asset("backend/assets/plugins/sparkline-charts/jquery.sparkline.min.js") }}"></script>
<script src="{{ asset("backend/assets/plugins/jquery-knob/excanvas.js") }}"></script>
<script src="{{ asset("backend/assets/plugins/jquery-knob/jquery.knob.js") }}"></script>


{{--Image upload File--}}
{{--<script src="{{ asset("backend/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js") }}"></script>--}}
{{--Image upload File--}}

{{--Tag input --}}
<script src="{{asset("backend/assets/plugins/input-tags/js/tagsinput.js")}}"></script>
{{---- Tag input ----}}
<!--Datatable-->
<script src="{{ asset("backend/assets/plugins/datatable/js/jquery.dataTables.min.js") }}"></script>


<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
<!--Datatable-->


  <script>
      $(function() {
          $(".knob").knob();
      });
  </script>

  <script src="{{ asset("backend/assets/js/index.js") }}"></script>
<!--app JS-->
<script src="{{ asset("backend/assets/js/app.js") }}"></script>



@stack('script')


<script>


        function getNotification(){
            let adminId = '{{auth()->guard('admin')->user()->id}}'
            let baseUrl = '{{url('admin/get-notification-for-admin')}}/'+adminId
            $.ajax({
                type : "GET" ,
                url : baseUrl ,
                dataType : 'json',
                success : (response)=>{
                    //console.log(response);
                    //set also Count

                    if(response.data.unreadNotificationCount){
                        $("#notification-count").empty();
                        $("#notification-count").html(`
                                                <span class="alert-count" >${response.data.unreadNotificationCount}</span>
                                                <i class='fa-light fa-bell'></i>`)
                    }else{
                        $("#notification-count").empty();
                    }

                     setData(response.data.unreadNotification)
                } ,
                error : (error)=>{
                    console.error(error);
                }
            });//end ajax
        } // end function

        function setData(data){
            let row = '';
            $.each(data , (index , item)=>{

                if(item.type === 'OrderNotify'){
                    row += `
                <a class="dropdown-item" href="javascript:;" data-id="${item.id}" onclick="makeAsRead(this)">
                   <div class="d-flex align-items-center">
                        <div class="notify bg-light-danger text-danger"><i class="bx bx-cart-alt"></i></div>
                        <div class="flex-grow-1">
                            <h6 class="msg-name d-flex justify-content-between align-items-center ">New Order
                            <span class="msg-time float-end">${item.created_at}</span></h6>
                            <p class="msg-info">${item.message}</p>
                        </div>
                   </div>
                </a>
                `
                }else if(item.type === 'RegisterNotify'){
                    row += `
                        <a class="dropdown-item" href="javascript:;" data-id="${item.id}" onclick="makeAsRead(this)" >
                           <div class="d-flex align-items-center">
                                <div class="notify bg-light-primary text-primary"><i class="fa-light fa-user-group"></i></div>
                                <div class="flex-grow-1">
                                    <h6 class="msg-name d-flex justify-content-between align-items-center ">New Register
                                    <span class="msg-time float-end">${item.created_at}</span></h6>
                                    <p class="msg-info">${item.message}</p>
                                </div>
                           </div>
                        </a>
                        `
                }

            }); //end foreach
            $(".header-notifications-list").html(row);
        }


        getNotification();



        function makeAsRead(element){
            let id = element.getAttribute('data-id')
            let baseUrl = '{{url('admin/make-notification-as-read')}}';
            $.ajax({
               type : "POST",
               url : baseUrl ,
                dataType : "json",
                data : {
                   notifyId : id,
                    _token: '{{csrf_token()}}'
                } ,
                success : function (response) {
                   console.log(response)
                    getNotification();
                },
                error : function(error){
                   console.log(error);
                }

            });
        }
</script>
