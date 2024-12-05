<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
     <div class="sidebar-header">
        <div>
            <img src="{{asset('backend/assets/images/logo-icon22.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">EcoHomes</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
     </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="menu-label">UI Elements</li>
        @if(auth()->user()->role !== 'seller')
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Property Type</div>
            </a>
            <ul>
                <li> <a href="{{ route('add.type') }}"><i class='bx bx-radio-circle'></i>Add Property Type</a>
                </li>
                <li> <a href="{{ route('all.type') }}"><i class='bx bx-radio-circle'></i>All Property Type</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Property</div>
            </a>
            <ul>
                <li> <a href="{{ route('add.property') }}"><i class='bx bx-radio-circle'></i>Add Property</a>
                </li>
                <li> <a href="{{ route('all.property') }}"><i class='bx bx-radio-circle'></i>All Property</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-wifi'></i>
                </div>
                <div class="menu-title">Amenities</div>
            </a>
            <ul>
                <li> <a href="{{ route('add.amenities') }}"><i class='bx bx-radio-circle'></i>Add Amenities</a>
                </li>
                <li> <a href="{{ route('all.amenities') }}"><i class='bx bx-radio-circle'></i>All Amenities</a>
                </li>
            </ul>
        </li>

        {{-- <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Content</div>
            </a>
            <ul>
                <li> <a href="content-grid-system.html"><i class='bx bx-radio-circle'></i>Grid System</a>
                </li>
                <li> <a href="content-typography.html"><i class='bx bx-radio-circle'></i>Typography</a>
                </li>
                <li> <a href="content-text-utilities.html"><i class='bx bx-radio-circle'></i>Text Utilities</a>
                </li>
            </ul>
        </li> --}}
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Icons</div>
            </a>
            <ul>
                <li> <a href="icons-line-icons.html"><i class='bx bx-radio-circle'></i>Line Icons</a>
                </li>
                <li> <a href="icons-boxicons.html"><i class='bx bx-radio-circle'></i>Boxicons</a>
                </li>
                <li> <a href="icons-feather-icons.html"><i class='bx bx-radio-circle'></i>Feather Icons</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('all.seller')}}">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Manage Sellers</div>
            </a>
        </li>
        <li>
            <a href="{{route('all.seller.progress')}}">
                <div class="parent-icon"><i class='bx bx-code-alt'></i>
                </div>
                <div class="menu-title">Step Status</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.profile') }}">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Admin Profile</div>
            </a>
        </li>
        @else
        <li>
            <a href="{{route('all.seller.progress')}}">
                <div class="parent-icon"><i class='bx bx-code-alt'></i>
                </div>
                <div class="menu-title">Manage Step 1-2</div>
            </a>
        </li>
        {{-- <li>
            <a href="{{route('all.seller3.progress3')}}">
                <div class="parent-icon"><i class='bx bx-code-alt'></i>
                </div>
                <div class="menu-title">Manage Step 3-4</div>
            </a>
        </li> --}}
        @endif
        <li class="menu-label">Others</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-menu"></i>
                </div>
                <div class="menu-title">Menu Levels</div>
            </a>
            <ul>
                <li> <a class="has-arrow" href="javascript:;"><i class='bx bx-radio-circle'></i>Level One</a>
                    <ul>
                        <li> <a class="has-arrow" href="javascript:;"><i class='bx bx-radio-circle'></i>Level Two</a>
                            <ul>
                                <li> <a href="javascript:;"><i class='bx bx-radio-circle'></i>Level Three</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="https://codervent.com/rocker/documentation/index.html" target="_blank">
                <div class="parent-icon"><i class="bx bx-folder"></i>
                </div>
                <div class="menu-title">Documentation</div>
            </a>
        </li>
        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
