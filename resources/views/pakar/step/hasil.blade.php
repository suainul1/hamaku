<div class="row">
    <div class="col-md-12" style="height:20%">
        <b><p>Jenis Hama:</p></b>
    <p>{{$hama->nama_hama}}</p>
    </div>
    <div class="col-md-12">
        <b><p>Solusi:</p></b>
        {!!$hama->solusi!!}        
    </div>
<div class="col-md-12">
<a href="{{route('pakar.index')}}"><button type="button" class="btn btn-primary btn-block btn-round waves-effect waves-classic">Selesai</button></a>
      
</div>
</div>