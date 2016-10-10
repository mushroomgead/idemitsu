<!DOCTYPE html>

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<?php
require_once('../database/connect_db.php');
require_once('../include/mpdf/mpdf.php');
ob_start();
//GET_DATA
	$sql = "SELECT A.team_id
				, A.team_name
				, A.institute_name
			    , CASE WHEN A.INSTITUTE_TYPE = 'HighScool' THEN 'มัธยมศึกษาหรือเทียบเท่า'
			      ELSE CASE WHEN A.INSTITUTE_TYPE = 'Vocational' THEN 'อาชีวะศึกษา'
			      ELSE CASE WHEN A.INSTITUTE_TYPE = 'University' THEN 'อุดมศึกษาหรือเทียบเท่า'
			        ELSE '' END END END AS institute_type
			    , CONCAT(A.LEADER_TITLE,' ',A.LEADER_FIRST_NAME,' ',A.LEADER_LAST_NAME) AS leader_name
			    , A.leader_id
			    , A.leader_email
			    , A.telephone
			    , CONCAT(B.MEMBER_TITLE,' ',B.MEMBER_FIRST_NAME,' ',B.MEMBER_LAST_NAME) AS member_name
			    , B.member_id
			    , B.level as member_level
			    , CONCAT(A.advisor_title,' ',A.advisor_name) as advisor_name
			    , A.advisor_email
			    , A.advisor_telephone
			FROM t_team_header A
			LEFT OUTER JOIN t_team_detail B ON A.TEAM_ID = B.TEAM_ID
			WHERE A.team_id = '".$_GET['id']."'
			ORDER BY A.TEAM_ID,B.DETAIL_ID";

	$query=mysqli_query($con,$sql);

	$i = 0;

	while($row = mysqli_fetch_assoc($query)){
		$data[$i] = $row;

		$i++;
	}
?>

	<script src="../include/mpdf/mpdf.php"></script>
	<title></title>
	<div>
		<img src="../img/apollo.png" >
	</div>
</head>
<body>
<div style="text-align:center">	
	<h2>ใบสมัครโครงการประกวดคลิปวีดีโอ<br>
	หัวข้อ “สร้างสรรค์ ปันน้ำใจ”</h2>
