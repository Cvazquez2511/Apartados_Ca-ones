<?php
    require_once '_db.php';
        if(isset($_POST["accion"])){
            switch($_POST["accion"]){

                case 'insertar_accesorios':
                    insertar_accesorios();
                break;

                case 'eliminar_accesorios':
                eliminar_accesorios($_POST['id']);
                break;

                case 'editar_accesorios':
                editar_accesorios();
                break;

                case 'mostrar_accesorios':
                mostrar_accesorios();
                break;

                case 'consultar_accesorios':
                consultar_accesorios($_POST['id']);
                break;
            }
        }

    function insertar_accesorios(){
        global $db;
        extract($_POST);

        $insertar=$db ->insert("accesorios",[
                                            "acc_nombre"=>$nom,                      
                                            "acc_status"=>$est,
                                            "acc_model"=>$mod,
                                            "acc_marca"=>$mar,
                                            "acc_tipo"=>$tipo,
                                            ]);
        if($insertar){
            echo "Registro existoso";
        }else{
            echo "Se ocasiono un error";
	    }
        return;
    }

    function eliminar_accesorios($id){
        global $db;
        $eliminar = $db->delete("accesorios",["acc_id" => $id]);
        if($eliminar){
            echo "Registro eliminado";
        }else{
            echo "registro eliminado";
        }
    }

    function consultar_accesorios($id){
        global $db;
         $consultar = $db -> get("accesorios","*",["AND" => [ "acc_id"=>$id]]);
        echo json_encode($consultar);

    }


    function editar_accesorios(){
        global $db;
        extract($_POST);
         $editar=$db ->update("accesorios",["acc_nombre"=>$nom,
                                        "acc_status"=>$est,
                                        "acc_model"=>$mod,
                                        "acc_marca"=>$mar,
                                        "acc_tipo"=>$tipo,
                                      ],["acc_id"=>$id]);
        if($editar){
            echo "Edicion completada";
        }else{
            echo "Se ocasiono un error";
        }

    }
    function mostrar_accesorios(){
        global $db;
        $accesorios = $db->select("accesorios","*","");
        echo json_encode($accesorios);
    }
?>
