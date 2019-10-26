<!-- Modal -->
<div class="modal fade" id="modalModify" tabindex="-1" role="dialog" aria-labelledby="modalModifyTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModifyLongTitle">Registrar servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="user-modify-form">
                    <input id="id" name="id" type="hidden" value="0">
                    <div class="form-group">
                        <label for="email">Correo* </label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
                    </div>

                    <div class="form-group">
                        <label for="first_name">Nombre* </label>
                        <input type="text" class="form-control" name="first_name" id="first_name"
                               placeholder="Enter first name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Apellido* </label>
                        <input type="text" class="form-control" name="last_name" id="last_name"
                               placeholder="Enter last name" required>
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-modal-service">Cerrar
                    </button>
                    <button type="button" class="btn btn-primary" id="user-modify">Modificar</button>
                </form>
            </div>
        </div>
    </div>
</div>