</div>
<div style="text-align:center;font-size:16px;">
**โปรดศึกษาเงื่อนไขการรับสมัครและส่งผลงาน แล้วกรอกข้อมูลออนไลน์ให้ครบถ้วน ก่อนพิมพ์ใบรับสมัครเพื่อให้อาจารย์ที่ปรึกษาเซ็นต์รับรอง**
</div>
<div style="padding-left:35px">
	<div style="font-size:16px;padding-top:10px;">
		<b>ชื่อทีม : <?php print(isset($data[0]['team_name'])?$data[0]['team_name']:'')?> <br>
		ชื่อสถานศึกษา : <?php print(isset($data[0]['institute_name'])?$data[0]['institute_name']:'')?>  <br>
		สมาชิกภายในทีม</b>
	</div>
	<div style="padding-left: 20px;">
		<ol style="font-size:14px;">
			<li style="padding-top:100px;">
				(หัวหน้าทีม) ชื่อ-ชื่อสกุล   <?php print(isset($data[0]['leader_name'])?$data[0]['leader_name']:'')?> <br>                                     
				หมายเลขบัตรประชาชน <?php print(isset($data[0]['leader_id'])?$data[0]['leader_id']:'')?>  <br>
				กำลังศึกษาระดับ <?php print(isset($data[0]['institute_type'])?$data[0]['institute_type']:'')?> <br>
				เบอร์โทรศัพท์ที่ติดต่อได้ <?php print(isset($data[0]['telephone'])?$data[0]['telephone']:'')?>  <br>
				อีเมล <?php print(isset($data[0]['leader_email'])?$data[0]['leader_email']:'')?>
			</li>
			<li>
				สมาชิกในทีม  ชื่อ-ชื่อสกุล   <?php print(isset($data[0]['member_name'])?$data[0]['member_name']:'')?>   <br>                                         
				หมายเลขบัตรประชาชน <?php print(isset($data[0]['member_id'])?$data[0]['member_id']:'')?>  <br> 
				กำลังศึกษาระดับ <?php print(isset($data[0]['institute_type'])?$data[0]['institute_type']:'')?> ชั้น <?php print(isset($data[0]['member_level'])?$data[0]['member_level']:'')?><br>
			</li>
			<li>
				สมาชิกในทีม  ชื่อ-ชื่อสกุล   <?php print(isset($data[1]['member_name'])?$data[1]['member_name']:'')?>   <br>                                         
				หมายเลขบัตรประชาชน <?php print(isset($data[1]['member_id'])?$data[1]['member_id']:'')?>  <br> 
				กำลังศึกษาระดับ <?php print(isset($data[1]['institute_type'])?$data[1]['institute_type']:'')?>  ชั้น <?php print(isset($data[1]['member_level'])?$data[1]['member_level']:'')?><br>
			</li>
			<li>
				สมาชิกในทีม  ชื่อ-ชื่อสกุล   <?php print(isset($data[2]['member_name'])?$data[2]['member_name']:'')?>   <br>                                         
				หมายเลขบัตรประชาชน <?php print(isset($data[2]['member_id'])?$data[2]['member_id']:'')?>  <br> 
				กำลังศึกษาระดับ <?php print(isset($data[2]['institute_type'])?$data[2]['institute_type']:'')?>  ชั้น <?php print(isset($data[2]['member_level'])?$data[2]['member_level']:'')?><br>
			</li>
			<li>
				สมาชิกในทีม  ชื่อ-ชื่อสกุล   <?php print(isset($data[3]['member_name'])?$data[3]['member_name']:'')?>   <br>                                         
				หมายเลขบัตรประชาชน <?php print(isset($data[3]['member_id'])?$data[3]['member_id']:'')?>  <br> 
				กำลังศึกษาระดับ <?php print(isset($data[3]['institute_type'])?$data[3]['institute_type']:'')?>  ชั้น <?php print(isset($data[3]['member_level'])?$data[3]['member_level']:'')?><br>
			</li>
		</ol>
	</div>
</div>
-------------------------------------------------------------------------------------------------------------------------------------------

<div style="font-size:14px;padding-top:10px;padding-top:10px;">
	ขอรับรองว่าข้อความที่ได้กรอกไว้ในใบสมัครข้างต้นและหลักฐานที่ใช้ในการสมัครของทีม เป็นความจริงทุกประการ<br>
</div>
<div style="padding-left:35px;font-size:14px;padding-top:10px;padding-top:15px;">
	อาจารย์ที่ปรึกษา  ชื่อ-ชื่อสกุล   <?php print(isset($data[0]['advisor_name'])?$data[0]['advisor_name']:'')?> <br>
	เบอร์โทรศัพท์ที่ติดต่อได้ <?php print(isset($data[0]['advisor_telephone'])?$data[0]['advisor_telephone']:'')?>  <br>
	อีเมล <?php print(isset($data[0]['advisor_email'])?$data[0]['advisor_email']:'')?> <br>
</div>
<div style="padding-left:35px;font-size:14px; padding-top:25px; line-height:30px;">
ลงชื่อ ......................................................................  อาจารย์ที่ปรึกษา <br> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(...................................................................)  <br> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่ ……………………………………………………….                
</div>
<div style="text-align:center; padding-top: 35px;">
	ติดต่อสอบถามรายละเอียดเพิ่มเติมได้ที่ <br>
	คุณอภินันท์ สวนกูล ฝ่ายประชาสัมพันธ์โครงการ “สร้างสรรค์ ปันน้ำใจ” <br>
	บริษัท น้ำมันอพอลโล (ไทย) จำกัด โทร. ๐๓๘-๔๕๖๙๐๐ Email: apinan.su@apollothai.com <br>
	www.idemitsucontest.com
</div>
</body>
</html>

<?php
	$html = ob_get_contents();
	ob_end_clean();

	$pdf = new mPDF('th', 'A4', '0', '');
	$pdf->SetAutoFont();
	$pdf->SetDefaultFont(monospace);
	$pdf->SetDisplayMode('fullpage');
	$pdf->SetTopMargin(5);
	$pdf->WriteHTML($html, 2);
	$pdf->Output('Certificate.pdf','I');
?>