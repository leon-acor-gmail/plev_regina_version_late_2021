<?php
/*
Created: 24/08/2015
Last: 24/08/2015
Author: PPH.NET
Description: This file Uploads files to the server
*/
session_start();
include ('InfoSystem.php') ;
$objInfoSystem = new InfoSystem();
$strEmail = $_SESSION['usr'];
$target_dir = "../uploads/";
/////////////////////////////////////////////////////////////////////////////////////////7
if(count($_FILES["fileToUpload"]["name"]))
{
    $i = 0;
	$hash = md5($_SESSION['nme'].'@'.date("Ymd_His"));
	$sr = '';
	foreach ($_FILES["fileToUpload"]["name"] as $file)
    {
		$target_file_user = basename($_FILES["fileToUpload"]["name"][$i]);
        $h = hash('ripemd160',$target_file_user);
		$dat = date("Ymd_His");
        $fileType = pathinfo($target_file_user,PATHINFO_EXTENSION);
        $target_name = $strEmail.'_'.$_POST['arg1'].'_'.$dat.'_'.$h.'.'.$fileType;
        $target_file = $target_dir.$target_name;

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file))
        {
			switch($_POST['arg5'])
			{
				case 1:
					$sr = $objInfoSystem->setEviInd($_POST['arg0'], $_POST['arg1'], $_POST['arg2'], $_POST['arg3'], $target_file_user, $target_dir.$target_name, $hash, $fileType);
					echo ("El archivo <strong>". basename( $_FILES["fileToUpload"]["name"][$i]). "</strong> ha sido cargado.<br>");
					$r = json_decode(str_replace("'"," ",$sr));
					if(setEmail($_SESSION['usr'], $r[0]->{'L1'}, $_POST['arg4'].' ['.($i+1).' archivos enviado(s)]', $r[0]->{'L1'})>0)
					{
						echo('Se ha enviado un mensaje a tus asesores. Ahora puedes cerrar esta pestaña. <br><br>CARAN Soluciones Estratégicas SC.');
					}
					else
					{
						echo('hay demoras con alguno de tus datos, por favor verifica una vez más, gracias ...');
					}
				break;
				case 2:
					echo ("Se añadio un archivo <strong>". basename( $_FILES["fileToUpload"]["name"][$i]). "</strong> ha tu proyecto.<br>");
					break;
				default:
					break;
			}

		}
        else
        {
            echo ("lo siento, hubo un error al cargar el archivo...");
        }

        $i++;
	}

}
else{
echo("error al subir tus archivos, comunícate con tu asesor de proyeco.");
}

function setEmail($to, $from, $msg, $copy){
	$objInfoSystem = new InfoSystem();
	return $objInfoSystem->sendEmail($to,$from,$copy,$msg,'Reporte de actividad en CARAN PLEV');
}
?>
