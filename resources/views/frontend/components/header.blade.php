
<!-- Header  -->
<header class="header-area header-style-1 header-height-2">
    <div class="mobile-promotion">
        <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
    </div>
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>

                            <li><a href="page-account.html">My Cart</a></li>
                            <li><a href="{{route(\App\Constants\Constants::USER_WISH_LIST)}}" >Checkout</a></li>
                            <li><a href="shop-order.html">Order Tracking</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li>100% Secure delivery without contacting the courier</li>
                                <li>Supper Value Deals - Save more with coupons</li>
                                <li>Trendy 25silver jewelry, save up 35% off today</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>

                            {{--<li>
                                <a class="language-dropdown-active" href="#">English <i class="fi-rs-angle-small-down"></i></a>
                                <ul class="language-dropdown">
                                    <li>
                                        <a href="#"><img src="{{asset("frontend/assets/imgs/theme/flag-fr.png")}}" alt="" />Français</a>
                                    </li>
                                </ul>
                            </li>--}}

                            <li>Need help? Call Us: <strong class="text-brand"> +213 000000000</strong></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{route(\App\Constants\Constants::WELCOME)}}">
                        <img src="{{asset("frontend/assets/imgs/theme/cart.svg")}}"alt="logo" width="180" height="56" />
                    </a>
                    {{--<a> <i class="fa-solid fa-cart-shopping fa-2xl"></i> </a>--}}
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        <form action="#">
                            <select class="select-active">
                                <option>All Categories</option>
                                <option>Milks and Dairies</option>
                                <option>Wines & Alcohol</option>
                                <option>Clothing & Beauty</option>
                                <option>Pet Foods & Toy</option>
                                <option>Fast food</option>
                                <option>Baking material</option>
                                <option>Vegetables</option>
                                <option>Fresh Seafood</option>
                                <option>Noodles & Rice</option>
                                <option>Ice cream</option>
                            </select>
                            <input type="text" placeholder="Search for items..." />
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="search-location">
                                <form action="#">
                                    <select class="select-active">
                                        <option>Your Location</option>
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>Arizona</option>
                                        <option>Delaware</option>
                                        <option>Florida</option>
                                        <option>Georgia</option>
                                        <option>Hawaii</option>
                                        <option>Indiana</option>
                                        <option>Maryland</option>
                                        <option>Nevada</option>
                                        <option>New Jersey</option>
                                        <option>New Mexico</option>
                                        <option>New York</option>
                                    </select>
                                </form>
                            </div>

                            <div class="header-action-icon-2">
                                <a href="{{route(\App\Constants\Constants::USER_COMPARE_LIST)}}">
                                    {{--<img class="svgInject" alt="Nest" src="{{asset("frontend/assets/imgs/theme/icons/icon-heart.svg")}}" />--}}
                                    <i class="fa-duotone fa-shuffle fa-xs"></i>
                                    @auth
                                        <span class="pro-count blue" id="countCompareList">
                                            {{count(auth()->user()->compare)}}
                                        </span>
                                    @endauth

                                </a>
                                <a href="{{route(\App\Constants\Constants::USER_COMPARE_LIST)}}"><span class="lable">comapre</span></a>
                            </div>

                            <div class="header-action-icon-2">
                                <a href="{{route(\App\Constants\Constants::USER_WISH_LIST)}}">
                                    {{--<img class="svgInject" alt="Nest" src="{{asset("frontend/assets/imgs/theme/icons/icon-heart.svg")}}" />--}}
                                    <i class="fa-light fa-heart fa-xs"></i>
                                    @auth
                                        <span class="pro-count blue" id="countWishList">
                                            {{count(auth()->user()->wishlist)}}
                                        </span>
                                    @endauth

                                </a>
                                <a href="{{route(\App\Constants\Constants::USER_WISH_LIST)}}"><span class="lable">Wishlist</span></a>
                            </div>

                            {{--Cart --}}
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon"  >
                                    {{--<img alt="Nest" src="{{asset("frontend/assets/imgs/theme/icons/icon-cart.svg")}}" />--}}
                                    <i class="fa-duotone fa-shopping-cart fa-xs"></i>
                                    {{--<span class="pro-count blue" id="cart-count"></span>--}}
                                </a>
                                <a href="shop-cart.html"><span class="lable">Cart</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul id="listCart">

                                        {{--Her se set the cart shope using js --}}

                                    </ul>
                                    <div class="shopping-cart-footer" id="footer-cart">
                                        <div class="shopping-cart-total">
                                            <h4>Total<span id="cart-total" > </span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="shop-cart.html" class="outline">View cart</a>
                                            <a href="shop-checkout.html">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--End Cart--}}


                            {{--USER ACCOUNT--}}
                            <div class="header-action-icon-2">
                                @auth
                                        <a href="{{route(Constants::USER_LOGIN)}}" >
                                            {{--<img class="svgInject mr-1" alt="Nest" src="{{asset("frontend/assets/imgs/theme/icons/icon-user.svg")}}" />--}}
                                            <i class="fa-solid fa-user fa-xs mr-1"></i>
                                        </a>
                                    <a href="{{route(Constants::USER_ACCOUNT)}}"><span class="lable ml-1">Account</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li>
                                                <a href="{{route(Constants::USER_ACCOUNT)}}"><i class="fi fi-rs-user mr-10"></i>My Account</a>
                                            </li>
                                            <li>
                                                <a href="page-account.html"><i class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                                            </li>
                                            <li>
                                                <a href="page-account.html"><i class="fi fi-rs-label mr-10"></i>My Voucher</a>
                                            </li>
                                            <li>
                                                <a href="{{route(\App\Constants\Constants::USER_WISH_LIST)}}"><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a>
                                            </li>
                                            <li>
                                                <a href="page-account.html"><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                            </li>
                                            <li>
                                                <a href="{{route(\App\Constants\Constants::USER_LOGOUT)}}"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                                            </li>
                                        </ul>
                                    </div>
                                @else
                                    <a href="{{route(Constants::USER_LOGIN)}}"><span class="lable ml-5 font-weight-bold fs-6">Login</span></a>
                                    <b class="lable ml-10" >|</b>
                                    <a href="{{route(Constants::USER_Register)}}"><span class="lable ml-10 font-weight-bold fs-6">Register</span></a>
                                @endauth
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




