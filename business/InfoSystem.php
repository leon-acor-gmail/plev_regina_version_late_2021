<?php
session_start();

include('DataSystem.php');
class InfoSystem extends DataSystem
{
    private $bConnection;
    private function OpenDB()
    {
        $bConnection = new mysqli(DataSystem::dbHost, DataSystem::dbUser, DataSystem::dbPwd, DataSystem::dbName);
		if ($bConnection->connect_errno)
		{
			//echo 'NOK: (Error: '.$mysqli->connect_errno.') '.$mysqli->connect_error;
			$this->bConnection = false;
		}
		else
		{
			//echo 'OK '.$mysqli->host_info.'\n';
			$this->bConnection = $bConnection;
		}
    }

    private function CloseDB()
    {
        mysqli_close($this->bConnection);
    }

    private function GetQueryUSP($i, $arg1 = 'N/A', $arg2 = 'N/A', $arg3 = 'N/A', $arg4 = 'N/A', $arg5 = 'N/A', $arg6 = 'N/A', $arg7 = 'N/A', $arg8 = 'N/A', $arg9 = 'N/A', $arg10 = 'N/A', $arg11 = 'N/A', $arg12 = 'N/A', $arg13 = 'N/A', $arg14 = 'N/A', $arg15 = 'N/A')
	{
		return "call uspCaran(".$i.",'".$arg1."','".$arg2."','".$arg3."','".$arg4."','".$arg5."','".$arg6."','".$arg7."','".$arg8."','".$arg9."','".$arg10."','".$arg11."', '".$arg12."', '".$arg13."', '".$arg14."','".$arg15."');";
	}

    public function getAccess($strUser, $strPwd)//bsnsLogin
	{
    //return $this->GetQueryUSP(1,$strUser,$strPwd);
		$this->OpenDB();
		$this->bConnection->set_charset("utf8");
		$res = $this->bConnection->query($this->GetQueryUSP(1,$strUser,$strPwd));
		$row = $res->fetch_assoc();
		$strR = $row['L1'];
		$this->CloseDB();
		return $strR;
	}

	public function setAccess($json)//bsnsReg
	{

		$r = json_decode(str_replace("'"," ",$json));
		$this->OpenDB();
		$this->bConnection->set_charset("utf8");
		$res = $this->bConnection->query($this->GetQueryUSP(2,$r->{'user'}, $r->{'nameOrg'}, $r->{'name'}, $r->{'problem'}, $r->{'justy'}, $r->{'goal'}, $r->{'female'}, $r->{'male'}, json_encode($r->{'addr'}), $r->{'email'}, rand(1111,9999), $r->{'supervisor'}));
		$row = $res->fetch_assoc();
		$strR = $row['L1'];
		$this->CloseDB();
		return $strR;
	}

	public function setNewProj($json)//bsnsReg
	{
		//$r = json_decode(str_replace("'"," ",$json));
		//return $this->GetQueryUSP(9, $r->{'nameOrg'}, $r->{'name'}, $r->{'problem'}, $r->{'justy'}, $r->{'goal'}, $r->{'female'}, $r->{'male'}, json_encode($r->{'addr'}), $r->{'supervisor'});

		$r = json_decode(str_replace("'"," ",$json));
		$this->OpenDB();
		$this->bConnection->set_charset("utf8");
		$res = $this->bConnection->query($this->GetQueryUSP(9, $r->{'nameOrg'}, $r->{'name'}, $r->{'problem'}, $r->{'justy'}, $r->{'goal'}, $r->{'female'}, $r->{'male'}, json_encode($r->{'addr'}), $r->{'supervisor'}, $_SESSION['usr']));
		$row = $res->fetch_assoc();
		$strR = $row['L1'];
		$this->CloseDB();
		return $strR;
	}

