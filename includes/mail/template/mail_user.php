<?php

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