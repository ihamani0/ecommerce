

<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            {{--<div class="search-bar flex-grow-1">
                <div class="position-relative search-bar-box">
                    <input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
                    <span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
                </div>
            </div>--}}

            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    {{--Notification--}}
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" id="notification-count" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='fa-light fa-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Notifications</p>
                                    {{--<p class="msg-header-clear ms-auto">Marks all as read</p>--}}
                                </div>
                            </a>
                            <div class="header-notifications-list">

                                {{--Ajax Her--}}

                            </div>

                        </div>
                    </li>


                    {{--Language--}}
                    <li class="nav-item dropdown dropdown-menu">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-light fa-earth"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Language</p>
                                </div>
                            </a>
                            <div class="header-message-list ps h-100" >
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <img src="{{asset('backend/assets/flags/1x1/us.svg')}}" class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6>English</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>


            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">



                    {{-- start image  --}}

                    @if(Auth::guard("admin")->user()->photo_profile)
                        <img src="{{\Illuminate\Support\Facades\Storage::url(Auth::guard("admin")->user()->photo_profile)}}" class="user-img" alt="user avatar">
                    @else
                        <img src="{{\Illuminate\Support\Facades\Storage::url("public/upload/user-1.svg")}}" class="user-img" alt="user avatar">
                    @endif

                    {{-- end  image  --}}



                    <div class="user-info ps-3">
                        <p class="user-name mb-0"> {{ str( Auth::guard("admin")->user()->name )->limit(6) }}  </p>
                        <p class="designattion mb-0">{{ str(Auth::guard("admin")->user()->email )->limit(6) }} </p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route("admin.profile") }}"><i class="bx bx-user"></i><span>Profile</span></a>
                    </li>
                    <li><a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>Settings</span></a>
                    </li>
                    <li><a class="dropdown-item" href="javascript:;"><i class='bx bx-home-circle'></i><span>Dashboard</span></a>
                    </li>
                    <li><a class="dropdown-item" href="javascript:;"><i class='bx bx-dollar-circle'></i><span>Earnings</span></a>
                    </li>
                    <li><a class="dropdown-item" href="javascript:;"><i class='bx bx-download'></i><span>Downloads</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li>
                        <form id="form_logout" action="{{ route("admin.logout") }}" method="post">
                            @csrf
                        <button type="submit" class="dropdown-item"  ><i class='bx bx-log-out-circle'>
                            </i><span>Logout</span>
                        </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
