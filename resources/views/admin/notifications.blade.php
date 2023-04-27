@extends('admin.layout.main')
@section('content')
  
<div class="container mt-3">
    <h2>Notifications</h2>
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
                        <th>Title</th>
                        <th>Date</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                      @php
                          $i = 1;
                      @endphp
                      @foreach ($allNotifications as $noti)
                      <tr>
                          <td>{{$i}}</td>
                          <td>{{$noti->noti_title}}</td>
                          <td>{{dateFormat($noti->created_at)}}</td>
                          <td>
                              <a
                              @if ($noti->noti_type == 'Reg')
                              href="{{url('myProfile')}}/{{$noti->noti_typeId}}"    
                              @elseif($noti->noti_type == 'E')
                              href="{{url('events')}}/{{Custom::getEventUrl($noti->noti_typeId)}}"    
                              @endif
                               class="btn btn-primary m-1 "><i class="fa fa-eye"></i></a>
                          </td>
                      </tr>
                      @php 
                           $i++;
                      @endphp
                      @endforeach
                    </tbody>
                </table>
                <div class="container d-flex mt-4 mb-4 justify-content-center">
                 {{  $allNotifications->links('pagination::bootstrap-4') }} 
               </div>
             </div>
          </div>
       </div>
    </div>
</div>

@endsection