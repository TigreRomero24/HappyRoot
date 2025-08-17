@extends('layouts.admin')

@section('title', 'Home - Wholesale Admin')

@section('content')

  
  <div class="container-fluid col-sm-8 der rounded shadow p-3 ml-5">


<!-- TABLA -->
 <h1 class="container-fluid text-center mt-3">Wholesale - New Order</h1>


<div class="container mt-4">
  <div class="row">
    
    <!-- Column 1 -->
    <div class="col-md-4">
      
      <!-- Search Client -->
      <div class="form-group">
        <label for="searchClient"><strong>Search Client</strong></label>
        <div class="input-group">
          <input type="text" id="searchClient" class="form-control" placeholder="Enter client name">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i> Search
            </button>
          </div>
        </div>
      </div>

      <!-- Shipping Country -->
      <div class="form-group">
        <label for="shippingCountry"><strong>Shipping Country</strong></label>
        <select id="shippingCountry" class="form-control">
          <option value="">Select a country</option>
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

      <!-- Shipping Address -->
      <div class="form-group">
        <label for="shippingAddress"><strong>Shipping Address</strong></label>
        <input type="text" id="shippingAddress" class="form-control" placeholder="Enter shipping address">
      </div>

      <hr>

      <!-- Products to Order -->
      <h5><strong>Products to Order</strong></h5>

      <!-- Product Select List -->
      <div class="form-group">
        <label for="productSelect"><strong>Select Product</strong></label>
        <select id="productSelect" class="form-control">
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

      <!-- Add Product Button -->
      <button id="addProductBtn" class="btn btn-success btn-block">
        <i class="fas fa-plus"></i> Add Product
      </button>

      <!-- Sumatoria de productos y factura -->

      <div class="border rounded p-3 bg-light mt-3" style="min-width: 250px;">
        <div class="d-flex justify-content-between mb-1">
          <span><strong>Total Products:</strong></span>
          <span id="totalProducts">$0.00</span>
        </div>
        <div class="d-flex justify-content-between mb-1">
          <span><strong>Shipping + Taxes:</strong></span>
          <span id="shippingTaxes">$0.00</span>
        </div>
        <hr class="my-2">
        <div class="d-flex justify-content-between">
          <span><strong>Total:</strong></span>
          <span id="finalTotal">$0.00</span>
        </div>
      </div>

    </div>
    
    <!-- Column 2 -->
    <div class="col-md-8">
      <h5><strong>Order Details</strong></h5>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>Product Name</th>
            <th>Type</th>
            <th>Total Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="orderTableBody">
          <!-- Starts empty -->
        </tbody>
      </table>
    </div>
    
  </div>
</div>

<script>
  const prices = {
    pallets: 150,
    boxes: 20,
  };

  const taxRates = {
    US: 0.07,
    CA: 0.13,
    MX: 0.16,
    ES: 0.21,
    DE: 0.19,
    FR: 0.20,
    CR: 0.13,
    default: 0.10,
  };

  const productSelect = document.getElementById("productSelect");
  const addProductBtn = document.getElementById("addProductBtn");
  const orderTableBody = document.getElementById("orderTableBody");
  const shippingCountry = document.getElementById("shippingCountry");
  const totalProductsSpan = document.getElementById("totalProducts");
  const shippingTaxesSpan = document.getElementById("shippingTaxes");
  const grandTotalSpan = document.getElementById("finalTotal"); // corregido aquí

  function formatCurrency(num) {
    return `$${num.toFixed(2)}`;
  }

  function parseCurrency(str) {
    return parseFloat(str.replace("$", "")) || 0;
  }

  function updateTotals() {
    let totalProducts = 0;
    const rows = orderTableBody.querySelectorAll("tr");
    rows.forEach((row) => {
      const priceText = row.querySelector(".priceCell").textContent;
      totalProducts += parseCurrency(priceText);
    });

    totalProductsSpan.textContent = formatCurrency(totalProducts);

    const countryCode = shippingCountry.value;
    const taxRate =
      taxRates.hasOwnProperty(countryCode) ? taxRates[countryCode] : taxRates.default;

    const shippingAndTaxes = totalProducts * taxRate;
    shippingTaxesSpan.textContent = formatCurrency(shippingAndTaxes);

    // Suma numérica correcta
    const grandTotal = totalProducts + shippingAndTaxes;
    grandTotalSpan.textContent = formatCurrency(grandTotal);
  }

  addProductBtn.addEventListener("click", () => {
    const selectedProduct = productSelect.value.trim();
    if (!selectedProduct) {
      alert("Please select a product before adding.");
      return;
    }

    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${selectedProduct}</td>
      <td>
        <select class="form-control typeSelect">
          <option value="pallets">Pallets - $150</option>
          <option value="boxes">Boxes - $20</option>
        </select>
      </td>
      <td class="priceCell">${formatCurrency(prices.pallets)}</td>
      <td>
        <button class="btn btn-danger btn-sm deleteBtn">
          <i class="fas fa-trash"></i> Delete
        </button>
      </td>
    `;

    orderTableBody.appendChild(row);

    const typeSelect = row.querySelector(".typeSelect");
    const priceCell = row.querySelector(".priceCell");
    const deleteBtn = row.querySelector(".deleteBtn");

    typeSelect.addEventListener("change", () => {
      priceCell.textContent =
        typeSelect.value === "pallets"
          ? formatCurrency(prices.pallets)
          : formatCurrency(prices.boxes);
      updateTotals();
    });

    deleteBtn.addEventListener("click", () => {
      row.remove();
      updateTotals();
    });

    updateTotals();
  });

  shippingCountry.addEventListener("change", () => {
    updateTotals();
  });

  window.addEventListener("load", () => {
    updateTotals();
  });
</script>








<div class="d-flex justify-content-end mt-3">
  <button type="button" class="btn btn-success mr-2">
    <i class="fas fa-save"></i> Save Order
  </button>
  <button type="button" class="btn btn-danger">
    <i class="fas fa-times"></i> Cancel Order
  </button>
</div>

 
</div>








<div class="container d-flex flex-column" style="min-height: 300px;">
  <div class="flex-grow-1">
    <!-- Aquí va tu contenido, por ejemplo la tabla -->
  </div>

</div>
  </div>
</div>
</div>






<div style="height: 50px;"></div>

      <!-- Footer -->

@endsection
