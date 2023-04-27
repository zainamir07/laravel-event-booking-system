@extends('admin.layout.main')

@section('content')
  
<div class="container mt-3">
    <h2>Organizers</h2>
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
               <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal">
                Add Organization+
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
                          <th>Org. Name</th>
                          <th>Owner Name</th>
                          <th>Email</th>
                          <th>Contact</th>
                          <th>Address</th>
                          <th>Website</th>
                          <th>Status</th>
                          <th>Action</th>
                       </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$user->org_name}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->contact}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->website}}</td>
                            <td>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_1 user_status" {{$user->status == true ? 'checked' : "" }} data-id="{{$user->id}}">
                                </div>
                              {{-- {{status($user->status)}} --}}
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary editmodalbtn" data-toggle="modal" data-target="#editModal" data-id="{{$user->id}}">
                                    <i class="fa fa-edit"></i>
                                  </button>
                                <a href="{{url('admin/users/delete')}}/{{$user->id}}" class="btn btn-danger m-1 deleteBtn "><i class="fa fa-trash"></i></a>
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
          <h5 class="modal-title" id="exampleModalLabel">Add New Organizer</h5>
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
                  <input type="hidden" name="org_type" value="OA">
                  <label for="name" class="form-label">Name</label>
                  <input type="text"
                    class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">@error('name')
                      {{$message}}
                  @enderror</small>
                </div>
                <div class="mb-3">
                  <input type="hidden" name="org_type" value="OA">
                  <label for="org_name" class="form-label">Organizer Name</label>
                  <input type="text"
                    class="form-control" name="org_name" id="org_name" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">@error('org_name')
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
                      <label for="name" class="form-label">Owner Name</label>
                      <input type="text"
                        class="form-control" name="editname" id="editname" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-muted">@error('editname')
                          {{$message}}
                      @enderror</small>
                    </div>
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

@section('script')

@endsection

@endsection