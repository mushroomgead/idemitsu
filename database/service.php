<?php
session_start();
require_once('function.php');

switch($_GET['action']){
	case "registeration" 	:	if($_POST['captcha']==$_SESSION['cap_code']){
									if(strlen(trim($_POST['password']))>=6){
										if(trim($_POST['password'])==trim($_POST['confirmpassword'])){
											saveRegisterData(trim($_POST['teamname'])
													,trim($_POST['institutename'])
													,trim($_POST['institutetype'])
													,trim($_POST['leader_title'])
													,trim($_POST['leaderfirstname'])
													,trim($_POST['leaderlastname'])
													,trim($_POST['leaderid'])
													,trim($_POST['leaderemail'])
													,trim($_POST['telephone'])
													,trim($_POST['username'])
													,trim($_POST['password']));
										}else{
											print("PASSWORD_NOT_MATCHED");
										}
									}else{
										print("PASSWORD_LENGTH");
									}
								}else{
									print("CAPTCHA_NOT_MATCHED");
								}
								
							   	break;

	case "login"			:	login(trim($_POST['username']),trim($_POST['password']));
								break;
	case "fpwd"				:	fpwd(trim($_POST['email']),trim($_POST['IDNO']));
								break;
								
	case "resend"			:	resend(trim($_POST['username']));
								break;

	case "updatedetail"		:	if(trim($_POST['password'])!=""){
									if(trim($_POST['oldpassword']!="")){
										if(trim($_POST['password'])!=trim($_POST['oldpassword'])){
											if(strlen(trim($_POST['password']))>=6){
												if(trim($_POST['password'])==trim($_POST['confirmpassword'])){
													$data[0]['password'] = trim($_POST['password']);
													$data[0]['oldpassword'] = trim($_POST['oldpassword']);
												}else{
													print("PASSWORD_NOT_MATCHED");
													break;
												}
											}else{
												print("PASSWORD_LENGTH");
												break;
											}
										}else{
											print("SAME_PREVIOUS");
											break;
										}
									}else{
										print("OLD_PASSWORD");
										break;
									}
								}else{
									$data[0]['password'] = "";
								}
								if( isset($_POST['memberamt']) ){
									$memberamt = $_POST['memberamt'];
								}else{
									print("MEMBER_NO");
									break;
								}
								$data[0]['leader_title'] = trim($_POST['leader_title']);
								$data[0]['leader_first_name'] = trim($_POST['leaderfirstname']);
								$data[0]['leader_last_name'] = trim($_POST['leaderlastname']);
								$data[0]['leader_id'] = trim($_POST['leaderid']);
								$data[0]['advisor_title'] = trim($_POST['advisor_title']);
								$data[0]['advisor_name'] = trim($_POST['advisor_name']);
								$data[0]['advisor_last_name'] = trim($_POST['advisor_last_name']);
								$data[0]['advisor_email'] = trim($_POST['advisor_email']);
								$data[0]['advisor_telephone'] = trim($_POST['advisor_telephone']);
								$data[0]['telephone'] = trim($_POST['telephone']);
								$data[0]['leader_email'] = trim($_POST['leaderemail']);
								
								
							
								$data[0]['member_number'] = $memberamt;
								$data[0]['team_name']=trim($_POST['teamname']);
								$data[0]['institute_name']=trim($_POST['institutename']);
								$data[0]['institute_type']=trim($_POST['institutetype']);
								$i=0 ;
								for($i=0;$i<$memberamt;$i++){
									$data[$i]['member_title'] = trim($_POST['member_title'.($i+1)]);
									$data[$i]['member_first_name'] = trim($_POST['memberfirstname'.($i+1)]);
									$data[$i]['member_last_name'] = trim($_POST['memberlastname'.($i+1)]);
									$data[$i]['member_id'] = trim($_POST['memberid'.($i+1)]);
									$data[$i]['level'] = trim($_POST['level'.($i+1)]);
								}
								updateInfo($data,$i);
								break;

	default					:	break;
}

?>