<?php
    require_once '_db.php';
        if(isset($_POST["accion"])){
            switch($_POST["accion"]){
                case 'insertar_salon':
                    insertar_salon();
                break;

                case 'eliminar_salon':
                eliminar_salon($_POST['id']);
                break;

                case 'editar_salon':
        
                editar_salon();
                break;

                case 'mostrar_salon':
                mostrar_salon();
                break;

                case 'consultar_salon':
                consultar_salon($_POST['id']);
                break;
            }
        }
    
    function insertar_salon(){
        global $db;
        extract($_POST);
        
        $insertar=$db ->insert("salones",[
                                            "sal_num"=>$num,
                                            "sal_cap"=>$cap,
                                            "sal_av"=>$av ,
                                            "sal_fa" => date("Y").date("m").date("d")
                                            ]);
        if($insertar){
            echo "Registro existoso";
        }else{
            echo "Se ocasiono un error";
	    }
        return;
    }

    function eliminar_salon($id){
        global $db;
        $eliminar = $db->delete("salones",["sal_id" => $id]);
        if($eliminar){
            echo "Registro eliminado";
        }else{
            echo "registro eliminado";
        }
    }

    function consultar_salon($id){
        global $db;
         $consultar = $db -> get("salones","*",["AND" => [ "sal_id"=>$id]]);
        echo json_encode($consultar);

    }


    function editar_salon(){
        global $db;
        extract($_POST);
         $editar=$db ->update("salones",["sal_num"=>$num,
                                        "sal_cap"=>$cap,
                                        "sal_av"=>$av,
                                        ],["sal_id"=>$id]);
        if($editar){
            echo "Edicion completada";
        }else{
            echo "Se ocasiono un error";
        } 

    }
    function mostrar_salon(){
        global $db;
        $salones = $db->select("salones","*","");
        echo json_encode($salones);  
    }
?>