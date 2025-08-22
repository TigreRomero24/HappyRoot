@extends('layouts.admin')

@section('title', 'Home - Wholesale Admin')

@section('content')

  
<div class="container-fluid col-sm-8 der rounded shadow p-3 ml-5">
  <div class="container mt-4">
    <button id="addUserBtn" class="btn btn-success mb-3">
      <i class="fas fa-plus"></i> Add New User
    </button>

    <table class="table table-bordered table-hover" id="companyTable">
      <thead class="thead-light">
        <tr>
          <th>ID</th>
          <th>User</th>
          <th>Email</th>
          <th>Company</th>
          <th>Country</th>
          <th>Contact</th>
          <th>Wholesale Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($clients as $index => $client)
        <tr data-id="{{ $client->id }}">
          <td>{{ $index + 1 }}</td>
          <td class="userCell">{{ $client->nombre }}</td>
          <td class="emailCell">{{ $client->email }}</td>
          <td class="companyCell">{{ $client->compania }}</td>
          <td class="countryCell">{{ $client->pais }}</td>
          <td class="contactCell">{{ $client->contacto }}</td>
          <td class="priceLevelCell">{{ $client->wholesPrice->nombre ?? 'N/A' }}</td>
          <td>
            <button class="btn btn-sm btn-warning editBtn">
              <i class="fas fa-edit"></i> Edit
            </button>
            <form action="{{ route('dashboard-admin.delete', $client->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this client?')">Erase</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Modal para agregar/editar usuario -->
<div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editClientForm" method="POST" action="">
        @csrf
        <input type="hidden" name="_method" value="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="editClientModalLabel">Add/Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline:none;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nombreInput">User</label>
              <input type="text" class="form-control" name="nombre" id="nombreInput" placeholder="Enter username" required>
            </div>
            <div class="form-group col-md-6">
              <label for="passwordInput">Password</label>
              <input type="password" class="form-control" name="password" id="passwordInput" placeholder="Enter password" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="emailInput">Email</label>
              <input type="email" class="form-control" name="email" id="emailInput" placeholder="Enter email" required>
            </div>
            <div class="form-group col-md-6">
              <label for="companyInput">Company</label>
              <input type="text" class="form-control" name="compania" id="companyInput" placeholder="Enter company name" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="countrySelect">Country</label>
              <select class="form-control" name="pais" id="countrySelect" required>
                <option value="">Select country</option>
                <option value="United States">United States</option>
                <option value="Canada">Canada</option>
                <option value="Mexico">Mexico</option>
                <option value="Brazil">Brazil</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="Germany">Germany</option>
                <option value="France">France</option>
                <option value="Spain">Spain</option>
                <option value="Italy">Italy</option>
                <option value="Argentina">Argentina</option>
                <option value="Colombia">Colombia</option>
                <option value="Chile">Chile</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Peru">Peru</option>
                <option value="Costa Rica">Costa Rica</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="contactInput">Contact</label>
              <input type="text" class="form-control" name="contacto" id="contactInput" placeholder="Enter contact number or name" required>
            </div>
          </div>

          <div class="form-group">
            <label for="priceLevelSelect">Wholesale Price</label>
            <select class="form-control" name="wholesPrice_id" id="priceLevelSelect" required>
              @foreach ($precios as $precio)
              <option value="{{ $precio->id }}">{{ $precio->nombre }}</option>
              @endforeach
            </select>
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
const companyTable = document.getElementById('companyTable');
const editClientModal = $('#editClientModal');
const editClientForm = document.getElementById('editClientForm');
const addUserBtn = document.getElementById('addUserBtn');

let currentEditingRow = null;
let editingId = null;

// Editar usuario (abre modal con datos)
companyTable.addEventListener('click', (e) => {
    if (e.target.classList.contains('editBtn')) {
        currentEditingRow = e.target.closest('tr');
        // Obtener ID del formulario de eliminar
        editingId = currentEditingRow.querySelector('form').action.split('/').pop();

        // Llenar campos del modal
        document.getElementById('nombreInput').value = currentEditingRow.querySelector('.userCell').textContent.trim();
        document.getElementById('emailInput').value = currentEditingRow.querySelector('.emailCell').textContent.trim();
        document.getElementById('companyInput').value = currentEditingRow.querySelector('.companyCell').textContent.trim();
        document.getElementById('countrySelect').value = currentEditingRow.querySelector('.countryCell').textContent.trim();
        document.getElementById('contactInput').value = currentEditingRow.querySelector('.contactCell').textContent.trim();

        // Manejar el select de precios
        const priceValue = currentEditingRow.querySelector('.priceLevelCell').textContent.trim();
        const priceSelect = document.getElementById('priceLevelSelect');
        Array.from(priceSelect.options).forEach(opt => {
            opt.selected = opt.text === priceValue;
        });

        // Configurar el modal para edición
        $('#editClientModalLabel').text('Edit User');
        editClientForm.action = `/dashboard-admin/${editingId}`;
        editClientForm.querySelector('[name="_method"]').value = "PUT";
        
        // Campo de contraseña no requerido en edición
        document.getElementById('passwordInput').required = false;

        editClientModal.modal('show');
    }
});

// Agregar usuario nuevo (abre modal vacío)
addUserBtn.addEventListener('click', () => {
    currentEditingRow = null;
    editingId = null;

    // Limpiar formulario
    editClientForm.reset();
    
    // Configurar el modal para crear
    $('#editClientModalLabel').text('Add New User');
    editClientForm.action = '/dashboard-admin/clients';
    editClientForm.querySelector('[name="_method"]').value = "POST";
    
    // Campo de contraseña requerido al crear
    document.getElementById('passwordInput').required = true;

    editClientModal.modal('show');
});

// Validación antes de enviar
editClientForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Validación básica
    const email = document.getElementById('emailInput').value;
    if (!email.includes('@')) {
        showAlert('Please enter a valid email address', 'error');
        return;
    }

    // Preparar datos del formulario
    const formData = new FormData(this);

    // Enviar mediante AJAX
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mostrar mensaje de éxito
            showAlert(data.message, 'success');
            
            // Cerrar el modal
            editClientModal.modal('hide');
            
            // Recargar la tabla después de 1 segundo
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            // Mostrar mensaje de error
            showAlert(data.message, 'error');
        }
    })
    .catch(error => {
        showAlert('Error al procesar la solicitud', 'error');
        console.error('Error:', error);
    });
});

// Función para mostrar alertas
function showAlert(message, type) {
    // Eliminar alertas anteriores
    const existingAlert = document.querySelector('.alert');
    if (existingAlert) {
        existingAlert.remove();
    }

    // Crear nueva alerta
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-' + (type === 'success' ? 'success' : 'danger') + ' alert-dismissible fade show';
    alertDiv.role = 'alert';
    
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    `;

    // Insertar alerta después del botón "Add New User"
    const addButton = document.getElementById('addUserBtn');
    addButton.parentNode.insertBefore(alertDiv, addButton.nextSibling);

    // Eliminar la alerta después de 3 segundos
    setTimeout(() => {
        alertDiv.remove();
    }, 3000);
}

// Agregar manejador para el botón de eliminar
document.querySelectorAll('form[action*="delete"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (confirm('¿Está seguro de que desea eliminar este cliente?')) {
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert(data.message, 'success');
                    this.closest('tr').remove();
                } else {
                    showAlert(data.message, 'error');
                }
            })
            .catch(error => {
                showAlert('Error al eliminar el cliente', 'error');
                console.error('Error:', error);
            });
        }
    });
});
</script>

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

