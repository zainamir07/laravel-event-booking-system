@extends('layout.main')
@section('content')
    <div class="container mt-5 mb-3">
        <div class="row">
            <h3>All Reviews</h3>
            <p><p>Event: <a href="{{url('events/'.Custom::getEventUrl($event->event_id))}}">{{Custom::getEventTitle($event->event_id)}}</a> Reviews</p>
        </p>
        </div>
    </div>

    <div class="container">
     <div class="row">
        @foreach ($reviews as $review)
        <div class="col-12 mb-1 border p-3 rounded bg-light">
         <div class="user-profile d-flex justify-content-between align-items-center">
           <span> <img class="rounded-circle img-fluid pb-2" src="{{url(Custom::userImagePath($review->user_id))}}" alt="" style="width: 50px"> <h6>{{Custom::authorName($review->user_id)}}</h6></span>
           <span> <p>Event: <a href="{{url('events/'.Custom::getEventUrl($event->event_id))}}">{{Custom::getEventTitle($event->event_id)}}</a> </p>
            <p>Organizer:
           <a href="{{url('profile/'.Custom::getEventOrgUsername($review->event_id) )}}" >{{Custom::getEventOrgName($review->event_id)}}</a></p></span>
         </div>
         <p class="pb-0 mb-0 mt-1">{{$review->description}}</p>
         @if ($review->stars == 1)
           <i class="fa fa-star text-warning"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
           <i class="fa fa-star"></i><i class="fa fa-star"></i>
         @elseif($review->stars == 2)  
         <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
           <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
         @elseif($review->stars == 3)  
        <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
           <i class="fa fa-star text-warning"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  
        @elseif($review->stars == 4)  
           <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
           <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star"></i>
        @elseif($review->stars == 5)  
           <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
           <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
           <i class="fa fa-star text-warning"></i>        
        @endif
        <br>
        <div class="mt-2">
          {{get_time_ago( strtotime( $review->created_at))}}
        </div>
        </div>
        @endforeach
     </div>
    </div>
@endsection