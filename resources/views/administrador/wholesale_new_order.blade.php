@extends('layouts.admin')

@section('title', 'Home - Wholesale Admin')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid col-sm-8 der rounded shadow p-3 ml-5">

  <h1 class="container-fluid text-center mt-3">Wholesale - New Order</h1>

  <div class="container mt-4">
    <div class="row">

      <!-- Column 1 -->
      <div class="col-md-4">

        <!-- Search Client -->
        <div class="form-group">
          <label for="searchClient"><strong>Search Client</strong></label>
          <div class="input-group">
            <div style="position: relative; width: 300px;">
              <input type="text" id="buscarCliente" placeholder="Buscar cliente..." style="width: 100%; padding: 8px;">
              <input type="hidden" id="cliente_id" name="usuario_id">
              <ul id="sugerencias" style="position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1px solid #ccc; border-top: none; list-style: none; margin: 0; padding: 0; max-height: 200px; overflow-y: auto; display: none; z-index: 1000;">
              </ul>
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

        <div class="form-group">
          <label for="productSelect"><strong>Select Product</strong></label>
          <select id="productSelect" class="form-control" name="producto_id">
            @foreach($products as $producto)
            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
            @endforeach
          </select>
        </div>

        <button id="addProductBtn" class="btn btn-success btn-block">
          <i class="fas fa-plus"></i> Add Product
        </button>

        <!-- Totals Box -->
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
              <th>Quantity</th>
              <th>Total Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="orderTableBody">
            <!-- Rows se generan dinámicamente desde JS -->
          </tbody>
        </table>
      </div>

    </div>
    <div class="d-flex justify-content-end mt-3">
      <button type="button" class="btn btn-success mr-2" id="saveOrderBtn">
        <i class="fas fa-save"></i> Save Order
      </button>
      <a type="button" href="{{route('dashboard-admin.orders')}}" class="btn btn-danger">
        <i class="fas fa-times"></i> Cancel Order
      </a>
    </div>
  </div>

</div>

