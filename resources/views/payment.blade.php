@extends('layout.main')

@section('content')
<div class="container py-5">
    <!-- For demo purpose -->
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h3><i class="fa fa-lock"></i> Secure Payment</h3>
        </div>
    </div> <!-- End -->
    <div class="row">
        <div class="col-lg-8 col-md-8 col-12">
            <div class="card ">
                <div class="card-header">
                    <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2 text-center rounded">
                        <p class="bg-light rounded p-2"> <i class="fas fa-credit-card mr-2"></i> Credit Card </button> </p>
                        <!-- Credit card form tabs -->
                        {{-- <ul role="tablist" class="n">
                            <li class="nav-item "> 
                        </ul> --}}
                    </div> <!-- End -->
                    <!-- Credit card form content -->
                    <div class="tab-content">
                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade show active pt-3">
                            <form action="{{url($formUrl)}}" method="post">
                            @foreach ($ticketId as $value)
                            <input type="hidden" name="ticketId[]" value="{{$value}}">
                            {{-- {{$value}} --}}
                            @endforeach
                            <input type="hidden" name="singleticketId" value="{{$singleTicketId->buy_ticket_id}}">
                            {{-- {{$totalAmount}} --}}
                            <input type="hidden" name="event" id="event" value="{{$eventData->event_id}}">
                                @csrf
                                <div class="form-group"> <label for="username">
                                        <h6>Card Owner</h6>
                                    </label> <input type="text" name="username" placeholder="Card Owner Name" required class="form-control "> </div>
                                <div class="form-group"> <label for="cardNumber">
                                        <h6>Card number</h6>
                                    </label>
                                    <div class="input-group"> <input type="text" name="cardNumber" placeholder="Valid card number" class="form-control " required>
                                        <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group"> <label><span class="hidden-xs">
                                                    <h6>Expiration Date</h6>
                                                </span></label>
                                            <div class="input-group"> <input type="number" placeholder="MM" name="" class="form-control" required> <input type="number" placeholder="YY" name="" class="form-control" required> </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                            </label> <input type="text" required class="form-control"> </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-item-center bg-light border p-3 rounded"> 
                                    <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment </button> 
                                    <p class=" fw-bold lead">Total: {{$totalAmount}} <input type="hidden" name="totalAmount" id="totalAmount" value="{{$totalAmount}}"></p>
                            </form>
                        </div>
                    </div> <!-- End -->
                   
                   
                    <!-- End -->
                </div>
            </div>
        </div>
    </div>

        <div class="col-lg-4 col-md-4 col-12">
            <div class="container bg-light rounded">
                <div class="details pt-3">
                    <h3>Order Details</h3>
                    <div class="col-12 mb-3 text-primary mt-4">
                        <strong>{{$eventData->event_name}}</strong>
                      </div>
                    <hr class="mb-3">
                    <div class="col-12 mb-3">
                        <p><strong>Organizer Name: </strong>{{Custom::orgName($eventData->event_author_id)}}</p>
                      </div>
                    <div class="col-12 mb-3">
                        <p><strong>Price: </strong>Rs. {{$eventData->event_ticket_price}}</p>
                      </div>
                    <div class="col-12 mb-3">
                      <p><strong>Location: </strong>{{$eventData->event_address}}, {{$eventData->event_location}}</p>
                    </div>
                    <div class="col-12 mb-3">
                      <p><strong>Available Seats: </strong>{{Custom::availableSeats($eventData->event_id)}}</p>
                    </div>
                    <div class="col-12 mb-3">
                      <p><strong>Event Date: </strong>{{$eventData->event_start_date}}</p>
                    </div>
                    <div class="col-md-10 col-12 mb-3">
                        <p><strong>Event Details: </strong>{{$eventData->event_description}}</p>
                      </div>
                      <div class="col-12 col-lg-10 col-md-10 mt-2">
                        <img src="{{url('Backend/event_images')}}/{{$eventImages->event_image_path}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

    <script>
        $(function() {
        $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

@endsection