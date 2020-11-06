@extends('layouts.master',['title' => 'All User','body' => 'page-user'])
@section('head')
<link rel="stylesheet" href="{{asset('assets/examples/css/pages/user.css')}}">
<link rel="stylesheet" href="{{asset('assets/examples/css/uikit/modals.css')}}">
@endsection
@section('content')
<div class="page">
    <div class="page-content">
      <div class="row mb-5">
        <div class="col-md-12">
            <button data-target="#exampleNiftyFall" data-toggle="modal" type="button" class="btn btn-primary waves-effect waves-classic float-right" id="myButtonAdd"><i class="icon md-plus" aria-hidden="true"></i>Add User</button>
      <!-- Modal -->
      <div class="modal fade modal-fall" id="exampleNiftyFall" aria-hidden="true" aria-labelledby="exampleModalTitle"
      role="dialog" tabindex="-1">
      <div class="modal-dialog modal-simple">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Add User</h4>
          </div>
          <div class="modal-body">
          <form action="{{route('user.add')}}" method="POST" >
              @csrf
              <div class="form-group form-material @error('nama') has-danger @enderror" data-plugin="formMaterial">
                  <label class="form-control-label" for="inputText">Nama</label>
              <input type="text" class="form-control" id="inputText" value="{{old('nama')}}" name="nama" placeholder="Nama">
              @error('nama')
          <span class="text-danger">{{$message}}</span>
          @enderror
                </div>
                <span class="text-info">Nb:Profesi diisi khusus Ahli tani</span>
                <div class="form-group form-material @error('profesi') has-danger @enderror" data-plugin="formMaterial">
                  <label class="form-control-label" for="inputText">Profesi</label>
              <input type="text" class="form-control" id="inputText" value="{{old('profesi')}}" name="profesi" placeholder="Profesi">
              @error('profesi')
          <span class="text-danger">{{$message}}</span>
          @enderror
                </div>
            <div class="form-group form-material @error('email') has-danger @enderror" data-plugin="formMaterial">
              <label class="form-control-label" for="inputText">E-mail</label>
          <input type="email" class="form-control" id="inputText" value="{{old('email')}}" name="email" placeholder="E-mail">
          @error('email')
      <span class="text-danger">{{$message}}</span>
      @enderror
            </div>
            <div class="form-group form-material @error('password') has-danger @enderror" data-plugin="formMaterial">
              <label class="form-control-label" for="inputPassword">Password</label>
              <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
              @error('password')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="form-group form-material" data-plugin="formMaterial">
              <label class="form-control-label" for="inputPassword">Ulangi Password</label>
              <input type="password" class="form-control" id="inputPassword" name="password_confirmation" placeholder="Password">
            </div>
            <div class="form-group form-material @error('alamat') has-danger @enderror" data-plugin="formMaterial">
              <label class="form-control-label" for="textarea">Alamat</label>
            <textarea class="form-control" id="textarea" name="alamat" rows="3">{{old('alamat')}}</textarea>
              @error('alamat')
              <span class="text-danger">{{$message}}</span>
            
            @enderror
            </div>
            <div class="form-group form-material floating @error('jenis_kelamin') has-danger @enderror" data-plugin="formMaterial">
              <select name="jenis_kelamin" class="form-control">
                <option value="pria" {{old('jenis_kelamin') == 'pria' ? 'checked' : null}}>Laki-Laki</option>
                <option value="wanita" {{old('jenis_kelamin') == 'wanita' ? 'checked' : null}}>Perempuan</option>
              </select>
              <label class="floating-label">Jenis Kelamin</label>
              @error('jenis_kelamin')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
            <div class="form-group form-material floating @error('role') has-danger @enderror" data-plugin="formMaterial">
              <select name="role" class="form-control">
                <option value="admin" {{old('role') == 'admin' ? 'checked' : null}}>Admin</option>
                <option value="ahli_tani" {{old('role') == 'ahli_tani' ? 'checked' : null}}>Ahli Tani</option>
                <option value="petani" {{old('role') == 'petani' ? 'checked' : null}}>Ahli Tani</option>
              
              </select>
              <label class="floating-label">Hak Akses</label>
              @error('role')
              <div class="invalid-feedback">
                {{$message}}
              </div>
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
    </div>
    </div>
      <!-- Panel -->
      <div class="panel">
        <div class="panel-body">
          <form class="page-search-form" role="search">
            <div class="input-search input-search-dark">
              <i class="input-search-icon md-search" aria-hidden="true"></i>
              <input type="text" class="form-control" id="inputSearch" name="search" placeholder="Search Users">
              <button type="button" class="input-search-close icon md-close" aria-label="Close"></button>
            </div>
          </form>

          <div class="nav-tabs-horizontal nav-tabs-animate" data-plugin="tabs">
            <div class="dropdown page-user-sortlist">
              Order By: <a class="dropdown-toggle inline-block" data-toggle="dropdown" href="#" aria-expanded="false">Last Active</a>
              <div class="dropdown-menu animation-scale-up animation-top-right animation-duration-250" role="menu">
                <a class="active dropdown-item" href="javascript:void(0)">Last Active</a>
                <a class="dropdown-item" href="javascript:void(0)">Username</a>
                <a class="dropdown-item" href="javascript:void(0)">Location</a>
                <a class="dropdown-item" href="javascript:void(0)">Register Date</a>
              </div>
            </div>

            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
              <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#all_contacts" aria-controls="all_contacts" role="tab">All Contacts</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane animation-fade active" id="all_contacts" role="tabpanel">
                <ul class="list-group">
                  @foreach ($users as $u)    
                  <li class="list-group-item">
                    
                    <div class="media">

                      <div class="pr-0 pr-sm-20 align-self-center">
                        <div class="avatar avatar-online">
                          <img src="{{asset(Storage::url(is_null($u->image) ? 'user/profile/placeholder.png' : 'user/profile/'.$u->image))}}"" alt="...">
                          <i class="avatar avatar-busy"></i>
                        </div>
                      </div>
                      <div class="media-body align-self-center">
                        <h5 class="mt-0 mb-5">
                          {{Str::title($u->name)}}
                        <small>created at: {{$u->created_at->format('d-M-Y')}}</small>
                        </h5>
                        <p>
                          <i class="icon icon-color md-pin" aria-hidden="true"></i>{{$u->alamat}}
                        </p>
                        <div>
                          <a class="text-action" href="javascript:void(0)">
                        <i class="icon icon-color md-email" aria-hidden="true"></i>
                      </a>
                          <a class="text-action" href="javascript:void(0)">
                        <i class="icon icon-color md-smartphone" aria-hidden="true"></i>
                      </a>
                          <a class="text-action" href="javascript:void(0)">
                        <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                      </a>
                          <a class="text-action" href="javascript:void(0)">
                        <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                      </a>
                          <a class="text-action" href="javascript:void(0)">
                        <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                      </a>
                        </div>
                      </div>
                      <div style="width: 200px" class="pl-0 pl-sm-20 mt-15 mt-sm-0 align-self-center">
                      
                        <button id="myButtonEdit" type="button" @if ((auth()->user()->id == $u->id) || $u->role != 'admin') data-target="#exampleNifty{{$u->id}}" data-toggle="modal" @endif class="btn btn-warning btn-sm waves-effect waves-classic">
                          <i class="icon md-plus" aria-hidden="true"></i>Edit
                        </button>
                        @if ((auth()->user()->id == $u->id) || $u->role != 'admin')
                          <form style="display: inline" action="{{route('user.blokir',$u->id)}}" method="post">
                        @endif
                            @csrf
                        @method('put')
                        <button type="submit" class="btn {{$u->status == 'nonaktif' ? 'btn-danger' : 'btn-success'}} btn-sm waves-effect waves-classic">
                          @if ($u->status == 'nonaktif')
                          <i class="icon md-block-alt" aria-hidden="true"></i>Block
                          @else
                          <i class="icon md-check" aria-hidden="true"></i>Active
                          @endif 
                        </button>
                      </form>
                      </div>
                    </div>
                  </li>
                  @endforeach
                  
                </ul>
                <nav>
                  <ul data-plugin="paginator" data-total="50" data-skin="pagination-no-border" class="pagination pagination-no-border"><li class="pagination-prev page-item disabled"><a class="page-link" href="javascript:void(0)" aria-label="Prev"><span class="icon md-chevron-left"></span></a></li><li class="pagination-items page-item active" data-value="1"><a class="page-link" href="javascript:void(0)">1</a></li><li class="pagination-items page-item" data-value="2"><a class="page-link" href="javascript:void(0)">2</a></li><li class="pagination-items page-item" data-value="3"><a class="page-link" href="javascript:void(0)">3</a></li><li class="pagination-items page-item" data-value="4"><a class="page-link" href="javascript:void(0)">4</a></li><li class="pagination-items page-item" data-value="5"><a class="page-link" href="javascript:void(0)">5</a></li><li class="pagination-next page-item"><a class="page-link" href="javascript:void(0)" aria-label="Next"><span class="icon md-chevron-right"></span></a></li></ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Panel -->
    </div>
  </div>
  @foreach ($users as $u)  
  <!-- Modal -->
