@extends('layouts.admin')

@section('title', 'Home - Wholesale Shipping & Taxes')

@section('content')
  
<div class="container-fluid col-sm-8 der rounded shadow p-3 ml-5">

  <!-- Button to Add New Tax Entry -->
  <div class="mb-3">
    <button class="btn btn-primary" data-toggle="modal" data-target="#addTaxModal">
      <i class="fas fa-plus"></i> Add New Tax Entry
    </button>
  </div>

  <!-- Taxes Table -->
  <table class="table table-bordered table-hover" id="taxTable">
    <thead class="thead-dark">
      <tr>
        <th>ID Taxes</th>
        <th>Destination</th>
        <th>Unit Type</th>
        <th>Taxes ($)</th>
        <th>INTERCOM ($)</th>
        <th>Profit ($)</th>
        <th>Total ($)</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($taxes as $index => $tax)
      <!-- Sample row -->
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $tax->destino }}</td>
        <td>{{ $tax->tipo }}</td>
        <td>{{ $tax->taxes}}</td>
        <td>{{ $tax->intercom }}</td>
        <td>{{ $tax->profit }}</td>
        <td>{{ $tax->total }}</td>
        <td>
          <button class="btn btn-sm btn-warning" onclick="openEditTaxModal(this)">Edit</button>
          <form action="{{ route('dashboard-admin.taxes.delete',$tax->id)}}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this tax entry?')" >Erase</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <!-- Add Tax Modal -->
  <div class="modal fade" id="addTaxModal" tabindex="-1" role="dialog" aria-labelledby="addTaxModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form id="addTaxForm"  method="POST" action="{{ route('dashboard-admin.taxes.post') }}" autocomplete="off">
        @csrf
        @method('POST')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add New Tax Entry</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label for="newDestination">Destination</label>
                <select class="form-control" id="newDestination" name="destino" required>
                  <option value="">-- Select Country --</option>
                  <option value="United States">United States</option>
                  <option value="Canada">Canada</option>
                  <option value="Mexico">Mexico</option>
                  <option value="Spain">Spain</option>
                  <option value="France">France</option>
                  <option value="Germany">Germany</option>
                  <option value="Italy">Italy</option>
                  <option value="Brazil">Brazil</option>
                  <option value="Argentina">Argentina</option>
                  <option value="Costa Rica">Costa Rica</option>
                  <option value="Ecuador">Ecuador</option>
                  <option value="Peru">Peru</option>
                  <option value="Chile">Chile</option>
                  <option value="Colombia">Colombia</option>
                  <option value="Panama">Panama</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div class="form-group">
                <label for="newUnitType">Unit Type</label>
                <select class="form-control" id="newUnitType" name="tipo" required>
                  <option value="">-- Select Unit Type --</option>
                  <option value="Pallets">Pallets</option>
                  <option value="Boxes">Boxes</option>
                </select>
              </div>
              <div class="form-group">
                <label for="newTaxes">Taxes ($)</label>
                <input type="number" min="0" step="0.01" pattern="\d*\.?\d*" inputmode="decimal"  class="form-control" id="newTaxes" name="taxes" required placeholder="Enter taxes amount">
              </div>
              <div class="form-group">
                <label for="newIntercom">INTERCOM ($)</label>
                <input type="number" min="0" step="0.01" pattern="\d*\.?\d*" inputmode="decimal" class="form-control" id="newIntercom" name="intercom" required placeholder="Enter INTERCOM">
              </div>
              <div class="form-group">
                <label for="newProfit">Profit ($)</label>
                <input type="number" min="0" step="0.01" pattern="\d*\.?\d*" inputmode="decimal" class="form-control" id="newProfit" name="profit" required placeholder="Enter profit">
              </div>
              <div class="form-group">
                <label for="newTotal">Total ($)</label>
                <input type="number" step="0.01" class="form-control" id="newTotal" name="total" readonly placeholder="Calculated automatically" readonly>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save Entry</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>

