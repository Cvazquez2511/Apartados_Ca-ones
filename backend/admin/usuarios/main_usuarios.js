
$(document).ready(function(){
    //inicializar el plugin de datatable
    mostrar_usuarios();
    $("#tablausuario").DataTable({

        
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

    
//Obtener los parametros
$("#btnGuardar").click(function(){
    console.log($(this).data("edicion"));
    ///e.preventDefault();
    let mac=$("#matricula").val();
    let nom=$("#nombre").val();
    let pat=$("#paterno").val();
    let mat=$("#materno").val();
    let lista=$("#lista").val();
    let cor=$("#correo").val();
    let tel=$("#tel").val();
    let tip=$("#tipo").val();
    let niv=$("#nivel").val();
    let pass=$("#pass").val();
    let obj={
        accion: "insertar_usuarios",
        mac: mac,
        nom: nom,
        pat: pat,
        mat: mat,
        lista: lista,
        cor: cor,
        tel: tel,
        tip: tip,
        pass,
        niv: niv
    }

    if($(this).data("edicion")==1){
        obj["accion"]="editar_usuarios";
        obj["id"]=$(this).data("id");
      $(this).removeData("edicion").removeData("id");
    }
    
    if(mac=="" || nom=="" || pat=="" || lista==0 || mat=="" || cor=="" || tel=="" || niv=="" || pass==""){
        alert("No dejes campos vacios");
    }else{
        $.ajax({
            url: "../../includes/_funciones.php",
            type: "POST",
            dataType: "json",
            data: obj
        })
        $("#modalusuario").modal("hide");
        location.reload();
    }
    
    //console.log("matricula", mac)
    
});


//inicializar accion del boton para mostrar el modal
$("#btnNuevoU").click(function(){    
$("#formulario").trigger("reset");
$(".modal-header").css("background-color","#28a745"); 
$(".modal-header").css("color","white"); 
$(".modal-title").text("Agregar usuario");  
$("#modalusuario").modal("show");   
});
//Editar
$(document).on("click",".editar_usuarios",function(){
    id=$(this).data("id");
    
    
    obj={
        "accion" : "consultar_usuarios",
        "id" : $(this).data("id")
    }
    $.post("../../includes/_funciones.php", obj, function(data){
        $("#matricula").val(data.usr_id);
        $("#nombre").val(data.usr_nombre);
        $("#paterno").val(data.usr_appat);
        $("#materno").val(data.usr_apmat);
        $("#lista").val(data.cps_id);
        $("#correo").val(data.usr_email);
        $("#tel").val(data.usr_tel);
        $("#tipo").val(data.rol_Id);
        $("#nivel").val(data.usr_nivel);
        $("#pass").val(data.usr_password);
        
    }, "JSON");
    
   
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Usuarios"); 
    $("#btnGuardar").text("Actualizar").data("edicion", 1).data("id", id);  

    $("#modalusuario").modal("show");  
    

    
});
//eliminar
$(document).on("click", ".eliminar_usuarios",function(){
id=$(this).data("id");
$.ajax({
    url: "../../includes/_funciones.php",
    type: "POST",
    dataType: "json",
    data: {
        accion: "eliminar_usuarios",
        id: id
    },
    success: function(data){
        console.log(data);
    }
})
location.reload();
});
function mostrar_usuarios(){
let obj = {
  "accion" : "mostrar_usuarios"
}

$.post("../../includes/_funciones.php",obj, function(data){
  template = ``; 
  $.each(data, function(e,elem){
    template += `
    <tr>
    <td>${elem.usr_id}</td>
    <td>${elem.usr_nombre.concat( " ", elem.usr_appat, " ", elem.usr_apmat)}</td>
    <td>${elem.usr_email}</td>
    <td>${elem.usr_tel}</td>
    <td>${elem.cps_nombre}</td>
    <td>${elem.rol_Nombre}</td>
    <td>
        <a href="#" class="editar_usuarios" data-id="${elem.usr_id}"><i class="fas fa-edit"></i></a>
    </td>
    <td>
        <a href="#" class="eliminar_usuarios" data-id="${elem.usr_id}"><i class="fas fa-trash"></i></a>
    </td>            
    </tr>
    `;
  });
  $("#tablausuario tbody").html(template);
},"JSON");  
 
}

} );
    