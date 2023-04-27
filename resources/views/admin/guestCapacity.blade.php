@extends('admin.layout.main')

@section('content')
  
<div class="container mt-3">
    <h2>Guest Capacity</h2>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto nemo totam commodi, dolorem quia quaerat mollitia sint nulla recusandae quam!</p>
    <div class="row"> 
      <!-- table section -->
      <div class="col-md-12 mb-5">
        <div class="white_shd full margin_bottom_30">
           <div class="full graph_head">
            {{-- <div id="save_errList"></div> --}}
            @if (session()->has('error'))
            <div class="alert alert-danger">{{session()->get('error')}}</div>
          @endif
          @if (session()->has('success'))
          <div class="alert alert-success">{{session()->get('success')}}</div>
          @endif
              <div class="heading1 margin_0 d-flex justify-content-between mt-3 mb-4">
               <!-- Button trigger modal -->
               <button type="button" class="btn btn-primary eventTypeAddModal" data-toggle="modal" data-target="#exampleModal">
                Add Event Type+
              </button>
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
                          <th>Guest Capacity Range</th>
                          <th>Action</th>
                       </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($guestCapacity as $guest)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$guest->guest_capacity_range}}</td>
                            <td>
                                {{-- <button type="button" class="btn btn-primary editeventTypeModalbtn" data-toggle="modal" data-target="#editModal" data-id="{{$guest->guest_capacity_id}}">
                                    <i class="fa fa-edit"></i>
                                  </button> --}}
                                <a href="{{url('admin/guestCapacity/delete')}}/{{$guest->guest_capacity_id}}" class="btn btn-danger m-1 deleteBtn "><i class="fa fa-trash"></i></a>
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
          <h5 class="modal-title" id="exampleModalLabel">Add Guest Capacity</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div id="save_errList"></div>
            </div>
            <div class="container-fluid">
                <form action="{{route('guestCapacity_register')}}" method="post" id="guestCapacityForm">
                    @csrf
                <div class="mb-3">
                  <label for="guestCapacity_range" class="form-label">Guest Capacity Range</label>
                  <input type="text"
                    class="form-control" name="guestCapacity_range" id="guestCapacity_range" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">@error('guestCapacity_range')
                      {{$message}}
                  @enderror</small>
                </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" data-dismiss="modal" class="btn btn-primary guestCapacity-btn">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>


@section('script')

@endsection

@endsection