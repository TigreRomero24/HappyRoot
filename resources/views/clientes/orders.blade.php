@extends('layouts.layout_cliente')

@section('title', 'Home - My Account')

@section('content')


  
  <div class="container-fluid col-sm-8 der rounded shadow p-3 ml-5">
<!-- TABLA -->
<div class="container">
  <h2 class="container-fluid text-center mt-4">History of orders placed</h2>
  <div class="table-responsive">
    <table class="table table-striped">
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
          <th class="align-middle">PDF</th> <!-- NUEVA COLUMNA -->
        </tr>
      </thead>
      <tbody>
      @foreach ($orders as $order)
      <tr>
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
          <a href="#" data-toggle="modal" data-target="#detailsModal">
            <i class="fas fa-search"></i> View
          </a>
        </td>
        <td>
          <button type="button" class="btn btn-outline-danger btn-sm download-pdf">
            <i class="fas fa-file-pdf"></i> 
          </button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
</div>

<div class="container mt-4">
  <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('client.orders.create') }}" class="btn btn-primary">
      <i class="fas fa-plus"></i> Create New Order
    </a>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="padding: 20px;">
      <div class="modal-header">
        <h5 class="modal-title w-100 text-center" id="detailsModalLabel">More details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline:none;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>ID:</strong> <span id="detalle-id"></span></p>
        <p><strong>Producto:</strong> <span id="detalle-producto"></span></p>
        <p><strong>Precio:</strong> <span id="detalle-precio"></span></p>
        <p><strong>Impuesto:</strong> <span id="detalle-impuesto"></span></p>
        <p><strong>Estado:</strong> <span id="detalle-estado"></span></p>
        <p><strong>Fecha:</strong> <span id="detalle-fecha"></span></p>
      </div>
    </div>
  </div>
</div>

<!-- jsPDF CDN (para generar el PDF en el navegador) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-NA0K6C8f6nF+V+f0qK0qQ9Oqf+1k4QFf6R8b2t+vCjB5t1dOeBk3aU4e1wQm5JrE3O5IY4l3V2HfJ0rXK5B1VQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Obtener todos los botones de detalles
    const botones = document.querySelectorAll('a[data-toggle="modal"]');

    botones.forEach(boton => {
        boton.addEventListener("click", function (e) {
            e.preventDefault();
            const row = this.closest('tr');
            const cells = row.querySelectorAll('td');
            
            // Extraer datos de la fila
            const orderData = {
                id: cells[0].textContent.trim(),
                shipment_id: cells[1].textContent.trim(),
                client: cells[2].textContent.trim(),
                origin: cells[3].textContent.trim(),
                destination: cells[4].textContent.trim(),
                container: cells[5].textContent.trim(),
                departure: cells[6].textContent.trim(),
                arrival: cells[7].textContent.trim(),
                status: cells[8].textContent.trim(),
                total: cells[9].textContent.trim()
            };

            // Llenar el modal con los datos
            document.getElementById("detalle-id").textContent = orderData.id;
            document.getElementById("detalle-producto").textContent = "Product information";
            document.getElementById("detalle-precio").textContent = orderData.total;
            document.getElementById("detalle-impuesto").textContent = "Tax information";
            document.getElementById("detalle-estado").textContent = orderData.status;
            document.getElementById("detalle-fecha").textContent = orderData.departure;

            // Mostrar modal
            $('#detailsModal').modal('show');
        });
    });
});
</script>

<script>
  // Genera PDF tomando los datos de la fila
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.download-pdf');
    if (!btn) return;
    else {

    }

    const row = btn.closest('tr');
    const cells = row.querySelectorAll('td');


    const data = {
      internal:   cells[0]?.textContent.trim() || '',
      shipment:   cells[1]?.textContent.trim() || '',
      client:     cells[2]?.textContent.trim() || '',
      origin:     cells[3]?.textContent.trim() || '',
      destination:cells[4]?.textContent.trim() || '',
      container:  cells[5]?.textContent.trim() || '',
      departure:  cells[6]?.textContent.trim() || '',
      eta:        cells[7]?.textContent.trim() || '',
      status:     cells[8]?.textContent.trim() || '',
      total:      cells[9]?.textContent.trim() || ''
    };

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Encabezado
    doc.setFontSize(16);
    doc.text('Order Summary', 14, 18);
    doc.setFontSize(11);

    let y = 30;
    const lineGap = 8;

    const lines = [
      `N° Internal: ${data.internal}`,
      `Shipment ID: ${data.shipment}`,
      `Client: ${data.client}`,
      `Origin: ${data.origin}`,
      `Destination: ${data.destination}`,
      `Container: ${data.container}`,
      `Departure Date: ${data.departure}`,
      `Estimated Arrival: ${data.eta}`,
      `Status: ${data.status}`,
      `Total: ${data.total}`
    ];

    lines.forEach(line => {
      doc.text(line, 14, y);
      y += lineGap;
    });

    // Pie con fecha/hora
    const now = new Date();
    doc.setFontSize(9);
    doc.text(`Generated: ${now.toLocaleString()}`, 14, 285);

    // Nombre de archivo
    const fileName = `order_${data.internal || 'NA'}_${(data.shipment || 'NA').replace(/\s+/g,'')}.pdf`;
    doc.save(fileName);
  });
</script>


<div class="container d-flex flex-column" style="min-height: 300px;">
  <div class="flex-grow-1">
    <!-- Aquí va tu contenido, por ejemplo la tabla -->
  </div>
  <div class="text-right mt-3 mb-3">
    <button class="btn btn-success">
      <a href="new_order_client.html" class="text-decoration-none" style="color: inherit;">
        <i class="fas fa-plus"></i> Add New Order
      </a>
    </button>
  </div>
</div>
  </div>
</div>
</div>

<div style="height: 50px;"></div>
@endsection