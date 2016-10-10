<?php $data = getHeader();?>

<div class="head-title">ทีม <?php echo $data['team_name'];?></div>
<div class="page-info">
	<div style="padding:10px">
	<table style="font-size:16pt;width:100%;" >
	<tr><td>
		ขั้นตอนที่ 1 หลังจากเข้าสู่ระบบแล้ว ให้กรอกข้อมูลต่างๆ ของผู้สมัครและทีม พร้อมแนบไฟล์บัตรประชาน ให้ครบถ้วน  <a href="?menu=info2">[กรอกข้อมูลทีม]</a>
	</td></tr>
	<tr><td>
		ขั้นตอนที่ 2 	ทำการ download เอกสารในรับรองการสมัคร(พร้อมข้อมูลทีมที่กรอกลงไป) นำไปให้อาจารย์ที่ปรึกษาเซ็นรับรอง  <a href="/report/Certificate.php?id=<?php echo $cmd->getParam('session','teamid')?>" target="_blank">[เอกสารใบรับรอง]</a>
	</td></tr>
	<tr><td>
		<p>ขั้นตอนที่ 3 เอกสารในรับรองที่อาจารย์ที่ปรึกษาเซ็นแล้ว ทำการสแกนเป็นไฟล์ PDF  
                  แล้วนำมา upload ส่งเข้าระบบ </p>
			<div style="padding-left:50px;font-size:16pt;width:100%">
			  <form action="/database/upload.php?action=uploadfile" method="post" enctype="multipart/form-data">
			  	<table style="width:100%;" >
					<?php if($data['file_link']!=""){?>
						<tr>
							<td colspan="2" width="70px" align="left" style="height:40px;font-size:16pt">เอกสารรับรองการสมัคร <a href="uploads/<?php echo $cmd->getParam('session','teamid')?>/<?php echo $data['file_link']?>">Download</a></td>
						</tr>
					<?php }else{?>
					<tr>
						<td width="70px" align="right" style="height:40px;font-size:16pt">เลือกไฟล์: </td>
						<td  align="left">
							<div class="clearfix beforespace-10">
								<input type="file"  title="เลือกไฟล์" name="file" width="250px" id="file"   border="1px" style="font-size:14px;">
							</div>
						</td>
					</tr>
					<tr>
						<td></td>
						<td align="left">
							<div class="clearfix beforespace-10">
								<input type="submit" value="Upload" name="submit"  align="left" style="font-size:18px;font-family: KittithadaB;">
							</div>
						</td>
					</tr>
					<?php }?>
				</table>
			</form>
		</div>
	<tr><td>
		ขั้นตอนที่ 4 จัดทำคลิปวีดีโอ แล้วทำการ upload เข้า dropbox ที่จัดเตรียมไว้
	</td></tr>
	</table>
	<p></p>
	<div class="line_hr"></div>
	<?php $data = getStatus();?>
	 <table style="font-size:16pt;width:100%;" >
	 <tr><td width="60%">
		<table style="font-size:16pt;width:100%;"  >
		  <tr> 
			<td width="75%" bgcolor="#C4E1FF" align="center">ขั้นตอน</td>
			<td bgcolor="#C4E1FF"  align="center" style="height:36px;border-left-style: solid; border-left-width: 1px; border-left-color: #fff">สถานะ</td>
		  </tr>
		  <tr> 
			<td>1. สมัครและยืนยันการเข้าใช้ระบบ</td>
			<td align="center"><?php echo $data['register_status']?></td>
		  </tr>
		  <tr> 
			<td>2. กรอกข้อมูลทีมและสมาชิกครบถ้วน</td>
			<td align="center"><?php echo $data['information_status']?></td>
		  </tr>
		  <tr> 
			<td>3. Donwload และ upload เอกสารเพื่อให้อาจารย์ที่ปรึกษาเซ็นรับรอง</td>
			<td align="center"><?php echo $data['advisor_status']?></td>
		  </tr>
		  <tr> 
			<td>4. Upload ไฟล์คลิป</td>
			<td align="center"><?php echo $data['video_status']?></td>
		  </tr>
		</table>
	</td>
	<td>
		<table style="font-size:16pt;width:100%;" >
			<tr>
				<td align="center">
					<img src="img/sl.png">	
				</td>
			</tr>
		</table>
	</td>
	</tr>
	</table>
	</div>
	<div style="">
	
	
	</div>
	
</div>