<?php
session_start();
include('InfoSystem.php');

$iC = $_POST['iC'];
$arg1 = $_POST['arg1'];
$arg2 = $_POST['arg2'];
$arg3 = $_POST['arg3'];
$arg4 = $_POST['arg4'];
$arg5 = $_POST['arg5'];

$objInfoSystem = new InfoSystem();
switch($iC)
{
	case 1:
        $strR = $objInfoSystem->setAccess($arg1);
    	echo($strR);
        break;
	case 2:
        $strR = $objInfoSystem->getSupervisors();
    	echo($strR);
        break;
	case 3:
        $strR = $objInfoSystem->setNewProj($arg1);
    	echo($strR);
        break;
	case 4:
		$strR = $objInfoSystem->editProject($arg1);
		echo($strR);
		break;
	case 5:
		$strR = $objInfoSystem->sendEmail($arg1,$arg2,$arg3,$arg4,$arg5);
		echo($strR);
		break;
    default:
        break;
}
?>