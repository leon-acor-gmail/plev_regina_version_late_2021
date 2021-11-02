<?php
session_start();
include('InfoSystem.php');

$iC = $_POST['iC'];
$arg1 = $_POST['arg1'];
$arg2 = $_POST['arg2'];

$objInfoSystem = new InfoSystem();
switch($iC)
{
	case 1:
        $strR = $objInfoSystem->setMML($arg1);
    	echo($strR);
        break;
    case 2:
        $strR = $objInfoSystem->getMML($arg1);
    	echo($strR);
        break;
	case 3:
        $strR = $objInfoSystem->getMMLbyInd($arg1, $arg2);
    	echo($strR);
        break;
    default:
        break;
}
?>