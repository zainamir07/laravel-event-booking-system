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
                                @if ($noti->noti_type === 'T')
                                <a href="{{url('events')}}/{{Custom::getEventUrl($noti->noti_typeId)}}" class="btn btn-primary m-1 "><i class="fa fa-eye"></i></a>
                                @elseif($noti->noti_type === 'Rev')
                                <a href="{{url('reviews')}}/{{Custom::getEventReviewUrl($noti->noti_typeId)}}" class="btn btn-primary m-1 "><i class="fa fa-eye"></i></a>
                                @endif
                            </td>
                        </tr>
                        @php $i++; @endphp

                        @endforeach
                           
                      </tbody>
                  </table>
                  <div class="row">
                   {{  $followNotifications->links('pagination::bootstrap-5') }} 
                 </div>
               </div>
            </div>
        </div>


    </div>
    
@endsection