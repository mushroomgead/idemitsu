<?php
require_once('connect_db.php');

/* ------ Registeration process ------ */
function saveRegisterData($teamname
						,$institutename
						,$institutetype
						,$leader_title
						,$leaderfirstname
						,$leaderlastname
						,$leaderid
						,$leaderemail
						,$telephone
						,$username
						,$password){
	global $con;
	$process_flag = "N";

	//Check exists Team name
	$sql = "select count(*) as countdata
			from t_team_header
			where team_name = '".$teamname."'";
	$query=mysqli_query($con,$sql);

	if(mysqli_num_rows($query)>0){
		while($row = mysqli_fetch_assoc($query)){
			if($row['countdata']==0){
				$process_flag="Y";
			}else{
				print("TEAM_EXISTS");
				$process_flag="N";
				exit;
			}
		}
	}

	//Check exists Leader ID
	$sql = "select count(*) as countdata
			from t_team_header
			where leader_id = '".$leaderid."'";
	$query=mysqli_query($con,$sql);

	if(mysqli_num_rows($query)>0){
		while($row = mysqli_fetch_assoc($query)){
			if($row['countdata']==0){
				$process_flag="Y";
			}else{
				print("ID_EXISTS");
				$process_flag="N";
				exit;
			}
		}
	}

	//Check ID Format
	require_once('command.php');
	$cmd = new Command();

	if($cmd->checkID($leaderid)){
		$process_flag="Y";
	}else{
		print("WRONG_ID_FORMAT");
		$process_flag="N";
		exit;
	}

	//Check exists Username
	$sql = "select count(*) as countdata
			from t_user
			where user_name = '".$username."'";
	$query=mysqli_query($con,$sql);

	if(mysqli_num_rows($query)>0){
		while($row = mysqli_fetch_assoc($query)){
			if($row['countdata']==0){
				$process_flag="Y";
			}else{
				print("USER_EXISTS");
				$process_flag="N";
				exit;
			}
		}
	}

	if($process_flag=="Y"){

		//Create New Team Header
		$sql = "insert into t_team_header
				(team_name
				,institute_name
				,institute_type
				,leader_title
				,leader_first_name
				,leader_last_name
				,leader_id
				,leader_email
				,telephone
				,user_name
				,status
				,create_date
				,create_by
				,member_number)
				values
				('".$teamname."'
				,'".$institutename."'
				,'".$institutetype."'
				,'".$leader_title."'
				,'".$leaderfirstname."'
				,'".$leaderlastname."'
				,'".$leaderid."'
				,'".$leaderemail."'
				,'".$telephone."'
				,'".$username."'
				,'Confirm'
				,sysdate()
				,'SYSTEM'
				,4)";

		$query=mysqli_query($con,$sql);

		//Encrypt Password
		require_once('Encryption.php');
		$encryption = new Encryption($password,'en');
		$password = $encryption->endecrypt();

		//Create New Username
		$sql = "insert into t_user
				(user_name
				,user_password
				,create_date
				,create_by)
				values
				('".$username."'
				,'".$password."'
				,sysdate()
				,'SYSTEM')";

		$query=mysqli_query($con,$sql);

		//sendEmail($teamname,$institutename,$leaderfirstname,$leaderlastname,$leaderemail);

		print("Success");
		exit;
	}
}


