 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
     
     <div class="row d-flex justify-content-center align-item-center">
     <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
            <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
        </a>
                <!-- Sidebar Toggler (Sidebar) -->
                {{-- <div class="text-center d-none d-md-inline mt-3">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div> --}}
        </div>
       

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('admin')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
            <a class="nav-link" href="{{url('/')}}" target="_blank">
                <i class="fas fa-fw fa-globe"></i>
                <span>Visit Site</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{url('admin')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="Javascript:;" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Community</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('admin.users')}}">Users</a>
                 <a class="collapse-item" href="{{route('admin.organization')}}">Organizations</a>
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.eventTypes')}}">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Event Types</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.guestCapacity')}}">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Guest Capacity</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.events')}}">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Events</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.tickets')}}">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Tickets</span>
        </a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{route('admin.cities')}}">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Cities</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.brands')}}">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Brands</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.colors')}}">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Colors</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.models')}}">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Models</span>
        </a>
    </li>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('admin.listing')}}">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Listings</span>
    </a>
</li> --}}

{{-- <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.listing')}}" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Listing</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('admin.listing')}}">All Ads</a>
                 <a class="collapse-item" href="utilities-color.html">Sell Cars</a>
                <a class="collapse-item" href="utilities-border.html">Buy Cars</a>
                <a class="collapse-item" href="utilities-animation.html">Rent Cars</a>
            </div>
        </div>
    </li> --}}

    
    <li class="nav-item">
        <a class="nav-link" href="{{route('logout')}}">
            <i class="fas fa-fw fa-cog" ></i>
            <span>Logout</span>
        </a>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Utilities Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Addons
    </div> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Charts -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li> --}}

    <!-- Nav Item - Tables -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> --}}

    <!-- Divider -->
    {{-- <hr class="sidebar-divider d-none d-md-block"> --}}

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->