<script>
  // Objeto con precios por producto
  const productPrices = {
    @foreach($products as $producto)
      "{{ $producto->id }}": {
        precio_pallets: "{{ $producto->precio_pallets }}",
        precio_boxes: "{{ $producto->precio_boxes }}"
      },
    @endforeach
  };

  const input = document.getElementById('buscarCliente');
  const sugerencias = document.getElementById('sugerencias');

  input.addEventListener('keyup', function() {
    let query = this.value;
    if(query.length > 2){ 
      fetch(`/dashboard-admin/buscarclientes?q=${query}`)
        .then(res => res.json())
        .then(data => {
          sugerencias.innerHTML = '';
          if (data.length > 0) {
            sugerencias.style.display = 'block';
            data.forEach(cliente => {
              let li = document.createElement('li');
              li.textContent = cliente.nombre;
              li.style.padding = "8px";
              li.style.cursor = "pointer";
              li.addEventListener('click', function() {
                input.value = cliente.nombre; 
                sugerencias.style.display = 'none';
                document.getElementById('cliente_id').value = cliente.id;
              });
              li.addEventListener('mouseover', () => li.style.background = "#f0f0f0");
              li.addEventListener('mouseout', () => li.style.background = "white");
              sugerencias.appendChild(li);
            });
          } else {
            sugerencias.style.display = 'none';
          }
        });
    } else {
      sugerencias.style.display = 'none';
    }
  });

  const orderTableBody = document.getElementById("orderTableBody");
  const shippingCountry = document.getElementById("shippingCountry");
  const totalProductsSpan = document.getElementById("totalProducts");
  const shippingTaxesSpan = document.getElementById("shippingTaxes");
  const grandTotalSpan = document.getElementById("finalTotal");
  const addProductBtn = document.getElementById("addProductBtn");
  const saveOrderBtn = document.getElementById("saveOrderBtn");
  const productSelect = document.getElementById("productSelect");

  function formatCurrency(num) {
    return '$' + parseFloat(num).toFixed(2);
  }

  // Agregar producto
  addProductBtn.addEventListener("click", e => {
    e.preventDefault();
    const selectedOption = productSelect.selectedOptions[0];
    if (!selectedOption) return alert("Seleccione un producto.");

    const row = document.createElement("tr");
    row.innerHTML = `
      <td class="productName" data-id="${selectedOption.value}">${selectedOption.text}</td>
      <td>
        <select class="form-control tipoSelect">
          <option value="Pallets">Pallet ($${productPrices[selectedOption.value].precio_pallets})</option>
          <option value="Boxes">Box ($${productPrices[selectedOption.value].precio_boxes})</option>
        </select>
      </td>
      <td><input type="number" class="form-control cantidadInput" min="1" value="1"></td>
      <td class="priceCell">$0.00</td>
      <td>
        <button class="btn btn-danger btn-sm deleteBtn">
          <i class="fas fa-trash"></i> Delete
        </button>
      </td>
    `;

    orderTableBody.appendChild(row);

    row.querySelector(".cantidadInput").addEventListener("input", updateTotals);
    row.querySelector(".tipoSelect").addEventListener("change", updateTotals);
    row.querySelector(".deleteBtn").addEventListener("click", () => {
      row.remove();
      updateTotals();
    });

    updateTotals();
  });

  function updateTotals() {
    const rows = orderTableBody.querySelectorAll("tr");
    let totalProducts = 0;

    rows.forEach(row => {
        const cantidad = parseInt(row.querySelector(".cantidadInput").value, 10) || 0;
        const productoId = row.querySelector(".productName").dataset.id;
        const tipo = row.querySelector(".tipoSelect").value;
        let precioUnitario = tipo === "Pallets"
            ? parseFloat(productPrices[productoId].precio_pallets)
            : parseFloat(productPrices[productoId].precio_boxes);

        const subtotal = precioUnitario * cantidad;
        row.querySelector(".priceCell").textContent = formatCurrency(subtotal);

        totalProducts += subtotal;
    });

    totalProductsSpan.textContent = formatCurrency(totalProducts);

    const usuarioId = document.getElementById('cliente_id').value;
    const destino = shippingCountry.value;

    if (!usuarioId || !destino) return;

    // Preparar productos para el cálculo
    const productos = [];
    orderTableBody.querySelectorAll("tr").forEach(row => {
        const productoId = row.querySelector(".productName").dataset.id;
        const cantidad = parseInt(row.querySelector(".cantidadInput").value, 10) || 1;
        const tipo = row.querySelector(".tipoSelect").value;
        const precioUnitario = tipo === "Pallets"
            ? parseFloat(productPrices[productoId].precio_pallets)
            : parseFloat(productPrices[productoId].precio_boxes);
        const subtotal = precioUnitario * cantidad;

        productos.push({ producto_id: productoId, tipo, cantidad, subtotal });
    });

    fetch("/dashboard-admin/calcular-totales", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        body: JSON.stringify({
            usuario_id: usuarioId,
            destino: destino,
            productos: productos
        })
    })

    .then(res => res.json())
    .then(data => {
        if (data.error) return;
    
        const shippingAndTaxes = parseFloat(data.shipping_taxes) || 0;
        const descuento = parseFloat(data.descuento) || 0;
        
        shippingTaxesSpan.textContent = formatCurrency(shippingAndTaxes);
        grandTotalSpan.textContent = formatCurrency(data.total_final);
        totalCalculado = parseFloat(data.total_final);

        if (data.detalle_productos && data.detalle_productos.length > 0) {
            const breakdown = data.detalle_productos.map(item => {
              const taxUnit = item.shipping_tax_breakdown ? item.shipping_tax_breakdown.total : 0;
              const taxTotal = item.shipping_tax_total || 0;

              return `${item.nombre} (${item.tipo}): ${item.cantidad} unidades × $${taxUnit} = $${taxTotal}`;
          }).join('\n');

          console.log('Shipping + Taxes breakdown:', breakdown);
        }
    })
    .catch(err => console.error('Error calculating totals:', err));
  }

  shippingCountry.addEventListener("change", updateTotals);
  window.addEventListener("load", updateTotals);

  // Guardar pedido
  saveOrderBtn.addEventListener("click", () => {
    const usuario_id = document.getElementById('cliente_id').value;
    const destino = shippingCountry.value;
    const address = document.getElementById('shippingAddress').value;

    if (!usuario_id || !destino || !address) return alert("Complete todos los campos.");

    const productos = [];
    orderTableBody.querySelectorAll("tr").forEach(row => {
      const productoId = row.querySelector(".productName").dataset.id;
      const cantidad = parseInt(row.querySelector(".cantidadInput").value, 10) || 1;
      const tipo = row.querySelector(".tipoSelect").value;
      const precioUnitario = tipo === "Pallets"
        ? parseFloat(productPrices[productoId].precio_pallets)
        : parseFloat(productPrices[productoId].precio_boxes);
      const subtotal = precioUnitario * cantidad;

      productos.push({ producto_id: productoId, tipo, cantidad, subtotal });
    });
    const ordersAdminUrl = "{{ route('dashboard-admin.orders') }}";

    fetch("/dashboard-admin/orderst", {
    method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
      },
      body: JSON.stringify({
        usuario_id: usuario_id,
        destino: destino,
        address: address,
        productos: productos
      })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert("Order added successfully!");
        location.href= ordersAdminUrl;
      } else {
        alert("Error: " + (data.error || "No se pudo guardar."));
      }
    })
    .catch(err => console.error(err));
  });
</script>



 
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
