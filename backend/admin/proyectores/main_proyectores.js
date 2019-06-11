$(document).ready(function(){

  Mostrar();

  tablapro =$("tablapro").DataTable({

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

$("#btnpro").click(function(){
  $("#formulario").trigger("reset");
  $(".modal-header").css("background-color","#28a745");
  $(".modal-header").css("color","white");
  $(".modal-title").text("Agregar Proyector");
  $("#btnGuardarPro").text("Guardar");
  $("#modalpro").modal("show");
});

//BOTON GUARDAR
$("#btnGuardarPro").click(function(){
  console.log("en formulario")
  nom=$("#nombre").val();
  est=$("#lista").val();
  mod=$("#modelo").val();
  mar=$("#marca").val();



  obj={
    accion: "insertar_proyectores",
    nom: nom,
    est: est,
    mod: mod,
    mar: mar
  }

  if($(this).data("edicion")==1){
    obj["accion"]="editar_proyectores";
       obj["id"]=$(this).data("id");
     $(this).removeData("edicion").removeData("id");
   }


   if(nom=="" ||est=="" || mod=="" || mar == ""){
       alert("No dejes campos vacios");
       return;
   }else{
       $.ajax({
           url: "../../includes/funciones_proyectores.php",
           type: "POST",
           dataType: "json",
           data: obj,
           success: function(data){
          console.log(data);
           }
       })
       $("#modalpro").modal("hide");
      location.reload();
   }
});

//ELIMINAR
$(document).on("click", ".eliminar_proyectores", function(){
  id=$(this).data("id");

  $.ajax({
      url: "../../includes/funciones_proyectores.php",
      type: "POST",
      dataType: "json",
      data: {
          accion: "eliminar_proyectores",
          id: id
      },
      success: function(data){
         // console.log(data);
      }
  })
  location.reload();
});

//EDITAR
$(document).on("click", ".editar_proyectores", function(){
  id=$(this).data("id");

  obj={
      "accion" : "consultar_proyectores",
      "id" : $(this).data("id")
  }


  $.post("../../includes/funciones_proyectores.php", obj, function(data){
      $("#nombre").val(data.pro_nombre);
      $("#lista").val(data.pro_status);
      $("#modelo").val(data.pro_modelo);
      $("#marca").val(data.pro_marca);
  }, "JSON");


  $(".modal-header").css("background-color", "#007bff");
  $(".modal-header").css("color", "white");
  $(".modal-title").text("Editar Proyectores");
  $("#btnGuardarPro").text("Actualizar").data("edicion", 1).data("id", id);
  $("#modalpro").modal("show");
});


function Mostrar(){

  let obj={
      "accion" : "mostrar_proyectores"

  }
  let template = ``;

   $.post("../../includes/funciones_proyectores.php", obj, function(data){
       $.each(data,function(i,e){
           console.log(i,e);
           let status = "";
                      template += `           <tr>
                                  <td>${i+1}</td>
                                  <td>${e.pro_nombre}</td>                             
                                  <td>${e.pro_status}</td>                             
                                  <td>${e.pro_modelo}</td>
                                  <td>${e.pro_marca}</td>
                                  <td>
                                      <a href="#" class="editar_proyectores" data-id="${e.pro_id}" ><i  class="fas fa-edit"></i></a>
                                  </td>
                                  <td>
                                      <a href="#" class="eliminar_proyectores" data-id="${e.pro_id}" ><i class="fas fa-trash"></i></a>
                              </td>
                              </tr>`;

       });
       $("#tablapro tbody").html(template);
  }, "JSON");


}

});
