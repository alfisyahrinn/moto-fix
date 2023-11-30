<!-- Edit Modal -->
<form action="{{ route('supplier.update', $data->id) }}"
    method="POST" style="display: inline;">
    @csrf
    @method('PUT')
    <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1"
        role="dialog" aria-labelledby="editModalLabel{{ $data->id }}"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $data->id }}">
                        Edit Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $data->name) }}">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#aditModal">Save</button>
                </div>
            </div>
        </div>

</form>