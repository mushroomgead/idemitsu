<?php

require_once('../database/connect_db.php');
require_once('../database/Command.php');
require_once('../include/phpexcel/PHPExcel.php');

$cmd = new Command();

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("SYSTEM")
							 ->setLastModifiedBy("SYSTEM")
							 ->setTitle("Team Report")
							 ->setSubject("Team Report");

$headerStyle = new PHPExcel_Style();
$detailStyle = new PHPExcel_Style();

$headerStyle->applyFromArray(
	array('fill' 	=> array(
								'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
								'color'		=> array('argb' => 'FFFFFF00')
							),
		  'borders' => array(
								'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
							),
		  'alignment' => array(
		  						'horizontal'	=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER
		  					)
		 ));

$detailStyle->applyFromArray(
	array('borders' => array(
								'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
							)
		 ));

$objPHPExcel->setActiveSheetIndex(0);

//Set Header Value
$objPHPExcel->getActiveSheet()->getCell('D1')->setValue("หัวหน้าทีม");
$objPHPExcel->getActiveSheet()->getCell('H1')->setValue("สมาชิกคนที่ 1");
$objPHPExcel->getActiveSheet()->getCell('J1')->setValue("สมาชิกคนที่ 2");
$objPHPExcel->getActiveSheet()->getCell('L1')->setValue("สมาชิกคนที่ 3");
$objPHPExcel->getActiveSheet()->getCell('N1')->setValue("สมาชิกคนที่ 4");
$objPHPExcel->getActiveSheet()->getCell('A2')->setValue("ชื่อทีม");
$objPHPExcel->getActiveSheet()->getCell('B2')->setValue("ชื่อสถานศีกษา");
$objPHPExcel->getActiveSheet()->getCell('C2')->setValue("ประเภท");
$objPHPExcel->getActiveSheet()->getCell('D2')->setValue("ชื่อ-นามสกุล");
$objPHPExcel->getActiveSheet()->getCell('E2')->setValue("หมายเลขบัตรประชาชน");
$objPHPExcel->getActiveSheet()->getCell('F2')->setValue("email");
$objPHPExcel->getActiveSheet()->getCell('G2')->setValue("เบอร์โทรศัพท์");
$objPHPExcel->getActiveSheet()->getCell('H2')->setValue("ชื่อ-นามสกุล");
$objPHPExcel->getActiveSheet()->getCell('I2')->setValue("หมายเลขบัตรประชาชน");
$objPHPExcel->getActiveSheet()->getCell('J2')->setValue("ชื่อ-นามสกุล");
$objPHPExcel->getActiveSheet()->getCell('K2')->setValue("หมายเลขบัตรประชาชน");
$objPHPExcel->getActiveSheet()->getCell('L2')->setValue("ชื่อ-นามสกุล");
$objPHPExcel->getActiveSheet()->getCell('M2')->setValue("หมายเลขบัตรประชาชน");
$objPHPExcel->getActiveSheet()->getCell('N2')->setValue("ชื่อ-นามสกุล");
$objPHPExcel->getActiveSheet()->getCell('O2')->setValue("หมายเลขบัตรประชาชน");
$objPHPExcel->getActiveSheet()->getCell('P2')->setValue("อาจารย์ที่ปรึกษา");
$objPHPExcel->getActiveSheet()->getCell('Q2')->setValue("สถานะ");
$objPHPExcel->getActiveSheet()->getCell('R2')->setValue("วันที่สมัคร");

$endofHeaderRow = 2;

//Merge Cell
$objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
$objPHPExcel->getActiveSheet()->mergeCells('D1:G1');
$objPHPExcel->getActiveSheet()->mergeCells('H1:I1');
$objPHPExcel->getActiveSheet()->mergeCells('J1:K1');
$objPHPExcel->getActiveSheet()->mergeCells('L1:M1');
$objPHPExcel->getActiveSheet()->mergeCells('N1:O1');

//Get and Set Report Data
$thisRow = 0;
$condition = "";

if($cmd->getParam('get','regdatefrom')!=""){
	$condition = $condition . " and date(create_date) >= str_to_date('" . $cmd->getParam('get','regdatefrom') . "','%d/%m/%Y') ";
}
if($cmd->getParam('get','regdateto')!=""){
	$condition = $condition . " and date(create_date) <= str_to_date('" . $cmd->getParam('get','regdateto') . "','%d/%m/%Y') ";
}
if($cmd->getParam('get','institutename')!=""){
	$condition = $condition . " and institute_name like '%" . $cmd->getParam('get','institutename') . "%'";
}
if($cmd->getParam('get','institutetype')!=""){
	$condition = $condition . " and institute_type = '" . $cmd->getParam('get','institutetype') . "'";
}
if($cmd->getParam('get','teamname')!=""){
	$condition = $condition . " and team_name like '" . $cmd->getParam('get','teamname') . "'";
}
if($cmd->getParam('get','status')!=""){
	$condition = $condition . " and status_code = '" . $cmd->getParam('get','status') . "'";
}