<!-- Edit Tax Modal -->
  <div class="modal fade" id="editTaxModal" tabindex="-1" role="dialog" aria-labelledby="editTaxModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form id="editTaxesForm" method="POST" action="" >
        @csrf
        @method('PUT')
        <input type="hidden" id="editTaxesRealId" name="id">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Tax Entry</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>ID Taxes</label>
              <input type="text" class="form-control" id="editTaxId" readonly>
            </div>
            <div class="form-group">
              <label>Destination</label>
              <select class="form-control" id="editDestination" name="destino" required>
                <option value="">-- Select Country --</option>
                <option value="United States">United States</option>
                <option value="Canada">Canada</option>
                <option value="Mexico">Mexico</option>
                <option value="Spain">Spain</option>
                <option value="France">France</option>
                <option value="Germany">Germany</option>
                <option value="Italy">Italy</option>
                <option value="Brazil">Brazil</option>
                <option value="Argentina">Argentina</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Peru">Peru</option>
                <option value="Chile">Chile</option>
                <option value="Colombia">Colombia</option>
                <option value="Panama">Panama</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="form-group">
              <label>Unit Type</label>
              <select class="form-control" id="editUnitType" name="tipo" required>
                <option value="">-- Select Unit Type --</option>
                <option value="Pallets">Pallets</option>
                <option value="Boxes">Boxes</option>
              </select>
            </div>
            <div class="form-group">
              <label>Taxes ($)</label>
              <input type="number" min="0" step="0.01" pattern="\d*\.?\d*" inputmode="decimal" class="form-control" id="editTaxes" name="taxes" required placeholder="Enter taxes amount">
            </div>
            <div class="form-group">
              <label>INTERCOM ($)</label>
              <input type="number" min="0" step="0.01" pattern="\d*\.?\d*" inputmode="decimal" class="form-control" id="editIntercom" name="intercom" required placeholder="Enter INTERCOM">
            </div>
            <div class="form-group">
              <label>Profit ($)</label>
              <input type="number" min="0" step="0.01" pattern="\d*\.?\d*" inputmode="decimal" class="form-control" id="editProfit" name="profit" required placeholder="Enter profit">
            </div>
            <div class="form-group">
              <label>Total ($)</label>
              <input type="number" step="0.01" class="form-control" id="editTotal" name="total" readonly placeholder="Calculated automatically" readonly>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Update Entry</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
document.addEventListener('DOMContentLoaded', function() {
    // Referencia correcta al formulario
    const editTaxesForm = document.getElementById('editTaxesForm');
    const addTaxForm = document.getElementById('addTaxForm');

    function calculateTotal(prefix) {
        try {
            const taxes = parseFloat(document.getElementById(prefix + 'Taxes').value) || 0;
            const intercom = parseFloat(document.getElementById(prefix + 'Intercom').value) || 0;
            const profit = parseFloat(document.getElementById(prefix + 'Profit').value) || 0;
            const totalField = document.getElementById(prefix + 'Total');

            if(totalField) {
                totalField.value = (taxes + intercom + profit).toFixed(2);
            } else {
                console.error(`Total field with id ${prefix}Total not found`);
            }
        } catch(error) {
            console.error('Error calculating total:', error);
        }
    }

    function validateNumericInput(event) {
        const input = event.target;
        let value = parseFloat(input.value);
        
        if (isNaN(value) || value < 0) {
            input.value = 0;
            value = 0;
        }

        // Identificar si estamos en el formulario de nuevo o edición
        const prefix = input.id.startsWith('new') ? 'new' : 'edit';
        calculateTotal(prefix);
    }

    // Inicializar listeners para ambos modales
    ['new', 'edit'].forEach(prefix => {
        ['Taxes', 'Intercom', 'Profit'].forEach(field => {
            const input = document.getElementById(prefix + field);
            if(input) {
                input.addEventListener('input', () => calculateTotal(prefix));
                input.addEventListener('change', validateNumericInput);
            }
        });
    });

    // Función para abrir modal de edición
    window.openEditTaxModal = function(button) {
        const row = button.closest('tr');
        const cells = row.getElementsByTagName('td');
        const formDelete = row.querySelector('form');
        const taxesId = formDelete ? formDelete.action.split('/').pop() : '';

        try {
            // Llenar campos con validación
            document.getElementById('editTaxesRealId').value = taxesId;
            document.getElementById('editTaxId').value = cells[0].innerText;
            document.getElementById('editDestination').value = cells[1].innerText.trim();
            document.getElementById('editUnitType').value = cells[2].innerText.trim();
            document.getElementById('editTaxes').value = parseFloat(cells[3].innerText) || 0;
            document.getElementById('editIntercom').value = parseFloat(cells[4].innerText) || 0;
            document.getElementById('editProfit').value = parseFloat(cells[5].innerText) || 0;

            // Actualizar total
            calculateTotal('edit');

            // Actualizar action del formulario
            if(editTaxesForm) {
                editTaxesForm.action = `/dashboard-admin/taxes/${taxesId}`;
            }

            $('#editTaxModal').modal('show');
        } catch(error) {
            console.error('Error opening edit modal:', error);
        }
    }

    // Evento para calcular total en formulario nuevo
    if(addTaxForm) {
        addTaxForm.addEventListener('input', function(e) {
            if(['newTaxes', 'newIntercom', 'newProfit'].includes(e.target.id)) {
                calculateTotal('new');
            }
        });
    }
});
</script>

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

@endsection