{{------------------------------------------------------------------------------------------------------------------------------------}}

    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="index.html"><img src="{{asset("frontend/assets/imgs/theme/logo.svg")}}" alt="logo" /></a>
                </div>


                <div class="header-nav d-none d-lg-flex">
                    {{------------------All Categories----------------}}
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categories-button-active" href="#">
                            <span class="fi-rs-apps"></span>   All Categories
                            <i class="fi-rs-angle-down"></i>
                        </a>
                        <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                            <div class="d-flex categori-dropdown-inner">
                                <ul>
                                    @foreach($Categories->take(4) as $item)
                                    <li>
                                        <a href="{{route(\App\Constants\Constants::WEB_Products_By_Category ,
                                                                   ['uuid'=>$item->uuid_category , 'slug' => $item->category_slug])}}">
                                            <img src="{{\Illuminate\Support\Facades\Storage::url($item->category_img)}}" alt="" />{{$item->category_name}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                <ul class="end">
                                    @foreach($Categories->skip(4)->take(4) as $item)
                                        <li>
                                            <a href="{{route(\App\Constants\Constants::WEB_Products_By_Category ,
                                                                   ['uuid'=>$item->uuid_category , 'slug' => $item->category_slug])}}">
                                                <img src="{{\Illuminate\Support\Facades\Storage::url($item->category_img)}}" alt="" />{{$item->category_name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="more_slide_open" style="display: none">
                                <div class="d-flex categori-dropdown-inner">
                                    <ul>
                                        @foreach($Categories->skip(8)->take(4) as $item)
                                            <li>
                                                <a href="{{route(\App\Constants\Constants::WEB_Products_By_Category ,
                                                                   ['uuid'=>$item->uuid_category , 'slug' => $item->category_slug])}}">
                                                    <img src="{{\Illuminate\Support\Facades\Storage::url($item->category_img)}}" alt="" />{{$item->category_name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <ul class="end">
                                        @foreach($Categories->skip(12)->all() as $item)
                                            <li>
                                                <a href="{{route(\App\Constants\Constants::WEB_Products_By_Category ,
                                                                   ['uuid'=>$item->uuid_category , 'slug' => $item->category_slug])}}">
                                                    <img src="{{\Illuminate\Support\Facades\Storage::url($item->category_img)}}" alt="" />{{$item->category_name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="more_categories"><span class="icon"></span> <span class="heading-sm-1">Show more...</span></div>
                        </div>
                    </div>
                    {{------------------All Categories----------------}}
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>



                                <li>
                                    <a class="active" href="{{route(App\Constants\Constants::WELCOME)}}">Home</a>
                                </li>

                                {{--Mega menu--}}
                                {{--<li class="position-static">
                                    <a href="#">Mega menu <i class="fi-rs-angle-down"></i></a>
                                    <ul class="mega-menu">
                                        <li class="sub-mega-menu sub-mega-menu-width-22">
                                            <a class="menu-title" href="#">Fruit & Vegetables</a>
                                            <ul>
                                                <li><a href="shop-product-right.html">Meat & Poultry</a></li>
                                                <li><a href="shop-product-right.html">Fresh Vegetables</a></li>
                                                <li><a href="shop-product-right.html">Herbs & Seasonings</a></li>
                                                <li><a href="shop-product-right.html">Cuts & Sprouts</a></li>
                                                <li><a href="shop-product-right.html">Exotic Fruits & Veggies</a></li>
                                                <li><a href="shop-product-right.html">Packaged Produce</a></li>
                                            </ul>
                                        </li>
                                        <li class="sub-mega-menu sub-mega-menu-width-22">
                                            <a class="menu-title" href="#">Breakfast & Dairy</a>
                                            <ul>
                                                <li><a href="shop-product-right.html">Milk & Flavoured Milk</a></li>
                                                <li><a href="shop-product-right.html">Butter and Margarine</a></li>
                                                <li><a href="shop-product-right.html">Eggs Substitutes</a></li>
                                                <li><a href="shop-product-right.html">Marmalades</a></li>
                                                <li><a href="shop-product-right.html">Sour Cream</a></li>
                                                <li><a href="shop-product-right.html">Cheese</a></li>
                                            </ul>
                                        </li>
                                        <li class="sub-mega-menu sub-mega-menu-width-22">
                                            <a class="menu-title" href="#">Meat & Seafood</a>
                                            <ul>
                                                <li><a href="shop-product-right.html">Breakfast Sausage</a></li>
                                                <li><a href="shop-product-right.html">Dinner Sausage</a></li>
                                                <li><a href="shop-product-right.html">Chicken</a></li>
                                                <li><a href="shop-product-right.html">Sliced Deli Meat</a></li>
                                                <li><a href="shop-product-right.html">Wild Caught Fillets</a></li>
                                                <li><a href="shop-product-right.html">Crab and Shellfish</a></li>
                                            </ul>
                                        </li>
                                        <li class="sub-mega-menu sub-mega-menu-width-34">
                                            <div class="menu-banner-wrap">
                                                <a href="shop-product-right.html"><img src="{{asset("frontend/assets/imgs/banner/banner-menu.png")}}" alt="Nest" /></a>
                                                <div class="menu-banner-content">
                                                    <h4>Hot deals</h4>
                                                    <h3>
                                                        Don't miss<br />
                                                        Trending
                                                    </h3>
                                                    <div class="menu-banner-price">
                                                        <span class="new-price text-success">Save to 50%</span>
                                                    </div>
                                                    <div class="menu-banner-btn">
                                                        <a href="shop-product-right.html">Shop now</a>
                                                    </div>
                                                </div>
                                                <div class="menu-banner-discount">
                                                    <h3>
                                                        <span>25%</span>
                                                        off
                                                    </h3>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>--}}
                                {{-- End Mega menu--}}

                                {{--Nestead neasted Meanu --}}
                                {{--<li>
                                    <a href="shop-grid-right.html">Shop <i class="fi-rs-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="shop-list-left.html">Shop List – Left Sidebar</a></li>
                                        <li><a href="shop-fullwidth.html">Shop - Wide</a></li>
                                        <li>
                                            <a href="#">Single Product <i class="fi-rs-angle-right"></i></a>
                                            <ul class="level-menu">
                                                <li><a href="shop-product-right.html">Product – Right Sidebar</a></li>
                                                <li><a href="shop-product-left.html">Product – Left Sidebar</a></li>
                                                <li><a href="shop-product-full.html">Product – No sidebar</a></li>
                                                <li><a href="shop-product-vendor.html">Product – Vendor Info</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>--}}

                                @foreach($Categories->take(5) as $item)
                                        <li>
                                            <a href="{{route(\App\Constants\Constants::WEB_Products_By_Category ,['uuid'=>$item->uuid_category , 'slug' => $item->category_slug])}}">
                                                {{$item->category_name}} <i class="fi-rs-angle-down"></i>
                                            </a>

                                            @if($item->subcategories)
                                                <ul class="sub-menu">
                                                    @foreach($item->subcategories as $subcategory)
                                                        <li><a href="{{route(\App\Constants\Constants::WEB_Products_By_Subcategory ,['uuid'=>$subcategory->uuid_subcategory , 'slug' => $subcategory->subcategory_slug])}}">
                                                                {{$subcategory->subcategory_name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                        </li>
                                @endforeach




                                {{--Pages --}}
                                <li>
                                    <a href="#">Pages <i class="fi-rs-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="page-about.html">About Us</a></li>
                                        <li><a href="page-contact.html">Contact</a></li>

                                        @auth
                                            <li><a href="page-account.html">My Account</a></li>
                                        @endauth
                                        @guest
                                            <li><a href="page-login.html">Login</a></li>
                                            <li><a href="page-register.html">Register</a></li>
                                        @endguest
                                        <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                        <li><a href="page-terms.html">Terms of Service</a></li>

                                    </ul>
                                </li>
                                {{--End Pages --}}
                            </ul>
                        </nav>
                    </div>
                </div>


                <div class="hotline d-none d-lg-flex">
                    <img src="{{asset("frontend/assets/imgs/theme/icons/icon-headphone.svg")}}" alt="hotline" />
                    <p>1900 - 888<span>24/7 Support Center</span></p>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="shop-wishlist.html">
                                <img alt="Nest" src="{{asset("frontend/assets/imgs/theme/icons/icon-heart.svg")}}" />
                                <span class="pro-count white">4</span>
                            </a>
                        </div>

                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="#">
                                <img alt="Nest" src="{{asset("frontend/assets/imgs/theme/icons/icon-cart.svg")}}" />
                                <span class="pro-count white">2</span>
                            </a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                <ul>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="shop-product-right.html"><img alt="Nest" src="{{asset("frontend/assets/imgs/shop/thumbnail-3.jpg")}}" /></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="shop-product-right.html">Plain Striola Shirts</a></h4>
                                            <h3><span>1 × </span>$800.00</h3>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="shop-product-right.html"><img alt="Nest" src="{{asset("frontend/assets/imgs/shop/thumbnail-4.jpg")}}" /></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="shop-product-right.html">Macbook Pro 2022</a></h4>
                                            <h3><span>1 × </span>$3500.00</h3>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>Total <span>$383.00</span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="shop-cart.html">View cart</a>
                                        <a href="shop-checkout.html">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>



{{-- Phone Grid --}}

<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="index.html"><img src="{{asset("frontend/assets/imgs/theme/logo.svg")}}" alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="#">
                    <input type="text" placeholder="Search for items…" />
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu font-heading">
                        <li class="menu-item-has-children">
                            <a href="{{route(App\Constants\Constants::WELCOME)}}">Home</a>
                        </li>


                        <li class="menu-item-has-children">
                            <a href="#">Categories</a>
                            <ul class="dropdown">


                                @foreach ($Categories as $item )
                                    <li><a href="{{route(\App\Constants\Constants::WEB_Products_By_Category ,
                                                                   ['uuid'=>$item->uuid_category , 'slug' => $item->category_slug])}}">{{$item->category_name}}</a></li>
                                @endforeach

                                {{-- <li class="menu-item-has-children">
                                    <a href="#">Shop Invoice</a>
                                    <ul class="dropdown">
                                        <li><a href="shop-invoice-1.html">Shop Invoice 1</a></li>
                                        <li><a href="shop-invoice-2.html">Shop Invoice 2</a></li>
                                        <li><a href="shop-invoice-3.html">Shop Invoice 3</a></li>
                                        <li><a href="shop-invoice-4.html">Shop Invoice 4</a></li>
                                        <li><a href="shop-invoice-5.html">Shop Invoice 5</a></li>
                                        <li><a href="shop-invoice-6.html">Shop Invoice 6</a></li>
                                    </ul>
                                </li> --}}
                            </ul>
                        </li>




                        <li class="menu-item-has-children">
                            <a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="page-about.html">About Us</a></li>
                                <li><a href="page-contact.html">Contact</a></li>
                                @auth
                                    <li><a href="{{route(App\Constants\Constants::USER_ACCOUNT)}}">My Account</a></li>
                                @endauth
                                @guest
                                    <li><a href="{{route(App\Constants\Constants::USER_LOGIN)}}">Login</a></li>
                                    <li><a href="{{route(App\Constants\Constants::USER_Register)}}">Register</a></li>
                                @endguest

                                <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                <li><a href="page-terms.html">Terms of Service</a></li>

                            </ul>
                        </li>
                        {{-- LAnguage --}}
                            {{-- <li class="menu-item-has-children">
                                <a href="#">Language</a>
                                <ul class="dropdown">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                </ul>
                            </li> --}}

                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                <div class="single-mobile-header-info">
                    <a href="page-contact.html"><i class="fi-rs-marker"></i> Our location </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="page-login.html"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                </div>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">Follow Us</h6>
                <a href="#"><img src="{{asset("frontend/assets/imgs/theme/icons/icon-facebook-white.svg")}}" alt="" /></a>
                <a href="#"><img src="{{asset("frontend/assets/imgs/theme/icons/icon-instagram-white.svg")}}" alt="" /></a>
            </div>
            <div class="site-copyright">Copyright 2024 © Nest. All rights reserved. Powered by HMN.</div>
        </div>
    </div>
</div>
<!-- End Header  -->
