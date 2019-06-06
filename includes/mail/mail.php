<?php
	error_reporting(E_ALL);
	header('Access-Control-Allow-Origin: *'); 
	//require './template/mail_admin.php';
	//require './template/mail_user.php';
	if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

function solicitar_registro($data){

	

	
	/* Template para usuario */
	$messageUser     = getMailWelcome($data);
	/* Template para copmañia */
	$messageContacto = getMailContacto($data);

	$headers = "MIME-Version: 1.0" . PHP_EOL;
	$headers .= "Content-type: text/html; charset=utf-8" . PHP_EOL;    
	$headers .= "Return-Path: vcesar.rl@hotmail.com" . PHP_EOL;
	$headers .= "To: Cesar <vcesar@hotmail.com>" . PHP_EOL;
	$headers .= "From: ".$data['email']." <Solicitud de información de registro>". PHP_EOL;

	/*Mail para la compañia*/
	mail('vcesar.rl@hotmail.com', $data['email']."Solicitud de registro", $messageContacto, $headers);
	//mail('jose.alejandro@immosystem.com.mx', $data['company']."(Solicitud de información". $data['folioProp'].")", $messageContacto, $headers);


	$headers = "MIME-Version: 1.0" . PHP_EOL;
	$headers .= "Content-type: text/html; charset=utf-8" . PHP_EOL;    
	$headers .= "Return-Path: vcesar.rl@hotmail.com". PHP_EOL;
	$headers .= "To: " .$data['email']. PHP_EOL;
	$headers .= "From: Cesar <vcesar.rl@hotmail.com> <Solicitud de registro en proceso>". PHP_EOL;

	/*Mail para el cliente*/
	mail($data['email'], "vcesar.rl@hotmail.com", $messageUser, $headers);
	//mail('jose.alejandro@immosystem.com.mx', $data['company'], $messageUser, $headers);

	$response = array('status' => 'ok', 'messaje' => 'send');
	echo json_encode($response); 
	exit();
}

function getMailContacto($data) {
$messageContacto ='<!DOCTYPE html>
           <html>
           <head>
           <meta charset="UTF-8">
           </head> 
           <body style ="background:#fff; font-size: 14px;" >

              <table width="600" style="color:#303641; background:#fff; padding:5px;" border:2px solid #d7d7d7; align="center">
                <tbody>
                  <tr>                    
                    <td style="text-align:right;" colspan="2"><strong>'.date('d • m • Y',time()).'</strong></td>
                  </tr>
                  <tr><td style="" colspan="4"><br></td></tr>
                  <tr>
                    <td style="text-align:left;" colspan="4"><h3>Solicitud de registro </h3></td>
                  </tr>
                 
                  <tr>
                    <td style="text-align:left;" colspan="4">
                        <h4 style="text-align: justify;"><strong>Datos de la solicitud de registro</strong></h4>
                    </td>
                  </tr>                  
                  <tr>
                    <td style="text-align:left;" colspan="4">
                    <p>
                    Nombre: '.$data['name'].'
                    <br>  
                    Apellido: '.$data['lastname'].'
                    <br>
                    Email: '.$data['email'].'                     
                    <br>   
                    Telefono: '.$data['phone'].'
                    <br>';

                    $messageContacto .='<br><br>
                    
                    <br><br><br>
                    <strong>Correo generado por '.$data['email'].'</strong>
                    </td>
                  </tr>
                  ';
                  $messageContacto .='<tr><td colspan="4"><br></td></tr>
                  <tr><td colspan="4"><br></td></tr>
                  <tr><td colspan="4"></td></tr>';
                  
                  $messageContacto .='</tbody></table>

            </body>
           </html>';

return $messageContacto;           
}

function getMailWelcome($data) {
$messageUser ='<!DOCTYPE html>
           <html>
           <head>
           <meta charset="UTF-8">
           </head> 
           <body style ="background:#fff; font-size: 14px;" >

              <table width="600" style="color:#303641; background:#fff; padding:5px;" border:2px solid #d7d7d7; align="center">
                <tbody>
                  <tr>                    
                    <td style="text-align:right;" colspan="2"><strong>'.date('d • m • Y',time()).'</strong></td>
                  </tr>
                  <tr><td style="" colspan="4"><br></td></tr>

                  <tr>
                    <td style="text-align:left;" colspan="4"><h3>Solicitud de registro en proceso </h3></td>
                  </tr>
                 
                  <tr>
                    <td style="text-align:left;" colspan="4">
                        <h4 style="text-align: justify;"><strong>Registro en proceso</strong></h4>
                    </td>
                  </tr>                  
                  <tr>
                    <td style="text-align:left;" colspan="4">
                    <p>
                      ytddcfduyfytfyu
                    </p>';
                    
                
                    $messageUser .='<br><br>
                    
                    <strong>Correo generado por Mantenimiento</strong>
                    </td>
                  </tr>
                  ';
                  $messageUser .='<tr><td colspan="4"><br></td></tr>
                  <tr><td colspan="4"><br></td></tr>
                  <tr><td colspan="4"></td></tr>';
                
                  
                  $messageUser .='</tbody></table>

            </body>
           </html>';

return $messageUser;           
}
?>