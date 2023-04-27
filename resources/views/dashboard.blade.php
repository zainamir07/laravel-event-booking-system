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
  <h2>Dashboard</h2>
  <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto nemo totam commodi, dolorem quia quaerat mollitia sint nulla recusandae quam!</p>


  
<div class="container bootstrap snippet bg-light p-4 rounded text-white">
  <div class="row justify-content-around">
    <div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading bg-primary"><i class="fa fa-users fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content bg-primary">
          <div class="circle-tile-description text-faded"> Total Events</div>
          <div class="circle-tile-number text-faded ">{{$totalEvents}}</div>
          <a class="circle-tile-footer" href="{{route('org_events')}}">More Info <i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div>
     
    <div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading bg-secondary"><i class="fa fa-users fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content bg-secondary">
          <div class="circle-tile-description text-faded"> Sold Tickets </div>
          <div class="circle-tile-number text-faded ">{{$soldTicketsCount}}</div>
          <a class="circle-tile-footer" href="{{url('myTickets')}}">More Info <i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div> 

    <div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading bg-dark"><i class="fa fa-users fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content bg-dark">
          <div class="circle-tile-description text-faded"> Earnings Rs.</div>
          <div class="circle-tile-number text-faded ">{{$totalEarnings}}</div>
          <a class="circle-tile-footer" href="#">This Month <i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div> 

    <div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading bg-success"><i class="fa fa-users fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content bg-success">
          <div class="circle-tile-description text-faded"> Widhrawl </div>
          <div class="circle-tile-number text-faded ">10</div>
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
            <h4>Upcomming Three Events</h4>
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
                          {{-- <th>Action</th> --}}
                       </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($eventList as $event)
                        <tr>
                            <td>{{$i}}</td>
                            <td class="text-center">
                              <span><img src="{{url(Custom::eventImagePath($event->event_id))}}" alt="" class="img-fluid" width="100px"></span>  
                              <p>{{$event->event_name}}</p> 
                            </td>
                            <td>{{Custom::cityName($event->event_location)}}</td>
                            <td> <p>Date: {{$event->event_start_date}}</p> <p>Time: {{$event->event_start_time}}</p></td>
                            <td> <p>Date: {{dateFormat($event->event_end_date)}}</p> <p>Time: {{$event->event_end_time}}</p></td>
                            <td> @if ($event->event_subscription == 'F')
                                <span class="p-2 badge badge-success bg-success">Free</span>
                                @elseif($event->event_subscription == 'P')
                                <span class="p-2 badge badge-danger bg-danger">Paid</span>
                               <p class="mt-2"><strong>Rs. {{$event->event_ticket_price}}</strong></p>
                            @endif </td>
                            <td>{{$event->event_guestCapacity}}</td>
                            <td><a class="text-primary" href="{{url('myTickets')}}/{{$event->event_slug}}"> <span class="badge bg-secondary btn">{{Custom::soldTickets($event->event_id)}}</span> <br>
                                View All</a></td>
                                <td>
                                    @if ($event->event_status == 1)
                                    <span class="badge bg-primary">Active</span>
                                @else 
                                   <span class="badge bg-danger">In Active</span>
                                @endif
                                </td>
                            {{-- <td>
                                <button type="button" class="btn btn-primary editmodalbtn" data-toggle="modal" data-target="#editModal" data-id="{{$event->event_id}}">
                                    <i class="fa fa-edit"></i>
                                  </button>
                                <a href="{{url('admin/events/delete')}}/{{$event->event_id}}" class="btn btn-danger m-1 deleteBtn "><i class="fa fa-trash"></i></a>
                            </td> --}}
                        </tr>
                        @php
                             $i++;
                        @endphp
                        @endforeach
                          
                    </tbody>
                 </table>
                 <div class="container text-center mt-3 mb-4">
                  <a href="{{route('org_events')}}" class="btn btn-primary">View All</a>
                  {{-- {{  $users->links('pagination::bootstrap-5') }}  --}}
                </div>
                <hr>
              </div>
           </div>

           <div class="mt-5 mb-4">
            <h4>Last Three Tickets</h4>
        </div>
        <div class="table_section padding_infor_info">
            <div class="table-responsive-sm">
               <table class="table">
                  <thead>
                     <tr>
                      <th>#</th>
                      <th>Evnet Name</th>
                      <th>Ticket Payment</th>
                      <th>Buyer Name</th>
                      <th>Email</th>
                      <th>Address/Contact</th>
                      <th>Buying At</th>
                     </tr>
                  </thead>
                  <tbody>
                    @php
                    $i = 1;
                @endphp
                @foreach ($soldTickets as $ticket)
                <tr>
                    <td>{{$i}}</td>

                    <td class="text-center">
                      <span><img src="{{url(Custom::eventImagePath($ticket->buyer_event_id))}}" alt="" class="img-fluid" width="60px"></span>  
                      <p>{{Custom::eventName($ticket->buyer_event_id)}}</p> 
                      <button type="button" class="btn btn-primary btn-sm ticketModalbtn" data-toggle="modal" data-target="#ticketModal" data-id="{{$ticket->buyer_event_id}}">
                        <i class="fa fa-info-circle"></i> Event Details
                      </button>
                      </td>

                     <td>Rs.{{$ticket->buyer_user_ticket_price}} <br>
                        {{$ticket->buyer_user_payment_method}}</td>

                    <td>{{$ticket->buyer_user_name}}</td>
                    <td>{{$ticket->buyer_user_email}}</td>

                    <td>{{$ticket->buyer_user_address}} <br> {{$ticket->buyer_user_contact}} </td>
                    <td>{{dateFormat($ticket->created_at)}} <br> {{get_time_ago( strtotime( $ticket->created_at)) }}</td>
                   
                    {{-- <td>
                        <a href="{{url('admin/events/delete')}}/{{$ticket->buy_ticket_id}}" class="btn btn-sm btn-danger m-1 deleteBtn "><i class="fa fa-trash"></i></a>
                    </td> --}}
                </tr>
                @php
                     $i++;
                @endphp
                @endforeach
                        
                  </tbody>
               </table>
               <div class="container text-center mt-3 mb-4">
                <a href="{{route('org_tickets')}}" class="btn btn-primary">View All</a>
                {{-- {{  $users->links('pagination::bootstrap-5') }}  --}}
              </div>
              <hr>
            </div>
         </div>


        </div>

     </div>
</div>
</div>



@section('script')

@endsection

@endsection