<!-- Categroy 1 -->
<div class=" tab-pane animation-fade" id="category-4" role="tabpanel">
    <div class="panel-group panel-group-simple panel-group-continuous" id="accordion3" aria-multiselectable="true"
        role="tablist">
        <!-- Question 1 -->
        <div class="panel">
            <div class="panel-heading" id="question-15" role="tab">
                <a class="panel-title" aria-controls="answer-15" aria-expanded="true" data-toggle="collapse"
                    href="#answer-15" data-parent="#accordion3">
                    Setting Rule
                </a>
            </div>
            <div class="panel-collapse collapse show" id="answer-15" aria-labelledby="question-15" role="tabpanel">
                <div class="panel-body">
                    <div class="float-right">
                        <button data-target="#rule" data-toggle="modal" type="button"
                            class="btn btn-floating btn-info btn-sm waves-effect waves-classic"><i class="icon md-plus"
                                aria-hidden="true"></i></button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">rule</th>
                                <th scope="col">Hama dan Solusi</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rule as $i=>$r)
                            <tr>
                                <td scope="row">{{$i+1}}</td>
                                <td>{{$r->rule}}</td>
                                <td>{{$r->hama->kode}}</td>
                                <td>
                                    <div>
                                        <button  data-target="#editrule{{$r->id}}" data-toggle="modal" type="button" class="btn btn-round btn-warning btn-pill-left waves-effect waves-classic">Edit</button>
                                    <form onsubmit="return confirm('apakah anda yakin?')" action="{{route('rule.delete',$r->id)}}" method="post" style="display: inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-round btn-danger btn-pill-right waves-effect waves-classic">Delete</button>
                                    </form>
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
<div class="modal fade modal-fall" id="rule" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Setting Rule</h4>
            </div>
            <div class="modal-body">
            <form autocomplete="off" action="{{route('rule.create')}}" method="POST">
                @csrf
                <div class="form-group form-material floating" data-plugin="formMaterial">
                    <select name="hama" class="form-control">
                    @foreach ($hama as $h)
                    <option value="{{$h->id}}">{{$h->kode}}-{{$h->nama_hama}}</option>
                    @endforeach
                    </select>
                    <label class="floating-label">Hama dan Solusi</label>
                  </div>
                        <div class="form-group form-material @error('rule') has-danger @enderror" data-plugin="formMaterial">
                            <label class="form-control-label" for="rule">rule</label>
                            <textarea class="form-control" id="rule" name="rule" placeholder="example:GD1,GD2"></textarea>
                                @error('rule')
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
@foreach ($rule as $r)
    <!-- Modal add kategori gejala-->
<div class="modal fade modal-fall" id="editrule{{$r->id}}" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog"
tabindex="-1">
<div class="modal-dialog modal-simple">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Edit Rule</h4>
        </div>
        <div class="modal-body">
        <form autocomplete="off" action="{{route('rule.update',$r->id)}}" method="POST">
            @csrf
            @method('put')
            <div class="form-group form-material floating" data-plugin="formMaterial">
                <select name="hama" class="form-control">
                @foreach ($hama as $h)
                <option value="{{$h->id}}" {!! $r->hama_id == $h->id ? 'selected' : null !!}>{{$h->kode}}-{{$h->nama_hama}}</option>
                @endforeach
                </select>
                <label class="floating-label">Hama dan Solusi</label>
              </div>
                    <div class="form-group form-material @error('rule') has-danger @enderror" data-plugin="formMaterial">
                        <label class="form-control-label" for="rule">rule</label>
                    <textarea class="form-control" id="rule" name="rule" placeholder="example:GD1,GD2">{{$r->rule}}</textarea>
                            @error('rule')
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
@endforeach
