<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="include/css/style.css">
	<link rel="stylesheet" type="text/css" href="include/css/style-responsive.css">
	<link rel="stylesheet" type="text/css" href="include/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="include/jqueryui/jquery-ui.min.css">
	<script src="include/js/script.js"></script>
	<script src="include/js/jquery-2.2.0.min.js"></script>
	<script src="include/js/bootstrap.min.js"></script>
	<script src="include/jqueryui/jquery-ui.min.js"></script>
	<title>โครงการ สร้างสรรค์ ปันน้ำใจ IDEMITSU CONTEST 2016</title>
</head>
<body class="dbsty">
<div id = "main" class="block_main">
  <?php
	session_start();
	require_once('database/function.php');
	require_once('database/command.php');
	require_once('tools/tools-function.php');

	$cmd = new Command();
	require_once('views/layouts/head.php');
	if(isset($_GET['menu'])){
		if($cmd->getParam('get','menu')=='home'){
			require_once('views/home/home.php');
		}else if($cmd->getParam('get','menu')=='register'){
			if($cmd->getParam('get','action')=='complete'||$cmd->getParam('get','action')=='confirmed'){
				require_once('views/register/complete.php');
			}else{
				require_once('views/register/register.php');
			}
		}else if($cmd->getParam('get','menu')=='user'){
			if($cmd->getParam('session','user')==""){
				require_once('views/UserInfo/Login.php');
			}else{
				if($cmd->getParam('session','admin')==true){
					redirect("?menu=adminsearch");
				}else{
					redirect("?menu=info1");
				}
			}
		}else if($cmd->getParam('get','menu')=='info1'){
			require_once('views/UserInfo/Info-tab1.php');
		}else if($cmd->getParam('get','menu')=='info2'){
			require_once('views/UserInfo/Info-tab2.php');
		}else if($cmd->getParam('get','menu')=='info4'){
			require_once('views/UserInfo/Info-tab4.php');
		}else if($cmd->getParam('get','menu')=='fpwd'){
			require_once('views/UserInfo/fpwd.php');
		}else if($cmd->getParam('get','menu')=='project'){
			require_once('views/project/project.php');
		}else if($cmd->getParam('get','menu')=='aboutus'){
			require_once('views/aboutus/aboutus.php');
		}else if($cmd->getParam('get','menu')=='adminsearch'){
			require_once('views/Admin/admin-search.php');
		}else if($cmd->getParam('get','menu')=='teaminfo'){
			require_once('views/Admin/team-info.php');
		}else{
			print("PAGE NOT FOUND 404");
		}
	}else{
		if($cmd->getParam('get','logout')=='true'){
			session_unset();
			session_destroy();
		}
		redirect("?menu=home");
	}

	require_once('views/layouts/footer.php');
	die();
?>
</div>
</body>
</html>