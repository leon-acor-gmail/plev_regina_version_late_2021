<?php
//$arg0 = $_POST['arg0'];
$arg1 = $_POST['arg1'];
$arg2 = $_POST['arg2'];

include ('InfoSystem.php') ;
$objInfoSystem = new InfoSystem();
$strA = $objInfoSystem->getAccess($arg1, $arg2);
$str = explode(':',$strA);
//echo($str[1]);
if($str[0] == 3 || $str[0] == 1 || $str[0] == 2)//admin
{
    $t = setSession($arg1,$str[0],$str[1],$str[2]);
    header('Location: ../views/home.php?token='.$t);
}
else
{
    header('Location: https://www.caransoluciones.com.mx/');
}

function setSession($strEmail, $iPfl, $strName, $strPfl)
{
    session_start();
    $_SESSION['usr'] = $strEmail;
    $_SESSION['nme'] = $strName;
    $_SESSION['pfl'] = $iPfl;
    $_SESSION['spr'] = $strPfl;
    $_SESSION['lgn'] = true;
    return base64_encode(hash('sha256',$str[3].date('Y/m/d')));
}
