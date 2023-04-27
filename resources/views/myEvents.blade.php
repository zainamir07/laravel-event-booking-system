@extends('layout.main')

@section('content')
<style>
  .circle-tile {
  margin-bottom: 15px;
  text-align: center;
}
.circle-tile-heading {
  border: 3px solid rgba(255, 255, 255, 0.3);
  border-radius: 100%;
  color: #FFFFFF;
  height: 80px;
  margin: 0 auto -40px;
  position: relative;
  transition: all 0.3s ease-in-out 0s;
  width: 80px;
}
.circle-tile-heading .fa {
  line-height: 80px;
}
.circle-tile-content {
  padding-top: 50px;
}
.circle-tile-number {
  font-size: 26px;
  font-weight: 700;
  line-height: 1;
  padding: 5px 0 15px;
}
.circle-tile-description {
  text-transform: uppercase;
}
.circle-tile-footer {
  background-color: rgba(0, 0, 0, 0.1);
  color: rgba(255, 255, 255, 0.5);
  display: block;
  padding: 5px;
  transition: all 0.3s ease-in-out 0s;
}
.circle-tile-footer:hover {
  background-color: rgba(0, 0, 0, 0.2);
  color: rgba(255, 255, 255, 0.5);
  text-decoration: none;
}
.circle-tile-heading.dark-blue:hover {
  background-color: #2E4154;
}
.circle-tile-heading.green:hover {
  background-color: #138F77;
}
.circle-tile-heading.orange:hover {
  background-color: #DA8C10;
}
.circle-tile-heading.blue:hover {
  background-color: #2473A6;
}
.circle-tile-heading.red:hover {
  background-color: #CF4435;
}
.circle-tile-heading.purple:hover {
  background-color: #7F3D9B;
}
.tile-img {
  text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.9);
}
</style>
<div class="container mt-3">
  <h2>My Events</h2>
  <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto nemo totam commodi, dolorem quia quaerat mollitia sint nulla recusandae quam!</p>


  
<div class="container bootstrap snippet bg-light p-4 rounded text-white">
  <div class="row justify-content-around">
    <div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading bg-primary"><i class="fa fa-users fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content bg-primary">
          <div class="circle-tile-description text-faded"> Total Events</div>
          <div class="circle-tile-number text-faded ">{{$totalEvents}}</div>
          <a class="circle-tile-footer" href="#">Upcoming<i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div>
     
    <div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading bg-secondary"><i class="fa fa-users fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content bg-secondary">
          <div class="circle-tile-description text-faded"> Today's Events </div>
          <div class="circle-tile-number text-faded ">{{$TodayTotalEvents}}</div>
          <a class="circle-tile-footer" href="#">Running<i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div> 

    <div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading bg-dark"><i class="fa fa-users fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content bg-dark">
          <div class="circle-tile-description text-faded"> Upcoming Events </div>
          <div class="circle-tile-number text-faded ">{{$upcommingTotalEvents}}</div>
          <a class="circle-tile-footer" href="#">Block By Admin<i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div> 

    <div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading bg-success"><i class="fa fa-users fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content bg-success">
          <div class="circle-tile-description text-faded"> Completed </div>
          <div class="circle-tile-number text-faded ">{{$completedTotalEvents}}</div>
          <a class="circle-tile-footer" href="#">End<i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div> 
  </div> 
