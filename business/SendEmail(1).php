<?php
$to = $_POST['to'];
$from = $_POST['from'];
$copy = $_POST['copy'];
$subject= 'Nuevo usuario de CARAN-PLEV';
$message = '<html><head></head><body><p>'.$_POST['msg'].'</p><br><br><br><p>Atentamente: CARAN Soluciones Estratégicas SC</p><br><br><a href="http://caransoluciones.com.mx">sitio web</a><br><a href="http://dees.mx/caram">PLEV</a></body></html>';
$headers = 'MIME-Version: 1.0'.PHP_EOL;
$headers .= 'Content-type: text/html; charset=UTF-8;'.PHP_EOL;
$headers .= 'From: "Gerente PLEV" <'.$from.'>'.PHP_EOL;
$headers .= 'Cc: "Cc. Gerente PLEV" <'.$copy.'>'.PHP_EOL;
$headers .= 'Bcc: "Cc. Admin PLEV" <leon_acor@hotmail.com>'.PHP_EOL;
if(mail($to,utf8_encode($subject),$message,utf8_encode($headers)))
{
    echo('1');
}
else
{
    echo('0');
}
?>