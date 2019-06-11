$(document).ready(function(){
  
  Mostrar();
  
  tablasal =$("tablasal").DataTable({

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
//BOTON NUEVO SALON

$("#btnsalon").click(function(){
  $("#formulario").trigger("reset");
  $(".modal-header").css("background-color","#28a745"); 
  $(".modal-header").css("color","white"); 
  $(".modal-title").text("Agregar Salon");  
  $("#btnGuardarSal").text("Guardar");  
  $("#modalsal").modal("show");   
});

//BOTON GUARDAR
$("#btnGuardarSal").click(function(){
  
  num=$("#num").val();
  cap=$("#cap").val();
  av=$("#lista").val();

//Checa si un radio esta seleccionado y guarda el valor en av
 /* var isChecked = document.getElementById('pan').checked;
  if(isChecked){
      av=$("#pan").val();
  }
  var isChecked = document.getElementById('pro').checked;
  if(isChecked){
      av=$("#pro").val();
  }*/

  obj={
    accion: "insertar_salon",                
    num: num,
    cap: cap,
    av:av              
  }    

  if($(this).data("edicion")==1){
    obj["accion"]="editar_salon";
       obj["id"]=$(this).data("id");
     $(this).removeData("edicion").removeData("id");
   }

   
   if(num=="" || cap=="" || av == ""){
       alert("No dejes campos vacios");
       return;
   }else{
       $.ajax({
           url: "../../includes/funciones_salones.php",
           type: "POST",
           dataType: "json",
           data: obj,
           success: function(data){
               console.log(data);
           }
       })
       $("#modalsal").modal("hide");
      location.reload();
   }
});

//ELIMINAR
$(document).on("click", ".eliminar_salon", function(){
  id=$(this).data("id");

  $.ajax({
      url: "../../includes/funciones_salones.php",
      type: "POST",
      dataType: "json",
      data: {
          accion: "eliminar_salon",
          id: id
      },
      success: function(data){
          console.log(data);
      }
  })
  location.reload();
});

//EDITAR
$(document).on("click", ".editar_salon", function(){
  id=$(this).data("id");
  
  obj={
      "accion" : "consultar_salon",
      "id" : $(this).data("id")
  }

  
  $.post("../../includes/funciones_salones.php", obj, function(data){       
      $("#num").val(data.sal_num);
      $("#cap").val(data.sal_cap);            
      $("#lista").val(data.sal_av);                    
  }, "JSON");
  
 
  $(".modal-header").css("background-color", "#007bff");
  $(".modal-header").css("color", "white");
  $(".modal-title").text("Editar Salon"); 
  $("#btnGuardarSal").text("Actualizar").data("edicion", 1).data("id", id);    
  $("#modalsal").modal("show");    
});


function Mostrar(){
          
  let obj={
      "accion" : "mostrar_salon"
      
  }
  let template = ``; 
  
   $.post("../../includes/funciones_salones.php", obj, function(data){       
       $.each(data,function(i,e){
           console.log(i,e);
           let status = "";
                      template += `           <tr>
                                  <td>${i+1}</td>
                                  <td>${e.sal_num}</td>
                                  <td>${e.sal_cap}</td>
                                  <td>${e.sal_av}</td>                                       
                                  <td>${e.sal_fa}</td>     
                                  <td>
                                      <a href="#" class="editar_salon" data-id="${e.sal_id}" ><i  class="fas fa-edit"></i></a>
                                  </td>
                                  <td>
                                      <a href="#" class="eliminar_salon" data-id="${e.sal_id}" ><i class="fas fa-trash"></i></a>
                              </td>  
                              </tr>`; 
           
       });
       $("#tablasal tbody").html(template);
  }, "JSON");
  
                              
}

});
