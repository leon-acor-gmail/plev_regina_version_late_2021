<?php
include('InfoSystem.php');

$iC = $_POST['iC'];
$objInfoSystem = new InfoSystem();
switch($iC)
{
	case 1:
        $strR = $objInfoSystem->getSupervisors();
    	echo($strR);
        break;
    default:
        break;
}
?>