@extends('layouts.admin')

@section('title', 'Home - Wholesale New Client')

@section('content')

  
  <div class="container-fluid col-sm-8 der rounded shadow p-3 ml-5">


<div class="row ml-3 mt-5">
  <div class="col-sm-6">
    <form>
      <div class="form-group">
        <label for="user">User</label>
        <input type="text" class="form-control" id="user" placeholder="Enter username">
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Enter password">
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email">
      </div>

      <div class="form-group">
        <label for="company">Company</label>
        <input type="text" class="form-control" id="company" placeholder="Enter company name">
      </div>

      <div class="form-group">
        <label for="country">Country</label>
        <select class="form-control" id="country">
          <option value="">Select country</option>
          <option>United States</option>
          <option>Canada</option>
          <option>Mexico</option>
          <option>Brazil</option>
          <option>United Kingdom</option>
          <option>Germany</option>
          <option>France</option>
          <option>Spain</option>
          <option>Italy</option>
          <option>Argentina</option>
          <option>Colombia</option>
          <option>Chile</option>
          <option>Ecuador</option>
          <option>Peru</option>
          <option>Costa Rica</option>
        </select>
      </div>

      <div class="form-group">
        <label for="contact">Contact</label>
        <input type="text" class="form-control" id="contact" placeholder="Enter contact number or name">
      </div>
    </form>
  </div>

<div class="col-sm-4">
  <div class="form-group">
    <label for="price-level">Price Level</label>
    <select class="form-control" id="price-level">
      <option value="">Select Price Level</option>
      <option>Wholesale Price 1</option>
      <option>Wholesale Price 2</option>
      <option>Wholesale Price 3</option>
      <option>Distributor Price 1</option>
      <option>Distributor Price 2</option>
      <option>Retailer Price 1</option>
      <option>Retailer Price 2</option>
      <option>Corporate Price 1</option>
      <option>Corporate Price 2</option>
      <option>Partner Price</option>
      <option>Reseller Price</option>
      <option>Agent Price</option>
      <option>Key Account Price</option>
      <option>VIP Customer Price</option>
      <option>Special Contract Price</option>
    </select>
  </div>
</div>

</div>








<div class="container d-flex flex-column" style="min-height: 300px;">
  <div class="flex-grow-1">
    <!-- Aquí va tu contenido, por ejemplo la tabla -->
  </div>
  <div class="text-right mt-3 mb-3">
    <button class="btn btn-success">
      <a href="wholesale_add_new_client.html" class="text-decoration-none" style="color: inherit;">
        <i class="fas fa-plus"></i> Add New Client
      </a>
    </button>
  </div>
</div>
  </div>
</div>
</div>






<div style="height: 50px;"></div>

      <!-- Footer -->

@endsection
