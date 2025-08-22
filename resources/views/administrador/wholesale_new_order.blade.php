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
        <select id="shippingCountry" class="form-control" name="destino">
          <option value="">Select a country</option>
          <option value="Afghanistan">Afghanistan</option>
          <option value="Albania">Albania</option>
          <option value="Algeria">Algeria</option>
          <option value="Argentina">Argentina</option>
          <option value="Australia">Australia</option>
          <option value="Austria">Austria</option>
          <option value="Bangladesh">Bangladesh</option>
          <option value="Belgium">Belgium</option>
          <option value="Bolivia">Bolivia</option>
          <option value="Brazil">Brazil</option>
          <option value="Bulgaria">Bulgaria</option>
          <option value="Canada">Canada</option>
          <option value="Chile">Chile</option>
          <option value="China">China</option>
          <option value="Colombia">Colombia</option>
          <option value="Costa Rica">Costa Rica</option>
          <option value="Croatia">Croatia</option>
          <option value="Czech Republic">Czech Republic</option>
          <option value="Denmark">Denmark</option>
          <option value="Dominican Republic">Dominican Republic</option>
          <option value="Ecuador">Ecuador</option>
          <option value="Egypt">Egypt</option>
          <option value="El Salvador">El Salvador</option>
          <option value="Finland">Finland</option>
          <option value="France">France</option>
          <option value="Germany">Germany</option>
          <option value="Greece">Greece</option>
          <option value="Guatemala">Guatemala</option>
          <option value="Honduras">Honduras</option>
          <option value="Hong Kong">Hong Kong</option>
          <option value="Hungary">Hungary</option>
          <option value="India">India</option>
          <option value="Indonesia">Indonesia</option>
          <option value="Ireland">Ireland</option>
          <option value="Israel">Israel</option>
          <option value="Italy">Italy</option>
          <option value="Japan">Japan</option>
          <option value="Kenya">Kenya</option>
          <option value="South Korea">South Korea</option>
          <option value="Malaysia">Malaysia</option>
          <option value="Mexico">Mexico</option>
          <option value="Netherlands">Netherlands</option>
          <option value="New Zealand">New Zealand</option>
          <option value="Norway">Norway</option>
          <option value="Panama">Panama</option>
          <option value="Paraguay">Paraguay</option>
          <option value="Peru">Peru</option>
          <option value="Philippines">Philippines</option>
          <option value="Poland">Poland</option>
          <option value="Portugal">Portugal</option>
          <option value="Puerto Rico">Puerto Rico</option>
          <option value="Romania">Romania</option>
          <option value="Russia">Russia</option>
          <option value="Saudi Arabia">Saudi Arabia</option>
          <option value="Serbia">Serbia</option>
          <option value="Singapore">Singapore</option>
          <option value="South Africa">South Africa</option>
          <option value="Spain">Spain</option>
          <option value="Sweden">Sweden</option>
          <option value="Switzerland">Switzerland</option>
          <option value="Taiwan">Taiwan</option>
          <option value="Thailand">Thailand</option>
          <option value="Turkey">Turkey</option>
          <option value="Ukraine">Ukraine</option>
          <option value="United Arab Emirates">United Arab Emirates</option>
          <option value="United Kingdom">United Kingdom</option>
          <option value="United States">United States</option>
          <option value="Uruguay">Uruguay</option>
          <option value="Venezuela">Venezuela</option>
        </select>
      </div>

      <!-- Shipping Address -->
      <div class="form-group">
        <label for="shippingAddress"><strong>Shipping Address</strong></label>
        <input type="text" id="shippingAddress" class="form-control" name="address" placeholder="Enter shipping address">
      </div>

      <hr>

      <!-- Products to Order -->
      <h5><strong>Products to Order</strong></h5>

      <!-- Product Select List -->
      <div class="form-group">
        <label for="productSelect"><strong>Select Product</strong></label>
        <select id="productSelect" class="form-control" name="producto_id">
          @foreach($productos as $producto)
          <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
          @endforeach
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
            <th>Quantity</th><!-- NUEVA -->
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
  </div>

</div>
  </div>
</div>
</div>

<div style="height: 50px;"></div>

@endsection
