<?php
session_start();
include('InfoSystem.php');

$i = $_POST['i'];

/*$strArg1 = $_GET['strArg1'];
$strArg2 = $_GET['strArg2'];
*/
$objInfoSystem = new InfoSystem();

switch($i)
{
	case 1:
        $strR = '';
    	echo($strR);
        break;
	/*case 2:
        $strR = $objInfoSystem->getHomeChartByProject($strArg1);//ln 1564
    	echo($strR);
        break;
	case 3:
        $strR = $objInfoSystem->getStudentsTotal();
    	echo($strR);
        break;*/
    default:
        break;
}
?>

?>