	public function getProjects()//bsnsTree
	{
		$this->OpenDB();
		$this->bConnection->set_charset('utf8');
		switch($_SESSION['pfl'])
		{
			case 1://gerente
				$res = $this->bConnection->query($this->GetQueryUSP(8, $_SESSION['nme']));
				break;
			case 2://supervisor
				$res = $this->bConnection->query($this->GetQueryUSP(7, $_SESSION['usr']));
				break;
			case 3://admin
				$res = $this->bConnection->query($this->GetQueryUSP(3));
				break;
			default:// default
				$res = $this->bConnection->query($this->GetQueryUSP(8, $_SESSION['nme']));
				break;
		}
		$rows = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows[] = array_map(null, $r);
		}
		$this->CloseDB();
		return json_encode($rows);


	}

	public function getSupervisors()//bsnsTree
	{
		$this->OpenDB();
		//$this->bConnection->set_charset('utf8');
		$res = $this->bConnection->query($this->GetQueryUSP(4));
		$rows = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows[] = array_map('utf8_encode', $r);
		}
		$this->CloseDB();
		return json_encode($rows);
	}

	public function setTrees($json)//bsnsTree
	{
		$a= json_decode(str_replace("'"," ",$json));
		$this->OpenDB();
		$this->bConnection->set_charset('utf8');
		$res = $this->bConnection->query($this->GetQueryUSP(5, $a->{'tree'}, $a->{'key'}, $a->{'value'}, $a->{'user'}, $a->{'id'}));
		$row = $res->fetch_assoc();
		$strR = $row['L1'];
		$this->CloseDB();
		return $strR;
	}

	public function getTrees($arg1, $arg2)//bsnsTree
	{
		$this->OpenDB();
		$this->bConnection->set_charset('utf8');
		$res = $this->bConnection->query($this->GetQueryUSP(6, $arg1, $arg2));
		$rows = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows[] = array_map(null, $r);
		}
		$this->CloseDB();
		return json_encode($rows);
	}


	public function getProject($arg1)//bsnsTree
	{
		$this->OpenDB();
		$res = $this->bConnection->query($this->GetQueryUSP(10, $arg1));
		$rows = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows[] = array_map('utf8_encode', $r);
		}
		$this->CloseDB();
		return json_encode($rows);
	}


	public function editProject($json)//bsnsReg
	{
		$r = json_decode(str_replace("'"," ",$json));
		$this->OpenDB();
		$this->bConnection->set_charset("utf8");
		$res = $this->bConnection->query($this->GetQueryUSP(11, $r->{'id'}, $r->{'nameOrg'}, $r->{'problem'}, $r->{'justy'}, $r->{'goal'}, $r->{'female'}, $r->{'male'}, json_encode($r->{'addr'})));
		$row = $res->fetch_assoc();
		$strR = $row['L1'];
		$this->CloseDB();
		return $strR;
	}

	public function setMML($json)//bsnsMML
	{
		$r = json_decode(str_replace("'"," ",$json));
		$this->OpenDB();
		$this->bConnection->set_charset("utf8");
		$res = $this->bConnection->query($this->GetQueryUSP(12,  $r->{'indicador'}, $r->{'resumen'}, $r->{'calculo'}, $r->{'cadena'}, $r->{'evidencias'},$r->{'supuestos'},$r->{'presupuesto'},$r->{'dimension'},$r->{'base'},$r->{'meta'}, $r->{'frecuencia'},$r->{'unidad'}, $r->{'code'}, $r->{'proj'},$r->{'capitulo'}));
		$row = $res->fetch_assoc();
		$strR = $row['L1'];
		$this->CloseDB();
		return $strR;
	}

	public function getMML($id)//bsnsMML
	{
		$this->OpenDB();
		//$this->bConnection->set_charset("utf8");
		$res = $this->bConnection->query($this->GetQueryUSP(13, $id));
		$rows = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows[] = array_map('utf8_encode', $r);
		}
		$this->CloseDB();
		return json_encode($rows);
	}

	public function getMMLbyInd($id, $code)//bsnsMML
	{
		$this->OpenDB();
		//$this->bConnection->set_charset("utf8");
		$res = $this->bConnection->query($this->GetQueryUSP(14, $id, $code));
		$rows = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows[] = array_map('utf8_encode', $r);
		}
		$this->CloseDB();
		return json_encode($rows);
	}

	public function setSche($json, $id)//bsnsSche
	{
		$r = json_decode(str_replace("'"," ",$json));
		$this->OpenDB();
		$this->bConnection->set_charset("utf8");
		$res = $this->bConnection->query($this->GetQueryUSP(15, date("m/d/Y", strtotime(explode('T',$r->{'start_date'})[0])),date("m/d/Y", strtotime(explode('T',$r->{'end_date'})[0])),$r->{'arg1'}, $id, $r->{'arg2'},$r->{'arg3'}));
		$row = $res->fetch_assoc();
		$strR = $row['L1'];
		$this->CloseDB();
		return $strR;
	}

	public function getSche($id)//bsnsSche
	{
		$this->OpenDB();
		$res = $this->bConnection->query($this->GetQueryUSP(16, $id));
		$rows = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows[] = array_map('utf8_encode', $r);
		}
		$this->CloseDB();
		return json_encode($rows);
	}

	public function updateSche($ev)//bsnsSche
	{
		$a= json_decode(str_replace("'"," ",$ev));
		$this->OpenDB();
		$this->bConnection->set_charset('utf8');
		$res = $this->bConnection->query($this->GetQueryUSP(20, $a->{'arg1'}, $a->{'id'}, $a->{'arg2'}, $a->{'arg3'}));
		$row = $res->fetch_assoc();
		$strR = $row['L1'];
		$this->CloseDB();
		return $strR;
	}

	public function deleteSche($id)//bsnsSche
	{
		$this->OpenDB();
		$this->bConnection->set_charset('utf8');
		$res = $this->bConnection->query($this->GetQueryUSP(21,$id));
		$row = $res->fetch_assoc();
		$strR = $row['L1'];
		$this->CloseDB();
		return $strR;
	}

	public function getInd($id)//bsnsKardex
	{
		$this->OpenDB();
		//$this->bConnection->set_charset("utf8");
		$res = $this->bConnection->query($this->GetQueryUSP(17, $id));
		$rows = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows[] = array_map('utf8_encode', $r);
		}
		$this->CloseDB();
		return json_encode($rows);
	}

	public function getScheIndList($id)//bsnsSche
	{
		$this->OpenDB();
		$res = $this->bConnection->query($this->GetQueryUSP(22, $id));
		$rows = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows[] = array_map('utf8_encode', $r);
		}
		$this->CloseDB();
		return json_encode($rows);
	}

	public function getScheCatList()//bsnsSche
	{
		$this->OpenDB();
		$res = $this->bConnection->query($this->GetQueryUSP(23));
		$rows = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows[] = array_map('utf8_encode', $r);
		}
		$this->CloseDB();
		return json_encode($rows);
	}

	public function setEviInd($id, $ind, $data, $ava, $fileName, $filePath, $hash, $ext)//bsnsKardex
	{
		$this->OpenDB();
		$this->bConnection->set_charset("utf8");
		$res = $this->bConnection->query($this->GetQueryUSP(18, $id, $data, $ind, $ava, $fileName, $filePath, $hash, $ext));
		$rows = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows[] = array_map('utf8_encode', $r);
		}
		$this->CloseDB();
		return json_encode($rows);
	}

	public function getEviInd($id, $ind)//bsnsKardex
	{
		$this->OpenDB();
		$this->bConnection->set_charset("utf8");
		$res = $this->bConnection->query($this->GetQueryUSP(19, $id, $ind));
		$rows = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows[] = array_map('utf8_encode', $r);
		}
		$this->CloseDB();
		$json = json_encode($rows);
		$this->OpenDB();
		$res1 = $this->bConnection->query($this->GetQueryUSP(30, $id, $ind));
		$rows1 = array();
		while($r = mysqli_fetch_assoc($res1)) {
			$rows1[] = array_map('utf8_encode', $r);
		}
		$json1 = json_encode($rows1);
		$this->CloseDB();
		return $json.'|'.$json1;
		//return $this->GetQueryUSP(19, $id, $ind).':'.$this->GetQueryUSP(30, $id, $ind);
	}

	public function sendEmail($to, $from, $copy, $msg, $subject)//bsnsReg
	{
		//$message = '<html><body><p>'.$msg.'</p><br><br><br><p>Atentamente: CARAN Soluciones Estratégicas SC</p><br><br><a href="http://caransoluciones.com.mx">sitio web</a><br><a href="http://dees.mx/caram">PLEV</a></body></html>';

		$message = '<!DOCTYPE html><html><body><p>'.$msg.'</p><br><br><p>CARAN Soluciones Estratégicas SC</p><a href="#">caransoluciones.com.mx</a><br><a href="#">plev.dees.mx</a></body></html>';
		$headers = 'MIME-Version: 1.0'.PHP_EOL;
		$headers .= 'Content-type: text/html; charset=UTF-8;'.PHP_EOL;
		$headers .= 'From: "Gerente PLEV" <'.$from.'>'.PHP_EOL;
		$headers .= 'Cc: "Cc. Gerente PLEV" <'.$copy.'>'.PHP_EOL;
		$headers .= 'Bcc: "Cc. Admin PLEV" <leon_acor@hotmail.com>'.PHP_EOL;
		if(mail($to,utf8_encode($subject),$message,utf8_encode($headers)))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}


	public function getDataUploadUnsigned($id)//bsnsReview
	{
		$this->OpenDB();
		$res = $this->bConnection->query($this->GetQueryUSP(27, $id));
		$rows = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows[] = array_map('utf8_encode', $r);
		}
		$this->CloseDB();
		//$json = json_encode($rows);

		/*$this->OpenDB();
		$res = $this->bConnection->query($this->GetQueryUSP(31, $id));
		$rows1 = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows1[] = array_map('utf8_encode', $r);
		}
		$this->CloseDB();
		$json1 = json_encode($rows1);
		return $json.'|'.$json1;*/
		return json_encode($rows);
	}

	public function getDataUploadSigned($id)//bsnsReview
	{
		$this->OpenDB();
		$res = $this->bConnection->query($this->GetQueryUSP(24, $id));
		$rows = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows[] = array_map('utf8_encode', $r);
		}
		$this->CloseDB();
		return json_encode($rows);
	}

	public function getProjectById($id)//bsnsComplete
	{
		$this->OpenDB();
		//$res = $this->bConnection->query($this->GetQueryUSP(31, $id));
		$res = $this->bConnection->query($this->GetQueryUSP(29, $id));
		$rows = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows[] = array_map('utf8_encode', $r);
		}
		$this->CloseDB();
		return json_encode($rows);
	}

	public function getProgressByInd($id, $mml)//bsnsReview
	{
		$this->OpenDB();
		$res = $this->bConnection->query($this->GetQueryUSP(26, $id, $mml));
		$rows = array();
		while($r = mysqli_fetch_assoc($res)) {
			$rows[] = array_map('utf8_encode', $r);
		}
		$this->CloseDB();
		return json_encode($rows);
	}

	public function setComment($hash, $comment)//bsnsSche
	{
		$this->OpenDB();
		$this->bConnection->set_charset('utf8');
		$res = $this->bConnection->query($this->GetQueryUSP(25,$hash, $comment, $_SESSION['usr']));
		$row = $res->fetch_assoc();
		$strR = $row['L1'];
		$this->CloseDB();
		return $strR;
	}
}
