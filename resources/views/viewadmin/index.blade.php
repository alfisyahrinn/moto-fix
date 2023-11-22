@extends('viewadmin.layout.temp')

@section('content')


     <!-- Begin Page Content -->
     <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

    <table class="table table-bordered table-hover">
        <tr>
            <td class="col-1">ID</td>
            <td>Name</td>
            <td>plate nomor</td>
            <td class="col-2">Status</td>
            <td class="col-2">Edit</td>
        </tr>

     {{-- @foreach ($collection as $item) --}}
         
 
    <tr>
        <td>1</td>
        <td>
            <p> agus tinus</p>
        </td>
        <td> PR 1234 LWS </td>
        <td >
            <p class="btn btn-sm btn-warning rounded-pill px-3"> PENDING </p>
        </td>
        <td>
            <a href="/editqueue"  class="btn btn-sm btn-primary rounded-pill px-3">  <i class="fas fa-pen-square"> Edit </i></a>
        </td>
    </tr>
    {{-- @endforeach   --}}
</table>





        
@endsection