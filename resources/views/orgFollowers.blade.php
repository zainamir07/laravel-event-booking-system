@extends('layout.main')

@section('content')

<div class="container mt-4 mb-3">
    <div class="row">
        <h3>My Followers</h3>
    </div>
</div>

<div class="container">

    <div class="table_section padding_infor_info">
        <div class="table-responsive-sm">
           <table class="table">
              <thead>
                 <tr>
                    <th>#</th>
                    <th>Name/Image</th>
                    <th>Date</th>
                    <th>Action</th>
                 </tr>
              </thead>
              <tbody>
                  @php
                      $i = 1;
                  @endphp
                  @foreach ($followers as $users)
                  <tr>
                      <td>{{$i}}</td>
                      <td>
                        <span><img src="{{url(Custom::userImagePath($users->user_id))}}" alt="" class="img-fluid rounded-circle mb-2" width="50px"></span>  
                        <h6>{{Custom::authorName($users->user_id)}}</h6> 
                      </td>
                      <td>{{dateFormat($users->created_at)}}</td>
                      <td>
                        <div class="removed-user">
                          <button class="btn btn-danger m-1 remove-follower"  data-id="{{$users->user_id}}"><i class="fa fa-trash"></i></button>
                          </div>
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
@endsection