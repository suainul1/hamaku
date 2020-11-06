@extends('layouts.master',['title'=> 'Artikel'])
@section('head')
<link rel="stylesheet" href="{{asset('assets/examples/css/pages/email.css')}}">
@endsection

@section('content')

<div class="page">
  <div class="page-content">
 @if (auth()->user()->role == 'ahli_tani' || auth()->user()->role == 'admin')
    <div class="row mb-5">
      <div class="col-md-12">
      <a href="{{route('artikel.create')}}"><button type="button" class="btn btn-primary waves-effect waves-classic float-right"><i class="icon md-plus" aria-hidden="true"></i>Add Artikel</button>
     </a>  
    </div>
    </div>
    @endif
    <!-- Panel -->
    <div class="panel">
      <div class="panel-body container-fluid">
        <div class="email-title">
          <img style="width: 5%" src="{{asset('assets/images/favicon.png')}}" alt="..." />
          <h4 class="blue-grey-400 font-weight-400">Artikel</h4>
        </div>
        <!-- Card List -->
        <div class="card-list mt-20">
@foreach ($artikels as $a)
          <div class="card card-list-item">
            <div class="card-img-left">
              <div class="cover-background" style="background-image: url('{{asset(Storage::url('artikel/thumbnail/'.$a->thumbnail))}}')"></div>
            </div>
            <div class="card-block">
              @if (auth()->user()->role == 'ahli_tani' || auth()->user()->role == 'admin')
              <a href="{{route('artikel.edit',$a->slug)}}"><span class="badge badge-warning float-right">Edit</span></a>
              <a onclick="confirm('apakah anda yakin ingin Mengahpus?')" href="{{route('artikel.delete',$a->slug)}}"><span class="badge badge-danger float-right mr-2">Delete</span></a>
              @endif
                
              <p class="card-text">
                <small>
                  <span class="card-author">{{$a->user->name}}</span> /
                  <span class="card-category">Artikel</span> /
                  <span class="card-time">{{$a->created_at->format('d-M-Y')}}</span>
                </small>
              </p>
              <h4 class="card-title">{{$a->judul}}</h4>
            <p class="card-text">{{$a->desc}} </p>
            </div>
            <div class="card-block clearfix">
              <div class="card-actions float-left">
                <a href="javascript:void(0)">
              <i class="icon md-share"></i>
            </a>
                <a href="javascript:void(0)">
              <i class="icon md-heart"></i>
              <span>21</span>
            </a>
                <a href="javascript:void(0)">
              <i class="icon md-chat"></i>
              <span>35</span>
            </a>
              </div>
              <a class="btn btn-outline btn-default card-link float-right" href="{{route('artikel.show',$a->slug)}}">
            <i class="icon md-chevron-right"></i> Read More
          </a>
            </div>
          </div>
@endforeach
        </div>
        <!-- End Card List -->
        <div class="email-more">
          <div class="row justify-content-end">
            <div class="col-md-6">
              {{$artikels->links()}}
  
            </div>
          </div>
          
        </div>
      </div>
    </div>
    <!-- End Panel -->
  </div>
</div>
    @endsection