/* ------ Update Team Information ------ */
function updateInfo($data,$rownum){
	global $con;
	require_once("command.php");
	$cmd = new Command();

	//Check if get new password
	if($data[0]['password']!=""){
		$sql = "select usr.user_name, usr.user_password
			from t_user usr
			where usr.user_name = '".$cmd->getParam('session','user')."'";
		$query=mysqli_query($con,$sql);

		if(mysqli_num_rows($query)>0){
			while($row = mysqli_fetch_assoc($query)){

				//Decrypt Password
				require_once('Encryption.php');
				$encryption = new Encryption($row['user_password'],'de');
				$db_password = $encryption->endecrypt();

				//Check matching old password
				if($data[0]['oldpassword']==$db_password){

					//Encrypt Password
					$encryption = new Encryption($data[0]['password'],'en');
					$password = $encryption->endecrypt();

					$sql = "update t_user
							set user_password = '".$password."'
								,last_update_date = sysdate()
								,last_update_by = '".$cmd->getParam('session','user')."'
							where user_name = '".$cmd->getParam('session','user')."'";
					$query2=mysqli_query($con,$sql);

				}else{
					print("PASSWORD_NOT_MATCHED");
					exit;
				}
			}
		}
	}

	//Check exists Leader ID
	$sql = "select count(*) as countdata
			from t_team_header
			where leader_id = '".$data[0]['leader_id']."'
				and team_id <> '".$cmd->getParam('session','teamid')."'";
	$query=mysqli_query($con,$sql);

	if(mysqli_num_rows($query)>0){
		while($row = mysqli_fetch_assoc($query)){
			if($row['countdata']==0){
				$process_flag="Y";
			}else{
				print("ID_EXISTS");
				$process_flag="N";
				exit;
			}
		}
	}

	//Check ID Format
	if($cmd->checkID($data[0]['leader_id'])){
		$process_flag="Y";
	}else{
		print("WRONG_ID_FORMAT");
		$process_flag="N";
		exit;
	}

	//Update Header
	$sql = "update t_team_header
			set leader_first_name = '".$data[0]['leader_first_name']."'
			   ,leader_last_name = '".$data[0]['leader_last_name']."'
			   ,leader_title = '".$data[0]['leader_title']."'
			   ,leader_id = '".$data[0]['leader_id']."'
			   ,leader_email = '".$data[0]['leader_email']."'
			   ,telephone = '".$data[0]['telephone']."'
			   ,advisor_title = '".$data[0]['advisor_title']."'
			   ,advisor_name = '".$data[0]['advisor_name']."'
			   ,advisor_last_name = '".$data[0]['advisor_last_name']."'
			   ,advisor_email = '".$data[0]['advisor_email']."'
			   ,advisor_telephone = '".$data[0]['advisor_telephone']."'
			   ,member_number = '".$data[0]['member_number']."'
			   ,last_update_date = sysdate()
			   ,last_update_by = '".$cmd->getParam('session','user')."' ";

		$sql .= ",team_name = '".$data[0]['team_name']."'
				 ,institute_name = '".$data[0]['institute_name']."'
				 ,institute_type = '".$data[0]['institute_type']."' ";
	$sql .= " where team_id = '".$cmd->getParam('session','teamid')."'";

	$query=mysqli_query($con,$sql);


	for($i=0;$i<$rownum;$i++){

		$process_flag = "N";
		if($data[$i]['member_id']!=""){

			//Check exists ID
			$sql = "select sum(a.countdata) as countdata
					from (
						select count(*) as countdata
						from t_team_detail
						where member_id = '".$data[$i]['member_id']."'
							and team_id = '".$cmd->getParam('session','teamid')."'
							and detail_id <> '".($i+1)."') as a";
			$query=mysqli_query($con,$sql);

			if(mysqli_num_rows($query)>0){
				while($row = mysqli_fetch_assoc($query)){
					if($row['countdata']==0){
						$process_flag="Y";
					}else{
						print("ID_EXISTS".($i+1));
						$process_flag="N";
						exit;
					}
				}
			}

		//Check ID Format
			if($cmd->checkID($data[$i]['member_id'])){
				$process_flag="Y";
			}else{
				print("WRONG_ID_FORMAT".($i+1));
				$process_flag="N";
				exit;
			}
		}

		if($process_flag=="Y"){

			//Check Exists Detail
			//If exists Update else Insert new record
			$sql = "select count(*) as countrow
					from t_team_detail
					where team_id = '".$cmd->getParam('session','teamid')."'
						and detail_id = '".($i+1)."'";

			$query=mysqli_query($con,$sql);

			if(mysqli_num_rows($query)>0){
				while($row = mysqli_fetch_assoc($query)){
					if($row['countrow']==0){
						$sql = "insert into t_team_detail
								(team_id
								,detail_id
								,member_title
								,member_first_name
								,member_last_name
								,member_id
								,level
								,create_date
								,create_by)
								values
								('".$cmd->getParam('session','teamid')."'
								,'".($i+1)."'
								,'".$data[$i]['member_title']."'
								,'".$data[$i]['member_first_name']."'
								,'".$data[$i]['member_last_name']."'
								,'".$data[$i]['member_id']."'
								,'".$data[$i]['level']."'
								,sysdate()
								,'".$cmd->getParam('session','user')."')";

						$query2=mysqli_query($con,$sql);
					}else{
						$sql = "update t_team_detail
								set member_first_name = '".$data[$i]['member_first_name']."'
								   ,member_last_name = '".$data[$i]['member_last_name']."'
								   ,member_title = '".$data[$i]['member_title']."'
								   ,member_id = '".$data[$i]['member_id']."'
								   ,level = '".$data[$i]['level']."'
								   ,last_update_date = sysdate()
								   ,last_update_by = '".$cmd->getParam('session','user')."'
								where team_id = '".$cmd->getParam('session','teamid')."'
									and detail_id = '".($i+1)."'";

						$query2=mysqli_query($con,$sql);
					}
				}
			}
		}
	}
	print("Success");
	exit;
}


