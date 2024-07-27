<!-- Vendor JS-->
<script src={{ asset("frontend/assets/js/vendor/modernizr-3.6.0.min.js") }}></script>
<script src="{{ asset("frontend/assets/js/vendor/jquery-3.6.0.min.js") }}"></script>
<script src="{{ asset("frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js") }}"></script>
<script src="{{ asset("frontend/assets/js/vendor/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/slick.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/jquery.syotimer.min.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/waypoints.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/wow.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/perfect-scrollbar.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/magnific-popup.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/slider-range.js")}}"></script>
<script src="{{ asset("frontend/assets/js/plugins/select2.min.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/counterup.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/jquery.countdown.min.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/images-loaded.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/isotope.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/scrollup.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/jquery.vticker-min.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/jquery.theia.sticky.js") }}"></script>
<script src="{{ asset("frontend/assets/js/plugins/jquery.elevatezoom.js") }}"></script>
<!-- Template  JS -->
<script src="{{ asset("frontend/assets/js/main.js?v=5.3") }}"></script>
<script src="{{ asset("frontend/assets/js/shop.js?v=5.3") }}"></script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
</script>

<script>
    let token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        header:{
            'X-CSRF-Token': token
        }
    })
</script>


@stack('script')



{{--Quick View--}}
<script>
    function fetchProduct(element,slug='default'){
        $("#vendor_id").val('');
        const uuid = element.getAttribute('data-uuid');

        let baseUrl = '{{url('/Product-details/')}}' ;
        let fullUrl = `${baseUrl}/${uuid}/${slug}`
        console.log(fullUrl)
        $.ajax({
            type:'GET',
            dataType:'json' ,
            url :fullUrl ,
            success : (response)=>{
                setData(response)
            } ,
            error : (error)=>{
                console.error(error);
            }
        })
    }
    //function to set data from database to modal view
    function setData(data){

        $('#Product_img').attr('src', data.url_img );

        //set product uuid in input field


        $("#product_uuid").val(data.product.products_uuid);


        $('#product_name').text(data.product.product_name);


        let urlProductDetails = `/Product-details/${data.product.products_uuid}/default`
        $('#product_name').attr('href',urlProductDetails );


        if(data.product.product_Qty > 0){
            $('#product_sale').addClass('stock-status in-stock');
            $('#product_sale').text('in stock');
        }else{
            $('#product_sale').addClass('stock-status out-stock');
            $('#product_sale').text('out stock');
        }

        if (data.discount_price) {
            $("#product_price").text(data.discount_price+ "dz");
            $("#save_price").text("save "+ (100 - data.product.discount_price)+ "%");
            $("#old_price").text(data.product.selling_price + "dz");
        } else {
            $("#product_price").text(data.product.selling_price+ " dz");
            $("#save_price").text("");
            $("#old_price").text("");
        }

        if(data.vendor_name){
            //vendor_name
            $("#vendor_name").text(data.vendor_name);
        }else{
            $("#vendor_name").text("E comme");
        }

        $("#category_name").text(data.category_name);

        // Color
        if(!data.colors){ //if array is empty hide the choice of color
            $("#Parent_div_display_color").hide();
        }else{  // else is not empty

            $("#Parent_div_display_color").show(); // show the dce of parent content
            $("#child_div_display_color").empty(); // Clear any existing content

            data.colors.forEach( (item, index) => {
                let colorId = "size_"+index
                let colorLabel = $("<label></label>").addClass('form-check-label fw-500').attr('for', colorId).text(item);
                let colorinput = $("<input/>").attr({
                    type: 'radio',
                    class: 'form-check-input',
                    name: 'select_color',
                    id: colorId,
                    value: item
                });

                let labelParent = $("<label></label>").addClass("form-check form-check-inline");
                labelParent.append(colorLabel);
                labelParent.append(colorinput);
                // Append the new elements to the div
                $("#child_div_display_color").append(labelParent);

            })
        } // end Color

        // Sizes
        if(!data.sizes){ //if array is empty hide the choice of color
            $("#Parent_div_display_size").hide();
        }else{
            $("#Parent_div_display_size").show();
            $("#child_div_display_sizes").empty(); // Clear any existing content
            data.sizes.forEach( (item, index) => {

                let sizeId = "size_"+index
                let sizeLabel = $("<label></label>").addClass('form-check-label fw-500').attr('for', sizeId).text(item);
                let sizeInput = $("<input/>").attr({
                    type: 'radio',
                    class: 'form-check-input',
                    name: 'select_size',
                    id: sizeId,
                    value: item
                });
                let labelParnet = $("<label></label>").addClass("form-check form-check-inline")
                labelParnet.append(sizeLabel)
                labelParnet.append(sizeInput)
                // Append the new elements to the div
                $("#child_div_display_sizes").append(labelParnet);
            })
        }

        //
        if(data.tags){
            $("#tags").text(data.tags)
        }

        if(data.product.vendor_id){
            $("#vendor_id").val(data.product.vendor_id);
        }


    }
