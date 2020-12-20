   <!-- Modal edit-->
   <div class="modal fade modal-fall" id="create" aria-hidden="true" aria-labelledby="exampleModalTitle"
    role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title">Edit Komentar</h4>
        </div>
        <div class="modal-body">
        <form action="{{route('point.create')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group form-material floating @error('nominal') has-danger @enderror" data-plugin="formMaterial">
                <select name="nominal" class="form-control">
                  <option value="50">50</option>
                  <option value="100">100</option>
                  <option value="150">150</option>
                  <option value="200">200</option>
                  <option value="250">250</option>
                </select>
                <label class="floating-label">Nominal</label>
                @error('nominal')
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