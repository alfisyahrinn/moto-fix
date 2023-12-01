<form action="{{ route('price.update', $data->id) }}"
  method="POST" style="display: inline;" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="modal fade" id="EditModal{{ $data->id }}" tabindex="-1"
      role="dialog" aria-labelledby="editModalLabel{{ $data->id }}"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel{{ $data->id }}">
                      Edit Price</h5>
                  <button type="button" class="close" data-dismiss="modal"
                      aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="mb-3">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">
                        <div class="mb-3">
                          <label for="name" class="form-label"><h4> Name</h4></label>
                          <input type="text" class="form-control" id="name" name="name" value="{{ old('name',$data->name) }}" style="width: 250px">
                        </div>
                      </li> 
                      <li class="list-group-item">
                        <label for="price" class="form-label"><h4>Price </h4></label>
                        <div class="input-group mb-3" style="width: 250px">
                          
                          <span class="input-group-text">Rp</span>
                          <input type="number" id="price" name="price" class="form-control"  value="{{ old('name',$data->price) }}">
                          <span class="input-group-text" >.00</span>
                        </div>
                          
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success">Save</button>
              </div>
          </div>
      </div>

</form>