@extends('layout.main')
@section('content')
    <style>
      /* rating */
.rating-css div {
    color: #ffe400;
    font-size: 30px;
    font-family: sans-serif;
    font-weight: 800;
    text-align: center;
    text-transform: uppercase;
    padding: 20px 0;
  }
  .rating-css input {
    display: none;
  }
  .rating-css input + label {
    font-size: 23px;
    text-shadow: 1px 1px 0 #8f8420;
    cursor: pointer;
  }
  .rating-css input:checked + label ~ label {
    color: #b4afaf;
  }
  .rating-css label:active {
    transform: scale(0.8);
    transition: 0.3s ease;
  }

/* End of Star Rating */
    </style>
<div class="container">
<div class="mt-5 mb-4">
    <h4>My Book Events</h4>
</div>
@if (session()->has('error'))
<div class="alert alert-danger">{{session()->get('error')}}</div>
@endif
@if (session()->has('success'))
<div class="alert alert-success">{{session()->get('success')}}</div>
@endif
   <div class="table_section padding_infor_info">
      <div class="table-responsive-sm">
         <table class="table">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Title/Image</th>
                  <th>Location</th>
                  <th>Start Date/Time</th>
                  <th>End Date/Time</th>
                  <th>Subscription</th>
                  <th>Payment Status</th>
                  <th>Reviews</th>
                  <th>Tickets</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($events as $event)
                <tr>
                    <td>{{$i}}</td>
                    <td class="text-center">
                      <span><img src="{{url(Custom::eventImagePath($event->event_id))}}" alt="" class="img-fluid" width="100px"></span>  
                      <p>{{$event->event_name}}</p> 
                    </td>
                    <td>{{Custom::cityName($event->event_location)}}</td>
                    <td> <p>Date: {{$event->event_start_date}}</p> <p>Time: {{$event->event_start_time}}</p></td>
                    <td> <p>Date: {{$event->event_end_date}}</p> <p>Time: {{$event->event_end_time}}</p></td>
                    <td> @if ($event->event_subscription == 'F')
                        <span class="p-2 badge badge-success bg-success">Free</span>
                        @elseif($event->event_subscription == 'P')
                        <span class="p-2 badge badge-danger bg-danger">Paid</span>
                       <p class="mt-2"><strong>Rs. {{$event->event_ticket_price}}</strong></p>
                    @endif </td>
                    {{-- <td>{{Custom::availableSeats($event->event_id)}}</td> --}}
                    <td><span class="badge bg-primary p-2">Paid</span></td>
                    <td>
                    @if (Custom::reviewsCheck($event->event_id) == true)
                       @php $stars = Custom::reviewsCheck($event->event_id);  @endphp
                      @if ($stars == 1)
                        <i class="fa fa-star text-warning"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                      @elseif($stars == 2)  
                      <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                      @elseif($stars == 3)  
                     <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  
                     @elseif($stars == 4)  
                        <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star"></i>
                     @elseif($stars == 5)  
                        <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>        
                     @endif
                        {{-- {!! $stars !!} --}}
                    @else    
                    <button type="button" class="btn btn-primary btn-sm share_event_review" data-bs-toggle="modal" data-bs-target="#modalId"  data-id="{{$event->event_id}}">
                     <i class="fa fa-star"></i> Review
                   </button>
                    @endif  
                     {{-- <button class="btn btn-sm btn-dark share_event_review" data-id="{{$event->event_id}}">Review</button> --}}
                  </td>
                  <td> <span class="badge bg-secondary">{{Custom::soldTickets($event->event_id)}}</span> <br>
                     <a class="text-primary" href="{{url('myTickets')}}/{{$event->event_slug}}">View All</a></td>
                    <td><a href="{{url('events')}}/{{$event->event_slug}}" class="btn btn-sm btn-info">View</a></td>
               
                </tr>
                @php
                     $i++;
                @endphp
                @endforeach
                  
            </tbody>
         </table>
         <div class="row">
          {{-- {{  $users->links('pagination::bootstrap-5') }}  --}}
        </div>
      </div>
   </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" style="z-index: 99999">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
            <div class="modal-header">
                  <h5 class="modal-title" id="modalTitleId">Share Your Experience</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
         <div class="modal-body">
            <div class="container-fluid">
               <form action="{{url('BookEvents/event_review')}}" method="post">
                  @csrf
                  <div class="container">
                     <h4>Rate This Event</h4>
                     <p></p>
                     <input type="text" name="event_id" id="event_id_for_review" hidden>
                  </div>
                  <div class="mb-3">
                     <div class="rating-css">
                        <div class="star-icon">
                            <input type="radio" value="1" name="product_rating" checked id="rating1">
                            <label for="rating1" class="fa fa-star"></label>
                            <input type="radio" value="2" name="product_rating" id="rating2">
                            <label for="rating2" class="fa fa-star"></label>
                            <input type="radio" value="3" name="product_rating" id="rating3">
                            <label for="rating3" class="fa fa-star"></label>
                            <input type="radio" value="4" name="product_rating" id="rating4">
                            <label for="rating4" class="fa fa-star"></label>
                            <input type="radio" value="5" name="product_rating" id="rating5">
                            <label for="rating5" class="fa fa-star"></label>
                        </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="review_description" class="form-label">Description</label>
                    <textarea class="form-control" name="review_description" id="review_description" rows="3"></textarea>
                  </div>
                  <div class="mb-3">
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  </form>   
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>



@endsection