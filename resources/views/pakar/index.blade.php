@extends('layouts.master',['title' => 'Analasia Penyakit Padi'])
@section('content')
<div class="page">
    <div class="row">
        <div class="col-md-6 offset-3">
<div class="panel" style="margin-top: 4%">
    <div class="panel-heading">
    <h3 class="panel-title">{{$judul ?? 'Diagnosa Kategori Gejala'}}</h3>
    </div>
    <div class="panel-body container-fluid">
        @if ($step == null)
        @include('pakar.step.satu')
        @elseif($step == 'hasil')
        @include('pakar.step.hasil')
        @endif
    </div>
  </div>

</div>
</div>
</div>
@endsection