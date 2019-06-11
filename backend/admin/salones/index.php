<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <br><br>
        <h2>Salones
        <button id="btnsalon" type="button" class="btn btn-primary" data-toggle="modal">Agregar nuevo
            <span class="fas fa-plus"></span>
        </button>
    </h2>

        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablasal" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Numero de Salón</th>
                            <th>Capacidad</th>
                            <th>Audiovisual</th>
                            <th>Fecha Alta</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">


                    </tbody>

                   </table>
                </div>
            </div>
    </div>
</div>

<!--Modal-->
<div class="modal fade" id="modalsal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
        </div>
    <form id="formulario" action="">
        <div class="modal-body">
             <div class="form-group">
            <label for="nombre" class="col-form-label">Numero de Salón:</label>
            <input type="text" class="form-control" id="num">
            </div>
            <div class="form-group">
            <label for="descripcion" class="col-form-label">Capacidad:</label>
            <input type="text" class="form-control" id="cap">
            </div>
            <div class="form-group">
              <label for="descripcion" class="col-form-label">Audiovisual:</label><br>
                <select id="lista"> 
                    <option value="Ninguno">Ninguno</option>
                    <option value="Pantalla">Pantalla</option>
                    <option value="Proyector">Proyector</option>            
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="button" id="btnGuardarSal" class="btn btn-success">Guardar</button>
        </div>
    </form>
    </div>
</div>

</div>