</script>


{{--Cart--}}
<script>
    function addToCartQuickView(){
        let product_uuid =  $("#product_uuid").val()
        let vendor_id = $('#vendor_id').val();
        let selectedColor = "";
        let selectedSize = "";

        // Validation function to check if an option is selected
        function isOptionSelected(selector, isVisible) {
            return isVisible ? $(selector + ':checked').length > 0 : true;
        }

        // Show error message using Toast
        function showError(message) {
            Toast.fire({
                icon: "error",
                title: 'Error',
                text: message
            });
        }


        //validation
        let isSizeVisible = $('#Parent_div_display_size').is(':visible');
        let isColorVisible = $('#Parent_div_display_color').is(':visible');

        //if isSizeVisible is true he throws to check now if the user check the box or not if not he return false if check he
        //return true ,and it true by default if the isSizeVisible is false so is mean the color and the size isn,t show
        // so next check if the default is true (! sizeChecked=ture) he wont go throw toaster to show the error becuse no div of color or size
        // Check if a size is selected
        // Validate selection
        let sizeChecked = isOptionSelected('input[name="select_size"]', isSizeVisible);
        let colorChecked = isOptionSelected('input[name="select_color"]', isColorVisible);




        if (!sizeChecked ) {
            showError('Please select a size.');
            return;
        }
        if(!colorChecked){
            showError('Please select a color.');
            return;
        }



        selectedSize = $('input[name="select_size"]:checked').val();
        selectedColor = $('input[name="select_color"]:checked').val();


        let product_qty = $('input[name="product_qty"]').val();



        //send to save in cart session
        let baseUrl = '{{route(\App\Constants\Constants::ADD_TO_CART)}}' ;
        let token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type:'POST',
            dataType:'json' ,
            url :baseUrl ,
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                "id" : product_uuid,
                "colors" : selectedColor ,
                "sizes" : selectedSize ,
                "qty" : product_qty,
                'vendor_id' : vendor_id ,
            } ,
            success : (response)=>{

                $('#closeModal').click();

                console.log(response)

                if ($.isEmptyObject(response.error)) {
                    Toast.fire({
                        icon: "success",
                        title:  response.success
                    });
                }else{
                    Toast.fire({
                        icon: "error",
                        title:  'Try again something worng !'
                    });
                }

                getCart();
            } ,
            error : (error)=>{
                console.log(error)
            }
        })
    }

    function getCart(){

        $.ajax({
            type:'GET' ,
            data : 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url :'{{route(\App\Constants\Constants::GET_CART)}}',
            success : function (response){

                //console.log(response)
                let cart = "";

                $.each(response.content_cart , (index , item)=>{
                    cart +=`<li>
                                <div class="shopping-cart-img">
                                    <a href="shop-product-right.html"><img alt="Nest" src="${item.options.image}" /></a>
                                </div>
                                <div class="shopping-cart-title">
                                    <h4><a href="shop-product-right.html">${item.name.slice(0 , 12)+"..."}</a></h4>
                                    <h4><span>${item.qty} × </span>${item.price} DZ</h4>
                                </div>
                                <div class="shopping-cart-delete">
                                    <a id="${item.rowId}" onclick="removeFromCart(this.id)"><i class="fi-rs-cross-small"></i></a>
                                </div>
                            </li>` //end div


                }); //end foreach

                //add the html list to the ul div
                $("#listCart").html(cart);

                //append count cart-shope
                let count = $("<span></span>").addClass('pro-count blue').text(response.count_cart)
                $(".mini-cart-icon").append(count)

                //footer-cart
                //cart-total
                if(response.total_cart){
                    $("#cart-total").text(response.total_cart+ "DZ");
                }

            } ,
            error: function (error){
                console.log(error)
            }

        })
    }
    //when th
    getCart();
    function removeFromCart(rowId){
        $.ajax({
            type:'POST' ,
            dataType: 'json',
            //contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url :'{{route(\App\Constants\Constants::REMOVE_FROM_CART)}}',
            data : {
                'rowId' : rowId
            },
            success : (response)=>{

                if ($.isEmptyObject(response.error)) {
                    Toast.fire({
                        icon: "success",
                        title:  response.success
                    });
                }else{
                    Toast.fire({
                        icon: "error",
                        title:  'Try again something worng !'
                    });
                }
                getCart();
            },
            error : (error)=>{
                console.log(error)
            }
        }); //end ajax

    }

</script>



