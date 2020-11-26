<form action="{{route('pakar.index','gejala')}}" autocomplete="off">
    <div class="form-group form-material floating @error('kategori_gejala') has-danger @enderror" data-plugin="formMaterial">
        <select name="kategori_gejala" class="form-control">
        @foreach ($kategori as $k)
        <option value="{{$k->id}}">{{$k->nama_kategori}}</option>
        @endforeach
        </select>
        <label class="floating-label">Katgeori Gejala</label>
        @error('kategori_gejala')
        <span class="text-danger">{{$message}}</span>
        @enderror  
    </div>
    <button type="submit" class="btn btn-primary btn-block btn-round waves-effect waves-classic">Kirim</button>
                
  </form>