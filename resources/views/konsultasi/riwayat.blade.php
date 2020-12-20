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
                          $id =$u->id;
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
                            <p>Tidak Ditemukan</p>
                            @endforelse
                       
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</div>
@endsection
@section('footer')
<script src="{{asset('global/vendor/autosize/autosize.js')}}"></script>
<script src="{{asset('assets/js/Site.js')}}"></script>
<script src="{{asset('assets/js/App/Message.js')}}"></script>
{{-- <script src="{{asset('assets/examples/js/apps/message.js')}}"></script> --}}

@endsection