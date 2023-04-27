@extends('layout.main')

@section('content')
    <div class="container mt-5 mb-3">
        <div class="row">
            <h3> All ( {{session()->get('user_name')}} ) Reviews</h3>
        </div>
    </div>

    <div class="container">
        <div class="row">
           @foreach ($reviews as $review)
           <div class="col-12 mb-3 border p-3 rounded bg-light">
           <h6>{{Custom::authorName($review->user_id)}}</h6>
            <p class="mb-0 mt-3">{{$review->description}}</p>
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
          <br> <p class="float-start mb-0 mt-3">{{get_time_ago(strtotime($review->created_at))}}</p>
           <div class="float-end">
            <p class="mb-0">Event Title:</p>
           <a href="{{url('events/'.Custom::getEventUrl($review->event_id) )}}" >{{Custom::getEventTitle($review->event_id)}}</a>
         </div>
           </div>
           @endforeach
        </div>
       </div>

@endsection