@extends('layout.main')

@section('content')
<style>
    
.header {
  min-height: 60vh;
  /* background: #009FFF;
background: linear-gradient(to right, #ec2F4B, #009FFF); */
  /* background-image: url('Backend/event_images/7_1_.jpg'); */
  background-repeat: no-repeat;
  background-size: cover;
  color: white;
  clip-path: ellipse(100vw 60vh at 50% 50%);
  display: flex;
  align-items: center;
  justify-content: center;
  padding-top: 150px; 
}

.details {
  text-align: center;
  background-color: #34343494;
  padding: 30px 0px;
}

.profile-pic {
  height: 6rem;
  width: 6rem;
  object-fit: center;
  border-radius: 50%;
  border: 2px solid #fff;
}

.location p {
  display: inline-block;
}

.location svg {
  vertical-align: middle;
}

.stats {
  display: flex;
}

.stats .col-4 {
  width: 10rem;
  text-align: center;
}

.heading {
  font-weight: 400;
  font-size: 1.3rem;
  margin: 1rem 0;
}

</style>
<section class="profile">
    <header class="header" style="background-image:url({{url(Custom::userBgImagePath($users->id))}})">
      <div class="details rounded">
        <img src="{{url(Custom::userImagePath($users->id, 'OA'))}}" alt="John Doe" class="profile-pic">
        <h1 class="heading text-white">{{$users->org_name}}</h1>
        <div class="location">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
    <path d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12 ,2Z"></path>
  </svg>
  <p>{{$users->address}}</p>
</div>
<p><i class="fa fa-envelope"></i> {{$users->email}}</p>
        <div class="stats">
          <div class="col-4">
            <h4 class="text-white">{{$totalEvents}}</h4>
            <p>Events</p>
          </div>
          <div class="col-4">
            <h4 class="text-white" id="total-followers">{{$followers}}</h4>
            <p>Followers</p>
          </div>
          <div class="col-4">
            <h4 class="text-white">{{$totalReviews}}</h4>
            <p>Reviews</p>
          </div>
        </div>
        @if (session()->get('user_type') == 'OA' && $users->id == session()->get('user_id') || session()->get('user_type') == 'A')
            
        <div class="edit-profile">
            <a href="{{url('profile/edit')}}/{{$users->id}}" class="btn btn-dark mb-3">Edit Profile</a>
        </div>
        @else
        <div class="d-flex align-items-center justify-content-center mb-4 mt-4">
          {{-- <input type="checkbox" class="switch_1 " {{$users->status == true ? 'checked' : "" }} data-id="{{$users->id}}"> --}}
          <div class="btn-group" role="group" data-bs-toggle="buttons">

            <label for="follow-btn" class="btn btn-primary">
                <span class="follow-btn-label">
                  @if (Custom::followCheck(session()->get('user_id'), $users->id) == true)
                  Un Follow  <i class="fa fa-user-minus"></i>
                  @elseif(Custom::followCheck(session()->get('user_id'), $users->id) == false)
                  Follow <i class="fa fa-user-plus"></i>
                  @endif 
                  {{-- {{Custom::followCheck(session()->get('user_id'), $users->id) == true ? 'Un Follow' : "Follow" }} --}}
                </span>
                
              <input type="checkbox" class="me-2 follow-btn" name="follow-btn" id="follow-btn" 

              {{Custom::followCheck(session()->get('user_id'), $users->id) == true ? 'checked' : "" }} 
              
              data-id="{{$users->id}}" autocomplete="off" hidden> 

            </label>
          </div>
         
            <div class="col-4"><a href="{{url('chatify')}}/{{$users->id}}" class="btn btn-info dummy-alert">Message <i class="fa fa-comment"></i></a>
            </div>
            {{-- <div class="col-4"><a href="" class="btn btn-dark">Contact</a></div> --}}
        </div>
        @endif

        <div class="bg-dark rounded mb-2 p-1 d-flex align-items-center justify-content-center">
        <a class="btn btn-square mx-1 text-white border m-2" href="https://{{$users->facebook}}"><i class="fab fa-facebook-f"></i></a>
        <a class="btn btn-square mx-1 text-white border m-2" href="https://{{$users->instagram}}"><i class="fab fa-instagram"></i></a>
        <a class="btn btn-square mx-1 text-white border m-2" href="https://{{$users->twitter}}"><i class="fab fa-twitter"></i></a>
        <a class="btn btn-square mx-1 text-white border m-2" href="https://{{$users->youtube}}"><i class="fab fa-youtube"></i></a>
        <a class="btn btn-square mx-1 text-white border m-2"  href="https://{{$users->website}}"><i class="fa fa-globe"></i></a>
    </div>
      </div>
    </header>
    
    {{-- <div class="container-xxl py-5">
        <div class="container">
            <div class="bg-light rounded p-3">
                <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" style="height: 200px;">
                            <img class="rounded" style="width: 100%;height: inherit;" src="{{url('Frontend/img/call-to-action.jpg')}}" alt="">
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                            <div class="mb-4">
                                <h3 class="mb-3">Contact With Our Certified Agent</h3>
                                <p>Eirmod sed ipsum dolor sit rebum magna erat. Tempor lorem kasd vero ipsum sit sit diam justo sed vero dolor duo.</p>
                            </div>
                            <a href="" class="btn btn-primary "><i class="fa fa-phone-alt me-2"></i>Make A Call</a>
                            <a href="" class="btn btn-dark "><i class="fa fa-calendar-alt me-2"></i>Get Appoinment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container mt-4 mb-4 bg-light rounded p-4">
         @if (session()->get('user_type') == 'OA')
         <h3>All (<span class="text-decoration-underline text-secondary">{{Custom::orgName(session()->get('user_id'))}}</span>) Events</h3>
          @else
         <h3>(All {{$users->org_name}} ) Events</h3>
         @endif
    </div>
    
        @foreach ($events as $event)
        <div class="container py-1">
            <div class="container">
                <div class="bg-light rounded p-3">
                    <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                        <div class="row g-5 align-items-center">
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" style="height: 200px;">
                                <img class="rounded" style="width: 100%;height: inherit;" src="{{url(Custom::eventImagePath($event->event_id))}}" alt="">
                            </div>
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                                <div class="mb-4">
                                    <h3 class="mb-3">{{$event->event_name}}</h3>
                                    <p>{{$event->event_description}}</p>
                                </div>
                                <a href="{{url('events')}}/{{$event->event_slug}}" class="btn btn-primary "><i class="fa fa-phone-alt me-2"></i>View Details</a>
                                <a href="{{url('events')}}/{{$event->event_slug}}" class="btn btn-dark "><i class="fa fa-calendar-alt me-2"></i>Buy Ticket</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        @endforeach
   
</section>
@endsection