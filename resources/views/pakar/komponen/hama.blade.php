<!-- Categroy 2 -->
<div class="tab-pane animation-fade" id="category-2" role="tabpanel">
    <div class="panel-group panel-group-simple panel-group-continuous" id="accordion" aria-multiselectable="true"
        role="tablist">
        <!-- Question 5 -->
        <div class="panel">
            <div class="panel-heading" id="question-5" role="tab">
                <a class="panel-title" aria-controls="answer-5" aria-expanded="true" data-toggle="collapse"
                    href="#answer-5" data-parent="#accordion">
                    Setting Hama dan Solusi
                </a>
            </div>
            <div class="panel-collapse collapse show" id="answer-5" aria-labelledby="question-5" role="tabpanel">
                <div class="panel-body">
                    <div class="float-right">
                        <button data-target="#hama" data-toggle="modal" type="button"
                            class="btn btn-floating btn-info btn-sm waves-effect waves-classic"><i class="icon md-plus"
                                aria-hidden="true"></i></button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">kode kategori hama</th>
                                <th scope="col">Nama Hama</th>
                                <th scope="col">Solusi</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hama as $i=>$h)
                            <tr>
                                <td scope="row">{{$i+1}}</td>
                                <td>{{$h->kode}}</td>
                                <td>{{$h->nama_hama}}</td>
                                <td> <span style="cursor: pointer" data-target="#hama{{$h->id}}" data-toggle="modal"
                                        class="text-info">Lihat</span> </td>
                                <td>
                                    <div>
                                        <button  data-target="#hamaEdit{{$h->id}}" data-toggle="modal" type="button" class="btn btn-round btn-warning btn-pill-left waves-effect waves-classic">Edit</button>
                                    <button data-target="#hamaHapus{{$h->id}}" data-toggle="modal" type="button" class="btn btn-round btn-danger btn-pill-right waves-effect waves-classic">Delete</button>
                                      </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Question 5 -->
    </div>
</div>
<!-- End Categroy 2 -->
<div class="modal fade modal-fall" id="hama" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Setting Hama dan Solusi</h4>
            </div>
            <div class="modal-body">
                <form autocomplete="off" action="{{route('hama.create')}}" method="POST">
                    @csrf
                    <div class="form-group form-material @error('nama_hama') has-danger @enderror" data-plugin="formMaterial">
                        <label class="form-control-label" for="hama">Nama Hama</label>
                        <input type="text" class="form-control" id="hama" name="nama_hama" placeholder="Nama Hama">
                        @error('nama_hama')
                        <span class="text-danger">{{$message}}</span>
                        @enderror    
                    </div>
                    <div class="form-group form-material @error('solusi') has-danger @enderror" data-plugin="formMaterial">
                        <label class="form-control-label" for="solusi">Solusi</label>
                        <textarea id="summernote" data-plugin="summernote" class="form-control" id="solusi"
                            name="solusi" rows="3"></textarea>
                            @error('solusi')
                            <span class="text-danger">{{$message}}</span>
                            @enderror    
                        </div>
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
@foreach ($hama as $h)
{{-- modal lihat --}}
<div class="modal fade modal-fall" id="hama{{$h->id}}" aria-hidden="true" aria-labelledby="exampleModalTitle"
    role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Solusi</h4>
            </div>
            <div class="modal-body">
                {!! $h->solusi !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
{{-- modal edit --}}
<div class="modal fade modal-fall" id="hamaEdit{{$h->id}}" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Edit Hama dan Solusi</h4>
            </div>
            <div class="modal-body">
                <form autocomplete="off" action="{{route('hama.edit',$h->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group form-material @error('nama_hama') has-danger @enderror" data-plugin="formMaterial">
                        <label class="form-control-label" for="hama">Nama Hama</label>
                    <input type="text" class="form-control" id="hama" value="{{$h->nama_hama}}" name="nama_hama" placeholder="Nama Hama">
                    @error('nama_hama')
                    <span class="text-danger">{{$message}}</span>
                    @enderror        
                </div>
                    <div class="form-group form-material @error('solusi') has-danger @enderror" data-plugin="formMaterial">
                        <label class="form-control-label" for="solusi">Solusi</label>
                        <textarea id="summernote" data-plugin="summernote" class="form-control" id="solusi"
                    name="solusi" rows="3">{{$h->solusi}}</textarea>
                    @error('solusi')
                    <span class="text-danger">{{$message}}</span>
                    @enderror            
                </div>
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
{{-- modal lihat --}}
<div class="modal fade modal-fall" id="hamaHapus{{$h->id}}" aria-hidden="true" aria-labelledby="exampleModalTitle"
    role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Delete Hama</h4>
            </div>
            <div class="modal-body">
            <form action="{{route('hama.delete',$h->id)}}" method="POST">
                 @csrf
                 @method('delete')
                <h3 class="text-danger">Apakah Anda Yakin?</h3>
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