/* ------ Update Video ------ */
function updateVideo($status,$name,$description,$linkname){
	global $con, $cmd;
	//Update Header
	$sql = "update t_team_header
			set video_name = '".$name."'
				,video_description = '".$description."'
				,last_update_date = sysdate()
			   	,last_update_by = '".$cmd->getParam('session','user')."' ";
	if($status=="withfile"){
		$sql .= "		,video_link = '".$linkname."'";
	}
	$sql .= "where team_id = '".$cmd->getParam('session','teamid')."'
				and user_name = '".$cmd->getParam('session','user')."'";

	$query=mysqli_query($con,$sql);

}


/* ------ Update Document ------ */
function updateDoc($linkname){
	global $con, $cmd;
	//Update Header
	$sql = "update t_team_header
			set file_link = '".$linkname."'
				,last_update_date = sysdate()
			   	,last_update_by = '".$cmd->getParam('session','user')."'
			where team_id = '".$cmd->getParam('session','teamid')."'
				and user_name = '".$cmd->getParam('session','user')."'";

	$query=mysqli_query($con,$sql);

}


/* ------ Update Member Upload ID ------ */
function updateMemberID($linkname,$row,$data){
	global $con, $cmd;
	//Update Detail
	if($row==0){
		$sql = "update t_team_header
				set file_id_link = '".$linkname."'
					,last_update_date = sysdate()
				   	,last_update_by = '".$cmd->getParam('session','user')."'
				where team_id = '".$cmd->getParam('session','teamid')."'";
	}else{
		$sql = "update t_team_detail
				set file_link = '".$linkname."'
					,last_update_date = sysdate()
				   	,last_update_by = '".$cmd->getParam('session','user')."'
				where team_id = '".$cmd->getParam('session','teamid')."'
					and detail_id = '".$row."'
					and member_id = '".$data[$row]['member_id']."'";
	}

	$query=mysqli_query($con,$sql);
}

/* ------ Login process ------ */
function login($username,$password){
	global $con;

	$sql = "select usr.user_name, usr.user_password, thdr.status, thdr.team_id, thdr.team_name
			from t_user usr
			left join t_team_header thdr on usr.user_name = thdr.user_name
			where usr.user_name = '".$username."'";
	$query=mysqli_query($con,$sql);

	if(mysqli_num_rows($query)>0){
		while($row = mysqli_fetch_assoc($query)){
			$db_password = $row['user_password'];

			//Decrypt password
			require_once('Encryption.php');
			$encryption = new Encryption($db_password,'de');
			$db_password = $encryption->endecrypt();

			//Check confirm password
			if($password==$db_password){
				if($row['status']!="Confirm" && $username!="admin"){
					print("NOT_CONFIRMED");

					exit;
				}else{

					//Set session for using
					require_once("command.php");
					$cmd = new Command();

					if($username=="admin"){
						$cmd->setParam('session','user',$row['user_name']);
						$cmd->setParam('session','admin',true);
					}else{
						$cmd->setParam('session','user',$row['user_name']);
						$cmd->setParam('session','teamid',$row['team_id']);
						$cmd->setParam('session','teamname',$row['team_name']);
					}

					print("Success");
					exit;
				}
			}else{
				print("WRONG_PASSWORD");
				exit;
			}
		}
	}else{
		print("USER_NOT_FOUND");
		exit;
	}
}

