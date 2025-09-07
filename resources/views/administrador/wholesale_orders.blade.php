@extends('layouts.admin')

@section('title', 'Home - Wholesale Admin')

@section('content')
  
  <div class="container-fluid col-sm-8 der rounded shadow p-3 ml-5">

<!-- TABLA -->
<div class="container">
  <h2 class="container-fluid text-center mt-4">History of orders placed</h2>
  <div class="table-responsive">
    <table class="table table-striped" id="ordersTable">
      <thead>
        <tr class="header-row text-center align-middle">
          <th class="align-middle">N° Internal</th>
          <th class="align-middle">Shipment ID</th>
          <th class="align-middle">Client</th>
          <th class="align-middle">Origin</th>
          <th class="align-middle">Destination</th>
          <th class="align-middle">Container</th>
          <th class="align-middle">Departure Date</th>
          <th class="align-middle">Estimated Arrival</th>
          <th class="align-middle">Status</th>
          <th class="align-middle">Total</th>
          <th class="align-middle">Details</th>
          <th class="align-middle">Edit</th>
          <th class="align-middle">PDF</th> <!-- NUEVA COLUMNA -->
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
        <tr data-order-id="{{ $order->id }}">
          <td>{{ $order->id }}</td>
          <td>{{ $order->shipment_id }}</td>
          <td>{{ $order->user->nombre ?? 'N/A' }}</td>
          <td>{{ $order->origen ?? 'N/A' }}</td>
          <td>{{ $order->destino }}</td>
          <td>{{ $order->container }}</td>
          <td>{{ $order->fechaSalida ? $order->fechaSalida->format('Y-m-d') : 'N/A' }}</td>
            <td>{{ $order->fechaLlegada ? $order->fechaLlegada->format('Y-m-d') : 'N/A' }}</td>
            <td>{{ $order->estado ?? 'Pending' }}</td>
            <td>${{ number_format($order->total, 2) }}</td>
            <td>
            <a href="#" class="viewDetailsBtn" data-order-id="{{ $order->id }}">
              <i class="fas fa-search"></i> View
            </a>
          </td>
          <td>
            <a href="#" class="editBtn" data-order-id="{{ $order->id }}"><i class="fas fa-edit"></i> Edit</a>
          </td>
          <td>
            <a href="{{ route('dashboard-admin.orders.pdf', $order->id) }}" class="download-pdf-btn">
              <i class="fas fa-file-pdf"></i> 
            </a>
          </td>
        </tr>
        @endforeach<!-- Más filas igual -->
      </tbody>
    </table>
  </div>
</div>

<div class="container mt-4">
  <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('dashboard-admin.orders.create') }}" class="btn btn-primary">
      <i class="fas fa-plus"></i> Create New Order
    </a>
  </div>
</div>

<!-- Modal para ver detalles -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailsModalLabel">Order Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline:none;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detailsContent">
        <!-- Aquí se carga el texto largo de detalles -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para editar pedido -->
