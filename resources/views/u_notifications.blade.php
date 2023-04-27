@extends('layout.main')

@section('content')
    <div class="container mt-5 mb-3">
        <h3>All Notifications</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis similique praesentium ratione!</p>
    </div>

    <div class="container">
        <div class="row">
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
                         
                        @foreach ($followNotifications as $noti)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$noti->noti_title}}</td>
                            <td>{{dateFormat($noti->created_at)}} <br> 
                                {{get_time_ago( strtotime( $noti->created_at)) }}
                            </td>
                            <td>
                                <a
                                @if ($noti->noti_type == 'E')
                                href="{{url('events')}}/{{Custom::getEventUrl($noti->noti_typeId)}}"    
                                @else
                                href="{{url('profile')}}/{{Custom::orgUsername($noti->noti_byId)}}"
                                @endif
                                class="btn btn-primary m-1 "><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        @php $i++; @endphp

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
    
@endsection