/* ------ Login process ------ */
function fpwd($email,$IDNO){
	global $con;

	$sql = "select usr.user_name, usr.user_password, thdr.status, thdr.team_id, thdr.team_name , leader_email
			from t_user usr
			inner join t_team_header thdr on usr.user_name = thdr.user_name
			where thdr.leader_email = '".$email."' AND LEADER_ID = '".$IDNO."'";
	$query=mysqli_query($con,$sql);

	if(mysqli_num_rows($query)>0){
		while($row = mysqli_fetch_assoc($query)){
			$db_password = $row['user_password'];
			$username = $row['user_name'];

			//Decrypt password
			require_once('Encryption.php');
			$encryption = new Encryption($db_password,'de');
			$db_password = $encryption->endecrypt();
			print('User name : '.$username. '
			Password : '.$db_password);
			//Check confirm password
			//SendPwd($username,$db_password,$email);
			//print("Success");

			exit;

		}
	}else{
		print("USER_NOT_FOUND");
		exit;
	}
}

/* ------ Login process ------ */
function resend($username){
	global $con;

	$sql = "select usr.user_name, usr.user_password, thdr.status, thdr.team_id, thdr.team_name , leader_email ,insti INSTITUTE_NAME , LEADER_FIRST_NAME,LEADER_LAST_NAME
			from t_user usr
			inner join t_team_header thdr on usr.user_name = thdr.user_name
			where thdr.user_name = '".$username."'";
	$query=mysqli_query($con,$sql);

	if(mysqli_num_rows($query)>0){
		while($row = mysqli_fetch_assoc($query)){
			$username = $row['user_name'];
			$teamname = $row['team_name'];
			$institutename = $row['INSTITUTE_NAME'];
			$leaderfirstname = $row['LEADER_FIRST_NAME'];
			$leaderlastname = $row['LEADER_LAST_NAME'];
			$leaderemail = $row['leader_email'];

			//Check confirm password
			sendEmail($teamname,$institutename,$leaderfirstname,$leaderlastname,$leaderemail);
			print("Success");
			exit;

		}
	}else{
		print("USER_NOT_FOUND");
		exit;
	}
}

/* ------ Get Detail ------ */
function getDetail(){
	global $con,$cmd;

	$sql = "select thdr.team_name
				  ,thdr.institute_name
				  ,thdr.institute_type
				  ,thdr.leader_title
				  ,thdr.leader_first_name
				  ,thdr.leader_last_name
				  ,thdr.leader_id
				  ,thdr.file_id_link as leader_file_link
				  ,thdr.advisor_title
				  ,thdr.advisor_name
				  ,thdr.advisor_last_name
				  ,thdr.advisor_email
				  ,thdr.advisor_telephone
				  ,thdr.leader_email
				  ,thdr.telephone
				  ,thdr.file_link
				  ,tdtl.member_title
				  ,tdtl.member_first_name
				  ,tdtl.member_last_name
				  ,tdtl.member_id
				  ,tdtl.level
				  ,usr.user_name
				  ,thdr.member_number
				  ,tdtl.file_link as member_file_link
			from t_team_header thdr
			left outer join t_team_detail tdtl on thdr.team_id = tdtl.team_id
			inner join t_user usr on thdr.user_name = usr.user_name
			where thdr.team_id = '".$cmd->getParam('session','teamid')."'";
	if(!$cmd->getParam('session','admin')){

		$sql .= "and thdr.user_name = '".$cmd->getParam('session','user')."' ";
	}

	$sql .= "order by detail_id";

	$query=mysqli_query($con,$sql);

	if(mysqli_num_rows($query)>0){
		while($row = mysqli_fetch_assoc($query)){
			$data[] = $row;
		}

		return $data;
	}
}

/* ------ Get Header ------ */
function getHeader(){
	global $con,$cmd;

	$sql = "select thdr.team_name
				  ,thdr.institute_name
				  ,thdr.institute_type
				  ,thdr.leader_title
				  ,thdr.leader_first_name
				  ,thdr.leader_last_name
				  ,thdr.leader_id
				  ,thdr.advisor_title
				  ,thdr.advisor_name
				  ,thdr.advisor_last_name
				  ,thdr.advisor_email
				  ,thdr.advisor_telephone
				  ,thdr.leader_email
				  ,thdr.telephone
				  ,thdr.video_name
				  ,thdr.video_description
				  ,thdr.video_link
				  ,thdr.file_link
			from t_team_header thdr
			where thdr.team_id = '".$cmd->getParam('session','teamid')."'
				and thdr.user_name = '".$cmd->getParam('session','user')."'";

	$query=mysqli_query($con,$sql);

	if(mysqli_num_rows($query)>0){
		while($row = mysqli_fetch_assoc($query)){
			$data = $row;
		}

		return $data;
	}
}

/* ------ Get Search ------ */
function getSearch($regdatefrom,$regdateto,$institutename,$institutetype,$teamname,$status){
	global $con,$cmd;
	$condition = "";

	if($regdatefrom!=""){
		$condition = $condition . " and date(create_date) >= str_to_date('" . $regdatefrom . "','%d/%m/%Y') ";
	}
	if($regdateto!=""){
		$condition = $condition . " and date(create_date) <= str_to_date('" . $regdateto . "','%d/%m/%Y') ";
	}
	if($institutename!=""){
		$condition = $condition . " and institute_name like '%" . $institutename . "%'";
	}
	if($institutetype!=""){
		$condition = $condition . " and institute_type = '" . $institutetype . "'";
	}
	if($teamname!=""){
		$condition = $condition . " and team_name like '" . $teamname . "'";
	}
	if($status!=""){
		$condition = $condition . " and status_code = '" . $status . "'";
	}

	$sql = "select *
			from (select thdr.team_id
				  ,thdr.team_name
				  ,thdr.institute_name
				  ,thdr.institute_type
				  ,thdr.leader_title
				  ,thdr.leader_first_name
				  ,thdr.leader_last_name
				  ,thdr.leader_id
				  ,thdr.advisor_title
				  ,thdr.advisor_name
				  ,thdr.advisor_last_name
				  ,thdr.advisor_email
				  ,thdr.advisor_telephone
				  ,thdr.leader_email
				  ,thdr.telephone
				  ,thdr.video_name
				  ,thdr.video_description
				  ,thdr.video_link
				  ,thdr.file_link
				  ,create_date
				  ,case when thdr.video_link is not null and thdr.video_link <> ''
							and thdr.video_name is not null and thdr.video_name <> ''
							and thdr.video_description is not null and thdr.video_description <> '' then 'Upload ไฟล์คลิป'
				  		when thdr.file_link is not null and thdr.file_link <> '' then 'ให้อาจารย์ที่ปรึกษาเซ็นรับรอง'
				  		when tsta.information_status = 'ผ่าน' then 'กรอกข้อมูลทีมและสมาชิกครบถ้วน'
						when thdr.status = 'Confirm' then 'สมัครและยินยอมการเข้าใช้ระบบ'
					else '' end as status_desc
				  ,case when thdr.video_link is not null and thdr.video_link <> ''
							and thdr.video_name is not null and thdr.video_name <> ''
							and thdr.video_description is not null and thdr.video_description <> '' then 'video'
				  		when thdr.file_link is not null and thdr.file_link <> '' then 'advisor'
				  		when tsta.information_status = 'ผ่าน' then 'information'
						when thdr.status = 'Confirm' then 'register'
					else '' end as status_code
			from t_team_header thdr
			left outer join (select x.team_id, case when sum(x.information_status)=0 then 'ผ่าน' else 'รอดำเนินการ' end as information_status
				from (select a.team_id, case when b.member_first_name is not null and b.member_first_name <> ''
									and b.member_last_name is not null and b.member_last_name <> ''
						            and b.member_id is not null and b.member_id <> ''
						            and b.file_link is not null and b.file_link <> ''
						            and a.advisor_name is not null and a.advisor_name <>''
						      then 0 else 1
								end as information_status
						from t_team_header a
						left outer join t_team_detail b on a.team_id = b.team_id
														and a.member_number >= b.detail_id) x
				group by x.team_id) tsta on thdr.team_id = tsta.team_id) a
			where 1=1 " . $condition;

	$query=mysqli_query($con,$sql);

	if(mysqli_num_rows($query)>0){
		while($row = mysqli_fetch_assoc($query)){
			$data[] = $row;
		}
		return $data;
	}
}


/* ------ Get Status ------ */
function getStatus(){
	global $con,$cmd;

	$sql = "select case when thdr.status = 'Confirm' then 'ผ่าน' else 'รอดำเนินการ' end as register_status
				, tdtl.information_status
				, case when thdr.file_link is not null and thdr.file_link <> '' then 'ผ่าน' else 'รอดำเนินการ' end as advisor_status
				, case when thdr.video_link is not null and thdr.video_link <> ''
							and thdr.video_name is not null and thdr.video_name <> ''
							and thdr.video_description is not null and thdr.video_description <> ''
						then 'ผ่าน' else 'รอดำเนินการ' end as video_status
			from t_team_header thdr
			left outer join (select x.team_id, case when sum(x.information_status)=0 then 'ผ่าน' else 'รอดำเนินการ' end as information_status
							from (select a.team_id, case when b.member_first_name is not null and b.member_first_name <> ''
												and b.member_last_name is not null and b.member_last_name <> ''
									            and b.member_id is not null and b.member_id <> ''
									            and b.file_link is not null and b.file_link <> ''
									            and a.advisor_name is not null and a.advisor_name <>''
									      then 0 else 1
											end as information_status
									from t_team_header a
									left outer join t_team_detail b on a.team_id = b.team_id
																	and a.member_number >= b.detail_id) x
							group by x.team_id) tdtl on thdr.team_id = tdtl.team_id
			where thdr.team_id = '".$cmd->getParam('session','teamid')."'
				and thdr.user_name = '".$cmd->getParam('session','user')."'";

	$query=mysqli_query($con,$sql);

	if(mysqli_num_rows($query)>0){
		while($row = mysqli_fetch_assoc($query)){
			$data = $row;
		}

		return $data;
	}
}


/* ------ Get Institute ------ */
function getInstitute(){
	global $con,$cmd;
	$str = "";

	$sql = "select distinct institute_name from t_team_header order by institute_name";

	$query=mysqli_query($con,$sql);

	if(mysqli_num_rows($query)>0){
		while($row = mysqli_fetch_assoc($query)){
			$str .= "<option value='".$row['institute_name']."'>".$row['institute_name']."</option>";
		}

		return $str;
	}
}

function sendEmail($teamname,$institutename,$firstname,$lastname,$email){

	$string = $teamname.$institutename.$email;

	require_once('Encryption.php');
	$encryption = new Encryption($string,'en');
	$string = rawurlencode($encryption->endecrypt());

	$url = "http://www.idemitsucontest.com/database/activate.php?code=".$string."&email=".$email;

	$to = $email;
	$subject = 'Registeration Confirm Email';
	$headers = "From: Web Master <webmaster@idemitsu.com>";
	$message = "Please confirm the registeration from link below.
		  		".$url;

	$headers = array();
	$headers = "Content-type: text/plain; charset=iso-8859-1";
	$headers .= "From: IDEMETUS Contest";

	mail($to, $subject, $message, $headers);

}

function SendPwd($username,$db_password,$email){

	$to = $email;
	$subject = 'User name and password';
	$headers = "From: Web Master <webmaster@idemitsu.com>";
	$message = "Your infomation is below :-

	User name : ".$username."
	Password : ".$db_password ;

	$headers = array();
	$headers = "Content-type: text/plain; charset=iso-8859-1";
	$headers .= "From: IDEMETUS Contest";

	mail($to, $subject, $message, $headers);
}


?>