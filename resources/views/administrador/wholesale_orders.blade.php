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
          <th class="align-middle">Details</th>
          <th class="align-middle">Edit</th>
          <th class="align-middle">PDF</th> <!-- NUEVA COLUMNA -->
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
        <tr>
          <td>{{ $order->id }}</td>
          <td>{{ $order->shipment_id }}</td>
          <td>{{ $order->user->nombre }}</td>
          <td>{{ $order->origen }}</td>
          <td>{{ $order->destino }}</td>
          <td>{{ $order->container }}</td>
          <td>{{ $order->departure_date ?? 'N/A' }}</td>
          <td>{{ $order->estimated_arrival ?? 'N/A' }}</td>
          <td>{{ $order->status }}</td>
          <td>{{ $order->total }}</td>
          <td>
            <a href="#" class="viewDetailsBtn" data-details="Detailed info about order 001...">
              <i class="fas fa-search"></i> View
            </a>
          </td>
          <td>
            <a href="#" class="editBtn"><i class="fas fa-edit"></i> Edit</a>
          </td>
        </tr>
        @endforeach
        <!-- Más filas igual -->
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
      <form id="editOrderForm">
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
              <input type="text" class="form-control" id="shipmentId" required>
            </div>
            <div class="form-group col-md-3">
              <label for="clientName">Client</label>
              <input type="text" class="form-control" id="clientName" required>
            </div>
            <div class="form-group col-md-2">
              <label for="origin">Origin</label>
              <input type="text" class="form-control" id="origin" required>
            </div>
            <div class="form-group col-md-2">
              <label for="destination">Destination</label>
              <input type="text" class="form-control" id="destination" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="container">Container</label>
              <input type="text" class="form-control" id="container" required>
            </div>
            <div class="form-group col-md-3">
              <label for="departureDate">Departure Date</label>
              <input type="date" class="form-control" id="departureDate" required>
            </div>
            <div class="form-group col-md-3">
              <label for="estimatedArrival">Estimated Arrival</label>
              <input type="date" class="form-control" id="estimatedArrival" required>
            </div>
            <div class="form-group col-md-3">
              <label for="status">Status</label>
              <select class="form-control" id="status" required>
                <option>🚚 Delivered</option>
                <option>⌛ In progress</option>
                <option>⏰ Delayed</option>
                <option>❌ Canceled</option>
                <option>🕵️‍♂️ Pending Review</option>
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
  // Para mostrar el modal con detalles
  document.querySelectorAll('.viewDetailsBtn').forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
      const details = btn.getAttribute('data-details') || 'No details available';
      document.getElementById('detailsContent').textContent = details;
      $('#detailsModal').modal('show');
    });
  });

  // Variables para edición
  const editOrderModal = $('#editOrderModal');
  const editOrderForm = document.getElementById('editOrderForm');

  // Cuando se haga click en Edit
  document.querySelectorAll('.editBtn').forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
      const row = btn.closest('tr');
      // Extraer valores de la fila
      const internalNumber = row.cells[0].textContent;
      const shipmentId = row.cells[1].textContent;
      const clientName = row.cells[2].textContent;
      const origin = row.cells[3].textContent;
      const destination = row.cells[4].textContent;
      const container = row.cells[5].textContent;
      const departureDate = row.cells[6].textContent;
      const estimatedArrival = row.cells[7].textContent;
      const status = row.cells[8].textContent;
      const detailsLink = row.querySelector('td:nth-child(10) a');
      const details = detailsLink ? detailsLink.getAttribute('data-details') : '';

      // Rellenar formulario
      document.getElementById('internalNumber').value = internalNumber;
      document.getElementById('shipmentId').value = shipmentId;
      document.getElementById('clientName').value = clientName;
      document.getElementById('origin').value = origin;
      document.getElementById('destination').value = destination;
      document.getElementById('container').value = container;
      document.getElementById('departureDate').value = departureDate;
      document.getElementById('estimatedArrival').value = estimatedArrival;
      document.getElementById('status').value = status;
      document.getElementById('orderDetails').value = details;

      editOrderModal.modal('show');
    });
  });

  // Guardar cambios (solo en frontend, backend lo manejarías aparte)
  editOrderForm.addEventListener('submit', e => {
    e.preventDefault();

    const internalNumber = document.getElementById('internalNumber').value;
    const shipmentId = document.getElementById('shipmentId').value;
    const clientName = document.getElementById('clientName').value;
    const origin = document.getElementById('origin').value;
    const destination = document.getElementById('destination').value;
    const container = document.getElementById('container').value;
    const departureDate = document.getElementById('departureDate').value;
    const estimatedArrival = document.getElementById('estimatedArrival').value;
    const status = document.getElementById('status').value;
    const orderDetails = document.getElementById('orderDetails').value;

    // Buscar fila con ese internalNumber para actualizar
    const rows = document.querySelectorAll('#ordersTable tbody tr');
    for (let row of rows) {
      if (row.cells[0].textContent === internalNumber) {
        row.cells[1].textContent = shipmentId;
        row.cells[2].textContent = clientName;
        row.cells[3].textContent = origin;
        row.cells[4].textContent = destination;
        row.cells[5].textContent = container;
        row.cells[6].textContent = departureDate;
        row.cells[7].textContent = estimatedArrival;
        row.cells[8].textContent = status;

        // Actualizar data-details del link Details
        const detailsLink = row.querySelector('td:nth-child(10) a');
        if(detailsLink){
          detailsLink.setAttribute('data-details', orderDetails);
        }
        break;
      }
    }

    editOrderModal.modal('hide');
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

