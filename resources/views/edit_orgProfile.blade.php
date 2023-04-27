@extends('layout.main')
@section('content')

  <div class="container">
    <div class="row">
        <h3>Edit Profile</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum id dolores corrupti incidunt consequunt</p>
    </div>
  </div>

  <div class="container">
    <div class="row">
        <div class="col-md-10 col-lg-10 col-12 m-auto mt-4 mb-4">
            <form action="{{url('profile/edit')}}/{{$user->id}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">Your Name</label>
                  <input type="text"
                    class="form-control" name="name" id="name" aria-describedby="helpId" value="{{$user->name}}" placeholder="">
                  <small id="helpId" class="form-text text-danger">@error('name')
                      {{$message}}
                  @enderror</small>
                </div>
                <div class="mb-3">
                    <label for="orgName" class="form-label">Organization Name</label>
                    <input type="text"
                      class="form-control" name="orgName" id="orgName" aria-describedby="helpId" value="{{$user->org_name}}" placeholder="">
                    <small id="helpId" class="form-text text-danger">@error('orgName')
                        {{$message}}
                    @enderror</small>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email"
                      class="form-control" name="email" id="email" aria-describedby="helpId" value="{{$user->email}}" placeholder="">
                    <small id="helpId" class="form-text text-danger">@error('email')
                        {{$message}}
                    @enderror</small>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text"
                      class="form-control" name="contact" id="contact" aria-describedby="helpId" value="{{$user->contact}}" placeholder="">
                    <small id="helpId" class="form-text text-danger">@error('contact')
                        {{$message}}
                    @enderror</small>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text"
                      class="form-control" name="address" id="address" aria-describedby="helpId" value="{{$user->address}}" placeholder="">
                    <small id="helpId" class="form-text text-danger">@error('address')
                        {{$message}}
                    @enderror</small>
                </div>
                <div class="mb-3">
                    <label for="website" class="form-label">Website</label>
                    <input type="text"
                      class="form-control" name="website" id="website" aria-describedby="helpId" value="{{$user->website}}" placeholder="">
                    <small id="helpId" class="form-text text-danger">@error('website')
                        {{$message}}
                    @enderror</small>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-9 col-lg-9 col-12">
                        <label for="image" class="form-label">Profile Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <small id="helpId" class="form-text text-danger">@error('image')
                            {{$message}}
                        @enderror</small>
                    </div>
                        <div class="col-md-3 col-lg-3 col-12">
                          <img src="{{url(Custom::userImagePath($user->id))}}" alt="" class="img-fluid" width="100px">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                  <div class="row">
                      <div class="col-md-9 col-lg-9 col-12">
                      <label for="profileBg" class="form-label">Background Image</label>
                      <input type="file" name="profileBg" id="profileBg" class="form-control">
                      <small id="helpId" class="form-text text-danger">@error('profileBg')
                          {{$message}}
                      @enderror</small>
                  </div>
                      <div class="col-md-3 col-lg-3 col-12">
                        <img src="{{url(Custom::userBgImagePath($user->id))}}" alt="" class="img-fluid" width="100px">
                      </div>
                  </div>
              </div>

                <div class="mb-3 mt-4">
                   <h3>Social Links</h3>
                </div>
                <div class="mb-3">
                    <label for="facebook" class="form-label">Facebook</label>
                    <input type="text"
                      class="form-control" name="facebook" id="facebook" aria-describedby="helpId" value="{{$user->facebook}}" placeholder="">
                    <small id="helpId" class="form-text text-danger">@error('facebook')
                        {{$message}}
                    @enderror</small>
                </div>
                <div class="mb-3">
                    <label for="instagram" class="form-label">Instagram</label>
                    <input type="text"
                      class="form-control" name="instagram" id="instagram" aria-describedby="helpId" value="{{$user->instagram}}" placeholder="">
                    <small id="helpId" class="form-text text-danger">@error('instagram')
                        {{$message}}
                    @enderror</small>
                </div>
                <div class="mb-3">
                    <label for="twitter" class="form-label">Twitter</label>
                    <input type="text"
                      class="form-control" name="twitter" id="twitter" aria-describedby="helpId" value="{{$user->twitter}}" placeholder="">
                    <small id="helpId" class="form-text text-danger">@error('twitter')
                        {{$message}}
                    @enderror</small>
                </div>
                <div class="mb-3">
                    <label for="youtube" class="form-label">Youtube</label>
                    <input type="text"
                      class="form-control" name="youtube" id="youtube" aria-describedby="helpId" value="{{$user->youtube}}" placeholder="">
                    <small id="helpId" class="form-text text-danger">@error('youtube')
                        {{$message}}
                    @enderror</small>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
  </div>

@endsection