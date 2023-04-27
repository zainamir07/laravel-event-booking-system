@extends('layout.main')

@section('content')
<style>
img {
 display: block;
 height: auto;
 width: 100%
}
.card-price {
	display: inline-block;
    width: auto;
	height: 38px;
	background-color: #6ab070;
	-webkit-border-radius: 3px 4px 4px 3px;
	-moz-border-radius: 3px 4px 4px 3px;
	border-radius: 3px 4px 4px 3px;
	border-left: 1px solid #6ab070;
	/* This makes room for the triangle */
	margin-left: 19px;
	position: relative;
	color: white;
	font-weight: 300;
	font-size: 22px;
	line-height: 38px;
	padding: 0 10px 0 10px;
}
/* Makes the triangle */
.card-price:before {
	content: "";
	position: absolute;
	display: block;
	left: -19px;
	width: 0;
	height: 0;
	border-top: 19px solid transparent;
	border-bottom: 19px solid transparent;
	border-right: 19px solid #6ab070;
}
/* Makes the circle */
.card-price:after {
	content: "";
	background-color: white;
	border-radius: 50%;
	width: 4px;
	height: 4px;
	display: block;
	position: absolute;
	left: -9px;
	top: 17px;
}

.lSSlideOuter .lSSlideWrapper {
    height: 450px;
}

</style>


<div class = "container-fluid mt-5">
    <div class="container">
    {{-- <div class = "card p-5"> --}}
        <div class="row no-gutters">
            <div class="col-md-5 pr-2">
               <div class="card">
                  <div class="demo">
                     <ul id="lightSlider">
                        @foreach ($eventImages as $image)
                        <li data-thumb="{{url('Backend/event_images')}}/{{$image->event_image_path}}"> <img src="{{url('Backend/event_images')}}/{{$image->event_image_path}}" /> </li>
                        @endforeach
                     </ul>
                  </div>
               </div>
      
            </div>
            <div class="col-md-7">

              <div class="right-side-pro-detail pb-3 pe-3 ps-3 m-0">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-between">
                    {{-- <p>{{remainingDays($events->event_start_date)}}</p> --}}
                        @if ($events->event_author_id == 1)
                        <p class="mt-0 pt-0 mb-2">Organizer: <span class="text-decoration-underline text-secondary fw-bold">Admin</span></p>
                        @else
                        <p class="mt-0 pt-0 mb-2">Organizer: <a href="{{url('profile/'.Custom::orgUsername($events->event_author_id) )}}" class="text-secondary fw-bold text-decoration-underline">{{Custom::orgName($events->event_author_id)}}</a></p>
                        @endif
                        <p class="mt-0 pt-0 mb-2">Publish at: <span class="text-secondary fw-bold text-decoration-underline">{{dateFormat($events->created_at)}}</span></p>
                </div>
                <div class="col-lg-12">
                    {{-- <p>{{remainingDays($events->event_start_date)}}</p> --}}
                    <h3 class="">{{$events->event_name}}</h3>
                    <p class="mb-2"><a href="{{url('reviews')}}/{{$events->event_slug}}">Reviews ( {{$totalReviews}} )</a> Rating ( {{Custom::placeRating($events->event_id)}}<i class="fa fa-star text-warning"></i>)</p>
                </div>
                <div class="col-lg-12 pb-0 mb-0">
                    <p class="card-price mb-0">Rs.{{$events->event_ticket_price}}</p>
                    <hr>
                </div>
                <div class="col-lg-12">
                    <h5 class="text-primary">Event Details</h5>
                    <span>{{$events->event_description}}</span>
                    <hr class="m-0 pt-1 mt-2">
                </div>
                <div class="col-lg-12 mt-2">
                    <p class="tag-section"><strong>Location : <i class="fa fa-map-marker-alt text-primary"></i> </strong>{{$events->event_address}}, {{Custom::cityName($events->event_location)}}</p>
                </div>
                <div class="col-lg-12">
                    <p><strong>Starting at : </strong>( <i class="fa fas fa-calendar-alt text-primary me-1"></i>{{dateFormat($events->event_start_date)}} )  (<i class="fa far fa-clock text-primary me-1"></i>{{$events->event_start_time}}) </p>
                </div>
                <div class="col-lg-12">
                    <p><strong>Ending at : </strong>( <i class="fa fas fa-calendar-alt text-primary me-1"></i>{{dateFormat($events->event_end_date)}} )  (<i class="fa far fa-clock text-primary me-1"></i>{{$events->event_end_time}} ) </p>
                </div>
                <div class="col-lg-12 mt-2">
                    <p class="tag-section"><strong>Total Tickets : </strong>{{$events->event_guestCapacity}}</p>
                    <p class="tag-section"><strong>Available Tickets : </strong>{{Custom::availableSeats($events->event_id)}}</p>
                </div>
                <div class="col-lg-12 mt-3">
                    <div class="row">
                        <div class="col-lg-6">
                            @if (Custom::buyTicketCheckUserId($events->event_id) == 0)
                            <a href="{{route('login')}}" class="btn btn-success w-100">Login To Buy</a>

                            @elseif(Custom::buyTicketCheckUserId($events->event_id) == 1)
                            <p class="btn btn-success w-100">Only Users Can Buy</p>

                            @elseif(Custom::buyTicketCheckUserId($events->event_id) == 2)
                            <p class="btn btn-success w-100">You're Admin</p>
                
                            @elseif(Custom::buyTicketCheckUserId($events->event_id) == 'P')
                            <p class="btn btn-success w-100">Already Buy</p>
                            
                            @elseif(Custom::buyTicketCheckUserId($events->event_id) == 'NP')
                            <form action="{{url('events/buyTicket')}}/{{$events->event_slug}}" method="get">
                                @csrf
                            <div class="col-lg-12">
                              <div class="mb-3">
                                <label for="" class="form-label">Quantity</label>
                                <input type="number"  max="9" min="1"
                                  class="form-control border-secondary" name="quantity" id="quantity" aria-describedby="helpId" placeholder="">
                                  <span class="text-danger"> @error('quantity')
                                      {{$message}}
                                  @enderror</span>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Buy Ticket</button>
                            </form>
                            @endif

                        </div>
                        <div class="container mt-4">
                            <h5>Share it:</h5>
                            <div class="bg-dark rounded mb-2 p-1 mt-2 d-flex align-items-center justify-content-around">
                                <a class="btn btn-square mx-1 text-white border m-2" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1 text-white border m-2" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-square mx-1 text-white border m-2" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1 text-white border m-2" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-square mx-1 text-white border m-2" href=""><i class="fab fa-linkedin"></i></a>
                            <a class="btn btn-square mx-1 text-white border m-2" href=""><i class="fab fa-pinterest"></i></a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

            </div>
         </div>

      </div>
    </div>
</div>

    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
    <script src='https://sachinchoolur.github.io/lightslider/dist/js/lightslider.js'></script>
    <script> $('#lightSlider').lightSlider({ gallery: true, item: 1, loop: true, slideMargin: 0, thumbItem: 9 });</script>
    
@endsection