@extends('layouts.master',['title'=> 'Buat Artikel'])
@section('head')
<link rel="stylesheet" href="{{asset('global/vendor/summernote/summernote.css')}}">


@endsection
@section('content')
    
    <!-- Page -->
    <div class="page">
        <div class="page-content container-fluid">
          <div class="row" data-plugin="matchHeight" data-by-row="true">
            <div class="col-md-12">
            <div class="panel">
              <div class="panel-heading">
                <h3 class="panel-title">Tambah Artikel</h3>
              </div>
              <div class="panel-body">
              <form action="{{route('artikel.create')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group form-material @error('judul') has-danger @enderror" data-plugin="formMaterial">
                    <label class="form-control-label" for="inputText">Judul</label>
                  <input type="text" class="form-control" id="inputText" name="judul" value="{{old('judul')}}" placeholder="Judul">
    
                  @error('judul')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                  <div class="form-group">
                    <h4 class="example-title">Thumbnail</h4>
                    <div class="input-group input-group-file" data-plugin="inputGroupFile">
                      <input type="text" class="form-control @error('image') is-invalid @enderror" readonly="">
                      <span class="input-group-btn">
                        <span class="btn btn-primary btn-file waves-effect waves-classic">
                          <i class="icon md-upload" aria-hidden="true"></i>
                          <input type="file" name="image">
                        </span>
                      </span>
                    </div>
                    @error('image')
                    <span class="text-danger">{{$message}}</span>
                    
                    @enderror
                  </div>
                  <div class="form-group form-material" data-plugin="formMaterial">
                    <h4 class="example-title">Kategori</h4>
                  @foreach ($kategoris as $k)
                    <div class="checkbox-custom checkbox-primary">
                      <input type="checkbox" name="kategori[]" id="inputUnchecked" value="{{$k->id}}">
                      <label for="inputUnchecked">{{$k->nama}}</label>
                    </div>
                    @endforeach
                    @error('kategori')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group form-material @error('desc') has-danger @enderror" data-plugin="formMaterial">
                    <label class="form-control-label" for="textarea">Deskripsi Singkat</label>
                    <textarea class="form-control" id="textarea" name="desc" rows="3"></textarea>
                    @error('desc')
                    <span class="text-danger">{{$message}}</span>
                  
                  @enderror
                  </div>
                  <div class="form-group form-material" data-plugin="formMaterial">
                  <textarea name="isi" id="summernote" data-plugin="summernote">
                    
                  </textarea>
                  @error('isi')
                    <span class="text-danger">{{$message}}</span>
                  
                  @enderror
                  </div>
                  <button type="submit" class="btn btn-primary btn-block btn-round waves-effect waves-classic">Kirim</button>
                </form>
              </div>
            </div>
          </div>
          </div>
        </div>
    </div>
      <!-- End Page -->
@endsection
@section('footer')
<script src="{{asset('global/vendor/summernote/summernote.min.js')}}"></script>
<script src="{{asset('global/js/Plugin/summernote.js')}}"></script>
    
<script src="{{asset('assets/examples/js/forms/editor-summernote.js')}}"></script>
<script src="{{asset('global/js/Plugin/input-group-file.js')}}"></script>
    

@endsection