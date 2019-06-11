function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
let buttonSubmit = $("#buttonSubmit");
let buttonRegistrar = $("#btnRegistrar");

buttonSubmit.click(function () {
  
  buttonSubmit.attr("hidden", "true");
  let informationAlert = $("#informationAlert");
  let usuario = $("#inputEmail").val();
  let password = $("#inputPassword").val();
  if (usuario == "" || password == "") {
    informationAlert.removeAttr("hidden");
    informationAlert.text("Correo y Contraseña requeridos");
    buttonSubmit.removeAttr("hidden");
    return false;
  }
  if (!validateEmail(usuario)) {
    informationAlert.removeAttr("hidden");
    informationAlert.text("El campo de Correo es erróneo");
    buttonSubmit.removeAttr("hidden");
    return false;
  }
  informationAlert.attr("hidden", "true");

  let usr_data = {
    "accion": "login",
    "usuario": usuario,
    "password": password
  };
  console.log("Aqui se ejecuta la validacion");
  $.ajax({
      data: usr_data,
      type: "POST",
      dataType: "json",
      url: "../back-core/login.php"
    })
    .done((data) => {
      console.log("Conexión correcta ", data);
      if (data.status != 1) {
        $('#buttonSubmit').removeAttr("hidden");
        $('#buttonError').removeAttr("hidden");
      } else {
        $('#buttonError').attr("hidden", "true");
        $('#buttonOk').removeAttr("hidden");

        switch (data.type) {
          case '1':
            setTimeout(function () {
              location.href = './admin/?mod=1';
            }, 1000);
            break;
          case '2':
            setTimeout(function () {
              location.href = './coord/?mod=1';
            }, 1000);
            break;
          case '3':
            setTimeout(function () {
              location.href = './user/?mod=1';
            }, 1000);
            break;
          default:
            location.href = '../auth/404.php';
            break;
        }
        /*setTimeout(function () {
          location.href = './user/?mod=1';
        }, 1000);*/
      }
    })
    .fail(() => {
      console.log("Error en conexión");
      $('#buttonSubmit').removeAttr("hidden");
      $('#buttonError').removeAttr("hidden");
    })

  // Mostrar mensaje de error
  // Redireccionar a usuarios.php
});


buttonRegistrar.click(function(){
        console.log("Registrando");
       ///console.log($(this).data("edicion"));
        ///e.preventDefault();
        let nom=$("#name").val();
        let mac=$("#mac").val();
        let appat=$("#lastname").val();
        let apmat=$("#lastnameM").val();
        let cor=$("#email").val();
        let tel=$("#phone").val();
        let lis=$("#lista").val();
        let tip=$("#tipo").val();
        let niv=$("#nivel").val();
       
        let obj={
            accion: "registrar_usuarios",
            nom: nom,
            mac: mac,
            appat: appat,
            apmat: apmat,
            tel: tel,
            cor: cor,
            lis: lis,
            tip: tip,
            niv: niv
        }
        if(mac=="" || nom=="" || appat=="" || lis==0 || apmat=="" || cor=="" || tel=="" || niv==""){
          alert("No dejes campos vacios");
        }
        if (!validateEmail(cor)) {
            alert("El campo de Correo es erróneo");
            return false;
        }else{
          $.ajax({
            url: "../includes/_funciones.php",
            type: "POST",
            dataType: "json",
            data: obj
          })
          alert("Registro completado correctmante (Espere a que el Asesor de Sistemas active su cuenta");
          location.reload();
        }
    });