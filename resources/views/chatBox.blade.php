@extends('layout.main')
@section('content')
<style>
.chat-list {
    padding: 0;
    font-size: .8rem;
}

.chat-list li {
    margin-bottom: 10px;
    overflow: auto;
    color: #ffffff;
}

.chat-list .chat-img {
    float: left;
    width: 48px;
}

.chat-list .chat-img img {
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    width: 100%;
}

.chat-list .chat-message {
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    background: #5a99ee;
    display: inline-block;
    padding: 10px 20px;
    position: relative;
}

.chat-list .chat-message:before {
    content: "";
    position: absolute;
    top: 15px;
    width: 0;
    height: 0;
}

.chat-list .chat-message h5 {
    margin: 0 0 5px 0;
    font-weight: 600;
    line-height: 100%;
    font-size: .9rem;
}

.chat-list .chat-message p {
    line-height: 18px;
    margin: 0;
    padding: 0;
}

.chat-list .chat-body {
    margin-left: 20px;
    float: left;
    width: 70%;
}

.chat-list .in .chat-message:before {
    left: -12px;
    border-bottom: 20px solid transparent;
    border-right: 20px solid #5a99ee;
}

.chat-list .out .chat-img {
    float: right;
}

.chat-list .out .chat-body {
    float: right;
    margin-right: 20px;
    text-align: right;
}

.chat-list .out .chat-message {
    background: #fc6d4c;
}

.chat-list .out .chat-message:before {
    right: -12px;
    border-bottom: 20px solid transparent;
    border-left: 20px solid #fc6d4c;
}

.card .card-header:first-child {
    -webkit-border-radius: 0.3rem 0.3rem 0 0;
    -moz-border-radius: 0.3rem 0.3rem 0 0;
    border-radius: 0.3rem 0.3rem 0 0;
}
.card .card-header {
    background: #17202b;
    border: 0;
    font-size: 1rem;
    padding: .65rem 1rem;
    position: relative;
    font-weight: 600;
    color: #ffffff;
}

.content{
    margin-top:40px;    
}
</style>

    <div class="container content">
        <div class="row">
            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 m-auto">
                <div class="card">
                    <div class="card-header">Chat With @if ($reciever_id->org_name != "")
                        {{$reciever_id->org_name}} @else {{$reciever_id->name}}  @endif </div>
                    <div class="card-body height3">
                        <ul class="chat-list">
                            <input type="hidden" name="reciever_id" id="reciever_id" value="{{$reciever_id->id}}">
                            <input type="hidden" name="sender_id" id="sender_id" value="{{session()->get('user_id')}}">
                            {{-- <li class="in">
                                <div class="chat-img">
                                    <img alt="Avtar" src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                </div>
                                <div class="chat-body">
                                    <div class="chat-message">
                                        <h5>Jimmy Willams</h5>
                                        <p>Raw denim heard of them tofu master cleanse</p>
                                    </div>
                                </div>
                            </li>
                            <li class="out">
                                <div class="chat-img">
                                    <img alt="Avtar" src="https://bootdey.com/img/Content/avatar/avatar6.png">
                                </div>
                                <div class="chat-body">
                                    <div class="chat-message">
                                        <h5>Serena</h5>
                                        <p>Next level veard</p>
                                    </div>
                                </div>
                            </li> --}}
                            @foreach ($reciever as $msg)
                            <li class="in in-message">
                                <div class="chat-img">
                                    <img alt="Avtar" src="{{url(Custom::userImagePath($msg->sender_id))}}">
                                </div>
                                <div class="chat-body">
                                    <div class="chat-message recieve-message">
                                        <h5 class="name">{{Custom::authorName($msg->sender_id)}}</h5>
                                        <p>{{$msg->message}}</p>
                                    </div>
                                </div>
                            </li>    
                            @endforeach
                            
                            @foreach ($sender as $msg)
                            <li class="out out-message">
                                <div class="chat-img">
                                    <img alt="Avtar" src="{{url(Custom::userImagePath($msg->sender_id))}}">
                                </div>
                                <div class="chat-body">
                                    <div class="chat-message send-message">
                                        <h5>{{Custom::authorName($msg->sender_id)}}</h5>
                                        <p>{{$msg->message}}</p>
                                    </div>
                                </div>
                            </li>    
                            @endforeach
                            {{-- <li class="out out-message">
                                <div class="chat-img">
                                    <img alt="Avtar" src="https://bootdey.com/img/Content/avatar/avatar6.png">
                                </div>
                                <div class="chat-body">
                                    <div class="chat-message send-message">
                                        <h5>Serena</h5>
                                        <p>Tofu master best deal</p>
                                    </div>
                                </div>
                            </li> --}}
                        </ul>
                    </div>

                    <div class="mb-3 d-flex p-2 mt-4">
                      {{-- <label for="" class="form-label">Name</label> --}}
                      <input type="text"
                        class="form-control m-2 message" name="message" id="message" aria-describedby="helpId" placeholder="">
                        <div class="d-flex justify-content-center align-items-center">
                     <button class="btn btn-sm btn-primary message_send_btn">Send</button>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection