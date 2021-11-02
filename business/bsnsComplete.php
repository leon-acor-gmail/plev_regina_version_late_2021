<?php
session_start();
include('InfoSystem.php');

$i = $_POST['iC'];
$arg1 = $_POST['arg1'];

$objInfoSystem = new InfoSystem();
switch($i)
{
	case 1:
        $strR = $objInfoSystem->getDataUploadSigned($arg1);
    	echo($strR);
        break;
	case 2:
        $strR = $objInfoSystem->getProjectById($arg1);
    	echo($strR);
        break;
    default:
        break;
}
?>