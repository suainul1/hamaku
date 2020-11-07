@extends('layouts.master',['title'=> 'Artikel'])
@section('head')
<link rel="stylesheet" href="{{asset('assets/examples/css/uikit/modals.css')}}">
@endsection
@section('content')
    <div class="page">
      <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <button data-target="#exampleNiftyFall" data-toggle="modal" type="button" class="btn btn-primary waves-effect waves-classic float-right" id="myButtonAdd"><i class="icon md-plus" aria-hidden="true"></i>Add Kategori</button>
          <!-- Modal -->
          <div class="modal fade modal-fall" id="exampleNiftyFall" aria-hidden="true" aria-labelledby="exampleModalTitle"
            role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title">Kategori</h4>
                </div>
                <div class="modal-body">
                <form action="{{route('kategori.index')}}" method="POST">
                    @csrf
                    <div class="form-group form-material @error('nama') has-danger @enderror" data-plugin="formMaterial">
                        <label class="form-control-label" for="inputText">Nama Kategori</label>
                    <input type="text" class="form-control" id="inputText" value="{{old('nama')}}" name="nama" placeholder="Nama Kategori">
                      </div>
                      @error('nama')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
                  <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <!-- End Modal -->
        </div>
        </div>
        <div class="row justify-content-center" data-plugin="masonry">
            <div class="col-md-6 masonry-item">
                <ul class="list-group list-group-bordered">
                @foreach ($kategoris as $i=>$k)
                 <!-- Modal -->
          <div class="modal fade modal-fall" id="exampleNiftyFall{{$i}}" aria-hidden="true" aria-labelledby="exampleModalTitle"
          role="dialog" tabindex="-1">
          <div class="modal-dialog modal-simple">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Edit Kategori</h4>
              </div>
              <div class="modal-body">
              <form action="{{route('kategori.update',$k->id)}}" method="POST">
                  @csrf
                  @method('put')
                  <div class="form-group form-material @error('nama') has-danger @enderror" data-plugin="formMaterial">
                      <label class="form-control-label" for="inputText">Nama Kategori</label>
                  <input type="text" class="form-control" id="inputText" name="nama" value="{{$k->nama}}" placeholder="Nama Kategori">
                    </div>
                    @error('nama')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Save changes</button>
              </form>
                <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal -->
      <li class="list-group-item {{$i%2 == 0 ? 'active' : null}}">{{$k->nama}} <form id="kategori" action="{{route('kategori.delete',$k->id)}}" method="POST"> @csrf @method('delete') <a onclick="confirm('apakah anda yakin ingin Mengahpus?')" id="delete"><span style="cursor: pointer" class="badge badge-round badge-danger float-right">Hapus</span></a></form><span data-target="#exampleNiftyFall{{$i}}" data-toggle="modal" id="myButtonEdit{{$k->id}}" class="badge badge-round badge-warning float-right">Edit</span></li>
                @endforeach
                </ul>
            </div>
        </div>
      </div>
    </div>
@endsection
@section('footer')
    <script>
      var add = "{{session()->get('create')}}";
      var update =  "{{session()->get('update')}}" ;
      if(add == "1"){
      window.onload = function(){
      var button = document.getElementById('myButtonAdd');
    button.click();
      }
      }

      if(update == "1"){
      window.onload = function(){
      var button = document.getElementById('{{session()->get("button")}}');
    button.click();
      }
      }
      $("a#delete").click(function()
    {
    $("#kategori").submit();
    return false;
    });
    </script>
@endsection