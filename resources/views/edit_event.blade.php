@extends('layout.main')
@section('content')
    <div class="container mt-5 mb-4">
        <div class="row">
            <h3>Edit Event</h3>
        </div>
    </div>

    <div class="container">
        <form action="{{url('myevents/edit')}}/{{$event->event_id}}" method="post" enctype="multipart/form-data" id="eventForm">
            @csrf
        <div class="row mb-5">
            <div class="col-md-6 col-12 mb-3">
                <label for="eventName">Event Name/Title</label>
                <input type="text" name="eventName" id="eventName" class="form-control" value="{{$event->event_name}}" placeholder="Enter Your Event Name">
            </div>
            
            <div class="col-md-6 col-12 mb-3">
                <label for="eventLocation">Event Location</label>
                <select name="eventLocation" id="eventLocation" class="form-control">
                    <option value="">Select City</option>
                    @foreach ($cities as $city)
                        <option value="{{$city->id}}" @if ($event->event_location == $city->id)
                            selected
                        @endif>{{$city->city}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-6 col-12 mb-3">
                <label for="startDate">Start Date</label>
                <input type="date" name="startDate" id="startDate" value="{{$event->event_start_date}}" class="form-control" >
            </div>
    
            <div class="col-md-6 col-12 mb-3">
                <label for="startTime">Start Time</label>
                <input type="time" name="startTime" id="startTime" value="{{$event->event_start_time}}" class="form-control" >
            </div>
    
            <div class="col-md-6 col-12 mb-3">
                <label for="endDate">End Date</label>
                <input type="date" name="endDate" id="endDate" value="{{$event->event_end_date}}" class="form-control" >
            </div>
    
            <div class="col-md-6 col-12 mb-3">
                <label for="endTime">End Time</label>
                <input type="time" name="endTime" id="endTime" value="{{$event->event_end_time}}" class="form-control" >
            </div>
            
            <div class="col-md-6 col-12 mb-3">
              <label for="guestCapacity">Event Guest Capacity</label>
              <input type="number" name="guestCapacity" id="guestCapacity" value="{{$event->event_guestCapacity}}" class="form-control">
              <span class="text-danger">@error('guestCapacity')
                  {{$message}}
              @enderror</span>
          </div>
            
            <div class="col-md-6 col-12 mb-3">
                <label for="eventSubscription">Event Subscription</label>
                <select class="form-control" name="eventSubscription" id="eventSubscription">
                   <option value="">Select The Subscription</option>
                   <option value="P" @if ($event->event_subscription == 'P') selected @endif>Paid</option>
                   <option value="F" @if ($event->event_subscription == 'F') selected @endif>Free</option>
                </select>
            </div>
    
            <div class="col-md-6 col-12 mb-3 eventTicketPrice" hidden>
              <label for="eventTicketPrice">Event Ticket Price in PKR (Rs.)</label>
              <input type="number" name="eventTicketPrice" id="eventTicketPrice" value="{{$event->event_ticket_price}}" class="form-control" placeholder="">
            </div>
    
            <div class="col-md-6 col-12 mb-3">
              <label for="eventAddress">Event Address</label>
              <input type="text" name="eventAddress" id="eventAddress" value="{{$event->event_address}}" class="form-control">
          </div>
    
          <div class="col-md-12 col-12 mb-3">
            <label for="eventDescription">Event Description</label>
            <textarea name="eventDescription" id="eventDescription" class="form-control" cols="30" rows="10">{{$event->event_description}}</textarea>
          </div>
    
        </div>
    
    
        <div class="row image_section bg-light pt-4 pb-4 mt-4 mb-4 rounded text-center">
            {{-- Image Uploading --}}
                 <div class="container">
                           <h3>Upload Images</h3>
                           <p>Upload Only 4 Images</p>
                  </div>
                  <div class="container col-md-11 col-12 pt-5 ">
    
                    {{-- <div class=""> --}}
                      {{-- <div class="container" >
                        <div class="d-flex">
                          @foreach ($images as $img)
    
                        <div class="image-container">
                         <div class="img-preview">
                           <img data-id="{{$img->images_id}}" src="{{url('Backend/listing_images')}}/{{$img->images_path}}" alt="" class="img-fluid" style="width:90px;">
                         </div>
                         <div class="img-button">
                           <button type="button" class="deleteImageBtn btn btn-outline-danger" id="deleteImageBtn"  data-id="{{$img->images_id}}" >Delete</button>
                         </div>
                        </div>
    
                        @endforeach
                      </div>
                    </div> --}}
                    {{-- </div> --}}
    
                    <div class="row"
                         data-type="imagesloader"
                         data-errorformat="Accepted file formats"
                         data-errorsize="Maximum size accepted"
                         data-errorduplicate="File already loaded"
                         data-errormaxfiles="Maximum number of images you can upload"
                         data-errorminfiles="Minimum number of images to upload"
                         data-modifyimagetext="Modify immage">
              
                         <div class="d-flex">
                          @foreach ($images as $img)
                          
                        <div class="image-container m-2">
                         {{-- <div class="img-preview"> --}}
                           <img data-id="{{$img->image_id}}" src="{{url('Backend/event_images')}}/{{$img->event_image_path}}" alt="" class="img-fluid img-display mb-2 ratio-images" style="max-width:200px;">
                         {{-- </div> --}}
                         <br>
                         {{-- <div class="img-button"> --}}
                           <button type="button" class="deleteImageBtn btn btn-outline-danger" id="deleteImageBtn"  data-id="{{$img->image_id}}" >Delete</button>
                         {{-- </div> --}}
                        </div>
    
                        @endforeach
                      </div>
    
                      <!-- Progress bar -->
                      <div class="col-12 order-1 mt-2">
                        <div data-type="progress" class="progress" style="height: 25px; display:none;">
                          <div data-type="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 100%;">Load in progress...</div>
                        </div>
                      </div>
                      <!-- Model -->
                      <div data-type="image-model" class="col-4 pl-2 pr-2 pt-2 m-auto" style="max-width:200px; display:none;">
              
                        <div class="ratio-box text-center" data-type="image-ratio-box">
                          {{-- //Image Upload here --}}
                          <img data-type="noimage" class="btn btn-light ratio-img img-fluid p-2 image border dashed rounded" src="{{url('/uploadfile.svg')}}" style="cursor:pointer;">
                          <div data-type="loading" class="img-loading" style="color:#218838; display:none;">
                            <span class="fa fa-2x fa-spin fa-spinner"></span>
                          </div>
                          <img data-type="preview" class="btn btn-light ratio-img ratio-images img-fluid p-2 image border dashed rounded" src="" style="display: none; cursor: default;">
                          <span class="badge badge-pill badge-success p-2 w-50 main-tag" style="display:none;">Main</span>
                        </div>
              
                        <!-- Buttons -->
                        <div data-type="image-buttons" class="row justify-content-center mt-2">
                          <button data-type="add" class="btn btn-outline-success addNew-buttons" type="button"><span class="fa fa-camera mr-2"></span>Add</button>
                          <button data-type="btn-modify" type="button" class="btn btn-outline-success m-0" data-toggle="popover" data-placement="right" style="display:none;">
                            <span class="fa fa-pencil-alt mr-2"></span>Modify
                          </button>
                        </div>
                      </div>                       
                      <!-- Popover operations -->
                      <div data-type="popover-model" style="display:none">
                        <div data-type="popover" class="ml-3 mr-3" style="min-width:150px;">
                          <div class="row">
                            <div class="col p-0">
                              <button data-operation="main" class="btn btn-block btn-success btn-sm rounded-pill" type="button"><span class="fa fa-angle-double-up mr-2"></span>Main</button>
                            </div>
                          </div>
                          <div class="row mt-2">
                            <div class="col-6 p-0 pr-1">
                              <button data-operation="left" class="btn btn-block btn-outline-success btn-sm rounded-pill" type="button"><span class="fa fa-angle-left mr-2"></span>Left</button>
                            </div>
                            <div class="col-6 p-0 pl-1">
                              <button data-operation="right" class="btn btn-block btn-outline-success btn-sm rounded-pill" type="button">Right<span class="fa fa-angle-right ml-2"></span></button>
                            </div>
                          </div>
                          <div class="row mt-2">
                            <div class="col-6 p-0 pr-1">
                              <button data-operation="rotateanticlockwise" class="btn btn-block btn-outline-success btn-sm rounded-pill" type="button"><span class="fas fa-undo-alt mr-2"></span>Rotate</button>
                            </div>
                            <div class="col-6 p-0 pl-1">
                              <button data-operation="rotateclockwise" class="btn btn-block btn-outline-success btn-sm rounded-pill" type="button">Rotate<span class="fas fa-redo-alt ml-2"></span></button>
                            </div>
                          </div>
                          <div class="row mt-2">
                            <button data-operation="remove" class="btn btn-outline-danger btn-sm btn-block" type="button"><span class="fa fa-times mr-2"></span>Remove</button>
                          </div>
                        </div>
                      </div>
              
                    </div>
              
                    <div class="form-group row">
                      <div class="input-group">
                        <!--Hidden file input for images-->
                        <input id="files" type="file" name="files[]" id="files[]" class="files" data-button="" accept="image/jpeg, image/png, image/gif," style="display:none;">
                      </div>
                    </div>
                  @error('files')
                      {{$message}}
                  @enderror
              </div>
                        <!-- Image section End -->
                    </div>
    
    
                    </div>
                </div>
    
            <div class="container mt-5 mb-5 pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection