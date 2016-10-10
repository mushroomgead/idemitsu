<?php
session_start();
require_once('function.php');
require_once('command.php');
require_once('../tools/tools-function.php');

$cmd = new Command();

switch($_GET['action']){
	case "uploadvideo" 		:

		$strfile = "nofile";
		$linkname = "";
		$allowedExts = array("mp4");
		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		if ((($_FILES["file"]["type"] == "video/mp4"))
		&& ($_FILES["file"]["size"] < 102400000)
		&& in_array($extension, $allowedExts)){
			if ($_FILES["file"]["error"] > 0){
				echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			}else{
				if (!file_exists("../uploads/".$cmd->getParam('session','teamid'))) {
				    mkdir("../uploads/".$cmd->getParam('session','teamid'), 0777, true);
				}
				move_uploaded_file($_FILES["file"]["tmp_name"],"../uploads/".$cmd->getParam('session','teamid')."/videoProject.".$extension);
				$strfile = 'withfile';
				$linkname = 'videoProject.'.$extension;
			}
		}else{
			echo "
				<script type='text/JavaScript'>
					alert('ไม่สามรถ Upload ไฟล์ได้');
					location.href = '../?menu=info4';
				</script>";

			exit;
		}
		updateVideo($strfile,$_POST['media_name'],$_POST['media_desc'],$linkname);
		redirect('../?menu=info4');
		break;

	case "uploadfile" 		:	

		$allowedExts = array("pdf","doc","docx","xls","xlsx");
		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		if ((($_FILES["file"]["type"] == "application/pdf")
		   ||($_FILES["file"]["type"] == "application/msword")
		   ||($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
		   ||($_FILES["file"]["type"] == "application/vnd.ms-excel")
		   ||($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"))
		&& ($_FILES["file"]["size"] < 3072000)
		&& in_array($extension, $allowedExts)){
			if ($_FILES["file"]["error"] > 0){
				echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			}else{
				if (!file_exists("../uploads/".$cmd->getParam('session','teamid'))) {
				    mkdir("../uploads/".$cmd->getParam('session','teamid'), 0777, true);
				}
				move_uploaded_file($_FILES["file"]["tmp_name"],"../uploads/".$cmd->getParam('session','teamid')."/document.".$extension);
				$linkname = 'document.'.$extension;
			}
		}else{
			echo "
				<script type='text/JavaScript'>
					alert('ไม่สามรถ Upload ไฟล์ได้');
					location.href = '../?menu=info1';
				</script>";

			exit;
		}
		updateDoc($linkname);
		redirect('../?menu=info1');
		break;

	case "uploaddetail"		:

		$memberamt = $_POST['memberamt']+1;
		for($i=0;$i<$memberamt;$i++){

			if($i==0){
				if((isset($_FILES["file".$i]['name'])?$_FILES["file".$i]['name']:"") != ""){
					$allowedExts = array("pdf","doc","docx","xls","xlsx");
					$extension = pathinfo($_FILES['file'.$i]['name'], PATHINFO_EXTENSION);
					if ((($_FILES["file".$i]["type"] == "application/pdf")
					   ||($_FILES["file".$i]["type"] == "application/msword")
					   ||($_FILES["file".$i]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
					   ||($_FILES["file".$i]["type"] == "application/vnd.ms-excel")
					   ||($_FILES["file".$i]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"))
					&& ($_FILES["file".$i]["size"] < 3072000)
					&& in_array($extension, $allowedExts)){
						if ($_FILES["file".$i]["error"] > 0){
							echo "Return Code: " . $_FILES["file".$i]["error"] . "<br />";
						}else{
							if (!file_exists("../uploads/".$cmd->getParam('session','teamid'))) {
							    mkdir("../uploads/".$cmd->getParam('session','teamid'), 0777, true);
							}
							move_uploaded_file($_FILES["file".$i]["tmp_name"],"../uploads/".$cmd->getParam('session','teamid')."/leaderidfile".$i.".".$extension);
							$linkname = "leaderidfile".$i.".".$extension;
							updateMemberID($linkname,$i,"");
						}
					}else{
						echo "CANNOT_UPLOAD".$i;
						exit;
					}
				}else{
				}
			}else{

				$data[$i]['member_first_name'] = trim($_POST['memberfirstname'.$i]);
				$data[$i]['member_last_name'] = trim($_POST['memberlastname'.$i]);
				$data[$i]['member_id'] = trim($_POST['memberid'.$i]);

				if($data[$i]['member_id']!=""){
					if((isset($_FILES["file".$i]['name'])?$_FILES["file".$i]['name']:"") != ""){
						$allowedExts = array("pdf","doc","docx","xls","xlsx");
						$extension = pathinfo($_FILES['file'.$i]['name'], PATHINFO_EXTENSION);
						if ((($_FILES["file".$i]["type"] == "application/pdf")
						   ||($_FILES["file".$i]["type"] == "application/msword")
						   ||($_FILES["file".$i]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
						   ||($_FILES["file".$i]["type"] == "application/vnd.ms-excel")
						   ||($_FILES["file".$i]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"))
						&& ($_FILES["file".$i]["size"] < 3072000)
						&& in_array($extension, $allowedExts)){
							if ($_FILES["file".$i]["error"] > 0){
								echo "Return Code: " . $_FILES["file".$i]["error"] . "<br />";
							}else{
								if (!file_exists("../uploads/".$cmd->getParam('session','teamid'))) {
								    mkdir("../uploads/".$cmd->getParam('session','teamid'), 0777, true);
								}
								move_uploaded_file($_FILES["file".$i]["tmp_name"],"../uploads/".$cmd->getParam('session','teamid')."/memberidfile".$i.".".$extension);
								$linkname = "memberidfile".$i.".".$extension;
								updateMemberID($linkname,$i,$data);
							}
						}else{
							echo "CANNOT_UPLOAD".$i;
							exit;
						}
					}else{
					}
				}
			}
		}
		echo "Success";
		break;

	default					:	break;
}

?>