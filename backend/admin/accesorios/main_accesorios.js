$(document).ready(function(){

  Mostrar();

  tablaacc =$("tablaacc").DataTable({

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

$("#btnacc").click(function(){
  $("#formulario").trigger("reset");
  $(".modal-header").css("background-color","#28a745");
  $(".modal-header").css("color","white");
  $(".modal-title").text("Agregar Accesorios");
  $("#btnGuardarAcc").text("Guardar");
  $("#modalacc").modal("show");
});

//BOTON GUARDAR
$("#btnGuardarAcc").click(function(){
  console.log("en formulario")
  nom=$("#nombre").val();
    est=$("#lista").val();
  mod=$("#modelo").val();
  mar=$("#marca").val();
  tip=$("#tipo").val();



  obj={
    accion: "insertar_accesorios",
    nom: nom,
    est: est,
    mod: mod,
    mar: mar,
    tip: tip
  }

  if($(this).data("edicion")==1){
    obj["accion"]="editar_accesorios";
       obj["id"]=$(this).data("id");
     $(this).removeData("edicion").removeData("id");
   }


   if(nom=="" ||est=="" || mod=="" || mar == "" || tip == ""){
       alert("No dejes campos vacios");
       return;
   }else{
       $.ajax({
           url: "../../includes/funciones_accesorios.php",
           type: "POST",
           dataType: "json",
           data: obj,
           success: function(data){
          console.log(data);
           }
       })
       $("#modalacc").modal("hide");
      location.reload();
   }
});

//ELIMINAR
$(document).on("click", ".eliminar_accesorios", function(){
  id=$(this).data("id");

  $.ajax({
      url: "../../includes/funciones_accesorios.php",
      type: "POST",
      dataType: "json",
      data: {
          accion: "eliminar_accesorios",
          id: id
      },
      success: function(data){
          //console.log(data);
      }
  })
  location.reload();
});

//EDITAR
$(document).on("click", ".editar_accesorios", function(){
  id=$(this).data("id");

  obj={
      "accion" : "consultar_accesorios",
      "id" : $(this).data("id")
  }


  $.post("../../includes/funciones_accesorios.php", obj, function(data){
      $("#nombre").val(data.acc_nombre);
      $("#lista").val(data.acc_status);
      $("#modelo").val(data.acc_model);
      $("#marca").val(data.acc_marca);
      $("#tipo").val(data.acc_tipo);
  }, "JSON");


  $(".modal-header").css("background-color", "#007bff");
  $(".modal-header").css("color", "white");
  $(".modal-title").text("Editar accesorios");
  $("#btnGuardarAcc").text("Actualizar").data("edicion", 1).data("id", id);
  $("#modalacc").modal("show");
});


function Mostrar(){

  let obj={
      "accion" : "mostrar_accesorios"

  }
  let template = ``;

   $.post("../../includes/funciones_accesorios.php", obj, function(data){
       $.each(data,function(i,e){
           console.log(i,e);
           let status = "";
                      template += `           <tr>
                                  <td>${i+1}</td>
                                  <td>${e.acc_nombre}</td>               
                                  <td>${e.acc_status}</td>
                                  <td>${e.acc_model}</td>
                                  <td>${e.acc_marca}</td>
                                  <td>${e.acc_tipo}</td>
                                  <td>
                                      <a href="#" class="editar_accesorios" data-id="${e.acc_id}" ><i  class="fas fa-edit"></i></a>
                                  </td>
                                  <td>
                                      <a href="#" class="eliminar_accesorios" data-id="${e.acc_id}" ><i class="fas fa-trash"></i></a>
                              </td>
                              </tr>`;

       });
       $("#tablaacc tbody").html(template);
  }, "JSON");


}

});
