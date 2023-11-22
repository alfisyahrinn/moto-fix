@extends('viewadmin.layout.temp')
@section('content')
<div class=" container-fluid">


<form class="card" >
    <ul class="list-group list-group-flush">
      <li class="list-group-item">Name : Yunus</li> 
      <li class="list-group-item">Plate Nomor : PR 1234 LWS</li>
      <li class="list-group-item"><p>Problem :</p>
        <p> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea saepe non cum! Vel officia suscipit fuga nisi sapiente nemo quam exercitationem doloribus adipisci ad! Quo labore, cumque dolore sunt odit repellendus laborum neque dolorum, reprehenderit quia optio iusto minima, eaque fuga excepturi tempora sint ab voluptatem distinctio magnam? Quidem eveniet excepturi enim dicta quaerat! Explicabo distinctio asperiores, maxime est officiis minus quas cumque soluta omnis aliquam earum vero, minima expedita praesentium aspernatur inventore laborum, provident ducimus fugiat officia corporis ipsa porro doloribus fuga. A quos, necessitatibus, eaque quis reiciendis id magnam voluptate, illo blanditiis minima beatae vel natus. Doloremque, ex!</p>
        </li>
      <li class="list-group-item">

            <div class="form-check">
                <h3>price</h3>
              <input class="form-check-input" type="radio" name="option" id="option1" value="option1">
              <label class="form-check-label" for="auto">
                Auto 
                <select class="form-select form-select-lg mb-3" id="auto  " aria-label="Large select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
              </label>

            </div>
            <div class="form-check ">
              <input class="form-check-input" type="radio" name="option" for="manual " value="option2">
              <label class="form-check-label" for="manual">
                Manual

                <div class="input-group mb-3">
                    <span class="input-group-text">Rp</span>
                    <input type="number" id="manual"  class="form-control" aria-label="Amount (to the nearest dollar)">
                    <span class="input-group-text">.00</span>
                  </div>
              </label>
      </li>

      <li class="list-group-item"> STATUS :  <select class="form-select form-select-lg mb-3" aria-label="Large select example">
        <option selected>STATUS</option>
        <option value="1">Pending</option>
        <option value="2">Working</option>
        <option value="3">Done</option>
      </select>
  </label>
      </li>

      <li class="list-group-item">

            <a href="/" class="btn btn-danger">Back</a>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </li>

    </ul>

</form>


</div>
@endsection