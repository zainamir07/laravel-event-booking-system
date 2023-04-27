@extends('layout.main')
@section('content')

        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Event Organizers</h1>
                    <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                </div>
                <div class="row g-4">
                   @foreach ($organizers as $org) 
                       
                   <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                       <div class="team-item rounded overflow-hidden p-3">
                            <div class="position-relative text-center">
                                <img src="{{url(Custom::userImagePath($org->id))}}" alt="" height="200px" width="100%">
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                    <a class="btn btn-square mx-1" href="{{$org->facebook}}"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square mx-1" href="{{$org->instagram}}"><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square mx-1" href="{{$org->twitter}}"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                            <div class="text-center pt-2 pb-2 mt-3">
                                <h5 class="fw-bold">{{$org->org_name}}</h5>
                                <span class="mb-0">OverAll Reviews <span class="text-danger">( {{Custom::totalReviews($org->id)}} )</span> </span>
                            </div>
                            <div class="text-center">
                            <h6 class="badge bg-primary p-2"><a class="text-white btn-sm" href="{{url('profile')}}/{{$org->username}}">View Profile <i class="fa bi bi-arrow-right"></i></a></h6>
                        </div>
                    </div>
                </div>
                @endforeach
                
                    {{-- <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="team-item rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="{{url('Frontend/img/team-2.jpg')}}" alt="">
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                    <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">Lahore</h5>
                            </div>
                            <div class="text-center">
                                <h6 class="badge bg-primary p-2"><a class="text-white btn-sm" href="{{url('events?locationUpcoming=14')}}"> Upcoming Events <i class="fa bi bi-arrow-right"></i></a></h6>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>

    </div>

@endsection