<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLongTitle">Registrar profesional</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="place-add">
                    <input id="id" name="id" type="hidden" value="0">
                    <div class="form-group">
                        <label for="name">Nombre* </label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Estado </label>
                        <select class="form-control" name="is_active" id="is_active" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="company">Compañía* </label>
                        <select class="form-control" name="company_id" id="company_id" required>
                            @foreach($companies as $company)
                                <option value="{{$company['id']}}">{{$company['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-modal-place">Cerrar
                    </button>
                    <button type="submit" class="btn btn-primary" id="place-save">Guardar</button>
                </form>
            </div>

        </div>
    </div>
</div>