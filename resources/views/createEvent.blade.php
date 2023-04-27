@extends('layout.main')

@section('content')
  
<div class="container mt-4 pb-4">
    <h2>Create New Event</h2>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto nemo totam commodi, dolorem quia quaerat mollitia sint nulla recusandae quam!</p>
</div>


<div class="container">
    <form action="{{url('create_event')}}" method="post" enctype="multipart/form-data" id="eventForm">
        @csrf
    <div class="row mb-5">
        <div class="col-md-6 col-12 mb-3">
            <label for="eventName">Event Name/Title</label>
            <input type="text" name="eventName" id="eventName" class="form-control" placeholder="Enter Your Event Name">
            <span class="text-danger">@error('eventName')
                {{$message}}
            @enderror</span>
        </div>
        
        <div class="col-md-6 col-12 mb-3">
            <label for="eventLocation">Event Location</label>
            <select name="eventLocation" id="eventLocation" class="form-control">
                <option value="">Select City</option>
                @foreach ($cities as $city)
                    <option value="{{$city->id}}">{{$city->city}}</option>
                @endforeach
            </select>
            <span class="text-danger">@error('eventLocation')
                {{$message}}
            @enderror</span>
        </div>
        
        <div class="col-md-6 col-12 mb-3">
            <label for="startDate">Start Date</label>
            <input type="date" name="startDate" id="startDate" class="form-control" >
            <span class="text-danger">@error('startDate')
                {{$message}}
            @enderror</span>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <label for="startTime">Start Time</label>
            <input type="time" name="startTime" id="startTime" class="form-control" >
            <span class="text-danger">@error('startTime')
                {{$message}}
            @enderror</span>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <label for="endDate">End Date</label>
            <input type="date" name="endDate" id="endDate" class="form-control" >
            <span class="text-danger">@error('endDate')
                {{$message}}
            @enderror</span>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <label for="endTime">End Time</label>
            <input type="time" name="endTime" id="endTime" class="form-control" >
            <span class="text-danger">@error('endTime')
                {{$message}}
            @enderror</span>
        </div>
        
        <div class="col-md-6 col-12 mb-3">
            <label for="guestCapacity">Event Guest Capacity</label>
            <input type="number" name="guestCapacity" id="guestCapacity" class="form-control">
            <span class="text-danger">@error('guestCapacity')
                {{$message}}
            @enderror</span>
        </div>
        
        <div class="col-md-6 col-12 mb-3">
            <label for="eventSubscription">Event Subscription</label>
            <select class="form-control" name="eventSubscription" id="eventSubscription">
               <option value="">Select The Subscription</option>
               <option value="P">Paid</option>
               <option value="F">Free</option>
            </select>
            <span class="text-danger">@error('eventSubscription')
                {{$message}}
            @enderror</span>
        </div>

        <div class="col-md-6 col-12 mb-3 eventTicketPrice" hidden>
          <label for="eventTicketPrice">Event Ticket Price in PKR (Rs.)</label>
          <input type="number" name="eventTicketPrice" id="eventTicketPrice" class="form-control" placeholder="">
          <span class="text-danger">@error('eventTicketPrice')
            {{$message}}
        @enderror</span>
        </div>

        <div class="col-md-6 col-12 mb-3">
          <label for="eventAddress">Event Address</label>
          <input type="text" name="eventAddress" id="eventAddress" class="form-control">
          <span class="text-danger">@error('eventAddress')
            {{$message}}
        @enderror</span>
      </div>

      <div class="col-md-12 col-12 mb-3">
        <label for="eventDescription">Event Description</label>
        <textarea name="eventDescription" id="eventDescription" class="form-control" cols="30" rows="10"></textarea>
        <span class="text-danger">@error('eventDescription')
            {{$message}}
        @enderror</span>
      </div>

    </div>
        <div class="row image_section bg-dark pt-5 pb-4 mt-5 mb-5 rounded text-center m-auto ">
            {{-- Image Uploading --}}
                 <div class="container text-white">
                           <h3>Upload Images</h3>
                  </div>
                         <div class="container col-md-11 col-12 pt-4">
                             <div class="row"
                                  data-type="imagesloader"
                                  data-errorformat="Accepted file formats"
                                  data-errorsize="Maximum size accepted"
                                  data-errorduplicate="File already loaded"
                                  data-errormaxfiles="Maximum number of images you can upload"
                                  data-errorminfiles="Minimum number of images to upload"
                                  data-modifyimagetext="Modify immage">
                       
                               <!-- Progress bar -->
                               <div class="col-12 order-1 mt-2">
                                 <div data-type="progress" class="progress" style="height: 25px; display:none;">
                                   <div data-type="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 100%;">Load in progress...</div>
                                 </div>
                               </div>
                               <!-- Model -->
                               <div data-type="image-model" class="col-4 pl-2 pr-2 pt-2 m-auto" style="max-width:200px; display:none;">
                       
                                 <div class="ratio-box text-center" data-type="image-ratio-box">
                                   <img data-type="noimage" class="btn btn-light ratio-img img-fluid p-2 image border dashed rounded" src="{{url('/uploadfile.svg')}}" style="cursor:pointer;">
                                   <div data-type="loading" class="img-loading" style="color:#218838; display:none;">
                                     <span class="fa fa-2x fa-spin fa-spinner"></span>
                                   </div>
                                   <img data-type="preview" class="btn btn-light ratio-img img-fluid p-2 image border dashed rounded" src="" style="display: none; cursor: default;">
                                   <span class="badge badge-pill badge-success p-2 w-50 main-tag" style="display:none;">Main</span>
                                 </div>
                       
                                 <!-- Buttons -->
                                 <div data-type="image-buttons" class="row justify-content-center mt-2">
                                   <button data-type="add" class="btn btn-outline-success" type="button"><span class="fa fa-camera mr-2"></span>Add</button>
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
                                 <input id="files" type="file" name="files[]" id="files[]" class="files" data-button="" multiple="" accept="image/jpeg, image/png, image/gif," style="display:none;">
                               </div>
                             </div>
                             <span class="text-danger">@error('files')
                                {{$message}}
                            @enderror</span>
                       </div> <!-- Image section End -->
                    </div>
                </div>
            </div>

        <div class="container mt-5 mb-5 pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    </div>
</div>


  
 


@section('script')

@endsection

@endsection