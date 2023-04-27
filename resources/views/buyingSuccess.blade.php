@extends('layout.main')
@section('content')
<style>
   .progresses{display: flex;align-items: center}
   .line{width: 76px;height: 6px;background: #63d19e}
   .steps{display: flex;background-color: #63d19e;color: #fff;font-size: 12px;width: 30px;height: 30px;align-items: center;justify-content: center;border-radius: 50%}
   .check1{display: flex;background-color: #63d19e;color: #fff;font-size: 17px;width: 60px;height: 60px;align-items: center;justify-content: center;border-radius: 50%;margin-bottom: 10px}
   .invoice-link{font-size: 15px}
   .background-muted{background-color:#fafafc}
</style>
<div class="container mt-5 mb-5">
   <div class="container mt-4 mb-4">
      <div class="row d-flex cart align-items-center justify-content-center">
          <div class="col-md-10">
              <div class="card">
                  <div class="d-flex justify-content-center border-bottom">
                      <div class="p-3">
                          <div class="progresses">
                              <div class="steps"> <span><i class="fa fa-check"></i></span> </div> <span class="line"></span>
                              <div class="steps"> <span><i class="fa fa-check"></i></span> </div> <span class="line"></span>
                              <div class="steps"> <span class="font-weight-bold">3</span> </div>
                          </div>
                      </div>
                  </div>
                  <div class="row g-0">
                      <div class="col-md-6 border-right p-5">
                          <div class="text-center order-details">
                              <div class="d-flex justify-content-center mb-5 flex-column align-items-center"> <span class="check1"><i class="fa fa-check"></i></span> <span class="font-weight-bold">Order Confirmed</span> <small class="mt-2">{{$eventData->event_name}}</small> <a href="{{url('events')}}/{{$eventData->event_slug}}" class="text-decoration-none invoice-link">View Event</a> </div> <a href="{{url('events')}}" class="btn btn-danger btn-block">Buy More Tickets</a>
                          </div>
                      </div>
                      <div class="col-md-6 background-muted">
                          <div class="p-3 border-bottom">
                              <div class="d-flex justify-content-between align-items-center"> <span><i class="fa fa-clock-o text-muted"></i>Standard Ticket</span> <span><i class="fa fa-refresh text-muted"></i> {{$totalTickets}} Purchase</span> </div>
                              
                              @foreach ($newtickets as $ticket)
                                <div class="mt-3 d-flex justify-content-between align-items-center">
                                 <div>
                                   <h6 class="mb-0">{{$ticket->buyer_user_name}}</h6> <span class="d-block mb-0">{{$ticket->buyer_user_cnic}} </span>
                                 </div>
                                 <div>
                                    <a href="{{url('myTickets')}}" class="btn btn-primary btn-sm">View Ticket</a>
                                 </div>
                                   {{-- <div class="d-flex flex-column mt-3">
                                     <small><i class="fa fa-check text-muted"></i> Vector file</small> <small><i class="fa fa-check text-muted"></i> Sources files</small> 
                                    </div> --}}
                                 </div>
                                 <hr>
                                 @endforeach
                                 
                          </div>
                          <div class="row g-0 border-bottom">
                           <div class="col-md-6 border-right">
                               <div class="p-3 d-flex justify-content-center align-items-center"> <span>Total:</span> </div>
                           </div>
                           <div class="col-md-6">
                               <div class="p-3 d-flex justify-content-center align-items-center"> <span>{{$totalAmount}}</span> </div>
                           </div>
                       </div>
                       <div class="row g-0 border-bottom">
                        <div class="col-md-6 border-right">
                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Processing Fees:</span> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>0</span> </div>
                        </div>
                    </div>
                          <div class="row g-0 border-bottom">
                              <div class="col-md-6 border-right">
                                  <div class="p-3 d-flex justify-content-center align-items-center"> <span>Event Location</span> </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="p-3 d-flex justify-content-center align-items-center"> <span><i class="fa fa-map-marker-alt text-primary"></i> {{$eventData->event_address}}, {{Custom::cityName($eventData->event_location)}}</span> </div>
                              </div>
                          </div>
                          <div class="row g-0 border-bottom">
                              <div class="col-md-6">
                                  <div class="p-3 d-flex justify-content-center align-items-center"> <span>Starting At:</span> </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="p-3 d-flex justify-content-center align-items-center"> <span>( <i class="fa fas fa-calendar-alt text-primary me-1"></i>{{dateFormat($eventData->event_start_date)}} ) <br> (<i class="fa far fa-clock text-primary me-1"></i>{{$eventData->event_start_time}})</span> </div>
                              </div>
                          </div>
                          
                      </div>
                  </div>
                  <div> </div>
              </div>
          </div>
      </div>
  </div>

</div>
@endsection