@extends('layouts.layout')

@section('title', 'Home - My Account')

@section('content')


<div style="height: 30px;"></div>

 <!-- Espacio de Cuerpo -->

<div class="container-fluid">
     <!-- Columna Izquierda -->
<div class="row">
  <div class="col-sm-3 border rounded shadow p-3 ml-5">
    <div class="row">
            <div class="container my-4">
    <h1 class="container-fluid text-center account-title">Account data</h1>

            <div class="row align-items-center">
                <div class="col-auto text-center">
                    <img src="img/empresas/logo_crfarm.png" alt="Company Logo" width="150" height="150" class="img-fluid border rounded shadow p-2">
                </div>
                <div class="col d-flex justify-content-between align-items-center" style="max-width: 600px;">
                <div>
                    <h5 class="mb-1 mt-3">Company Name: <strong>Happy Roots</strong></h5>
                    <p class="mb-0 mt-3">Email: <a href="mailto:info@happyroots.com">info@happyroots.com</a></p>
                    <div>
                        <a href="login.html" class="btn btn-danger mt-2">Log Out</a>
                    </div>
                </div>
                
                </div>
            </div>

            <hr style="border: none; height: 2px; background-color: #ccc;">

<div class="container my-4">
  <ul class="list-group" id="menuList">
    <li class="list-group-item ">
<a href="orders.html" class="text-decoration-none" style="color: inherit;">
  <i class="fas fa-shopping-cart mr-2"></i> Orders
</a>
    </li>
    <li class="list-group-item active">
      <i class="fas fa-user-edit mr-2"></i> Edit My Information
    </li>
    <li class="list-group-item">
      <i class="fas fa-headset mr-2"></i> Support
    </li>
  </ul>
</div>
            </div>
    </div>
  </div>


  
  <div class="container-fluid col-sm-8 der rounded shadow p-3 ml-5">

 <h1 class="container-fluid text-center account-title mt-4">Edit account data</h1>
 <hr style="border: none; height: 2px; background-color: #ccc;">
  <div class="container col-sm-6 my-4 mt-5">
  <div class="row mb-2 align-items-center">
    <div class="col-md-4 font-weight-bold">Username</div>
    <div class="col-md-5" id="data-username">john_doe123</div>
    <div class="col-md-3 text-right">
      <button class="btn btn-sm btn-primary edit-btn" data-target="data-username">
        <i class="fas fa-edit"></i> Edit
      </button>
    </div>
  </div>

  <div class="row mb-2 align-items-center">
    <div class="col-md-4 font-weight-bold">Password</div>
    <div class="col-md-5" id="data-password">••••••••</div>
    <div class="col-md-3 text-right">
      <button class="btn btn-sm btn-primary edit-btn" data-target="data-password">
        <i class="fas fa-edit"></i> Edit
      </button>
    </div>
  </div>

  <div class="row mb-2 align-items-center">
    <div class="col-md-4 font-weight-bold">Email</div>
    <div class="col-md-5" id="data-email">john@example.com</div>
    <div class="col-md-3 text-right">
      <button class="btn btn-sm btn-primary edit-btn" data-target="data-email">
        <i class="fas fa-edit"></i> Edit
      </button>
    </div>
  </div>

  <div class="row mb-2 align-items-center">
    <div class="col-md-4 font-weight-bold">Company</div>
    <div class="col-md-5" id="data-company">Happy Roots Ltd.</div>
    <div class="col-md-3 text-right">
      <button class="btn btn-sm btn-primary edit-btn" data-target="data-company">
        <i class="fas fa-edit"></i> Edit
      </button>
    </div>
  </div>

  <div class="row mb-2 align-items-center">
    <div class="col-md-4 font-weight-bold">Country</div>
    <div class="col-md-5" id="data-country">Costa Rica</div>
    <div class="col-md-3 text-right">
      <button class="btn btn-sm btn-primary edit-btn" data-target="data-country">
        <i class="fas fa-edit"></i> Edit
      </button>
    </div>
  </div>

  <div class="row mb-2 align-items-center">
    <div class="col-md-4 font-weight-bold">Contact</div>
    <div class="col-md-5" id="data-contact">+506 1234 5678</div>
    <div class="col-md-3 text-right">
      <button class="btn btn-sm btn-primary edit-btn" data-target="data-contact">
        <i class="fas fa-edit"></i> Edit
      </button>
    </div>
  </div>
</div>

<script>
document.querySelectorAll(".edit-btn").forEach(button => {
  button.addEventListener("click", function () {
    let targetId = this.getAttribute("data-target");
    let targetElement = document.getElementById(targetId);

    if (this.textContent.trim() === "Edit") {
      let currentValue = targetElement.textContent.trim();
      targetElement.innerHTML = `<input type="text" class="form-control" value="${currentValue}">`;
      this.innerHTML = `<i class="fas fa-save"></i> Save`;
    } else {
      let inputValue = targetElement.querySelector("input").value;
      targetElement.textContent = inputValue;
      this.innerHTML = `<i class="fas fa-edit"></i> Edit`;
    }
  });
});
</script>

  </div>
</div>
</div>

<div style="height: 50px;"></div>

      <!-- Footer -->

@endsection
