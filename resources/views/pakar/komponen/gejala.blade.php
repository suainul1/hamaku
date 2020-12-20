<!-- Categroy 3 -->
<div class="tab-pane animation-fade" id="category-3" role="tabpanel">
    <div class="panel-group panel-group-simple panel-group-continuous" id="accordion1"
        aria-multiselectable="true" role="tablist">
        <!-- Question 8 -->
        <div class="panel">
            <div class="panel-heading" id="question-8" role="tab">
                <a class="panel-title" aria-controls="answer-8" aria-expanded="true"
                    data-toggle="collapse" href="#answer-8" data-parent="#accordion1">
                    Setting Gejala
                </a>
            </div>
            <div class="panel-collapse collapse show" id="answer-8" aria-labelledby="question-8"
                role="tabpanel">
                <div class="panel-body">
                    <div class="float-right">
                        <button data-target="#gejala" data-toggle="modal" type="button"
                            class="btn btn-floating btn-info btn-sm waves-effect waves-classic"><i class="icon md-plus"
                                aria-hidden="true"></i></button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Gejala</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Kode Kategori Gejala</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gejala as $i=>$g)
                            <tr>
                                <td scope="row">{{$i+1}}</td>
                                <td>{{$g->nama_gejala}}</td>
                                <td>{{$g->kode}}</td>
                                <td>{{$g->kategoriGejala->kode}}</td>
                                <td>
                                    <div>
                                        <button  data-target="#gejalaEdit{{$g->id}}" data-toggle="modal" type="button" class="btn btn-round btn-warning btn-pill-left waves-effect waves-classic">Edit</button>
                                    <button data-target="#gejalaDelete{{$g->id}}" data-toggle="modal" type="button" class="btn btn-round btn-danger btn-pill-right waves-effect waves-classic">Delete</button>
                                      </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Question 8 -->
    </div>
</div>
<!-- End Categroy 3 -->
<!-- Modal add gejala-->
<div class="modal fade modal-fall" id="gejala" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Setting Gejala</h4>
            </div>
            <div class="modal-body">
            <form autocomplete="off" action="{{route('gejala.create')}}" method="POST">
                @csrf
                    <div class="form-group form-material @error('nama_gejala') has-danger @enderror" data-plugin="formMaterial">
                        <label class="form-control-label" for="gejala">Nama Gejala</label>
                        <input type="text" class="form-control" id="gejala" name="nama_gejala"
                            placeholder="Nama Gejala">
                            @error('nama_gejala')
                            <span class="text-danger">{{$message}}</span>
                            @enderror             
                    </div>
                    <div class="form-group form-material floating @error('kategori_gejala') has-danger @enderror" data-plugin="formMaterial">
                        <select name="kategori_gejala" class="form-control">
                        @foreach ($kategori as $k)
                        <option value="{{$k->id}}">{{$k->kode}}-{{$k->nama_kategori}}</option>
                        @endforeach
                        </select>
                        <label class="floating-label">Katgeori Gejala</label>
                        @error('kategori_gejala')
                        <span class="text-danger">{{$message}}</span>
                        @enderror  
                    </div>
                    <div class="form-group form-material @error('kode') has-danger @enderror" data-plugin="formMaterial">
                        <label class="form-control-label" for="kategorigejala">Kode</label>
                        <input type="text" class="form-control" id="kategorigejala" value="{{$k->kode}}" name="kode"
                        placeholder="kode">
                        @error('kode')
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
@foreach ($gejala as $g)
    <!-- Modal edit gejala-->
<div class="modal fade modal-fall" id="gejalaEdit{{$g->id}}" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog"
tabindex="-1">
<div class="modal-dialog modal-simple">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Edit Gejala</h4>
        </div>
        <div class="modal-body">
        <form autocomplete="off" action="{{route('gejala.edit',$g->id)}}" method="POST">
            @csrf
            @method('put')
                <div class="form-group form-material" data-plugin="formMaterial">
                    <label class="form-control-label" for="gejala">Nama Gejala</label>
                <input type="text" class="form-control" value="{{$g->nama_gejala}}" id="gejala" name="nama_gejala"
                        placeholder="Nama Gejala">
                </div>
                <div class="form-group form-material floating" data-plugin="formMaterial">
                    <select name="kategori_gejala" class="form-control">
                    @foreach ($kategori as $k)
                    <option value="{{$k->id}}" {{$g->kategori_gejala_id == $k->id ? 'selected' : null}}>{{$k->kode}}-{{$k->nama_kategori}}</option>
                    @endforeach
                    </select>
                    <label class="floating-label">Katgeori Gejala</label>
                  </div>
                  <div class="form-group form-material @error('kode') has-danger @enderror" data-plugin="formMaterial">
                    <label class="form-control-label" for="kategorigejala">Kode</label>
                    <input type="text" class="form-control" id="kategorigejala" value="{{$g->kode}}" name="kode"
                    placeholder="kode">
                    @error('kode')
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
   <!-- Modal edit gejala-->
   <div class="modal fade modal-fall" id="gejalaDelete{{$g->id}}" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            <h4 class="modal-title">Hapus Gejala {{$g->nama_gejala}}</h4>
            </div>
            <div class="modal-body">
            <form autocomplete="off" action="{{route('gejala.delete',$g->id)}}" method="POST">
                @csrf
                @method('delete')
                    <h3 class="text-danger">Apakah anda yakin?</h3>
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