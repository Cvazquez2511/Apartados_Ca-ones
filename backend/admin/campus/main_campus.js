$(document).ready(function(){    
    //inicializar el plugin de datatable        
    Mostrar();
    
    tablacampus=$("#tablacampus").DataTable({
       
        
        //Para cambiar el lenguaje a español
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
    //inicializar accion del boton para mostrar el modal
    $("#btnNuevo").click(function(){         
        $("#formulario").trigger("reset");
        $(".modal-header").css("background-color","#28a745"); 
        $(".modal-header").css("color","white"); 
        $(".modal-title").text("Agregar Campus");  
        $("#btnGuardarCamp").text("Guardar");  
        $("#modalcampus").modal("show");   
    });
    //Obtener los parametros
    $("#btnGuardarCamp").click(function(){
        console.log("en formulario")                
        ciu=$("#ciudad").val();
        state=$("#estado").val();        
        est=$("#lista").val();
            
        obj={
                accion: "insertar_campus",                
                ciu: ciu,
                state: state,
                est: est                
            }            
        if($(this).data("edicion")==1){
            obj["accion"]="editar_campus";
            obj["id"]=$(this).data("id");
            $(this).removeData("edicion").removeData("id");
        }
        
        if(ciu=="" || state==""){
            alert("No dejes campos vacios");
            return;
        }else{
            $.ajax({
                url: "../../includes/funciones_campus.php",
                type: "POST",
                dataType: "json",
                data: obj,
                success: function(data){
                    console.log(data);
                }
            })
            $("#modalcampus").modal("hide");
            location.reload();
        }
    });
    
    //Eliminar
    $(document).on("click", ".eliminar_campus", function(){
        id=$(this).data("id");
        
          if(id <=3){
            alert("No se puede eliminar este campus");
            return;
        }
        $.ajax({
            url: "../../includes/funciones_campus.php",
            type: "POST",
            dataType: "json",
            data: {
                accion: "eliminar_campus",
                id: id
            },
            success: function(data){
              //  console.log(data);
            }
        })
        location.reload();
    });

    //Editar
    $(document).on("click", ".editar_campus", function(){
        id=$(this).data("id");
        
        if(id <=3){
            alert("No se puede modificar este rol");
            return;
        }
        
        obj={
            "accion" : "consultar_campus",
            "id" : $(this).data("id")
        }
        $.post("../../includes/funciones_campus.php", obj, function(data){       
            $("#ciudad").val(data.cps_nombre);
            $("#estado").val(data.est_id);            
            $("#lista").val(data.cps_status);                    
        }, "JSON");
        
       
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Campus"); 
        $("#btnGuardarCamp").text("Actualizar").data("edicion", 1).data("id", id);    
        $("#modalcampus").modal("show");  

        
    });

    function Mostrar(){
        
        let obj={
            "accion" : "mostrar_campus"
            
        }
        let template = ``; 
        
         $.post("../../includes/funciones_campus.php", obj, function(data){       
             $.each(data,function(i,e){
                 console.log(i,e);
                 template += `           
                    <tr>
                        <td>${i+1}</td>
                        <td>${e.cps_nombre}</td>
                        <td>${e.est_nombre}</td>
                        <td>${e.cps_status}</td>
                        <td>${e.cps_alta}</td>     
                        <td>
                            <a href="#" class="editar_campus" data-id="${e.cps_id}" ><i  class="fas fa-edit"></i></a>
                        </td>
                        <td>
                            <a href="#" class="eliminar_campus" data-id="${e.cps_id}" ><i class="fas fa-trash"></i></a>
                        </td>  
                    </tr>`; 
                 
             });
             $("#tablacampus tbody").html(template);
            // tablacampus.trigger("update");
        }, "JSON");
        
                                    
    }
});