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
        $strR = $objInfoSystem->setSche($arg1, $arg2);
    	echo($strR);
        break;
    case 2:
        $strR = $objInfoSystem->getSche($arg1);
    	echo($strR);
        break;
	case 3:
        $strR = $objInfoSystem->updateSche($arg1);
    	echo($strR);
        break;
	case 4:
        $strR = $objInfoSystem->deleteSche($arg1);
    	echo($strR);
        break;
	case 5:
        $strR = $objInfoSystem->getScheIndList($arg1);
    	echo($strR);
        break;
	case 6:
        $strR = $objInfoSystem->getScheCatList();
    	echo($strR);
        break;
    default:
        break;
}
?>