<div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form id="editOrderForm" method="POST" action="">
        <div class="modal-header">
          <h5 class="modal-title" id="editOrderModalLabel">Edit Order</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline:none;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-2">
              <label for="internalNumber">N° Internal</label>
              <input type="text" class="form-control" id="internalNumber" readonly>
            </div>
            <div class="form-group col-md-3">
              <label for="shipmentId">Shipment ID</label>
              <input type="text" class="form-control" id="shipmentId" name="Shipment_id" required>
            </div>
            <div class="form-group col-md-3">
              <label for="clientName">Client</label>
              <input type="text" class="form-control" id="clientName" name="usuario_id" required>
            </div>
            <div class="form-group col-md-2">
              <label for="origin">Origin</label>
              <input type="text" class="form-control" id="origin" name="origen" required>
            </div>
            <div class="form-group col-md-2">
              <label for="destination">Destination</label>
              <input type="text" class="form-control" id="destination" name="destino" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="container">Container</label>
              <input type="text" class="form-control" id="container" name="container" required>
            </div>
            <div class="form-group col-md-3">
              <label for="departureDate">Departure Date</label>
              <input type="date" class="form-control" id="departureDate" name="fechaSalida" required>
            </div>
            <div class="form-group col-md-3">
              <label for="estimatedArrival">Estimated Arrival</label>
              <input type="date" class="form-control" id="estimatedArrival" name="fechaLlegada" required>
            </div>
            <div class="form-group col-md-3">
              <label for="status">Status</label>
              <select class="form-control" id="status" name="estado" required>
                <option value="🚚 Delivered">🚚 Delivered</option>
                <option value="⌛ In progress">⌛ In progress</option>
                <option value="⏰ Delayed">⏰ Delayed</option>
                <option value="❌ Canceled">❌ Canceled</option>
                <option value="🕵️‍♂️ Pending Review">🕵️‍♂️ Pending Review</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="orderDetails">Details</label>
            <textarea class="form-control" id="orderDetails" rows="4" placeholder="Enter detailed info"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Para mostrar el modal con detalles
    document.querySelectorAll('.viewDetailsBtn').forEach(btn => {
        btn.addEventListener('click', async (e) => {
            e.preventDefault();
            const orderId = btn.getAttribute('data-order-id');
            
            try {
                const response = await fetch(`/dashboard-admin/orders/${orderId}/details`);
                const orderDetails = await response.json();
                
                // Crear contenido HTML detallado
                const detailsHTML = `
                    <div class="row">
                        <div class="col-md-6">
                            <h6><strong>Order Information</strong></h6>
                            <p><strong>Order ID:</strong> ${orderDetails.id}</p>
                            <p><strong>Shipment ID:</strong> ${orderDetails.shipment_id}</p>
                            <p><strong>Container:</strong> ${orderDetails.container}</p>
                            <p><strong>Status:</strong> ${orderDetails.status}</p>
                            <p><strong>Created:</strong> ${orderDetails.created_at}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Client Information</strong></h6>
                            <p><strong>Name:</strong> ${orderDetails.client}</p>
                            <p><strong>Email:</strong> ${orderDetails.client_email}</p>
                            <p><strong>Company:</strong> ${orderDetails.client_company}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6><strong>Shipping Information</strong></h6>
                            <p><strong>Origin:</strong> ${orderDetails.origin}</p>
                            <p><strong>Destination:</strong> ${orderDetails.destination}</p>
                            <p><strong>Address:</strong> ${orderDetails.address}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Product Information</strong></h6>
                            <p><strong>Product:</strong> ${orderDetails.product}</p>
                            <p><strong>Type:</strong> ${orderDetails.product_type}</p>
                            <p><strong>Quantity:</strong> ${orderDetails.quantity}</p>
                            <p><strong>Total:</strong> $${orderDetails.total}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6><strong>Dates</strong></h6>
                            <p><strong>Departure:</strong> ${orderDetails.departure_date}</p>
                            <p><strong>Arrival:</strong> ${orderDetails.arrival_date}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Shipping & Taxes</strong></h6>
                            ${orderDetails.shipping_taxes ? `
                                <p><strong>Taxes:</strong> $${orderDetails.shipping_taxes.taxes}</p>
                                <p><strong>Intercom:</strong> $${orderDetails.shipping_taxes.intercom}</p>
                                <p><strong>Profit:</strong> $${orderDetails.shipping_taxes.profit}</p>
                                <p><strong>Total S&T:</strong> $${orderDetails.shipping_taxes.total}</p>
                            ` : '<p>No shipping taxes information</p>'}
                        </div>
                    </div>
                `;
                
                document.getElementById('detailsContent').innerHTML = detailsHTML;
                $('#detailsModal').modal('show');
            } catch (error) {
                console.error('Error loading order details:', error);
                alert('Error loading order details');
            }
        });
    });

    // Variables para edición
    const editOrderModal = $('#editOrderModal');
    const editOrderForm = document.getElementById('editOrderForm');
    let currentOrderId = null;

    // Cuando se haga click en Edit
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', async (e) => {
            e.preventDefault();
            const orderId = btn.getAttribute('data-order-id');
            currentOrderId = orderId;
            
            try {
                const response = await fetch(`/dashboard-admin/orders/${orderId}/details`);
                const orderDetails = await response.json();
                
                // Rellenar formulario
                document.getElementById('internalNumber').value = orderDetails.id;
                document.getElementById('shipmentId').value = orderDetails.shipment_id;
                document.getElementById('clientName').value = orderDetails.client;
                document.getElementById('origin').value = orderDetails.origin;
                document.getElementById('destination').value = orderDetails.destination;
                document.getElementById('container').value = orderDetails.container;
                document.getElementById('departureDate').value = orderDetails.departure_date !== 'N/A' ? orderDetails.departure_date : '';
                document.getElementById('estimatedArrival').value = orderDetails.arrival_date !== 'N/A' ? orderDetails.arrival_date : '';
                document.getElementById('status').value = orderDetails.status;

                editOrderModal.modal('show');
            } catch (error) {
                console.error('Error loading order for edit:', error);
                alert('Error loading order for edit');
            }
        });
    });

    // Guardar cambios
    editOrderForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        if (!currentOrderId) {
            alert('No order selected for editing');
            return;
        }

        const formData = {
            shipment_id: document.getElementById('shipmentId').value,
            destino: document.getElementById('destination').value,
            address: 'N/A', // You might want to add this field to the form
            origen: document.getElementById('origin').value,
            container: document.getElementById('container').value,
            fechaSalida: document.getElementById('departureDate').value || null,
            fechaLlegada: document.getElementById('estimatedArrival').value || null,
            estado: document.getElementById('status').value
        };

        try {
            const response = await fetch(`/dashboard-admin/orders/${currentOrderId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(formData)
            });

            const result = await response.json();
            
            if (result.success) {
                alert('Order updated successfully!');
                location.reload(); // Reload to show updated data
            } else {
                alert('Error updating order: ' + (result.message || 'Unknown error'));
            }
        } catch (error) {
            console.error('Error updating order:', error);
            alert('Error updating order');
        }
    });
});
</script>



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

