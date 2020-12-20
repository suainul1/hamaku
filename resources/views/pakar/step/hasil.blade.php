<div class="row">
    @foreach ($rule as $hama)
    <div class="col-md-12" style="height:20%">
        <b><p>Jenis Hama:</p></b>
        <p>{{$hama->hama->nama_hama}}</p>
    </div>
    <div class="col-md-12">
        <b><p>Solusi:</p></b>
        {!!$hama->hama->solusi!!}        
    </div>
    @endforeach
<div class="col-md-12">
<a href="{{route('pakar.index')}}"><button type="button" class="btn btn-primary btn-block btn-round waves-effect waves-classic">Selesai</button></a>
      
</div>
</div>