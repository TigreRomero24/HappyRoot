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
      <tr>
        <td>001</td>
        <td>SHIP-1001</td>
        <td>John Doe</td>
        <td>Ecuador</td>
        <td>USA</td>
        <td>CNT-2001</td>
        <td>2025-08-01</td>
        <td>2025-08-15</td>
        <td>🚚 Delivered</td>
        <td>$2,500</td>
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
      <tr>
        <td>002</td>
        <td>SHIP-1002</td>
        <td>Mary Smith</td>
        <td>Costa Rica</td>
        <td>Spain</td>
        <td>CNT-2002</td>
        <td>2025-08-05</td>
        <td>2025-08-20</td>
        <td>⌛ In progress</td>
        <td>$3,100</td>
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
      <tr>
        <td>003</td>
        <td>SHIP-1003</td>
        <td>Mike Johnson</td>
        <td>Peru</td>
        <td>Germany</td>
        <td>CNT-2003</td>
        <td>2025-08-07</td>
        <td>2025-08-25</td>
        <td>⏰ Delayed</td>
        <td>$4,200</td>
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
      <tr>
        <td>004</td>
        <td>SHIP-1004</td>
        <td>Sarah Lee</td>
        <td>Mexico</td>
        <td>UK</td>
        <td>CNT-2004</td>
        <td>2025-08-09</td>
        <td>2025-08-27</td>
        <td>❌ Canceled</td>
        <td>$0</td>
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
      <tr>
        <td>005</td>
        <td>SHIP-1005</td>
        <td>David Brown</td>
        <td>Brazil</td>
        <td>France</td>
        <td>CNT-2005</td>
        <td>2025-08-12</td>
        <td>2025-08-30</td>
        <td>🕵️‍♂️ Pending Review</td>
        <td>$1,800</td>
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
    </tbody>
  </table>
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
        <p>
          Shipment place / Puerto de embarque: APM, MOIN LIMON CR
          Arrival Port / Puerto de arribo: Rotterdam Origin country / País de origen :COSTA RICA
          Arrival country / País de destino :Rotterdam, Netherlands
          Departure :12 agosto 2025
          Arrival :25 agosto 2025
          Shipping Company / Naviera:MEDITERRANEAN SHIPPING
          Vessel and Voyage / Vapor :MSC VAISHNAVI R / NN531R
          Bill of Lading:SEA25NLRTM1796
          #FDA 15798849296
          PAYMENT TERMS:
          30% On Invoice Date 08/05/2025
          20% Of The Invoice On Arrival At The Port 08/25/2025
          50% Of The Invoice On Arrival At The Client's Warehouse 08/29/2025
          BROKER: Fresh Connection
          operations@freshconnection.nl
          31*(0)*180799400
          Trondheim 11-15, Unit 2B3, 2993LE Barendrecht
        </p>
      </div>
    </div>
  </div>
</div>

<!-- jsPDF CDN (para generar el PDF en el navegador) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-NA0K6C8f6nF+V+f0qK0qQ9Oqf+1k4QFf6R8b2t+vCjB5t1dOeBk3aU4e1wQm5JrE3O5IY4l3V2HfJ0rXK5B1VQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  // Genera PDF tomando los datos de la fila
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.download-pdf');
    if (!btn) return;

    const row = btn.closest('tr');
    const cells = row.querySelectorAll('td');

    // Índices basados en el thead de esta tabla:
    // 0 Internal, 1 Shipment, 2 Client, 3 Origin, 4 Destination,
    // 5 Container, 6 Departure, 7 Estimated, 8 Status, 9 Total,
    // 10 Details (link), 11 PDF (botón)
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