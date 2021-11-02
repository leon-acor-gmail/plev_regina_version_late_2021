<?php
session_start();
include('InfoSystem.php');

$i = $_POST['iC'];
$arg1 = $_POST['arg1'];
$arg2 = $_POST['arg2'];

$objInfoSystem = new InfoSystem();
switch($i)
{
	case 1:
        $strR = $objInfoSystem->getDataUploadUnsigned($arg1);
    	echo($strR);
        break;
	case 2:
        $strR = $objInfoSystem->setComment($arg1,$arg2);
    	echo($strR);
        break;
	case 3:
		$strR = $objInfoSystem->getProgressByInd($arg1,$arg2);
		echo($strR);
		break;
    default:
        break;
}
?>