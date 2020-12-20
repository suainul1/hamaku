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
                            @forelse ($ahli ?? [] as $u)
                            <li class="list-group-item active">
                                <div class="media">
                                    <div class="pr-20">
                                        <a class="avatar avatar-online" data-target="#chatingan{{$u->id}}" data-toggle="modal" href="javascript:void(0)">
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
                            <p>Tidak ditemukan</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</div>

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

@endsection