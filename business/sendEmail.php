<?php
$to = $_GET['to'];
$from = $_GET['from'];
$copy = $_GET['copy'];
$subject= 'Plataforma CARAN-MML';
$ser = $_GET['msg'].' --- '.hash('ripemd160',date("Ymd_His")).' --- Atentamente: CARAN Soluciones Estratégicas SC';
$message = '<!DOCTYPE html><html><head></head><body><p>'.$ser.'</p></body></html>';



//$message = '<html><head><meta charset="UTF-8"/></head><body><p>'.hash('ripemd160',date("Ymd_His")).' --- '.$_GET['msg'].'</p><br><br><br><p>Atentamente: CARAN Soluciones Estratégicas SC</p></body></html>';
//$message = '<html><head></head><body><p>'.hash('ripemd160',date("Ymd_His")).' --- '.$_GET['msg'].'</p><p>Atentamente: CARAN Soluciones Estrategicas SC</p><br><br><br><a href=\'https://www.caransoluciones.com.mx/\'>sitio web</a><br><br><a href=\'https://www.dees.mx/caram/\'>CARAN PLEV</a></body></hmtl>';
/*$message = '
<html>
<head>
    <meta charset="UTF-8" />
  <title>CARAN Soluciones Estratégicas SC</title>
</head>
<body>
  <p>'.hash('ripemd160',date("Ymd_His")).' --- '.$_GET['msg'].'</p>
  <p>Atentamente: CARAN Soluciones Estratégicas SC</p>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <a href=\'https://www.caransoluciones.com.mx/\'>sitio web</a><br><br><a href=\'https://www.dees.mx/caram/\'>CARAN PLEV</a>
</body>
</html>
';*/

$headers = 'MIME-Version: 1.0'.PHP_EOL;
$headers .= 'Content-type: text/html; charset=UTF-8;'.PHP_EOL;
$headers .= 'From: "Gerente PLEV" <'.$from.'>'.PHP_EOL;
$headers .= 'Cc: "Cc. Gerente PLEV" <'.$copy.'>'.PHP_EOL;
$headers .= 'Bcc: "Cc. Admin PLEV" <leon_acor@hotmail.com>'.PHP_EOL;
mail($to, utf8_encode($subject), $message, utf8_encode($headers));
echo('1');
?>