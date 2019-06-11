<?php
    require_once '_db.php';
        if(isset($_POST["accion"])){
            switch($_POST["accion"]){

                case 'insertar_proyectores':
                    insertar_proyectores();
                break;

                case 'eliminar_proyectores':
                eliminar_proyectores($_POST['id']);
                break;

                case 'editar_proyectores':

                editar_proyectores();
                break;

                case 'mostrar_proyectores':
                mostrar_proyectores();
                break;

                case 'consultar_proyectores':
                consultar_proyectores($_POST['id']);
                break;
            }
        }

    function insertar_proyectores(){
        global $db;
        extract($_POST);

        $insertar=$db ->insert("proyectores",[                                                                             "pro_nombre"=>$nom,
                                            "pro_status"=>$est,
                                            "pro_modelo"=>$mod,
                                            "pro_marca"=>$mar,
                                            ]);
        if($insertar){
            echo "Registro existoso";
        }else{
            echo "Se ocasiono un error";
	    }
        return;
    }

    function eliminar_proyectores($id){
        global $db;
        $eliminar = $db->delete("proyectores",["pro_id" => $id]);
        if($eliminar){
            echo "Registro eliminado";
        }else{
            echo "registro eliminado";
        }
    }

    function consultar_proyectores($id){
        global $db;
         $consultar = $db -> get("proyectores","*",["AND" => [ "pro_id"=>$id]]);
        echo json_encode($consultar);

    }


    function editar_proyectores(){
        global $db;
        extract($_POST);
         $editar=$db ->update("proyectores",["pro_nombre"=>$nom,
                                        "pro_status"=>$est,
                                        "pro_modelo"=>$mod,
                                        "pro_marca"=>$mar,
                                      ],["pro_id"=>$id]);
        if($editar){
            echo "Edicion completada";
        }else{
            echo "Se ocasiono un error";
        }

    }
    function mostrar_proyectores(){
        global $db;
        $proyectores = $db->select("proyectores","*","");
        echo json_encode($proyectores);
    }
?>
