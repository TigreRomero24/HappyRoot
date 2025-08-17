@extends('layouts.layout')

@section('title', 'Home - New Order')

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
    <li class="list-group-item active">
      <i class="fas fa-shopping-cart mr-2"></i> Orders
    </li>
      <a href="my_account_edit.html" class="list-group-item list-group-item-action">
        <i class="fas fa-user-edit mr-2"></i> Edit My Information
      </a>
    <li class="list-group-item">
      <i class="fas fa-headset mr-2"></i> Support
    </li>
  </ul>
</div>
            </div>
    </div>
  </div>


  
  <div class="container-fluid col-sm-8 der rounded shadow p-3 ml-5">
<h1 class="container-fluid text-center">New Order</h1>
    


<div class="container-fluid row no-gutters">
  <div class="col-sm-4 pr-1">
    <select class="form-control" id="shippingCountry" required>
      <option value="" disabled selected>Select shipping country</option>
                <option value="AF">Afghanistan</option>
                <option value="AL">Albania</option>
                <option value="DZ">Algeria</option>
                <option value="AR">Argentina</option>
                <option value="AU">Australia</option>
                <option value="AT">Austria</option>
                <option value="BD">Bangladesh</option>
                <option value="BE">Belgium</option>
                <option value="BO">Bolivia</option>
                <option value="BR">Brazil</option>
                <option value="BG">Bulgaria</option>
                <option value="CA">Canada</option>
                <option value="CL">Chile</option>
                <option value="CN">China</option>
                <option value="CO">Colombia</option>
                <option value="CR">Costa Rica</option>
                <option value="HR">Croatia</option>
                <option value="CZ">Czech Republic</option>
                <option value="DK">Denmark</option>
                <option value="DO">Dominican Republic</option>
                <option value="EC">Ecuador</option>
                <option value="EG">Egypt</option>
                <option value="SV">El Salvador</option>
                <option value="FI">Finland</option>
                <option value="FR">France</option>
                <option value="DE">Germany</option>
                <option value="GR">Greece</option>
                <option value="GT">Guatemala</option>
                <option value="HN">Honduras</option>
                <option value="HK">Hong Kong</option>
                <option value="HU">Hungary</option>
                <option value="IN">India</option>
                <option value="ID">Indonesia</option>
                <option value="IE">Ireland</option>
                <option value="IL">Israel</option>
                <option value="IT">Italy</option>
                <option value="JP">Japan</option>
                <option value="KE">Kenya</option>
                <option value="KR">South Korea</option>
                <option value="MY">Malaysia</option>
                <option value="MX">Mexico</option>
                <option value="NL">Netherlands</option>
                <option value="NZ">New Zealand</option>
                <option value="NO">Norway</option>
                <option value="PA">Panama</option>
                <option value="PY">Paraguay</option>
                <option value="PE">Peru</option>
                <option value="PH">Philippines</option>
                <option value="PL">Poland</option>
                <option value="PT">Portugal</option>
                <option value="PR">Puerto Rico</option>
                <option value="RO">Romania</option>
                <option value="RU">Russia</option>
                <option value="SA">Saudi Arabia</option>
                <option value="RS">Serbia</option>
                <option value="SG">Singapore</option>
                <option value="ZA">South Africa</option>
                <option value="ES">Spain</option>
                <option value="SE">Sweden</option>
                <option value="CH">Switzerland</option>
                <option value="TW">Taiwan</option>
                <option value="TH">Thailand</option>
                <option value="TR">Turkey</option>
                <option value="UA">Ukraine</option>
                <option value="AE">United Arab Emirates</option>
                <option value="GB">United Kingdom</option>
                <option value="US">United States</option>
                <option value="UY">Uruguay</option>
                <option value="VE">Venezuela</option>
    </select>
  </div>

  <div class="col-sm-8 pl-1">
    <div class="form-group mb-0">
      <input type="text" class="form-control" id="shippingAddress" placeholder="Enter your shipping address" required>
    </div>
  </div>



</div>

  <div>
     <hr style="border: none; height: 1px; background-color: #ccc;">
  </div>


<!-- Contenedor de productos -->
<!-- Línea principal con ID -->
<div id="product-section">
  <div id="product-list" class="container-fluid row product-row mt-1">
    <div class="col-sm-3">
      <select name="product" class="form-control">
        <option value="">Select a product</option>
        <option>Yuca Chips - Barbecue</option>
        <option>Yuca Chips - Lemon & Salt</option>
        <option>Yuca Chips - Sea Salt</option>
        <option>Yuca Chips - Chili & Lemon</option>
        <option>Green Plantain - Sea Salt</option>
        <option>Green Plantain - Lemon & Salt</option>
        <option>Green Plantain - Chili & Lemon</option>
        <option>Ripe Plantain - Natural</option>
        <option>Root Mix - Natural</option>
      </select>
    </div>

    <div class="col-sm-2">
      <select class="form-control unit-select">
        <option value="150">Pallets</option>
        <option value="20">Cajas</option>
      </select>
    </div>

    <div class="col-sm-2">
      <input type="number" class="form-control unit-quantity" min="0" placeholder="Cantidad">
    </div>

    <div class="col-sm-2">
      <input type="text" class="form-control product-price" readonly>
    </div>

    <div class="col-sm-2">
      <button id="addProductBtn" class="btn btn-success btn-sm">
        <i class="fas fa-plus"></i> Add New Product
      </button>
    </div>
  </div>