</div>  






    
    <div class="row"> 
      <!-- table section -->
      <div class="col-md-12 mb-5">
        <div class="white_shd full margin_bottom_30">
           <div class="full graph_head">
            <div id="success_msg"></div>
            @if (session()->has('error'))
            <div class="alert alert-danger">{{session()->get('error')}}</div>
          @endif
          @if (session()->has('success'))
          <div class="alert alert-success">{{session()->get('success')}}</div>
          @endif
              <div class="heading1 margin_0 d-flex justify-content-between mt-3 mb-4">
               <!-- Button trigger modal -->
              <a href="{{route('create_event')}}" class="btn btn-primary">Create Events</a>
                {{-- <div></div> --}}
                <button class="btn btn-light refreshBtn">Refresh <i class="fa fa-refresh fetch-users"></i></button>
              </div>
           </div>

           
           <div class="mt-5 mb-4">
            <h4>Today's Events</h4>
        </div>
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
                          <th>GuestCapacity</th>
                          <th>Tickets Sold</th>
                          <th>Action</th>
                       </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($TodayEvents as $event)
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
                            <td>{{$event->event_guestCapacity}}</td>
                            <td> <span class="badge bg-secondary">{{Custom::soldTickets($event->event_id)}}</span> <br>
                                <a class="text-primary" href="{{url('myTickets')}}/{{$event->event_slug}}">View All</a></td>
                            <td>
                              <a href="{{url('myevents/edit')}}/{{$event->event_id}}" class="btn btn-primary m-1"><i class="fa fa-edit"></i></a>
                                <a href="{{url('myevents/delete')}}/{{$event->event_id}}" class="btn btn-danger m-1 deleteBtn "><i class="fa fa-trash"></i></a>
                            </td>
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


           <div class="mt-5 mb-4">
            <h4>Upcoming Events</h4>
        </div>
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
                          <th>GuestCapacity</th>
                          <th>Tickets Sold</th>
                          <th>Action</th>
                       </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($upcommingEvents as $event)
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
                            <td>{{$event->event_guestCapacity}}</td>
                            <td> <span class="badge bg-secondary">{{Custom::soldTickets($event->event_id)}}</span> <br>
                                <a class="text-primary" href="{{url('myTickets')}}/{{$event->event_slug}}">View All</a></td>
                            <td>
                              <a href="{{url('myevents/edit')}}/{{$event->event_id}}" class="btn btn-primary m-1"><i class="fa fa-edit"></i></a>
                                <a href="{{url('myevents/delete')}}/{{$event->event_id}}" class="btn btn-danger m-1 deleteBtn "><i class="fa fa-trash"></i></a>
                            </td>
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

           
        <div class="mt-5 mb-4">
          <h4>Completed Events</h4>
      </div>
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
                      <th>Tickets</th>
                      <th>Tickets Sold</th>
                      <th>Status</th>
                      <th>Action</th>
                   </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($completedEvents as $event)
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
                        <td>{{$event->event_guestCapacity}}</td>
                        <td> <span class="badge bg-secondary">{{Custom::soldTickets($event->event_id)}}</span> <br>
                            <a class="text-primary" href="{{url('myTickets')}}/{{$event->event_slug}}">View All</a></td>
                            <td>
                                @if ($event->event_status == 1)
                                <span class="badge bg-primary">Active</span>
                            @else 
                               <span class="badge bg-danger">In Active</span>
                            @endif
                            </td>
                        <td>
                          <a href="{{url('myevents/edit')}}/{{$event->event_id}}" class="btn btn-primary m-1"><i class="fa fa-edit"></i></a>
                              </button>
                            <a href="{{url('myevents/delete')}}/{{$event->event_id}}" class="btn btn-danger m-1 deleteBtn "><i class="fa fa-trash"></i></a>
                        </td>
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
     </div>
</div>



  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div id="save_errList"></div>
            </div>
            <div class="container-fluid">
                <form action="{{route('admin.users')}}" method="post" id="form">
                    @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text"
                    class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">@error('name')
                      {{$message}}
                  @enderror</small>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email"
                      class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">@error('email')
                        {{$message}}
                    @enderror</small>
                  </div>
                  <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text"
                      class="form-control" name="contact" id="contact" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">@error('contact')
                        {{$message}}
                    @enderror</small>
                  </div>
                  <div class="mb-3">
                    <label for="address" class="form-label">Home/Shop Address</label>
                    <input type="text"
                      class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="Enter Your Address">
                    <small id="helpId" class="form-text text-muted">@error('address')
                      {{$message}} 
                      @enderror
                    </small>
                  </div>    

                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password"
                      class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Enter Your Passwrord">
                    <small id="helpId" class="form-text text-muted">@error('password')
                      {{$message}} 
                      @enderror
                    </small>
                  </div>    
                
                  <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password"
                      class="form-control" name="password_confirmation" id="password_confirmation" aria-describedby="helpId" placeholder="Confirm Passwrord">
                    <small id="helpId" class="form-text text-muted">@error('password_confirmation')
                      {{$message}} 
                      @enderror
                    </small>
                  </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" data-dismiss="modal" class="btn btn-primary register-btn">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>


  {{-- Edit User Modal  --}}

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="{{route('admin.users')}}" method="post" id="updateform">
                        @csrf
                    <div class="mb-3">
                        <input type="hidden" value="" id="user_id">
                      <label for="name" class="form-label">Name</label>
                      <input type="text"
                        class="form-control" name="editname" id="editname" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-muted">@error('editname')
                          {{$message}}
                      @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label for="editemail" class="form-label">Email</label>
                        <input type="email"
                          class="form-control" name="editemail" id="editemail" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">@error('editemail')
                            {{$message}}
                        @enderror</small>
                      </div>
                      <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text"
                          class="form-control" name="editcontact" id="editcontact" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">@error('editcontact')
                            {{$message}}
                        @enderror</small>
                      </div>
                      <div class="mb-3">
                        <label for="address" class="form-label">Home/Shop Address</label>
                        <input type="text"
                          class="form-control" name="editaddress" id="editaddress" aria-describedby="helpId" placeholder="Enter Your Address">
                        <small id="helpId" class="form-text text-muted">@error('editaddress')
                          {{$message}} 
                          @enderror
                        </small>
                      </div>    

                    </div>
                    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button"  class="btn btn-primary updateBtn">Save changes</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>


@section('script')

@endsection

@endsection