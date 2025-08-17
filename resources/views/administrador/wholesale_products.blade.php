@extends('layouts.admin')

@section('title', 'Home - Wholesale Products')

@section('content')
<div class="container-fluid col-sm-8 der rounded shadow p-3 ml-5">

  <!-- Button to Add New Product -->
  <div class="mb-3">
    <button class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
      <i class="fas fa-plus"></i> Add New Product
    </button>
  </div>

  <!-- Tabla de productos -->
  <table class="table table-bordered table-hover" id="productTable">
    <thead class="thead-dark">
      <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Unit Type</th>
        <th>Price</th>
        <th>Product Details</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($productos as $index => $producto)
      <tr>
        <td>{{ $index+1 }}</td>
        <td><span class="badge badge-primary">{{ $producto->nombre }}</span></td>
        <td>{{ $producto->tipo }}</td>
        <td>{{ $producto->precio }}</td>
        <td>{{ $producto->descripcion }}</td>
        <td>
          <button class="btn btn-sm btn-warning" onclick="openEditModal(this)">Edit</button>
          <form action="{{ route('dashboard-admin.products.delete', $producto->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Erase</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <!-- Add Product Modal -->
  <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form id="addProductForm" method="POST" action="{{ route('dashboard-admin.products.post') }}">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add New Product</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Product Name</label>
              <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="form-group">
              <label>Unit Type</label>
              <select class="form-control" name="tipo" required>
                <option value="">-- Select Unit Type --</option>
                <option value="Pallets">Pallets</option>
                <option value="Boxes">Boxes</option>
              </select>
            </div>
            <div class="form-group">
              <label>Price</label>
              <input type="number" step="0.01" class="form-control" name="precio" required>
            </div>
            <div class="form-group">
              <label>Product Details</label>
              <textarea class="form-control" name="descripcion" rows="3" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Add Product</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Edit Product Modal -->
  <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form id="editProductForm" method="POST" action="">
        @csrf
        @method('POST')
        <input type="hidden" id="editProductRealId" name="id">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Product</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Product ID</label>
              <input type="text" class="form-control" id="editProductId" readonly>
            </div>
            <div class="form-group">
              <label>Product Name</label>
              <input type="text" class="form-control" id="editProductName" name="nombre" required>
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
              <label>Price</label>
              <input type="number" step="0.01" class="form-control" name="precio" id="editPrice" required>
            </div>
            <div class="form-group">
              <label>Product Details</label>
              <textarea class="form-control" id="editProductDetails" name="descripcion" rows="3" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Update Product</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    // open edit modal and fill fields
    function openEditModal(button) {
      const row = button.closest('tr');
      const cells = row.getElementsByTagName('td');
      const formDelete = row.querySelector('form');
      const productId = formDelete ? formDelete.action.split('/').pop() : '';

      document.getElementById('editProductRealId').value = productId;
      document.getElementById('editProductId').value = cells[0].innerText;
      document.getElementById('editProductName').value = cells[1].innerText.trim();
      document.getElementById('editUnitType').value = cells[2].innerText.trim();
      document.getElementById('editPrice').value = parseFloat(cells[3].innerText);
      document.getElementById('editProductDetails').value = cells[4].innerText;

      // Actualiza la acción del formulario para el producto correcto
      document.getElementById('editProductForm').action = `/dashboard-admin/products/${productId}`;

      $('#editProductModal').modal('show');
    }
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
