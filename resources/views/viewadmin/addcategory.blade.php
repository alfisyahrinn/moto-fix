@extends('viewadmin.layout.temp')

@section('content')
<form action="POST" class=" container-fluid">
<ul class="list-group list-group-flush">
    <li class="list-group-item">
      <div class="mb-3">
        <label for="item" class="form-label"><h4>Category Name</h4></label>
        <input type="text" class="form-control" id="item">
      </div>
    </li> 


<li class="list-group-item">
    <a href="/category" class="btn btn-danger">Back</a>
<button type="submit" class="btn btn-primary">Submit</button>

</ul>
</form>
@endsection