<div class="modal fade modal-fall" id="exampleNifty{{$u->id}}" aria-hidden="true" aria-labelledby="exampleModalTitle"
      role="dialog" tabindex="-1">
      <div class="modal-dialog modal-simple">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Add User</h4>
          </div>
          <div class="modal-body">
          <form action="{{route('user.all.update',$u->id)}}" method="POST">
              @csrf
              @method('put')
              <div class="form-group form-material @error('nama') has-danger @enderror" data-plugin="formMaterial">
                  <label class="form-control-label" for="inputText">Nama</label>
              <input type="text" class="form-control" id="inputText" value="{{$u->name}}" name="nama" placeholder="Nama">
              @error('nama')
          <span class="text-danger">{{$message}}</span>
          @enderror
                </div>
                @if ($u->role == 'ahli_tani')
                <span class="text-info">Nb:Profesi diisi khusus Ahli tani</span>
                <div class="form-group form-material @error('profesi') has-danger @enderror" data-plugin="formMaterial">
                  <label class="form-control-label" for="inputText">Profesi</label>
                  <input type="text" class="form-control" id="inputText" value="{{$u->ahliTani->profesi}}" name="profesi" placeholder="Profesi">
                  @error('profesi')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                @endif
            <div class="form-group form-material @error('email') has-danger @enderror" data-plugin="formMaterial">
              <label class="form-control-label" for="inputText">E-mail</label>
            <input type="email" class="form-control" id="inputText" value="{{$u->email}}" name="email" placeholder="E-mail">
          @error('email')
      <span class="text-danger">{{$message}}</span>
      @enderror
            </div>
            <span class="text-danger">Jika Tidak ingin mengganti password harap tidak diisi</span>
            <div class="form-group form-material @error('password') has-danger @enderror" data-plugin="formMaterial">
              <label class="form-control-label" for="inputPassword">Password</label>
              <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
              @error('password')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="form-group form-material" data-plugin="formMaterial">
              <label class="form-control-label" for="inputPassword">Ulangi Password</label>
              <input type="password" class="form-control" id="inputPassword" name="password_confirmation" placeholder="Password">
            </div>
            <div class="form-group form-material @error('alamat') has-danger @enderror" data-plugin="formMaterial">
              <label class="form-control-label" for="textarea">Alamat</label>
            <textarea class="form-control" id="textarea" name="alamat" rows="3">{{$u->alamat}}</textarea>
              @error('alamat')
              <span class="text-danger">{{$message}}</span>
            
            @enderror
            </div>
            <div class="form-group form-material floating @error('jenis_kelamin') has-danger @enderror" data-plugin="formMaterial">
              <select name="jenis_kelamin" class="form-control">
                <option value="pria" {{ $u->jenis_kelamin == 'pria' ? 'selected' : null}}>Laki-Laki</option>
                <option value="wanita" {{ $u->jenis_kelamin == 'wanita' ? 'selected' : null}}>Perempuan</option>
              </select>
              <label class="floating-label">Jenis Kelamin</label>
              @error('jenis_kelamin')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
            <div class="form-group form-material floating @error('role') has-danger @enderror" data-plugin="formMaterial">
              <select name="role" class="form-control">
                <option value="admin" {{$u->role == 'admin' ? 'selected' : null}}>Admin</option>
                <option value="ahli_tani" {{$u->role == 'ahli_tani' ? 'selected' : null}}>Ahli Tani</option>
                <option value="petani" {{$u->role == 'petani' ? 'selected' : null}}>Petani</option>
              
              </select>
              <label class="floating-label">Hak Akses</label>
              @error('role')
              <div class="invalid-feedback">
                {{$message}}
              </div>
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
@endsection
@section('footer')
<script src="{{asset('global/js/Plugin/aspaginator.js')}}"></script>
<script src="{{asset('global/js/Plugin/responsive-tabs.js')}}"></script>
<script src="{{asset('global/js/Plugin/tabs.js')}}"></script>
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
  var button = document.getElementById('myButtonEdit');
button.click();
  }
  }
  
    </script>

@endsection