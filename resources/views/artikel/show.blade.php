@extends('layouts.master',['title'=> $artikel->judul])
@section('head')
<link rel="stylesheet" href="{{asset('assets/examples/css/pages/email.css')}}">
@endsection
@section('content')

<div class="page">
    <div class="page-content">
      <!-- Panel -->
      <div class="panel">
        <div class="panel-body container-fluid">
          
          <div class="card">
            <div class="card-block px-0">
              <div class="card mb-0">
                <div class="card-block px-0">
                  <h3 class="card-title">{{$artikel->judul}}</h3>
                  <p class="card-text">
                    <small>{{$artikel->created_at->format('d-M-Y')}}</small>
                    <small>Created By: {{$artikel->user->name}}</small>
                  </p>
                  {!! $artikel->isi !!}
                </div>
                <div class="card-block p-0">
                  tags:
                  @foreach ($artikel->kategoris as $k)
                    <a class="badge badge-outline badge-default mx-5" href="#">{{Str::title($k->nama)}}</a>
                        
                    @endforeach
                  </div>
                <div class="card-block px-0 clearfix">
                  
                  <div class="card-actions float-right">
                    <a href="javascript:void(0)">
                  <i class="icon md-share"></i>
                </a>
                    <a href="javascript:void(0)">
                  <i class="icon md-favorite"></i>
                  <span>63</span>
                </a>
                    <a href="javascript:void(0)">
                  <i class="icon md-comment"></i>
                  <span>26</span>
                </a>
                  </div>
                </div>
                <div class="card-block px-0">
                  <h3 class="card-heading">
                    Comments
                  </h3>
                  <div class="card-block p-0">
                    <div class="media">
                      <div class="pr-20">
                        <a class="avatar" href="#">
                          <img class="img-responsive" src="../../../global/portraits/1.jpg" alt="..." />
                        </a>
                      </div>
                      <div class="media-body">
                        <div class="mt-0 mb-5" href="#">
                          Herman Beck
                          <small>Yesterday at 12:30AM</small>
                        </div>
                        <small>Officia qui commodo ad dolor. Sit nisi minim aute deserunt
                          quis. Cupidatat ea officia in proident non. Mollit
                          id sit aliqua laborum. Officia labore dolor irure amet.
                          Excepteur eu sit ullamco duis sunt anim consectetur.
                          Id aute non amet culpa pariatur officia.</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="email-more mt-0">
            <p>You are currently signed up to Company’s newsletters as: youremail@gmail.com
              to <a class="email-unsubscribe" href="javascript:void(0)">unsubscribe</a></p>
            <div class="email-more-social">
              <a href="javascript:void(0)"><i class="icon bd-twitter" aria-hidden="true"></i></a>
              <a href="javascript:void(0)"><i class="icon bd-facebook" aria-hidden="true"></i></a>
              <a href="javascript:void(0)"><i class="icon bd-linkedin" aria-hidden="true"></i></a>
              <a href="javascript:void(0)"><i class="icon bd-pinterest" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
      </div>
      <!-- End panel -->
    </div>
  </div>


@endsection