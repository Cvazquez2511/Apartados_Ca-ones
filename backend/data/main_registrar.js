//$(document).ready(function(){
    $("#btnRegistrar").click(function(){
        console.log("Registrando");
       ///console.log($(this).data("edicion"));
        ///e.preventDefault();
        let name=$("#name").val();
        let lastname=$("#lastname").val();
        let email=$("#email").val();
        let phone=$("#phone").val();
        let obj={
            accion: "solicitar_registro",
            name: name,
            lastname: lastname,
            email: email,
            phone: phone
        }
        if(name=="" || lastname=="" || email=="" || phone==0){
            alert("No dejes campos vacios");
        }else{
        $.ajax({
            url: "../../includes/funciones_registro.php",
            type: "POST",
            dataType: "json",
            data: obj
        })
        console.log("Registro completo");
    }

    }
//});