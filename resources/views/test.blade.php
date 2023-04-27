@extends('layout.main')

@section('content')

<style>
img {
 display: block;
 height: auto;
 width: 100%
}

hr {
 color: #d4d4d4
}

</style>


<link rel='stylesheet' href='https://sachinchoolur.github.io/lightslider/dist/css/lightslider.css'>
<div class="container-fluid mt-2 mb-3">
   <div class="row no-gutters">
      <div class="col-md-5 pr-2">
         <div class="card">
            <div class="demo">
               <ul id="lightSlider">
                  <li data-thumb="{{url('Backend/event_images/1_2_.jpg')}}"> <img src="{{url('Backend/event_images/1_2_.jpg')}}" /> </li>
                  <li data-thumb="{{url('Backend/event_images/1_2_.jpg')}}"> <img src="{{url('Backend/event_images/1_2_.jpg')}}" /> </li>
                  <li data-thumb="{{url('Backend/event_images/1_2_.jpg')}}"> <img src="{{url('Backend/event_images/1_2_.jpg')}}" /> </li>
                  <li data-thumb="{{url('Backend/event_images/1_2_.jpg')}}"> <img src="{{url('Backend/event_images/1_2_.jpg')}}" /> </li>
                  <li data-thumb="{{url('Backend/event_images/1_2_.jpg')}}"> <img src="{{url('Backend/event_images/1_2_.jpg')}}" /> </li>
                  <li data-thumb="{{url('Backend/event_images/1_2_.jpg')}}"> <img src="{{url('Backend/event_images/1_2_.jpg')}}" /> </li>
                  <li data-thumb="{{url('Backend/event_images/1_2_.jpg')}}"> <img src="{{url('Backend/event_images/1_2_.jpg')}}" /> </li>
                  <li data-thumb="{{url('Backend/event_images/1_2_.jpg')}}"> <img src="{{url('Backend/event_images/1_2_.jpg')}}" /> </li>
                  <li data-thumb="{{url('Backend/event_images/1_2_.jpg')}}"> <img src="{{url('Backend/event_images/1_2_.jpg')}}" /> </li>
                  <li data-thumb="{{url('Backend/event_images/1_2_.jpg')}}"> <img src="{{url('Backend/event_images/1_2_.jpg')}}" /> </li>
                  <li data-thumb="{{url('Backend/event_images/1_2_.jpg')}}"> <img src="{{url('Backend/event_images/1_2_.jpg')}}" /> </li>
                  <li data-thumb="{{url('Backend/event_images/1_2_.jpg')}}"> <img src="{{url('Backend/event_images/1_2_.jpg')}}" /> </li>
                  <li data-thumb="{{url('Backend/event_images/1_2_.jpg')}}"> <img src="{{url('Backend/event_images/1_2_.jpg')}}" /> </li>
                  <li data-thumb="{{url('Backend/event_images/1_2_.jpg')}}"> <img src="{{url('Backend/event_images/1_2_.jpg')}}" /> </li>
                  <li data-thumb="{{url('Backend/event_images/1_2_.jpg')}}"> <img src="{{url('Backend/event_images/1_2_.jpg')}}" /> </li>
               </ul>
            </div>
         </div>

      </div>
      <div class="col-md-7">

      </div>
   </div>
</div>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
<script src='https://sachinchoolur.github.io/lightslider/dist/js/lightslider.js'></script>
<script> $('#lightSlider').lightSlider({ gallery: true, item: 1, loop: true, slideMargin: 0, thumbItem: 9 });</script>

@endsection