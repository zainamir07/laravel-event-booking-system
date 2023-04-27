@extends('layout.main')
     @section('content')
         
     <div class="container mt-5">
        <div class="heading mb-5">
            <h2>Login</h2>
            <p>Login with your email and password. <br> Not an account Register <a href="{{route('register')}}">here</a></p>
        </div>
        <div class="row mb-5 pb-5">
            <div class="col-md-8 col-12 m-auto">
                <div id="login_errList"></div>
                @if (session()->has('error'))
                <div class="alert alert-danger">{{session()->get('error')}}</div>
                @endif
                @if (session()->has('success'))
                <div class="alert alert-success">{{session()->get('success')}}</div>
                @endif

                <form action="{{route('login')}}" method="post" id="loginform">
                     @csrf
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
                    <button type="submit" class="btn btn-primary login-btn" >Login</button>
                    </div>
            </div>
        </div>
     </div>
        
     @endsection