</div>

<!-- Total y botón enviar -->
<div class="container-fluid mt-3">
  <div class="row justify-content-between align-items-end">
    <!-- Botón de cancelar pedido con link -->
    <div class="col-md-3">
      <a href="orders.html" class="btn btn-outline-danger w-100">
        <i class="fas fa-times"></i> Cancelar Pedido
      </a>
    </div>

    <!-- Total general -->
    <div class="col-md-4">
      <label><strong>Total general:</strong></label>
      <input type="text" id="totalPrice" class="form-control" readonly>
    </div>

    <!-- Botón de enviar -->
    <div class="col-md-3 d-flex align-items-end">
      <button id="submitOrderBtn" class="btn btn-primary w-100">
        Enviar Pedido
      </button>
    </div>
  </div>
</div>


<!-- JS -->
<script>
  const productSection = document.getElementById('product-section');
  const productList = document.getElementById('product-list');
  const addProductBtn = document.getElementById('addProductBtn');

  // Función para actualizar el total general
  function updateTotal() {
    let total = 0;
    const allPrices = document.querySelectorAll('.product-price');
    allPrices.forEach(input => {
      const val = parseFloat(input.value.replace('$', '')) || 0;
      total += val;
    });
    document.getElementById('totalPrice').value = `$${total.toFixed(2)}`;
  }

  // Función para calcular precio
  function calculateLinePrice(select, quantityInput, output) {
    const pricePerUnit = parseFloat(select.value);
    const quantity = parseInt(quantityInput.value) || 0;
    const total = pricePerUnit * quantity;
    output.value = `$${total.toFixed(2)}`;
    updateTotal();
  }

  // Evento en la línea principal
  const mainUnitSelect = productList.querySelector('.unit-select');
  const mainQuantityInput = productList.querySelector('.unit-quantity');
  const mainPriceOutput = productList.querySelector('.product-price');

  mainUnitSelect.addEventListener('change', () => {
    calculateLinePrice(mainUnitSelect, mainQuantityInput, mainPriceOutput);
  });

  mainQuantityInput.addEventListener('input', () => {
    calculateLinePrice(mainUnitSelect, mainQuantityInput, mainPriceOutput);
  });

  // Agregar nuevas líneas
  addProductBtn.addEventListener('click', function () {
    const newRow = document.createElement('div');
    newRow.className = 'container-fluid row product-row mt-1';

    newRow.innerHTML = `
      <div class="col-sm-3">
        <select name="product" class="form-control">
          <option value="">Select a product</option>
          <option>Chips de Yuca Original</option>
          <option>Chips de Yuca Picante</option>
          <option>Chips de Ñampi</option>
          <option>Chips de Malanga</option>
          <option>Chips Mixtos</option>
          <option>Chips de Yuca Barbacoa</option>
          <option>Chips de Ñampi Picante</option>
          <option>Chips de Malanga Picante</option>
          <option>Chips Mixtos Picantes</option>
        </select>
      </div>

      <div class="col-sm-2">
        <select class="form-control unit-select">
          <option value="150">Pallets</option>
          <option value="20">Cajas</option>
        </select>
      </div>

      <div class="col-sm-2">
        <input type="number" class="form-control unit-quantity" min="0" placeholder="Cantidad">
      </div>

      <div class="col-sm-2">
        <input type="text" class="form-control product-price" readonly>
      </div>

      <div class="col-sm-2">
        <button class="btn btn-danger btn-sm remove-row">
          <i class="fas fa-trash-alt"></i> Eliminar
        </button>
      </div>
    `;

    productSection.appendChild(newRow);

    const unitSelect = newRow.querySelector('.unit-select');
    const quantityInput = newRow.querySelector('.unit-quantity');
    const priceOutput = newRow.querySelector('.product-price');
    const removeBtn = newRow.querySelector('.remove-row');

    unitSelect.addEventListener('change', () => {
      calculateLinePrice(unitSelect, quantityInput, priceOutput);
    });

    quantityInput.addEventListener('input', () => {
      calculateLinePrice(unitSelect, quantityInput, priceOutput);
    });

    removeBtn.addEventListener('click', function () {
      newRow.remove();
      updateTotal();
    });
  });

  // Botón de enviar pedido
  document.getElementById('submitOrderBtn').addEventListener('click', function () {
    alert('Pedido enviado exitosamente 🎉');
    // Aquí puedes añadir lógica para enviar los datos a un servidor o procesarlos
  });
</script>





</div>

</div>
</div>
<div>



</div>

  </div>
</div>
</div>






<div style="height: 50px;"></div>

      <!-- Footer -->

@endsection
