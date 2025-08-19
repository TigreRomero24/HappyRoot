@extends('layouts.layout_cliente')

@section('title', 'Home - My Account')

@section('content')
<div class="container-fluid col-sm-8 der rounded shadow p-3 ml-5">
    <h1 class="container-fluid text-center account-title mt-4">Edit account data</h1>
    <hr style="border: none; height: 2px; background-color: #ccc;">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('client.update-account') }}" method="POST" id="updateForm">
        @csrf
        @method('PUT')
        <div class="container col-sm-6 my-4 mt-5">
            <div class="row mb-2 align-items-center">
                <div class="col-md-4 font-weight-bold">Username</div>
                <div class="col-md-5" id="data-nombre">{{ auth()->user()->nombre }}</div>
                <div class="col-md-3 text-right">
                    <button type="button" class="btn btn-sm btn-primary edit-btn" data-target="data-nombre">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </div>
            </div>

            <div class="row mb-2 align-items-center">
                <div class="col-md-4 font-weight-bold">Password</div>
                <div class="col-md-5" id="data-password">••••••••</div>
                <div class="col-md-3 text-right">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#passwordModal">
                        <i class="fas fa-edit"></i> Change
                    </button>
                </div>
            </div>

            <div class="row mb-2 align-items-center">
                <div class="col-md-4 font-weight-bold">Email</div>
                <div class="col-md-5" id="data-email">{{ auth()->user()->email }}</div>
                <div class="col-md-3 text-right">
                    <button type="button" class="btn btn-sm btn-primary edit-btn" data-target="data-email">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </div>
            </div>

            <div class="row mb-2 align-items-center">
                <div class="col-md-4 font-weight-bold">Company</div>
                <div class="col-md-5" id="data-compania">{{ auth()->user()->compania }}</div>
                <div class="col-md-3 text-right">
                    <button type="button" class="btn btn-sm btn-primary edit-btn" data-target="data-compania">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </div>
            </div>

            <div class="row mb-2 align-items-center">
                <div class="col-md-4 font-weight-bold">Country</div>
                <div class="col-md-5" id="data-pais">{{ auth()->user()->pais }}</div>
                <div class="col-md-3 text-right">
                    <button type="button" class="btn btn-sm btn-primary edit-btn" data-target="data-pais">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </div>
            </div>

            <div class="row mb-2 align-items-center">
                <div class="col-md-4 font-weight-bold">Contact</div>
                <div class="col-md-5" id="data-contacto">{{ auth()->user()->contacto }}</div>
                <div class="col-md-3 text-right">
                    <button type="button" class="btn btn-sm btn-primary edit-btn" data-target="data-contacto">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-success" id="saveAllBtn">
                        <i class="fas fa-save"></i> Save All Changes
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal para cambiar contraseña -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('client.update-password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Confirm New Password</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentEditingButton = null;
let originalValues = {};

// Prevenir envío del formulario al presionar Enter
document.getElementById('updateForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Si hay un botón en modo edición, simula su clic
    if (currentEditingButton) {
        currentEditingButton.click();
    }
});

document.querySelectorAll(".edit-btn").forEach(button => {
    button.addEventListener("click", function() {
        let targetId = this.getAttribute("data-target");
        let targetElement = document.getElementById(targetId);
        let fieldName = targetId.replace('data-', '');

        // Si hay otro botón en modo edición, cancela la edición
        if (currentEditingButton && currentEditingButton !== this) {
            let previousTargetId = currentEditingButton.getAttribute("data-target");
            let previousElement = document.getElementById(previousTargetId);
            
            // Restaura el valor original
            previousElement.textContent = originalValues[previousTargetId];
            currentEditingButton.innerHTML = `<i class="fas fa-edit"></i> Edit`;
        }

        if (this.textContent.trim() === "Edit") {
            // Guarda el valor original
            originalValues[targetId] = targetElement.textContent.trim();
            
            // Cambia a modo edición
            targetElement.innerHTML = `
                <input type="text" 
                       class="form-control" 
                       name="${fieldName}" 
                       value="${originalValues[targetId]}"
                       required>`;
            this.innerHTML = `<i class="fas fa-save"></i> Save`;
            currentEditingButton = this;
        } else {
            // Guarda el valor
            let inputValue = targetElement.querySelector("input").value;
            
            // Actualiza solo el campo modificado
            let formData = new FormData();
            formData.append(fieldName, inputValue);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'PUT');

            // Envía la actualización al servidor
            fetch('{{ route("client.update-account") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    targetElement.textContent = inputValue;
                    this.innerHTML = `<i class="fas fa-edit"></i> Edit`;
                    currentEditingButton = null;
                    
                    // Muestra mensaje de éxito
                    const successAlert = document.createElement('div');
                    successAlert.className = 'alert alert-success mt-2';
                    successAlert.textContent = data.message;
                    targetElement.parentNode.appendChild(successAlert);
                    
                    setTimeout(() => {
                        successAlert.remove();
                    }, 3000);
                } else {
                    // Muestra el mensaje de error
                    const errorAlert = document.createElement('div');
                    errorAlert.className = 'alert alert-danger mt-2';
                    errorAlert.textContent = typeof data.message === 'object' ? 
                        Object.values(data.message).flat().join(', ') : 
                        data.message;
                    targetElement.parentNode.appendChild(errorAlert);
                    
                    // Restaura el valor original
                    targetElement.textContent = originalValues[targetId];
                    this.innerHTML = `<i class="fas fa-edit"></i> Edit`;
                    
                    setTimeout(() => {
                        errorAlert.remove();
                    }, 3000);
                }
            })
            .catch(error => {
                // Muestra error de red o servidor
                const errorAlert = document.createElement('div');
                errorAlert.className = 'alert alert-danger mt-2';
                errorAlert.textContent = 'Error de conexión';
                targetElement.parentNode.appendChild(errorAlert);
                
                // Restaura el valor original
                targetElement.textContent = originalValues[targetId];
                this.innerHTML = `<i class="fas fa-edit"></i> Edit`;
                
                setTimeout(() => {
                    errorAlert.remove();
                }, 3000);
            });
        }
    });
});

// Prevenir envío al presionar Enter en los inputs
document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && currentEditingButton) {
        e.preventDefault();
        currentEditingButton.click();
    }
});
</script>


</div>

</div>
</div>
<div>



</div>

  </div>
</div>
</div>
<div style="height: 50px;"></div>
@endsection
