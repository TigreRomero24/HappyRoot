@extends('layouts.admin')

@section('title', 'Home - Wholesale Prices')

@section('content')
<div class="container-fluid col-sm-8 der rounded shadow p-3 ml-5">

  <!-- TABLA -->
  <div class="container mt-4">
    <h4>Price List</h4>
    <div class="table-responsive">
      <table class="table table-striped table-bordered" id="priceTable">
        <thead class="thead-light">
          <tr>
            <th>ID Price</th>
            <th>Price Name</th>
            <th>Discount %</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($precios as $index => $precio)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td class="price-name">{{ $precio->nombre }}</td>
            <td class="price-discount">{{ $precio->descuentos }}</td>
            <td>
              <button class="btn btn-sm btn-primary editBtn mr-2">Edit</button>
              <form action="{{ route('dashboard-admin.prices.delete', $precio->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this price entry?')">Erase</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
    <!-- Botón agregar precio -->
    <div class="d-flex justify-content-end mt-3">
      <button id="addPriceBtn" class="btn btn-success">
        <i class="fas fa-plus"></i> Add Price
      </button>
    </div>
  </div>

  <!-- Modal para editar/agregar precio -->
  <div class="modal fade" id="editPriceModal" tabindex="-1" aria-labelledby="editPriceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="editPriceForm" method="POST" action="">
          @csrf
          <input type="hidden" name="_method" value="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="editPriceModalLabel">Edit Price</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline:none;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="priceNameInput">Price Name</label>
              <input type="text" id="priceNameInput" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="discountInput">Discount %</label>
              <input type="number" min="0" max="999999" step="0.01" inputmode="decimal" id="discountInput" name="descuentos" class="form-control" value="0.00" required pattern="^\d{1,3}([.,]\d{1,2})?$" title="Enter a valid percentage like 12,50 or 12.50">
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
    const priceTable = document.getElementById('priceTable');
    const editPriceModal = $('#editPriceModal');
    const editPriceForm = document.getElementById('editPriceForm');
    const priceNameInput = document.getElementById('priceNameInput');
    const discountInput = document.getElementById('discountInput');
    const addPriceBtn = document.getElementById('addPriceBtn');

    let currentEditingRow = null;
    let editingId = null;

    // Editar fila (abre modal con datos)
    priceTable.addEventListener('click', (e) => {
        if (e.target.classList.contains('editBtn')) {
            currentEditingRow = e.target.closest('tr');
            editingId = currentEditingRow.querySelector('form').action.split('/').pop();

            priceNameInput.value = currentEditingRow.querySelector('.price-name').textContent.trim();
            discountInput.value = currentEditingRow.querySelector('.price-discount').textContent.trim();

            $('#editPriceModalLabel').text('Edit Price');
            // Cambia la acción del formulario al endpoint de edición con el ID correcto
            editPriceForm.action = `/dashboard-admin/prices/${editingId}`;
            // Cambia el método a PUT para edición
            editPriceForm.querySelector('[name="_method"]').value = "PUT";

            editPriceModal.modal('show');
        }
    });

    // Agregar precio nuevo (abre modal vacío)
    addPriceBtn.addEventListener('click', () => {
        currentEditingRow = null;
        editingId = null;
        priceNameInput.value = '';
        discountInput.value = '';
        $('#editPriceModalLabel').text('Add New Price');
        // Cambia la acción del formulario al endpoint de creación
        editPriceForm.action = `/dashboard-admin/prices`;
        editPriceForm.querySelector('[name="_method"]').value = "POST";
        editPriceModal.modal('show');
    });
  </script>

  <!-- Recuerda incluir jQuery y Bootstrap JS para que el modal funcione -->

</div>

<div class="container d-flex flex-column" style="min-height: 300px;">
  <div class="flex-grow-1">
    <!-- Aquí va tu contenido, por ejemplo la tabla -->
  </div>
</div>
@endsection

