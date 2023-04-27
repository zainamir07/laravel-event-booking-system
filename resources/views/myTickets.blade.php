@extends('layout.main')

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
                          <th>Buyer Name</th>
                          {{-- <th>Email</th>
                            <th>Address</th> --}}
                          <th>CNIC</th>
                          <th>Ticket Payment</th>
                          <th>Payment Status</th>
                          <th>Buying at</th>
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
                              <p class="mb-1">{{Custom::eventName($ticket->buyer_event_id)}}</p>
                              <button type="button" class="btn btn-primary btn-sm orgticketModalbtn mb-2" data-bs-toggle="modal" data-bs-target="#modalId"  data-id="{{$ticket->buyer_event_id}}">
                                <i class="fa fa-info-circle"></i> Event Details
                              </button>
                              </td>


                            <td>{{$ticket->buyer_user_name}}</td>
                            <td>{{$ticket->buyer_user_cnic}}</td>
                            <td>Rs.{{$ticket->buyer_user_ticket_price}} <br>
                                {{$ticket->buyer_user_payment_method}}</td>
                            <td> @if ($ticket->buyer_user_payment_status == 'UP')
                                <span class="badge bg-danger p-2 mb-1">Un Paid</span> <br> @if (session()->get('user_type') == 'U')
                                <a href="{{url('events/payment')}}/{{Custom::getEventUrl($ticket->buyer_event_id)}}/{{$ticket->buy_ticket_id}}" class="btn btn-sm btn-success">Pay Now <span>Rs {{$ticket->buyer_user_ticket_price}}</span></a>
                                @endif
                                @else
                                <span class="badge bg-success p-2">Paid</span>
                            @endif </td>    
                            {{-- <td> {{$ticket->buyer_user_contact}} <br> {{$ticket->buyer_user_address}} </td> --}}
                            {{-- <td>{{$ticket->buyer_user_comment}}</td>  --}}
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
                 <div class="row">
                  {{-- {{  $users->links('pagination::bootstrap-5') }}  --}}
                </div>
              </div>
           </div>
        </div>
     </div>
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="col-12 mb-3">
                        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
                                <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
                                <li data-bs-target="#carouselId" data-bs-slide-to="2" aria-label="Third slide"></li>
                            </ol>
                            <div class="carousel-inner ticketImages" role="listbox">
                            
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
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
                       <p><strong>Subscription:</strong><span class="bg-primary m-2 rounded" id="subscription"> </span></p> 
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
            </div>
                      
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@section('script')

@endsection

@endsection