{{--wishlist--}}
<script>
    function getCountWishList(){
        //
        let baseUrl = '{{url("/user-get-count-wish-list")}}' ;
        $.ajax({
            type:'GET' ,
            dataType : 'json',
            url: baseUrl,
            success : (response) => {
                console.log(response)
                $("#countWishList").text(response.count)
            }
        });


    }
    getCountWishList();

    function AddToWishList(element) {
        let id = element.getAttribute('data-id');
        let baseUrl ='{{url('/add-to-wish-list')}}'

        $.ajax({
            type: "post",
            dataType: 'json',
            url: baseUrl,
            data: {
                "id": id,
                "_token" : '{{csrf_token()}}'
            },
            success: (response) => { //warning

                if (response.success) {

                    Toast.fire({
                        icon: "success",
                        title:  response.success
                    });
                }else if(response.warning){

                    Toast.fire({
                        icon: "warning",
                        title:  response.warning
                    });
                }else{
                    Toast.fire({
                        icon: "error",
                        title:  response.error
                    });
                }

                getCountWishList();

            },
            error: (error) => {
                console.log(error)
            }
        });
    }

</script>
{{--Compare List--}}
<script>
    //get Count of compare List
    function getCountCompareList(){
        //
        let baseUrl = '{{url("/user-get-count-compare-list")}}' ;
        $.ajax({
            type:'GET' ,
            dataType : 'json',
            url: baseUrl,
            success : (response) => {
                $("#countCompareList").text(response.count)
            }
        });


    }
    getCountCompareList();
    //Compare method
    function AddToCompareProducts(element){
        let id = element.getAttribute('data-id')

        let baseUrl ='{{url('/add-to-compare-products')}}'

        $.ajax({
            type: "post",
            dataType: 'json',
            url: baseUrl,
            data: {
                "id": id,
                "_token" : '{{csrf_token()}}'
            },
            success: (response) => { //warning

                if (response.success) {

                    Toast.fire({
                        icon: "success",
                        title:  response.success
                    });
                }else if(response.warning){

                    Toast.fire({
                        icon: "warning",
                        title:  response.warning
                    });
                }else{
                    Toast.fire({
                        icon: "error",
                        title:  response.error
                    });
                }

                getCountCompareList();

            },
            error: (error) => {
                console.log(error)
            }
        });
    }
</script>

{{--Add To Cart in all web site works --}}

<script>
    function addToCart(element){

        let id =  element.getAttribute('data-uuid')

        //send to save in cart session
        let baseUrl = '{{route(\App\Constants\Constants::ADD_TO_CART)}}' ;
        let token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type:'POST',
            dataType:'json' ,
            url :baseUrl ,
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                "id" : id,
                "qty" : 1 ,
                "colors" : null,
                "sizes" : null ,
                "vendor_id" : null ,
            } ,
            success : (response)=>{

                if ($.isEmptyObject(response.error)) {
                    Toast.fire({
                        icon: "success",
                        title:  response.success
                    });
                }else{
                    Toast.fire({
                        icon: "error",
                        title:  'Try again something worng !'
                    });
                }

                getCart();
                //getCart();
            } ,
            error : (error)=>{
                console.log(error)
            }
        })

    }
</script>

<script>
    $(document).ready(function() {

        let timeout = null;


        $('#searchBox').on('keyup', function() {
            clearTimeout(timeout);
            const query = $(this).val();

            timeout = setTimeout(() => {
                if (query.length > 0) {
                    fetchProducts(query);
                } else {
                    $('#searchResults').slideUp();
                }
            }, 300);
        });

        function fetchProducts(query){
            let Searchurl = '{{route(\App\Constants\Constants::WEB_SEARCH)}}'
            $.ajax({
                url: Searchurl,
                method: 'POST',
                dataType : 'json',
                data : {
                    _token  :` {{csrf_token()}}` ,
                    search : query
                },
                success: function(data) {
                    //console.log(data)
                    displayResults(data);
                },
                error: function(error) {
                    console.error('Error fetching products:', error);
                }
            });
        } //end function fetchProducts

        function displayResults(products){
            const resultsContainer = $('#searchResults');
            resultsContainer.empty();
            if (products.length > 0) {
                products.forEach(product => {
                    resultsContainer.append(`
                    <div class="result-item">
                        <img src='${product.product_thumbnail}' class="result-thumbnail">
                        <div class="result-details">
                            <a class="result-name" href="/Product-details/${product.products_uuid}/${product.slug}">
                                ${product.product_name}</a>
                            <p class="result-price">${product.selling_price}</p>
                        </div>
                    </div>
                    `);
                });
                resultsContainer.slideDown();
            } else {
                resultsContainer.slideUp();
            }
        }//end function displayResults

        // Hide results when clicking outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.search-style-2').length) {
                $('#searchResults').slideUp();
            }
        });
    });
</script>
