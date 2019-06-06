    <div class="container">
        <div class="row">
            <div class="col-lg-12"> 
            <br><br>    
            <h2>Usuarios  
            <button id="btnNuevoU" type="button" class="btn btn-primary" data-toggle="modal">Agregar nuevo
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
                        <table id="tablausuario" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre completo</th>
                                <th>Email</th>
                                <th>Telefono</th>
                                <th>Campus</th>
                                <th>Tipo de usuario</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                       

                        </tbody>
                               
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
<!--Modal-->
<div class="modal fade" id="modalusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <input type="text" class="form-control" id="matricula"  placeholder="Matricula">
                </div>
                <div class="form-group">
                <input type="text" class="form-control" id="nombre"  placeholder="Nombre">
                </div>               
                <div class="form-group">
                <input type="text" class="form-control" id="paterno" placeholder="Apellido paterno">
                </div>    
                <div class="form-group">
                <input type="text" class="form-control" id="materno"  placeholder="Apellido materno:">
                </div> 
                <div class="form-group">
                   <select id="lista">
                   <option value="0">Seleccionar Campus</option>
                    <?php 
                            $campus = $db->select("Campus","*"); 
                            foreach ($campus as $campus => $cps) {
                        ?>
                                <option value="<?php echo $cps["cps_id"]?>"><?php echo $cps["cps_nombre"]?></option>
                        <?php
                            }
                        ?>
                   </select>
                </div>  
                <div class="form-group">
                <input type="email" class="form-control" name="correo" id="correo" placeholder="Email">
                </div>  
                <div class="form-group">
                <input type="password" class="form-control" id="pass" placeholder="Contraseña">
                </div>
                <div class="form-group">
                <input type="number" class="form-control" id="tel" placeholder="Telefono">
                </div>    
                <div class="form-group">
                   <select id="tipo">
                   <option value="0">Seleccionar Tipo de usuario</option>
                    <?php 
                            $tipo = $db->select("Roles","*"); 
                            foreach ($tipo as $tipo => $tyu) {
                        ?>
                                <option value="<?php echo $tyu["rol_Id"]?>"><?php echo $tyu["rol_Nombre"]?></option>
                        <?php
                            }
                        ?>
                   </select>
                </div>  
                <div class="form-group">
                <input type="text" class="form-control" id="nivel" placeholder="Nivel educativo">
                </div>  
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnGuardar" class="btn btn-success">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>       
