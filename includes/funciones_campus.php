<?php  

    require_once '_db.php';
    if(isset($_POST["accion"])){
	    switch ($_POST["accion"]) {
            case 'insertar_campus':
                insertar_campus();
            break;                
            case 'consultar_campus':
                consultar_campus($_POST["id"]);
            break;
            case 'eliminar_campus':
                eliminar_campus($_POST["id"]);
            break;   
            case 'editar_campus':
                editar_campus();
            break;  
            case 'mostrar_campus':
                mostrar_campus();
            break;                  
            
        }
    }

    function insertar_campus(){
        global $db;
        extract($_POST);

        $insertar=$db ->insert("Campus",[
                                            "cps_nombre"=>$ciu,
                                            "est_id"=>$state,
                                            "cps_status"=>$est ,
                                            "cps_alta" => date("Y").date("m").date("d")
                                            ]);
        if($insertar){
            echo "Registro existoso";
        }else{
            echo "Se ocasiono un error";
	    }
        return;
    }

    function consultar_campus($id){
        global $db;
        
        $consultar = $db -> get("Campus","*",["AND" => [ "cps_id"=>$id]]);
        echo json_encode($consultar);

    }

    function eliminar_campus($id){
        global $db;
        $eliminar = $db->delete("Campus",["cps_id" => $id]);
        if($eliminar){
            echo "Registro eliminado";
        }else{
            echo "registro eliminado";
        }
    }

   function editar_campus(){
        global $db;
        extract($_POST);
        print_r($_POST);
         $editar=$db ->update("Campus",["cps_nombre"=>$ciu,
                                        "est_id"=>$state,
                                        "cps_status"=>$est,
                                        ],["cps_id"=>$id]);
        if($editar){
            echo "Edicion completada";
        }else{
            echo "Se ocasiono un error";
        } 
    }

    function mostrar_campus(){

        global $db;
        //$campus = $db->select("Campus","*",["cps_status" => "Activo"]);
         $campus = $db->select("Campus", [
            "[><]Estados" => ["est_id"]], [
            "Campus.cps_id","Campus.cps_nombre","Campus.cps_status","Campus.cps_alta","Estados.est_nombre"]);
         /*$campus = $db->select(
                        "Campus", 
                        array("[><]Estados" => array("Campus.est_id" => "Estados.est_id")),
                        array("Campus.cps_id","Campus.cps_nombre","Campus.cps_status","Campus.cps_alta","Estados.est_nombre")
                   ); */
        
                    
        echo json_encode($campus);                                                                                                                                                              
                                
    }
?>

