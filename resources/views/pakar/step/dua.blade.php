<form action="{{route('pakar.index','hasil')}}" autocomplete="off">
    <div class="form-group form-material floating @error('gejala') has-danger @enderror" data-plugin="formMaterial">
        <select name="gejala" class="form-control">
        @foreach ($gejala as $k)
        <option value="{{$k->id}}">{{$k->nama_gejala}}</option>
        @endforeach
        </select>
        <label class="floating-label">Katgeori Gejala</label>
        @error('gejala')
        <span class="text-danger">{{$message}}</span>
        @enderror  
    </div>
    <button type="submit" class="btn btn-primary btn-block btn-round waves-effect waves-classic">Kirim</button>
                
  </form>