@extends('layouts.master',['title'=> 'konsultasi','body' => 'app-message page-aside-scroll page-aside-left'])
@section('head')
<link rel="stylesheet" href="{{asset('assets/examples/css/apps/message.css')}}">
@endsection
@section('content')

<div class="page">
    <!-- Message Sidebar -->
    <div class="page-aside">
        <div class="page-aside-switch">
            <i class="icon md-chevron-left" aria-hidden="true"></i>
            <i class="icon md-chevron-right" aria-hidden="true"></i>
        </div>
        <div class="page-aside-inner">
            <div class="input-search">
                <button class="input-search-btn" type="submit">
                    <i class="icon md-search" aria-hidden="true"></i>
                </button>
                <form>
                    <input class="form-control" type="text" placeholder="Search Keyword" name="">
                </form>
            </div>

            <div class="app-message-list page-aside-scroll">
                <div data-role="container">
                    <div data-role="content">
                        
                        <ul class="list-group">
                            @forelse ($room as $u)
                            @php
                            $id = $u->id;
                              if(auth()->user()->role == 'petani'){
                                  $u = $u->ahliTani->user;
                              }else{
                                $u = $u->user;
                              }
                          @endphp
                            <li class="list-group-item active">
                                <div class="media">
                                    <div class="pr-20">
                                        <a class="avatar avatar-online" href="{{route('room.view',$id)}}">
                                            <img class="img-fluid"
                                                src="{{asset(Storage::url(is_null($u->image) ? 'user/profile/placeholder.png' : 'user/profile/'.$u->image))}}"
                                                alt="..."><i></i></a>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-5">{{$u->name}}</h5>
                                        <span class="media-time">{{$u->updated_at->diffForHumans()}}</span>
                                    </div>
                                    {{-- <div class="pl-20">
                      <span class="badge badge-pill badge-danger">3</span>
                    </div> --}}
                                </div>
                            </li>
                            @empty
                            <p>tidak ada chat</p>
                            @endforelse
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Message Sidebar -->
    <div class="page-main">
        <!-- Chat Box -->

        <div class="app-message-chats">
            <div class="chats">
                @forelse ($chat->message ?? [] as $c)
                @if (auth()->user()->id == $c->from_user_id)   
                    <div class="chat">
                        <div class="chat-avatar">
                            <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="">
                                <img src="{{asset(Storage::url(is_null(auth()->user()->image) ? 'user/profile/placeholder.png' : 'user/profile/'.auth()->user()->image))}}" alt="June Lane">
                            </a>
                        </div>
                        <div class="chat-body">
                            <div class="chat-content">
                                <p>
                                    {{$c->pesan}}
                                </p>
                                
                            </div>
                        </div>
                    </div>
                <p class="time">{{$c->created_at->diffForHumans()}}</p>
                @else
                @php
                    $to = \App\Models\User::find($c->to_user_id);
                @endphp
                <div class="chat chat-left">
                    <div class="chat-avatar">
                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="">
                            <img src="{{asset(Storage::url(is_null($to->image) ? 'user/profile/placeholder.png' : 'user/profile/'.$to->image))}}" alt="Edward Fletcher">
                        </a>
                    </div>
                    <div class="chat-body">
                        <div class="chat-content">
                            <p> {{$c->pesan}}</p>
                        </div>
                    </div>
                </div>
            <p class="time">{{$c->created_at->diffForHumans()}}</p>
                @endif
                @empty
                
                @endforelse
            </div>

        </div>
        <!-- End Chat Box -->

        <!-- Message Input-->
        @if ($chat->status != 'selesai')
         
        <form action="{{route('message.chat',$chat->id)}}" method="POST" class="app-message-input">
            @csrf
        <input type="number" name="touser" value="{{auth()->user()->role == 'petani' ? $chat->ahliTani->user->id : $chat->user->id}}" hidden>
            <div class="input-group form-material">
                <span class="input-group-btn">
                    @if (auth()->user()->role == 'ahli_tani')
                    <a href="javascript: void(0)" id="closechat" class="btn btn-pure btn-default icon md-close"></a>
                    @endif
                </span>
                <input class="form-control" type="text" placeholder="Type message here ..." name="pesan">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-pure btn-default icon md-mail-send"></button>
                </span>
            </div>
        </form>
        @endif
        <!-- End Message Input-->

    </div>
</div>
<form id="formclose" action="{{route('room.close',$chat->id)}}" method="post">
@csrf
@method('put')
</form>
@foreach ($ahli ?? [] as $u)
<div class="modal fade modal-fall" id="chatingan{{$u->id}}" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            <h4 class="modal-title">Yakin Ingin Konsultasi dengan {{$u->name}}</h4>
            </div>
            <div class="modal-body">
            <form autocomplete="off" action="{{route('room.konsul',$u->id)}}" method="POST">
                @csrf
                    <h3 class="text-danger">Poin anda akan Otomatasi Dikurangi 5</h3>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Yes</button>
                </form>
                <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div>
    <!-- End Modal -->
@endforeach
@endsection
@section('footer')
<script src="{{asset('global/vendor/autosize/autosize.js')}}"></script>
<script src="{{asset('assets/js/Site.js')}}"></script>
<script src="{{asset('assets/js/App/Message.js')}}"></script>
{{-- <script src="{{asset('assets/examples/js/apps/message.js')}}"></script> --}}
<script>
    $(document).ready(function(){
        $('#closechat').click(function(){
            $('#formclose').submit();
        });
    });
</script>
@endsection