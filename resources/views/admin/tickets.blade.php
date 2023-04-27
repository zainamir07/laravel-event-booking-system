@extends('admin.layout.main')

@section('content')
  
<div class="container mt-3">
    <h2>All Tickets</h2>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto nemo totam commodi, dolorem quia quaerat mollitia sint nulla recusandae quam!</p>
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
              {{-- <a href="{{route('createEvent')}}" class="btn btn-primary">Create Events</a> --}}
                {{-- <div></div> --}}
                <button class="btn btn-light refreshBtn">Refresh <i class="fa fa-refresh fetch-users"></i></button>
              </div>
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
                          {{-- <th>Action</th> --}}
                       </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($tickets as $ticket)
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

                            <td>{{$ticket->buyer_user_address}}  {{$ticket->buyer_user_contact}} </td>
                            <td>{{dateFormat($ticket->created_at)}}</td>
                           
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
                 <div class="row">
                  {{-- {{  $tickets->links('pagination::bootstrap-5') }}  --}}
                </div>
              </div>
           </div>
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


      
    <!-- View Ticket details Modal -->
    <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="container-fluid">
                <div class="col-12 mb-3">
                  <div id="carouselExampleIndicators" class="carousel slide bg-dark border" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner ticketImages">
                                          
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                      <span class="sr-only ">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </div>
                 <div class="col-12 mb-3">
                  <h4 id="eventTitle"></h4>
                 </div>
                 <div class="col-12 mb-3">
                  <p><strong>Organizer Name: </strong><span id="organizerName"></span> </p>
                </div>
                <div class="col-12 mb-3">
                  <div class="subscription">
                   <p><strong>Subscription:</strong><span id="subscription"> </span></p> 
                   <p><strong>Price:</strong> Rs.<span id="ticketPrice"></span> </p>
                  </div>
               </div>
               <div class="col-12 mb-3">
                <p><strong>Total Tickets: </strong> <span id="totalTickets"></span> <br>
                  <strong>Remaining Tickets: </strong> <span id="remainingTickets"></span></p>
              </div>
              <div class="col-12 mb-3">
               <p><strong>Event Location: </strong> <span id="address"></span>, <span id="eventLocation"></span> </p>
             </div>
             <div class="col-12 mb-3">
              <p><strong>Start Date: </strong> <span id="startDate"></span> <br>
                <strong>End Date: </strong> <span id="endDate"></span> </p>
            </div>
            {{-- <div class="col-12 mb-3">
              <p><strong>End Date: </strong> <span id="endDate"></span> <br>
                <strong>End Time: </strong> <span id="endTime"></span> </p>
           </div> --}}
                
                  </div>
                  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          </form>
        </div>
      </div>
    </div>


@section('script')

@endsection

@endsection