$sql = "select *
		from (select thdr.team_id
			  ,thdr.team_name
			  ,thdr.institute_name
			  , case when thdr.institute_type = 'Highscool' then 'มัธยมศึกษาหรือเทียบเท่า'
			      	when thdr.institute_type = 'University' then 'อุดมศึกษาหรือเทียบเท่า'
			    else '' end as institute_type
			  ,concat(thdr.leader_title,' ',thdr.leader_first_name,' ',thdr.leader_last_name) as leader_name
			  ,thdr.leader_id
			  ,concat(thdr.advisor_title,' ',thdr.advisor_name,' ',thdr.advisor_last_name) as advisor_name
			  ,thdr.advisor_email
			  ,thdr.advisor_telephone
			  ,thdr.leader_email
			  ,thdr.telephone
			  ,thdr.video_name
			  ,thdr.video_description
			  ,thdr.video_link
			  ,thdr.file_link
			  ,concat(tdtl.member_first_name,' ',tdtl.member_last_name) as member_name
			  ,tdtl.member_id as member_id
			  ,date_format(thdr.create_date,'%d/%m/%Y') as create_date
			  ,case when thdr.video_link is not null and thdr.video_link <> ''
						and thdr.video_name is not null and thdr.video_name <> ''
						and thdr.video_description is not null and thdr.video_description <> '' then 'Upload ไฟล์คลิป'
			  		when thdr.file_link is not null and thdr.file_link <> '' then 'ให้อาจารย์ที่ปรึกษาเซ็นรับรอง'
			  		when tsta.information_status = 'ผ่าน' then 'กรอกข้อมูลทีมและสมาชิกครบถ้วน'
					when thdr.status = 'Confirm' then 'สมัครและยินยอมการเข้าใช้ระบบ' 
				else '' end as status_desc
		from t_team_header thdr
		left outer join t_team_detail tdtl on thdr.team_id = tdtl.team_id
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

$teamid = "";
$chrDec = 72; // Column H -> Chr(72) is "H".
$nextChrDec = 0; // Add this value to move column to the right.

while($row = mysqli_fetch_assoc($query)){
	//Team Header
	if($row['team_id'] != $teamid){
		$chrDec = 72;
		$nextChrDec = 0;
		$thisRow += 1;
		$teamid = $row['team_id'];
		$objPHPExcel->getActiveSheet()->getCell('A'.($endofHeaderRow+$thisRow))->setValue($row['team_name']);
		$objPHPExcel->getActiveSheet()->getCell('B'.($endofHeaderRow+$thisRow))->setValue($row['institute_name']);
		$objPHPExcel->getActiveSheet()->getCell('C'.($endofHeaderRow+$thisRow))->setValue($row['institute_type']);
		$objPHPExcel->getActiveSheet()->getCell('D'.($endofHeaderRow+$thisRow))->setValue($row['leader_name']);
		$objPHPExcel->getActiveSheet()->getCell('E'.($endofHeaderRow+$thisRow))->setValue($row['leader_id']);
		$objPHPExcel->getActiveSheet()->getCell('F'.($endofHeaderRow+$thisRow))->setValue($row['leader_email']);
		$objPHPExcel->getActiveSheet()->getCell('G'.($endofHeaderRow+$thisRow))->setValue($row['telephone']);
		$objPHPExcel->getActiveSheet()->getCell('P'.($endofHeaderRow+$thisRow))->setValue($row['advisor_name']);
		$objPHPExcel->getActiveSheet()->getCell('Q'.($endofHeaderRow+$thisRow))->setValue($row['status_desc']);
		$objPHPExcel->getActiveSheet()->getCell('R'.($endofHeaderRow+$thisRow))->setValue($row['create_date']);
	}
	//Team Detail
	$objPHPExcel->getActiveSheet()->getCell(chr($chrDec+$nextChrDec).($endofHeaderRow+$thisRow))->setValue($row['member_name']);
	$nextChrDec += 1;
	$objPHPExcel->getActiveSheet()->getCell(chr($chrDec+$nextChrDec).($endofHeaderRow+$thisRow))->setValue($row['member_id']);
	$nextChrDec += 1;
}
$lastRow = $endofHeaderRow+$thisRow;

//Set Cell Style
foreach(range('A','R') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
}
$objPHPExcel->getActiveSheet()->getStyle('A1:R2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->setSharedStyle($headerStyle, "A1:R2");
$objPHPExcel->getActiveSheet()->setSharedStyle($detailStyle, "A3:R".$lastRow);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename='Team_report.xlsx'");
header("Cache-Control: max-age=0");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("php://output");

?>