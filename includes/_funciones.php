<?php  

    require_once '_db.php';
    if(isset($_POST["accion"])){
	    switch ($_POST["accion"]) {
            case 'insertar_usuarios':
                insertar_usuarios();
            break;
            case 'consultar_usuarios':
                consultar_usuarios($_POST["id"]);
            break;
            case 'eliminar_usuarios':
                eliminar_usuarios($_POST["id"]);
            break;
            case 'editar_usuarios':
                editar_usuarios();
            break;
            case 'mostrar_usuarios':
                mostrar_usuarios();
            break;

        }
            
    }

    function insertar_usuarios(){
        global $db;
        extract($_POST);

        $insertar=$db ->insert("usuarios",["usr_id" => $mac,
                                            "usr_nombre"=>$nom,
                                            "usr_appat"=>$pat,
                                            "usr_apmat"=>$mat,
                                            "usr_email"=>$cor,
                                            "usr_tel"=>$tel,
                                            "usr_password"=>$pass,
                                            "usr_nivel"=>$niv,
                                            "cps_id"=>$lista,
                                            "rol_Id"=>$tip,
                                            "usr_fechA"=>date("Y").date("m").date("d"),
                                            "usr_status"=>1
                                            ]);
        if($insertar){
            echo "Registro existoso";
        }else{
            echo "Se ocasiono un error";
	    }
    }

    function consultar_usuarios($id){
        global $db;
         $consultar = $db -> get("usuarios","*",["AND" => ["usr_status"=>1, "usr_id"=>$id]]);
        echo json_encode($consultar);

    }

    function eliminar_usuarios($id){
        global $db;
        $eliminar = $db->delete("usuarios",["usr_id" => $id]);
        if($eliminar){
            echo "Registro eliminado";
        }else{
            echo "registro eliminado";
        }
    }

    function editar_usuarios(){
        global $db;
        extract($_POST);
         $editar=$db ->update("usuarios",["usr_id" => $mac,
                                        "usr_nombre"=>$nom,
                                        "usr_appat"=>$pat,
                                        "usr_apmat"=>$mat,
                                        "usr_email"=>$cor,
                                        "usr_tel"=>$tel,
                                        "usr_password"=>$pass,
                                        "usr_nivel"=>$niv,
                                        "cps_id"=>$lista,
                                        "rol_Id"=>$tip,
                                        ],["usr_id"=>$id]);
        if($editar){
            echo "Ediccion completada";
        }else{
            echo "Se ocasiono un error";
        } 
    }

    function mostrar_usuarios(){
        global $db;
        $consultar=$db->select("usuarios",
        [
            "[>]Campus"=>"cps_id",
            "[>]Roles"=>"rol_Id"
        ],
        [
            "usuarios.usr_id",
            "usuarios.usr_nombre",
            "usuarios.usr_appat",
            "usuarios.usr_apmat",
            "usuarios.usr_email",
            "usuarios.usr_tel",
            "usuarios.usr_status",
            "usuarios.usr_password",
            "Campus.cps_id",
            "Campus.cps_nombre",
            "Roles.rol_Id",
            "Roles.rol_Nombre"                                      
        ],["usr_status"=>1,"ORDER" => [ "usr_fechA" => "ASC" ]
        ]); 
        echo json_encode($consultar);
    }
    

?>

