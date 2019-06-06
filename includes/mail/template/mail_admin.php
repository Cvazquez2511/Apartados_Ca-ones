<?php

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
                    Apellido: '.$date['lastname'].'
                    <br>
                    Email: '.$data['email'].'                     
                    <br>   
                    Telefono: '.$data['phone'].'
                    <br>';

                    $messageUser .='<br><br>
                    
                    <br><br><br>
                    <strong>Correo generado por '.$data['email'].'</strong>
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