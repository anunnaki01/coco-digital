<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLongTitle">Registrar servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="service-add">
                    <input id="id" name="id" type="hidden" value="0">
                    <div class="form-group">
                        <label for="name">Nombre* </label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Estado </label>
                        <select class="form-control" name="is_enabled" id="is_enabled" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="preparation">Preparación* </label>
                        <input type="text" class="form-control" name="preparation" id="preparation"
                               placeholder="Enter preparation" required>
                    </div>
                    <div class="form-group">
                        <label for="time">Tiempo* </label>
                        <input type="text" class="form-control" name="time" id="time"
                               placeholder="Enter time" required>
                    </div>
                    <div class="form-group">
                        <label for="place">Profesional* </label>
                        <select class="form-control" name="place_id" id="place_id" required>
                            @foreach($places as $place)
                                <option value="{{$place['id']}}">{{$place['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-modal-service">Cerrar
                    </button>
                    <button type="submit" class="btn btn-primary" id="service-save">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>