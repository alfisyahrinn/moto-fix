@extends('admin.layouts.temp')

@section('content')
<form action="POST" class=" container-fluid">
<ul class="list-group list-group-flush">
    <li class="list-group-item">
      <div class="mb-3">
        <label for="pricename" class="form-label"><h4>Price Name</h4></label>
        <input type="text" class="form-control" id="pricename">
      </div>
    </li> 

    <li class="list-group-item">
      <label for="price" class="form-label"><h4>Price </h4></label>
      <div class="input-group mb-3">
        <span class="input-group-text">Rp</span>
        <input type="number" id="price" class="form-control" aria-label="Amount (to the nearest dollar)">
        <span class="input-group-text">.00</span>
      </div>
   
    </li> 


<li class="list-group-item">
    <a href="/price" class="btn btn-danger">Back</a>
<button type="submit" class="btn btn-primary">Submit</button>

</ul>
</form>
@endsection