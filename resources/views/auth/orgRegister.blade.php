@extends('layout.main')
     @section('content')
         
     <div class="container mt-5">
        <div class="heading mb-5">
            <h3>Register You Organization and Start Listing Events</h3>
            <p>Have an account Login <a href="{{route('login')}}">here</a></p>
        </div>
        <div class="row mb-5 pb-5">
            <div class="col-md-8 col-12 m-auto">
                <div id="register_errList"></div>
                <form action="{{url('organization_register')}}" method="post" id="orgRegisterform" enctype="multipart/form-data">
                     @csrf
                     <div class="mb-3">
                      <label for="name" class="form-label">Your Full Name</label>
                      <input type="text"
                      class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Enter Your Full Name">
                      <small id="helpId" class="form-text text-danger">@error('name')
                      {{$message}} 
                      @enderror
                      </small>
                    </div>

                  <div class="mb-3">
                    <label for="orgName" class="form-label">Organization Name</label>
                    <input type="text"
                    class="form-control" name="orgName" id="orgName" aria-describedby="helpId" placeholder="Enter Organization Name">
                    <small id="helpId" class="form-text text-danger">@error('orgName')
                    {{$message}} 
                    @enderror
                    </small>
                  </div>
          
                  <div class="mb-3">
                    <label for="email" class="form-label">Organization Email</label>
                    <input type="email"
                      class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Enter Organization Email">
                    <small id="helpId" class="form-text text-danger">@error('email')
                      {{$message}} 
                      @enderror
                    </small>
                    </div> 
          
                    <div class="mb-3">
                    <label for="address" class="form-label">Organization Address</label>
                    <input type="text"
                      class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="Enter Organization Address">
                    <small id="helpId" class="form-text text-danger">@error('address')
                      {{$message}} 
                      @enderror
                    </small>
                    </div>   
                    
                    <div class="mb-3">
                      <label for="contact" class="form-label">Organization Contact</label>
                      <input type="text"
                        class="form-control" name="contact" id="contact" aria-describedby="helpId" placeholder="Enter Organization Active Contact">
                      <small id="helpId" class="form-text text-danger">@error('contact')
                        {{$message}} 
                        @enderror
                      </small>
                      </div> 

                      <div class="mb-3">
                        <label for="website" class="form-label">Organization Website (Optional)</label>
                        <input type="text"
                          class="form-control" name="website" id="website" aria-describedby="helpId" placeholder="Enter Organization Active Contact">
                        <small id="helpId" class="form-text text-danger">@error('website')
                          {{$message}} 
                          @enderror
                        </small>
                        </div> 

                        {{-- <div class="mb-3">
                          <label for="image" class="form-label">Organization Image</label>
                          <input type="file" class="form-control" name="image" multiple />
                          <small id="helpId" class="form-text text-danger">@error('image')
                            {{$message}} 
                            @enderror
                          </small>
                          </div>  --}}

                      <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password"
                          class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Set Password">
                        <small id="helpId" class="form-text text-danger">@error('password')
                          {{$message}} 
                          @enderror
                        </small>
                        </div>   
                  
                    <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password"
                      class="form-control" name="password_confirmation" id="password_confirmation" aria-describedby="helpId" placeholder="Confirm Passwrord">
                    <small id="helpId" class="form-text text-danger">@error('password_confirmation')
                      {{$message}} 
                      @enderror
                    </small>
                    </div>
                  
                    <div class="mb-3">
                    <button type="submit" class="btn btn-primary org-register-btn" >Register</button>
                    </div>
            </div>
        </div>
     </div>
        
     @endsection
