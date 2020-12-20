@extends('layouts.master',['title' => 'Riwayat Diagnosa'])
@section('content')
<div class="page">
    <div class="row">
        <div class="col-md-6 offset-3">
<div class="panel" style="margin-top: 4%">
    <div class="panel-heading">
    <h3 class="panel-title">Riwayat diagnosa</h3>
    </div>
    <div class="panel-body container-fluid">
        <div class="accordion" id="accordionExample">
            @foreach ($riwayat as $i=>$rule)
            <div class="card">
                <div class="card-header" id="heading-{{$rule->id}}">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-{{$rule->id}}" aria-expanded="true" aria-controls="collapse-{{$rule->id}}">
                            {{$rule->rule->hama->nama_hama}} #{{$rule->created_at->format('d-M-Y')}}
                        </button>
                    </h2>
                </div>
                
                <div id="collapse-{{$rule->id}}" class="collapse {!!$i==0 ? 'show' : null!!}" aria-labelledby="heading-{{$rule->id}}" data-parent="#accordionExample">
                    <div class="card-body">
                       {!! $rule->rule->hama->solusi !!}
                    </div>
                </div>
            </div>
            @endforeach
          </div>

    </div>
  </div>

</div>
</div>
</div>
@endsection