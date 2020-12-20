<form action="{{route('pakar.index','hasil')}}" autocomplete="off">
    @foreach ($kategori as $k)
    <div class="form-group form-material floating @error('kategori_gejala') has-danger @enderror" data-plugin="formMaterial">
        <select name="kategori_gejala[]" class="form-control">
            <option value=""></option>
            @foreach ($k->gejala()->get() as $g)
            <option value="{{$g->kode}}">{{$g->nama_gejala}}</option>
            @endforeach
        </select>
        <label class="floating-label">Katgeori Gejala Pada {{$k->nama_kategori}} </label>
        @error('kategori_gejala')
        <span class="text-danger">{{$message}}</span>
        @enderror  
    </div>
    @endforeach
    <button type="submit" class="btn btn-primary btn-block btn-round waves-effect waves-classic">Kirim</button>       
  </form>