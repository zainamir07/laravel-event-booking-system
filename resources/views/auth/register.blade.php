@extends('layout.main')
     @section('content')
         
     <div class="container mt-5">
        <div class="heading mb-5">
            <h2>Register</h2>
            <p>Register now. Have an account Login <a href="{{route('login')}}">here</a></p>
        </div>
        <div class="row mb-5 pb-5">
            <div class="col-md-8 col-12 m-auto">
                <div id="register_errList"></div>
                <form action="{{route('register')}}" method="post" id="registerform">
                     @csrf
                  <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text"
                    class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Enter Your Name">
                    <small id="helpId" class="form-text text-muted">@error('name')
                    {{$message}} 
                    @enderror
                    </small>
                  </div>
          
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email"
                      class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Enter Your Email">
                    <small id="helpId" class="form-text text-muted">@error('email')
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
                  
                    <div class="mb-3">
                    <button type="submit" class="btn btn-primary register-btn" >Register</button>
                    </div>
            </div>
        </div>
     </div>
        
     @endsection
