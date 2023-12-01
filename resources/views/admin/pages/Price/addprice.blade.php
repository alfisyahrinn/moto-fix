<form action="/admin/price" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Create New Price') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class=" modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <div class="mb-3">
                        <label for="name" class="form-label"><h4> Name</h4></label>
                        <input type="text" class="form-control" id="name" name="name" style="width: 250px">
                      </div>
                    </li> 
                
                    <li class="list-group-item">
                      <label for="price" class="form-label"><h4>Price </h4></label>
                      <div class="input-group mb-3" style="width: 250px">
                        <span class="input-group-text">Rp</span>
                        <input type="number" id="price" name="price" class="form-control" aria-label="Amount (to the nearest Rupiah)">
                        <span class="input-group-text">.00</span>
                      </div>
                    </li> 
                  </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>