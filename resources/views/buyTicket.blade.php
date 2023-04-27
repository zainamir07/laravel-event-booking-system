@extends('layout.main')

@section('content')

<div class="container mt-3 mb-3">
    <h2>Buy Ticket</h2>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <h5>Event Details</h5>
            {{-- <div class="row"> --}}
                <div class="col-12 col-lg-10 col-md-10 mt-2">
                    <img src="{{url('Backend/event_images')}}/{{$eventImages->event_image_path}}" class="img-fluid" alt="">
                </div>
                <div class="col-12 mb-3 text-primary mt-4">
                    <strong>{{$events->event_name}}</strong>
                  </div>

            <div class="eventDetails">
                <div class="col-12 mb-3">
                    <p><strong>Organizer Name: </strong>{{Custom::orgName($events->event_author_id)}}</p>
                  </div>
                <div class="col-12 mb-3">
                    <p><strong>Price: </strong>Rs. {{$events->event_ticket_price}}</p>
                  </div>
                <div class="col-12 mb-3">
                  <p><strong>Location: </strong>{{$events->event_address}}, {{$events->event_location}}</p>
                </div>
                <div class="col-12 mb-3">
                  <p><strong>Available Seats: </strong>{{Custom::availableSeats($events->event_id)}}</p>
                </div>
                <div class="col-12 mb-3">
                  <p><strong>Event Date: </strong>{{$events->event_start_date}}</p>
                </div>
                <div class="col-md-10 col-12 mb-3">
                    <p><strong>Event Details: </strong>{{$events->event_description}}</p>
                  </div>

            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-12">
            @php
                $id = session()->get('user_id');
                $name = session()->get('user_name');
                $email = session()->get('user_email');
                $contact = session()->get('user_contact');
                $address = session()->get('user_address');
            @endphp
                
            <form action="{{url('events/buyTicket')}}/{{$events->event_slug}}" method="post">
                <div class="buyer info">
                @for ($i = 0; $i < $quantity; $i++)
                <div class="all-forms">
                <h3>Buyer @if ($quantity > 1)
                    ( {{$i + 1}} )
                @endif  Details</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                @csrf
                <input type="hidden" name="buyerEventId" id="buyerEventId" value="{{$events->event_id}}">
                <input type="hidden" name="buyerEventAuthorId" id="buyerEventAuthorId" value="{{$events->event_author_id}}">

            <div class="col-12 mb-3">
                <label for="buyerName">Name</label>
                <input type="text" name="buyerName[]" id="buyerName" class="form-control">
                <span class="text-danger">@error('buyerName')
                    {{$message}}
                @enderror </span>
            </div>
            {{-- <div class="col-12 mb-3">
                <label for="buyerEmail">Email</label>
                <input type="email" name="buyerEmail[]" id="buyerEmail" class="form-control">
                <span class="text-danger">@error('buyerEmail')
                    {{$message}}
                @enderror </span>
            </div>
            <div class="col-12 mb-3">
                <label for="buyerAddress">Address</label>
                <input type="text" name="buyerAddress[]" id="buyerAddress" class="form-control">
                <span class="text-danger">@error('buyerAddress')
                    {{$message}}
                @enderror </span>
            </div>
            <div class="col-12 mb-3">
                <label for="buyerContact">Contact</label>
                <input type="text" name="buyerContact[]" id="buyerContact" class="form-control">
                <span class="text-danger">@error('buyerContact')
                    {{$message}}
                @enderror </span>
            </div> --}}

            <div class="col-12 mb-3">
                <label for="buyerCnic">CNIC</label>
                <input type="text" name="buyerCnic[]" id="buyerCnic" class="form-control"  placeholder="XXXXX-XXXXXXX-X" required>
                <span class="text-danger">@error('buyerCnic')
                    {{$message}}
                @enderror </span>
            </div>
            
           

        </div>

            <hr>

        @endfor
        @if ($events->event_ticket_price > 0)
        <div class="col-12 mb-3">
            <label for="buyerPaymentMethod">Payment Method</label>
            <select name="buyerPaymentMethod" id="buyerPaymentMethod" class="form-control">
                <option value="">Select Payment Method</option>
                <option value="JazzCash">JazzCash</option>
                <option value="EasyPaisa">EasyPaisa</option>
                <option value="BankTransfer">BankTransfer</option>
            </select>
            <span class="text-danger">@error('buyerPaymentMethod')
                {{$message}}
            @enderror </span>
        </div>
            
        @endif
        <div class="col-12 mb-3 bg-light border p-3 rounded fw-bold lead">
            <div class="float-start">Total Amount: </div>
            <input type="hidden" name="buyerTicketPrice" id="buyerTicketPrice" value="{{$events->event_ticket_price}}">
            <div class="float-end" >
                <input type="hidden" name="quantity" value=""> Rs. @php $total = $events->event_ticket_price * $quantity; @endphp {{$total}} 
                </div>  
            <br>
            <input type="hidden" name="totalAmount" id="totalAmount" value="{{$total}}"> 
        </div>

        <div class="col-12 mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="agreeNotice" name="agreeNotice[]" required>
              <label class="form-check-label" for="agreeNotice">
                I am agree with terms and conditions
              </label>
              <span class="text-danger">@error('agreeNotice')
                {{$message}}
            @enderror </span>
            </div>
        </div>

            <div class="col-12 mb-5 ">
                @if ($events->event_subscription == 'P')
                <button type="submit" class="btn btn-primary">Pay Now</button>
                <input type="hidden" name="payNow" id="payNow" value="P">
                @else
                <button type="submit" class="btn btn-primary buy-ticket">Buy Ticket</button>
                <input type="hidden" name="payNow" id="payNow" value="NP">
                @endif
            </div>
            <hr>
        </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection