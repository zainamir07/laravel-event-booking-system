@extends('layout.main')
     @section('content')
         
              <!-- Header Start -->
              <div class="container-fluid header bg-white p-0">
                <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                    <div class="col-md-6 p-5 mt-lg-5">
                        <h1 class="display-5 animated fadeIn mb-4">Find A <span class="text-primary">Perfect Event</span> To Change Your Life</h1>
                        <p class="animated fadeIn mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet
                            sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                        <a href="{{route('events')}}" class="btn btn-primary py-3 px-5 me-3 animated fadeIn">Find Events</a>
                    </div>
                    <div class="col-md-6 animated fadeIn">
                        <div class="owl-carousel header-carousel">
                            <div class="owl-carousel-item">
                                <img class="img-fluid" src="{{url('Frontend/img/carousel-1.jpg')}}" alt="">
                            </div>
                            <div class="owl-carousel-item">
                                <img class="img-fluid" src="{{url('Frontend/img/carousel-2.jpg')}}" alt="">
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header End -->
     
    
            <!-- Search Start -->
            <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
                <div class="container">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <form action="{{url('events')}}" method="get">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <input type="text" name="search" id="search" class="form-control border-0 py-3" placeholder="Search By Keyword" >
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select border-0 py-3" name="organizer" onchange="this.form.submit()">
                                        <option value="">Event Organizers</option>
                                        @foreach ($allOrganizers as $org)
                                        <option value="{{$org->id}}">{{$org->org_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select border-0 py-3" name="location"  onchange="this.form.submit()">
                                        <option value="">Location</option>
                                        @foreach ($cities as $city)
                                        <option value="{{$city->id}}" >{{$city->city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="col-md-2">
                             {{-- @if ($search != "" || $location != "" || $organizer != "")
                             <a href="{{url('events')}}" class="btn btn-dark border-0 w-100 py-3"> Reset </a>
                             @else
                             <button type="submit" class="btn btn-dark border-0 w-100 py-3"> Search </button>
                             @endif --}}
                             <button type="submit" class="btn btn-dark border-0 w-100 py-3"> Search </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search End -->
    
    
            <!-- Category Start -->
            {{-- <div class="container-xxl py-5">
                <div class="container">
                    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                        <h1 class="mb-3">Property Types</h1>
                        <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                            <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                                <div class="rounded p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="{{url('Frontend/img/icon-apartment.png')}}" alt="Icon">
                                    </div>
                                    <h6>Apartment</h6>
                                    <span>123 Properties</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                            <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                                <div class="rounded p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="{{url('Frontend/img/icon-villa.png')}}" alt="Icon">
                                    </div>
                                    <h6>Villa</h6>
                                    <span>123 Properties</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                            <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                                <div class="rounded p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="{{url('Frontend/img/icon-house.png')}}" alt="Icon">
                                    </div>
                                    <h6>Home</h6>
                                    <span>123 Properties</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                            <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                                <div class="rounded p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="{{url('Frontend/img/icon-housing.png')}}" alt="Icon">
                                    </div>
                                    <h6>Office</h6>
                                    <span>123 Properties</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                            <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                                <div class="rounded p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="{{url('Frontend/img/icon-building.png')}}" alt="Icon">
                                    </div>
                                    <h6>Building</h6>
                                    <span>123 Properties</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                            <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                                <div class="rounded p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="{{url('Frontend/img/icon-neighborhood.png')}}" alt="Icon">
                                    </div>
                                    <h6>Townhouse</h6>
                                    <span>123 Properties</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                            <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                                <div class="rounded p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="{{url('Frontend/img/icon-condominium.png')}}" alt="Icon">
                                    </div>
                                    <h6>Shop</h6>
                                    <span>123 Properties</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                            <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                                <div class="rounded p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="{{url('Frontend/img/icon-luxury.png')}}" alt="Icon">
                                    </div>
                                    <h6>Garage</h6>
                                    <span>123 Properties</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- Category End -->
    
    
            <!-- About Start -->
            {{-- <div class="container-xxl py-5">
                <div class="container">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="about-img position-relative overflow-hidden p-5 pe-0">
                                <img class="img-fluid w-100" src="{{url('Frontend/img/about.jpg')}}">
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                            <h1 class="mb-4">#1 Place To Find The Perfect Property</h1>
                            <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                            <p><i class="fa fa-check text-primary me-3"></i>Tempor erat elitr rebum at clita</p>
                            <p><i class="fa fa-check text-primary me-3"></i>Aliqu diam amet diam et eos</p>
                            <p><i class="fa fa-check text-primary me-3"></i>Clita duo justo magna dolore erat amet</p>
                            <a class="btn btn-primary py-3 px-5 mt-3" href="">Read More</a>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- About End -->
    
    
            <!-- Property List Start -->
            <div class="container-xxl py-5">
                <div class="container">
                    <div class="row g-0 gx-5 align-items-end">
                        <div class="col-lg-6">
                            <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                                <h1 class="mb-3">UpComing Events</h1>
                                <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit diam justo sed rebum.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                            {{-- <form action="{{route('home')}}" method="get"> --}}
                                <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                                    <li class="nav-item me-2">
                                        <button name="featured" class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-1">Featured</button>
                                    </li>
                                    <li class="nav-item me-2">
                                        <button name="freeEvents" class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-2" value="P" >Paid</button>
                                        {{-- onclick="this.form.submit()" --}}
                                    </li>
                                    <li class="nav-item me-0">
                                        <button name="paidEvents" class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-3" value="F" >Free</button>
                                    </li>
                                </ul>
                            {{-- </form> --}}
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                @foreach ($events as $event)
                                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="property-item rounded overflow-hidden">
                                        <div class="position-relative property-item-display overflow-hidden">
                                            <a href="{{url('events')}}/{{$event->event_slug}}"><img class="img-responsive" src="{{url(Custom::eventImagePath($event->event_id))}}" alt="" height="237px" width="100%"></a>
                                            @if ($event->event_subscription == 'F')
                                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Free</div>
                                            @elseif($event->event_subscription == 'P')
                                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Paid</div>
                                            @endif 
                                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{Custom::orgName($event->event_author_id)}}</div>
                                        </div>
                                        <div class="p-4 pb-0">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                            @if ($event->event_subscription == 'F')
                                            <h5 class="text-primary">Rs.0</h5>
                                            @elseif($event->event_subscription == 'P')
                                            <h5 class="text-primary">Rs.{{$event->event_ticket_price}}</h5>
                                            @endif

                                            <small class="flex-fill text-end border-end py-2"><i class="fa fa-users text-primary me-2"></i>{{Custom::availableSeats($event->event_id)}} Seats Left</small> 
                                            </div>

                                            <a class="d-block h5 mb-2" href="{{url('events')}}/{{$event->event_slug}}">{{$event->event_name}}</a>
                                            <p><i class="fa fa-map-marker-alt text-primary me-2"></i>                
                                                {{$event->event_address}}, {{Custom::cityName($event->event_location)}}</p>
                                        </div>
                                        <div class="d-flex border-top">
                                            {{-- <small class="flex-fill text-center border-end py-2"><i class="fa fa-users text-primary me-2"></i>{{Custom::availableSeats($event->event_id)}} Seats Left</small> --}}
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fas fa-calendar-alt text-primary me-2"></i>{{$event->event_start_date}}</small>
                                            <small class="flex-fill text-center py-2"><i class="fa far fa-clock text-primary me-2"></i>{{$event->event_start_time}}</small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                              

                              {{--    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="property-item rounded overflow-hidden">
                                        <div class="position-relative overflow-hidden property-item-display">
                                            <a href=""><img class="img-fluid" src="{{url('Frontend/img/property-2.jpg')}}" alt=""></a>
                                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Rent</div>
                                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Villa</div>
                                        </div>
                                        <div class="p-4 pb-0">
                                            <h5 class="text-primary mb-3">$12,345</h5>
                                            <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                                            <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</p>
                                        </div>
                                        <div class="d-flex border-top">
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                            <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>2 Bath</small>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                                    <a class="btn btn-primary py-3 px-5" href="{{route('events')}}">Browse More Events</a>
                                </div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                @foreach ($paidEvents as $event)
                                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="property-item rounded overflow-hidden">
                                        <div class="position-relative property-item-display overflow-hidden">
                                            <a href="{{url('events')}}/{{$event->event_slug}}"><img class="img-responsive" src="{{url(Custom::eventImagePath($event->event_id))}}" alt="" height="237px" width="100%"></a>
                                            @if ($event->event_subscription == 'F')
                                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Free</div>
                                            @elseif($event->event_subscription == 'P')
                                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Paid</div>
                                            @endif 
                                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{Custom::orgName($event->event_author_id)}}</div>
                                        </div>
                                        <div class="p-4 pb-0">
                                            @if ($event->event_subscription == 'F')
                                            <h5 class="text-primary mb-3">Rs.0</h5>
                                            @elseif($event->event_subscription == 'P')
                                            <h5 class="text-primary mb-3">Rs.{{$event->event_ticket_price}}</h5>
                                            @endif 
                                            <a class="d-block h5 mb-2" href="{{url('events')}}/{{$event->event_slug}}">{{$event->event_name}}</a>
                                            <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{Custom::cityName($event->event_location)}}</p>
                                        </div>
                                        <div class="d-flex border-top">
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-users text-primary me-2"></i>{{Custom::availableSeats($event->event_id)}} Left</small>
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fas fa-calendar-alt text-primary me-2"></i>{{$event->event_start_date}}</small>
                                            <small class="flex-fill text-center py-2"><i class="fa far fa-clock text-primary me-2"></i>{{$event->event_start_time}}</small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-12 text-center">
                                    <a class="btn btn-primary py-3 px-5" href="{{route('events')}}">Browse More Property</a>
                                </div>
                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                @foreach ($freeEvents as $event)
                                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="property-item rounded overflow-hidden">
                                        <div class="position-relative property-item-display overflow-hidden">
                                            <a href="{{url('events')}}/{{$event->event_slug}}"><img class="img-responsive" src="{{url(Custom::eventImagePath($event->event_id))}}" alt="" height="237px" width="100%"></a>
                                            @if ($event->event_subscription == 'F')
                                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Free</div>
                                            @elseif($event->event_subscription == 'P')
                                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Paid</div>
                                            @endif 
                                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{Custom::orgName($event->event_author_id)}}</div>
                                        </div>
                                        <div class="p-4 pb-0">
                                            @if ($event->event_subscription == 'F')
                                            <h5 class="text-primary mb-3">Rs.0</h5>
                                            @elseif($event->event_subscription == 'P')
                                            <h5 class="text-primary mb-3">Rs.{{$event->event_ticket_price}}</h5>
                                            @endif 
                                            <a class="d-block h5 mb-2" href="{{url('events')}}/{{$event->event_slug}}">{{$event->event_name}}</a>
                                            <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{Custom::cityName($event->event_location)}}</p>
                                        </div>
                                        <div class="d-flex border-top">
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-users text-primary me-2"></i>{{Custom::availableSeats($event->event_id)}} Left</small>
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fas fa-calendar-alt text-primary me-2"></i>{{$event->event_start_date}}</small>
                                            <small class="flex-fill text-center py-2"><i class="fa far fa-clock text-primary me-2"></i>{{$event->event_start_time}}</small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-12 text-center">
                                    <a class="btn btn-primary py-3 px-5" href="{{route('events')}}">Browse More Property</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Property List End -->
    
    
            <!-- Locations Start -->
            <div class="container-xxl py-5">
                <div class="container">
                    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                        <h1 class="mb-3">Event Locations</h1>
                        <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item rounded overflow-hidden">
                                <div class="position-relative">
                                    <img src="{{url('Frontend/img/islamabad.jpg')}}" alt="Islamabad" style="width=100%; height:175px">
                                    {{-- <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                        <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    </div> --}}
                                </div>
                                <div class="text-center p-4 mt-3">
                                    <h5 class="fw-bold mb-0">Islamabad</h5>
                                </div>
                                <div class="text-center">
                                <h6 class="badge bg-primary p-2"><a class="text-white btn-sm" href="{{url('events?locationUpcoming=6')}}">{{$islamabad}} Upcoming Events <i class="fa bi bi-arrow-right"></i></a></h6>
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="team-item rounded overflow-hidden">
                                <div class="position-relative">
                                    <img src="{{url('Frontend/img/lahore.jpg')}}" alt="Lahore" style="width=100%; height:175px">
                                </div>
                                <div class="text-center p-4 mt-3">
                                    <h5 class="fw-bold mb-0">Lahore</h5>
                                </div>
                                <div class="text-center">
                                    <h6 class="badge bg-primary p-2"><a class="text-white btn-sm" href="{{url('events?locationUpcoming=14')}}">{{$lahore}} Upcoming Events <i class="fa bi bi-arrow-right"></i></a></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                            <div class="team-item rounded overflow-hidden">
                                <div class="position-relative">
                                    <img src="{{url('Frontend/img/karachi.jpg')}}" alt="Karachi" style="width=100%; height:175px">
                                </div>
                                <div class="text-center p-4 mt-3">
                                    <h5 class="fw-bold mb-0">Karachi</h5>
                                </div>
                                <div class="text-center">
                                    <h6 class="badge bg-primary p-2"><a class="text-white btn-sm" href="{{url('events?locationUpcoming=2')}}">{{$karachi}} Upcoming Events <i class="fa bi bi-arrow-right"></i></a></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                            <div class="team-item rounded overflow-hidden">
                                <div class="position-relative">
                                    <img src="{{url('Frontend/img/multan.jpg')}}" alt="Multan" style="width=100%; height:175px">
                                </div>
                                <div class="text-center p-4 mt-3">
                                    <h5 class="fw-bold mb-0">Multan</h5>
                                </div>
                                <div class="text-center">
                                    <h6 class="badge bg-primary p-2"><a class="text-white btn-sm" href="{{url('events?locationUpcoming=38')}}">{{$multan}} Upcoming Events <i class="fa bi bi-arrow-right"></i></a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Team End -->
    
            
            <!-- Call to Action Start -->
            <div class="container-xxl py-5">
                <div class="container">
                    <div class="bg-light rounded p-3">
                        <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                            <div class="row g-5 align-items-center">
                                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                                    <img class="img-fluid rounded w-100" src="{{url('Frontend/img/call-to-action.jpg')}}" alt="">
                                </div>
                                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                                    <div class="mb-4">
                                        <h1 class="mb-3">Contact With Our Certified Agent</h1>
                                        <p>Eirmod sed ipsum dolor sit rebum magna erat. Tempor lorem kasd vero ipsum sit sit diam justo sed vero dolor duo.</p>
                                    </div>
                                    <a href="" class="btn btn-primary py-3 px-4 me-2"><i class="fa fa-phone-alt me-2"></i>Make A Call</a>
                                    <a href="" class="btn btn-dark py-3 px-4"><i class="fa fa-calendar-alt me-2"></i>Get Appoinment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Call to Action End -->
    
    
    
            <!-- Testimonial Start -->
            <div class="container-xxl py-5">
                <div class="container">
                    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                        <h1 class="mb-3">Our Clients Say!</h1>
                        <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                    </div>
                    <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                        <div class="testimonial-item bg-light rounded p-3">
                            <div class="bg-white border rounded p-4">
                                <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid flex-shrink-0 rounded" src="{{url('Frontend/img/testimonial-1.jpg')}}" style="width: 45px; height: 45px;">
                                    <div class="ps-3">
                                        <h6 class="fw-bold mb-1">Client Name</h6>
                                        <small>Profession</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-item bg-light rounded p-3">
                            <div class="bg-white border rounded p-4">
                                <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid flex-shrink-0 rounded" src="{{url('Frontend/img/testimonial-2.jpg')}}" style="width: 45px; height: 45px;">
                                    <div class="ps-3">
                                        <h6 class="fw-bold mb-1">Client Name</h6>
                                        <small>Profession</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-item bg-light rounded p-3">
                            <div class="bg-white border rounded p-4">
                                <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid flex-shrink-0 rounded" src="{{url('Frontend/img/testimonial-3.jpg')}}" style="width: 45px; height: 45px;">
                                    <div class="ps-3">
                                        <h6 class="fw-bold mb-1">Client Name</h6>
                                        <small>Profession</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Testimonial End -->
        
     @endsection
