@extends('viewadmin.layout.temp')

@section('content')


     <!-- Begin Page Content -->
     <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Storage</h1>
        </div>
        
    <div class="card">
      <div class="card-header bg-gray">
          <button type="button" class="btn btn-sm btn-primary rounded-pill px-3" onclick="window.location='{{ url('additem') }}'" >
              <i class="fas fa-plus-circle"> Add</i>
          </button>
      </div>
  </div>

    <table class="table table-bordered table-hover">
        <tr>
            <td class="col-1">ID</td>
            <td>Name</td>
            <td>Category</td>
            <td>Suplier</td>
            <td class="col-1">Stock</td>
            <td class="col-2">Edit</td>
            <td class="col-2">Delete</td>
        </tr>

     {{-- @foreach ($collection as $item) --}}
         
 
    <tr>
        <td>1</td>
        <td> Oli bekas </td>
        <td>Oli</td> 
        <td> yamaha </td>
        <td> 64 </td>
        <td> <a href="#" class="btn btn-sm btn-primary rounded-pill px-3">  <i class="fas fa-pen-square"> Edit </i></a></td>
        <td><button class="btn btn-sm btn-danger rounded-pill px-3"> <i class="fas fa-times-circle"> Hapus </i> </button> </td>
    </tr>
    {{-- @endforeach   --}}
</table>
 
@endsection