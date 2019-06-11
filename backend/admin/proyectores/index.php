<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <br><br>
        <h2>Proyectores
        <button id="btnpro" type="button" class="btn btn-primary" data-toggle="modal">Agregar nuevo
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
                    <table id="tablapro" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nombre</th>
                            <th>Estatus del proyector</th>
                            <th>Modelo</th>
                            <th>Marca</th>
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
<div class="modal fade" id="modalpro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <label for="nombre" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre">
            </div>
             
             <div class="form-group">
            <label for="nombre" class="col-form-label">Modelo:</label>
            <input type="text" class="form-control" id="modelo">
            </div>

            <div class="form-group">
            <label for="descripcion" class="col-form-label">Marca:</label>
            <input type="text" class="form-control" id="marca">
            </div>
            
             <div class="form-group">
            <label for="descripcion" class="col-form-label">Estatus:</label><br>
            <select id="lista">
               <option value="1">Activo</option>
               <option value="0">Inactivo</option>
            </select>
          </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="button" id="btnGuardarPro" class="btn btn-success">Guardar</button>
        </div>
    </form>
    </div>
</div>

</div>
