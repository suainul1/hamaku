@extends('layouts.master')
@section('head')
<link rel="stylesheet" href="{{asset('assets/examples/css/uikit/dropdowns.css')}}">
@endsection
@section('content')
<div class="page">
    <div class="page-content">
    
      <!-- Panel Sort & Hideheader -->
      <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title">Data Wisata</h3>
          <div class="row justify-content-end mb-3">
              <div class="col-md-3">
                  <div class="pull-right">
                      <button data-target="#create" data-toggle="modal"  class="btn btn-primary">Transaksi Baru</button>
                  </div>

              </div>
          </div>
        </div>
        <div class="panel-body">
        <form action="" class="page-search-form" method="GET" role="search">
            <div class="input-search input-search-dark">
              <i class="input-search-icon md-search" aria-hidden="true"></i>
              <input type="text" class="form-control" id="inputSearch" name="search" placeholder="Search Transaksi">
              <button type="button" class="input-search-close" aria-label="Close">></button>
            </div>
          </form>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nominal</th>
                <th scope="col">Total Bayar</th>
                <th scope="col">Methode Bayar</th>
                <th scope="col">status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transaksi as $i=>$t)
              @php
                $y = new \App\Http\Controllers\XenditController;
                $x = $y->invoice($t->metode_bayar);
             
                if($x['status'] == 'SETTLED' && $t->status == 'pembayaran'){
                  $t->update([
                    'status' => 'selesai',
                  ]);
                  $t->user()->update([
                      'point' => $t->user->point + $t->nominal, 
                  ]);
                }   
                if(\Carbon\Carbon::parse($t->created_at)->addDays(1) <=  \Carbon\Carbon::now()->toDateString() && $t->status == 'pembayaran'){
                  $y->expinvoice($t->invoice_id);
                  $t->update([
                    'status' => 'batal',
                  ]);

                }
              @endphp

              <tr>
              <th scope="row">{{$i+1}}</th>
              <td>{{$t->nominal}}</td>
              <td>{{$t->nominal*1000}}</td>
              <td><a target="__blank" href="{{$x['invoice_url']}}">See</a></td>    
              <td>{{$t->status}}</td>
            </tr>
                @endforeach
      
            </tbody>
          </table>
              <!-- End Example Basic Sort -->
              {{$transaksi->links()}} 
            </div>
          </div>
        </div>
      </div>
      <!-- End Panel Sort & Hideheader -->
      
    </div>
  </div>

  @include('transaksi.komponen.tambah')

@endsection
@section('footer')
<script src="{{asset('global/vendor/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}"></script>
@endsection