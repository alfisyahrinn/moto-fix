@extends('admin.layouts.temp')

@section('content')
<div class=" container-fluid">


<form class="card" >
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        <div class="mb-3">
          <label for="item" class="form-label"><h4>Item Name</h4></label>
          <input type="text" class="form-control" id="item">
        </div>
      </li> 

      <li class="list-group-item">
        <div class="mb-3">
          <label for="item" class="form-label"><h4>Stock</h4></label>
          <input type="number" class="form-control" id="item">
        </div>
      </li> 

      <li class="list-group-item">
        <select class="form-select" aria-label="Default select example">
          <option selected>Select Category</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>

        <select class="form-select" aria-label="Default select example">
          <option selected>Select Suplier</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
    </li> 



      <li class="list-group-item">
            <a href="/storage" class="btn btn-danger">Back</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </li>

    </ul>

</form>


</div>
@endsection