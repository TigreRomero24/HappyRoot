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
      <!-- Ejemplo inicial -->
      <tr>
        <td>1</td>
        <td class="userCell">jdoe</td>
        <td class="emailCell">jdoe@example.com</td>
        <td class="companyCell">Ejemplo S.A.</td>
        <td class="countryCell">United States</td>
        <td class="contactCell">+1 555 1234</td>
        <td class="priceLevelCell">Wholesale Price 1</td>
        <td>
          <button class="btn btn-sm btn-warning editBtn">
            <i class="fas fa-edit"></i> Edit
          </button>
          <button class="btn btn-sm btn-danger deleteBtn">
            <i class="fas fa-trash"></i> Delete
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<!-- Modal para agregar/editar usuario -->
<div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editClientForm">
        <div class="modal-header">
          <h5 class="modal-title" id="editClientModalLabel">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline:none;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="userInput">User</label>
              <input type="text" class="form-control" id="userInput" placeholder="Enter username" required>
            </div>
            <div class="form-group col-md-6">
              <label for="passwordInput">Password</label>
              <input type="password" class="form-control" id="passwordInput" placeholder="Enter password" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="emailInput">Email</label>
              <input type="email" class="form-control" id="emailInput" placeholder="Enter email" required>
            </div>
            <div class="form-group col-md-6">
              <label for="companyInput">Company</label>
              <input type="text" class="form-control" id="companyInput" placeholder="Enter company name" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="countrySelect">Country</label>
              <select class="form-control" id="countrySelect" required>
                <option value="">Select country</option>
                <option>United States</option>
                <option>Canada</option>
                <option>Mexico</option>
                <option>Brazil</option>
                <option>United Kingdom</option>
                <option>Germany</option>
                <option>France</option>
                <option>Spain</option>
                <option>Italy</option>
                <option>Argentina</option>
                <option>Colombia</option>
                <option>Chile</option>
                <option>Ecuador</option>
                <option>Peru</option>
                <option>Costa Rica</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="contactInput">Contact</label>
              <input type="text" class="form-control" id="contactInput" placeholder="Enter contact number or name" required>
            </div>
          </div>

          <div class="form-group">
            <label for="priceLevelSelect">Wholesale Price</label>
            <select class="form-control" id="priceLevelSelect" required>
              <option value="">Select Wholesale Price</option>
              <option>Wholesale Price 1</option>
              <option>Wholesale Price 2</option>
              <option>Wholesale Price 3</option>
              <option>Distributor Price 1</option>
              <option>Distributor Price 2</option>
              <option>Retailer Price 1</option>
              <option>Retailer Price 2</option>
              <option>Corporate Price 1</option>
              <option>Corporate Price 2</option>
              <option>Partner Price</option>
              <option>Reseller Price</option>
              <option>Agent Price</option>
              <option>Key Account Price</option>
              <option>VIP Customer Price</option>
              <option>Special Contract Price</option>
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
  const addUserBtn = document.getElementById('addUserBtn');
  const editClientModal = $('#editClientModal');
  const editClientForm = document.getElementById('editClientForm');

  // Inputs modal
  const userInput = document.getElementById('userInput');
  const passwordInput = document.getElementById('passwordInput');
  const emailInput = document.getElementById('emailInput');
  const companyInput = document.getElementById('companyInput');
  const countrySelect = document.getElementById('countrySelect');
  const contactInput = document.getElementById('contactInput');
  const priceLevelSelect = document.getElementById('priceLevelSelect');

  let currentEditingRow = null;
  let isAddingNew = false;

  function updateIDs() {
    const rows = companyTable.querySelectorAll('tbody tr');
    rows.forEach((row, index) => {
      row.cells[0].textContent = index + 1;
    });
  }

  addUserBtn.addEventListener('click', () => {
    currentEditingRow = null;
    isAddingNew = true;

    // Limpiar campos
    userInput.value = '';
    passwordInput.value = '';
    emailInput.value = '';
    companyInput.value = '';
    countrySelect.value = '';
    contactInput.value = '';
    priceLevelSelect.value = '';

    $('#editClientModalLabel').text('Add New User');
    editClientModal.modal('show');
  });

  companyTable.addEventListener('click', (e) => {
    if (e.target.closest('.editBtn')) {
      currentEditingRow = e.target.closest('tr');
      isAddingNew = false;

      userInput.value = currentEditingRow.querySelector('.userCell')?.textContent || '';
      passwordInput.value = ''; // Por seguridad no se muestra password
      emailInput.value = currentEditingRow.querySelector('.emailCell').textContent;
      companyInput.value = currentEditingRow.querySelector('.companyCell').textContent;
      countrySelect.value = currentEditingRow.querySelector('.countryCell').textContent;
      contactInput.value = currentEditingRow.querySelector('.contactCell').textContent;
      priceLevelSelect.value = currentEditingRow.querySelector('.priceLevelCell').textContent;

      $('#editClientModalLabel').text('Edit User');
      editClientModal.modal('show');
    }

    if (e.target.closest('.deleteBtn')) {
      if (confirm('Are you sure you want to delete this user?')) {
        const row = e.target.closest('tr');
        row.remove();
        updateIDs();
      }
    }
  });

  editClientForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const user = userInput.value.trim();
    const password = passwordInput.value.trim();
    const email = emailInput.value.trim();
    const company = companyInput.value.trim();
    const country = countrySelect.value;
    const contact = contactInput.value.trim();
    const priceLevel = priceLevelSelect.value;

    if (!user || !password || !email || !company || !country || !contact || !priceLevel) {
      alert('Please fill in all fields.');
      return;
    }

    if (isAddingNew) {
      const tbody = companyTable.querySelector('tbody');
      const newRow = document.createElement('tr');
      newRow.innerHTML = `
        <td></td>
        <td class="userCell">${user}</td>
        <td class="emailCell">${email}</td>
        <td class="companyCell">${company}</td>
        <td class="countryCell">${country}</td>
        <td class="contactCell">${contact}</td>
        <td class="priceLevelCell">${priceLevel}</td>
        <td>
          <button class="btn btn-sm btn-warning editBtn">
            <i class="fas fa-edit"></i> Edit
          </button>
          <button class="btn btn-sm btn-danger deleteBtn">
            <i class="fas fa-trash"></i> Delete
          </button>
        </td>
      `;
      tbody.appendChild(newRow);
      updateIDs();
    } else if (currentEditingRow) {
      currentEditingRow.querySelector('.userCell').textContent = user;
      // No guardamos password visible, normalmente lo manejarías en backend
      currentEditingRow.querySelector('.emailCell').textContent = email;
      currentEditingRow.querySelector('.companyCell').textContent = company;
      currentEditingRow.querySelector('.countryCell').textContent = country;
      currentEditingRow.querySelector('.contactCell').textContent = contact;
      currentEditingRow.querySelector('.priceLevelCell').textContent = priceLevel;
    }

    editClientModal.modal('hide');
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

