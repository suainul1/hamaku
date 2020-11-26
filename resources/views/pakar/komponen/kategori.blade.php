<!-- Categroy 1 -->
<div class=" tab-pane animation-fade active" id="category-1" role="tabpanel">
    <div class="panel-group panel-group-simple panel-group-continuous" id="accordion2" aria-multiselectable="true"
        role="tablist">
        <!-- Question 1 -->
        <div class="panel">
            <div class="panel-heading" id="question-1" role="tab">
                <a class="panel-title" aria-controls="answer-1" aria-expanded="true" data-toggle="collapse"
                    href="#answer-1" data-parent="#accordion2">
                    Setting kategori Gejala
                </a>
            </div>
            <div class="panel-collapse collapse show" id="answer-1" aria-labelledby="question-1" role="tabpanel">
                <div class="panel-body">
                    <div class="float-right">
                        <button data-target="#kategori" data-toggle="modal" type="button"
                            class="btn btn-floating btn-info btn-sm waves-effect waves-classic"><i class="icon md-plus"
                                aria-hidden="true"></i></button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">kode kategori Gejala</th>
                                <th scope="col">Nama kategori Gejala</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $i=>$w)
                            <tr>
                                <td scope="row">{{$i+1}}</td>
                                <td>{{$w->kode}}</td>
                                <td>{{$w->nama_kategori}}</td>
                                <td>
                                    <div>
                                        <button  data-target="#kategoriGejala{{$w->id}}" data-toggle="modal" type="button" class="btn btn-round btn-warning btn-pill-left waves-effect waves-classic">Edit</button>
                                    <button data-target="#kategoriGejalaDelete{{$w->id}}" data-toggle="modal" type="button" class="btn btn-round btn-danger btn-pill-right waves-effect waves-classic">Delete</button>
                                      </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Question 1 -->
    </div>
</div>
<!-- End Categroy 1 -->
<!-- Modal add kategori gejala-->
<div class="modal fade modal-fall" id="kategori" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Setting Kategori Gejala</h4>
            </div>
            <div class="modal-body">
            <form autocomplete="off" action="{{route('kategoriGejala.create')}}" method="POST">
                @csrf
                    <div class="form-group form-material @error('nama_kategori') has-danger @enderror" data-plugin="formMaterial">
                        <label class="form-control-label" for="kategorigejala">Nama Katgeori Gejala</label>
                        <input type="text" class="form-control" id="kategorigejala" name="nama_kategori"
                            placeholder="Nama Kategori Gejala">
                            @error('nama_kategori')
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
@foreach ($kategori as $k)
    
{{-- edit --}}
<div class="modal fade modal-fall" id="kategoriGejala{{$k->id}}" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Edit Kategori Gejala</h4>
            </div>
            <div class="modal-body">
                <form autocomplete="off" action="{{route('kategoriGejala.edit',$k->id)}}" method="POST">
                @csrf
                @method('put')
                <div class="form-group form-material @error('nama_kategori') has-danger @enderror" data-plugin="formMaterial">
                    <label class="form-control-label" for="kategorigejala">Nama Katgeori Gejala</label>
                    <input type="text" class="form-control" id="kategorigejala" value="{{$k->nama_kategori}}" name="nama_kategori"
                    placeholder="Nama Kategori Gejala">
                    @error('nama_kategori')
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
{{-- edit --}}
<div class="modal fade modal-fall" id="kategoriGejalaDelete{{$k->id}}" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Delete Kategori Gejala</h4>
            </div>
            <div class="modal-body">
                <form autocomplete="off" action="{{route('kategoriGejala.delete',$k->id)}}" method="POST">
                @csrf
                @method('delete')
                <h3 class="text-danger"> Apakah Anda Yakin?</h3>
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