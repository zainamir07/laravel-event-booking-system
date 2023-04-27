   <!-- Navbar Start -->
   <div class="container-fluid nav-bar bg-transparent">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
        <a href="{{route('home')}}" class="navbar-brand d-flex align-items-center text-center">
            <div class="icon p-2 me-2">
                <img class="img-fluid" src="{{url('Frontend/img/icon-deal.png')}}" alt="Icon" style="width: 30px; height: 30px;">
            </div>
            <h1 class="m-0 text-primary">Events</h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="{{route('home')}}" class="nav-item nav-link active">Home</a>
                <a href="{{route('events')}}" class="nav-item nav-link">Events</a>
                <a href="{{route('allOrganizers')}}" class="nav-item nav-link">Organizers</a>
                @if (session()->has('user_id') || session()->has('org_id') )
                {{-- <a @if (session()->get('user_id') == 1) href="{{route('admin')}}" @else href="{{route('home')}}" @endif class="nav-item nav-link">Dashboard</a> --}}
                
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Welcome 
                        @if (session()->get('org_name') != "")
                        {{session()->get('org_name')}}
                        @else
                        {{session()->get('user_name')}}
                        @endif
                        ! @if ($totalNotifications > 0) <span class="badge bg-danger">{{$totalNotifications}}</span> @endif</a>
                    <div class="dropdown-menu rounded-0 m-0">

                        @if (session()->get('user_type') == 'A')
                        <a href="{{route('admin')}}" class="dropdown-item">Dashboard</a>
                        @endif
                        @if (session()->get('user_type') == 'OA')
                        <a href="{{route('dashboard')}}" class="dropdown-item">Dashboard</a>
                        <a href="{{route('org_events')}}" class="dropdown-item">My Events</a>
                        <a href="{{route('org_tickets')}}" class="dropdown-item">All Tickets</a>
                        <a href="{{route('my_followers')}}" class="dropdown-item">My Followers</a>
                        <a href="{{url('chatify')}}" class="dropdown-item">Messages</a>
                        @endif
                          @if (session()->get('user_type') == 'U')
                            <a href="{{route('user_events')}}" class="dropdown-item">My Events</a>
                            <a href="{{route('org_tickets')}}" class="dropdown-item">All Tickets</a>
                            <a href="{{url('user_reviews')}}" class="dropdown-item">My Reviews</a>
                            <a href="{{url('chatify')}}" class="dropdown-item">Messages</a>
                          @endif

                        <a @if (session()->get('user_type') == 'U') href="{{route('userProfile')}}" 
                            @elseif(session()->get('user_type') == 'OA') href="{{route('orgProfile')}}" @else href="{{route('admin')}}"  @endif  class="dropdown-item">My Profile</a>

                            @if (session()->get('user_type') == 'U')
                            <a href="{{url('u_notifications')}}" class="dropdown-item">Notifications @if ($totalNotifications > 0) <span class="badge bg-danger">{{$totalNotifications}}</span> @endif </a>
                            @elseif(session()->get('user_type') == 'OA')
                            <a href="{{url('o_notifications')}}" class="dropdown-item">Notifications 
                                @if ($totalNotifications > 0) <span class="badge bg-danger">{{$totalNotifications}}</span> @endif
                                 </a>
                            @endif
                    </div>
                </div>

                <a href="{{route('logout')}}" class="nav-item nav-link">Logout</a>
                @else
                <a href="{{route('login')}}" class="nav-item nav-link">Login</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Register</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="{{route('register')}}" class="dropdown-item">As a User</a>
                        <a href="{{url('organization_register')}}" class="dropdown-item">As a Organizer</a>
                    </div>
                </div>
                @endif
                @if (session()->get('user_type') == 'OA')
                <div class="m-auto">
                <a href="{{route('create_event')}}" class="btn btn-primary px-3 d-none d-lg-flex">Create Event</a>
            </div>
                @endif

                
                {{-- <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Error</a>
                    </div>
                </div> --}}
               
            </div>
            {{-- <a href="" class="btn btn-primary px-3 d-none d-lg-flex">Create Event</a> --}}
        </div>
    </nav>
</div>
<!-- Navbar End -->
