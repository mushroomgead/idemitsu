<?php 
$cmd->setParam('session','teamid',$cmd->getParam('get','teamid'));
if($cmd->getParam('session','teamid')=="" || $cmd->getParam('get','teamid'=="")){
	redirect($cmd->getParam('session','url'));
}else{
	$data = getDetail();
?>
	<script type="text/JavaScript">
		$(document).ready(function(){
			$("select#memberamt").val(<?php echo $data[0]['member_number']?>);
			hideShowMember($("#memberamt").val());
		})
	</script>
	<!-- Header -->
	<div class="head-title">ข้อมูลทีมและสมาชิก</div>
<form method="post" name="form_userinfo" id="form_userinfo">
	<div class="page-info">
	<!-- Detail -->
	    <div class="detail-user-info">
	        <div class="block-regis"> <!-- TeamName-->
	            <div class="detail-left-100">
	                <?php echo "ชื่อทีม"; ?>
	            </div>
	            <div class="detail-right">
	                <input type="textbox" class="txtbox" value="<?php echo $data[0]['team_name'];?>"  name="teamname">
	            </div>
	        </div>
	        <div class="block-regis"> <!-- EducationName-->
	            <div class="detail-left-100">
	                <?php echo "ชื่อสถานศึกษา"; ?>
	            </div>
	            <div class="detail-right">
	                <input type="textbox" class="txtbox" value="<?php echo $data[0]['institute_name'];?>"  name="institutename">
	            </div>
	        </div>
	        <div class="block-regis">
	            <div class="detail-left-100">สถานศึกษา</div>
	            <div class="radio-box">
	                <input type="radio" class="radiobtn" name="institutetype" value="HighScool" <?php ($data[0]['institute_type']=="HighScool")?print("checked"):''?>><?php echo "มัธยมศึกษาหรือเทียบเท่า"; ?>
	            </div>
	            <div class="">
	                <input type="radio" class="radiobtn" name="institutetype" value="University" <?php ($data[0]['institute_type']=="University")?print("checked"):''?>><?php echo "อุดมศึกษาหรือเทียบเท่า"; ?>
	            </div>
	        </div>
			
			<div class="line_hr"></div>
			
			<div class="block-regis">
	            <div class="detail-left-100">
	                  <?php echo "คำนำหน้าชื่อ"; ?>
	            </div>
	            <div class="detail-left-300 required">
	               <input type="textbox"  class="txtbox" value="<?php echo $data[0]['advisor_title'];?>" name="advisor_title">
	            </div>
			</div>
			
	        <div class="block-regis"> <!-- AdvisorName-->
	            <div class="detail-left-100">
	                <?php echo "ชื่ออาจารย์ที่ปรึกษา"; ?>
	            </div>
	            <div class="detail-left-300 required">
	                <input type="textbox"  class="txtbox" value="<?php echo $data[0]['advisor_name'];?>" name="advisor_name">
	            </div>
				
	            <div class="detail-left-100">
	                <?php echo "อีเมล์"; ?>
	            </div>
	            <div class="detail-right required">
	                <input type="textbox"  class="txtbox" value="<?php echo $data[0]['advisor_email'];?>" name="advisor_email">
	            </div>
	        </div>
			
			<div class="block-regis"> <!-- AdvisorName-->
	            <div class="detail-left-100">
	                <?php echo "นามสกุล"; ?>
	            </div>
	            <div class="detail-left-300 required">
	                <input type="textbox"  class="txtbox" value="<?php echo $data[0]['advisor_last_name'];?>" name="advisor_last_name">
	            </div>
				
	            <div class="detail-left-100">
	                <?php echo "เบอร์โทรศัพท์ "; ?>
	            </div>
	            <div class="detail-right required">
	                 <input type="textbox"  class="txtbox" value="<?php echo $data[0]['advisor_telephone'];?>" name="advisor_telephone">
	            </div>
	        </div>

			
			 <div class="line_hr"></div>
			 
			 <div class="block-regis">
	            <div class="detail-left-100">
	                  <?php echo "คำนำหน้าชื่อ"; ?>
	            </div>
	            <div class="detail-left-300 required">
	               <input type="textbox"  class="txtbox" value="<?php echo $data[0]['leader_title'];?>" name="leader_title">
	            </div>
			</div>
			
			 <div class="block-regis"> <!-- Header-->
	            <div class="detail-left-100">
	                  <?php echo "หัวหน้าทีม - ชื่อ"; ?>
	            </div>
	            <div class="detail-left-300 required">
	                <input type="textbox"  class="txtbox" value="<?php (isset($data[0]['leader_first_name'])?print($data[0]['leader_first_name']):"");?>" name="leaderfirstname">
	            </div>
	            <div class="detail-left-100">
	                <?php echo "อีเมล์"; ?>
	            </div>
	            <div class="detail-right required">
	                <input type="textbox"  class="txtbox" value="<?php echo $data[0]['leader_email'];?>" name="leaderemail">
	            </div>
	        </div>

	        <div class="block-regis">
	             <div class="detail-left-100">
	                <?php echo "นามสกุล"; ?>
	            </div>
	            <div class="detail-left-300 required">
	                <input type="textbox"  class="txtbox" value="<?php (isset($data[0]['leader_last_name'])?print($data[0]['leader_last_name']):"");?>" name="leaderlastname">
	            </div>
	            <div class="detail-left-100">
	                <?php echo "เบอร์โทรศัพท์ที่ติดต่อได้"; ?>
	            </div>
	            <div class="detail-right required">
	                <input type="textbox"  class="txtbox" value="<?php echo $data[0]['telephone'];?>" name="telephone">
	            </div>
			</div>
			
			<div class="block-regis">
	            <div class="detail-left-100">
	                <?php echo "หมายเลขบัตรประชาชน"; ?>
	            </div>
	            <div class="detail-left-300 required">
	                <input type="textbox"  maxlength="13" class="txtbox" value="<?php (isset($data[0]['leader_id'])?print($data[0]['leader_id']):"");?>" name="leaderid">
	            </div>
	        </div>
			<div class="block-regis">
				<div class="detail-left-100">
					<?php echo "ไฟล์บัตรประชาชน"; ?>
				</div>
				<div class="detail-right">
					<div class="clearfix beforespace-10">
				<?php if((isset($data[0]['leader_file_link'])?$data[0]['leader_file_link']:"") != ""){?>
					<a href="uploads/<?php echo $cmd->getParam('session','teamid')?>/<?php echo $data[0]['leader_file_link']?>">Download</a>
	                <?php }else{
	                ?>
	                	ยังไม่มี
	            <?php } ?>
	                </div>
				</div>
			</div>
	    </div>
	    <div class="line_hr"></div>

	    <div class="detail-user-info">
	     	<div class="block-regis"> <!-- Member amt-->
	            <div class="detail-left-100">
	                <?php echo "จำนวนสมาชิก (รวมหัวหน้า)"; ?>
	            </div>
	            <div class="detail-right">
	                <select class="selectbox" name="memberamt" id="memberamt" onchange="hideShowMember($(this).val())">
	                	<option value="1">2 คน</option>
	                	<option value="2">3 คน</option>
	                	<option value="3">4 คน</option>
						<option value="4" selected>5 คน</option>
	                </select>
	            </div>
	        </div>

		<table class="userinfotable" style="margin: 15px 10px 15px 10px;" width="100%" border="0" >
		<tr>
			<td class="userinfotd" style="width:50%:margin-top:10px;" id="1">
				<div class="block-regis">
					<div class="detail-left-100"></div>
					<div class="detail-right"><?php echo "สมาชิกคนที่ 1"; ?></div>
				</div>
				
				<div class="block-regis">
					<div class="detail-left-100">
					   <?php echo "คำนำหน้าชื่อ"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  class="txtbox" value="<?php (isset($data[0]['member_title'])?print($data[0]['member_title']):"");?>" name="member_title1">
					</div>
				</div>
			
				<div class="block-regis">
					<div class="detail-left-100">
					   <?php echo "ชื่อ"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  class="txtbox" value="<?php (isset($data[0]['member_first_name'])?print($data[0]['member_first_name']):"");?>" name="memberfirstname1">
					</div>
				</div>
				<div class="block-regis">
					<div class="detail-left-100">
						<?php echo "นามสกุล"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  class="txtbox" value="<?php (isset($data[0]['member_last_name'])?print($data[0]['member_last_name']):"");?>" name="memberlastname1">
					</div>
				</div>
				<div class="block-regis">
					<div class="detail-left-100">
						<?php echo "ชั้นปีที่กำลังศึกษาอยู่"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  class="txtbox" value="<?php (isset($data[0]['level'])?print($data[0]['level']):"");?>" name="level1">
					</div>
				</div>
				<div class="block-regis">
					<div class="detail-left-100">
						<?php echo "หมายเลขบัตรประชาชน"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  maxlength="13" class="txtbox" value="<?php (isset($data[0]['member_id'])?print($data[0]['member_id']):"");?>" name="memberid1">
					</div>
				</div>
				<div class="block-regis">
					<div class="detail-left-100">
						<?php echo "ไฟล์บัตรประชาชน"; ?>
					</div>
					<div class="detail-right">
						<div class="clearfix beforespace-10">
					<?php if((isset($data[0]['member_file_link'])?$data[0]['member_file_link']:"") != ""){?>
						<a href="uploads/<?php echo $cmd->getParam('session','teamid')?>/<?php echo $data[0]['member_file_link']?>">Download</a>
	                <?php }else{
	                ?>
	                	ยังไม่มี
	                <?php } ?>
	                    </div>
					</div>
				</div>
			</td>
			<td id="2" >
				<div class="block-regis">
					<div class="detail-left-100"></div>
					<div class="detail-right"><?php echo "สมาชิกคนที่ 2"; ?></div>
				</div>
				
				<div class="block-regis">
					<div class="detail-left-100">
					   <?php echo "คำนำหน้าชื่อ"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  class="txtbox" value="<?php (isset($data[1]['member_title'])?print($data[1]['member_title']):"");?>" name="member_title2">
					</div>
				</div>
				
				 <div class="block-regis">
					<div class="detail-left-100">
						<?php echo "ชื่อ"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  class="txtbox" value="<?php (isset($data[1]['member_first_name'])?print($data[1]['member_first_name']):"");?>" name="memberfirstname2">
					</div>
				</div>
				<div class="block-regis">
					<div class="detail-left-100">
						<?php echo "นามสกุล"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  class="txtbox" value="<?php (isset($data[1]['member_last_name'])?print($data[1]['member_last_name']):"");?>" name="memberlastname2">
					</div>
				</div>
				<div class="block-regis">
					<div class="detail-left-100">
						<?php echo "ชั้นปีที่กำลังศึกษาอยู่"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  class="txtbox" value="<?php (isset($data[1]['level'])?print($data[0]['level']):"");?>" name="level2">
					</div>
				</div>
				<div class="block-regis">
					<div class="detail-left-100">
						<?php echo "หมายเลขบัตรประชาชน"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  maxlength="13" class="txtbox" value="<?php (isset($data[1]['member_id'])?print($data[1]['member_id']):"");?>" name="memberid2">
					</div>
				</div>
				<div class="block-regis">
					<div class="detail-left-100">
						<?php echo "ไฟล์บัตรประชาชน"; ?>
					</div>
					<div class="detail-right">
						<div class="clearfix beforespace-10">
					<?php if((isset($data[1]['member_file_link'])?$data[1]['member_file_link']:"") != ""){?>
						<a href="uploads/<?php echo $cmd->getParam('session','teamid')?>/<?php echo $data[1]['member_file_link']?>">Download</a>
	                <?php }else{
	                ?>
	                	ยังไม่มี
	                <?php } ?>
	                    </div>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td id="3" style="border-top-style: solid; border-top-width: 1px; border-top-color: #d7d7d7;padding-top5px;padding-bottom:10px;">
				
				<div class="block-regis">
					<div class="detail-left-100"></div>
					<div class="detail-right"><?php echo "สมาชิกคนที่ 3"; ?></div>
				</div>
				
				<div class="block-regis">
					<div class="detail-left-100">
					   <?php echo "คำนำหน้าชื่อ"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  class="txtbox" value="<?php (isset($data[2]['member_title'])?print($data[2]['member_title']):"");?>" name="member_title3">
					</div>
				</div>
				
				 <div class="block-regis">
					<div class="detail-left-100">
						 <?php echo "ชื่อ"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  class="txtbox" value="<?php (isset($data[2]['member_first_name'])?print($data[2]['member_first_name']):"");?>" name="memberfirstname3">
					</div>
				</div>
				<div class="block-regis">
					<div class="detail-left-100">
						<?php echo "นามสกุล"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  class="txtbox" value="<?php (isset($data[2]['member_last_name'])?print($data[2]['member_last_name']):"");?>" name="memberlastname3">
					</div>
				</div>
				<div class="block-regis">
					<div class="detail-left-100">
						<?php echo "ชั้นปีที่กำลังศึกษาอยู่"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  class="txtbox" value="<?php (isset($data[2]['level'])?print($data[0]['level']):"");?>" name="level3">
					</div>
				</div>
				<div class="block-regis">
					<div class="detail-left-100">
						<?php echo "หมายเลขบัตรประชาชน"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  maxlength="13" class="txtbox" value="<?php (isset($data[2]['member_id'])?print($data[2]['member_id']):"");?>" name="memberid3">
					</div>
				</div>
				<div class="block-regis">
					<div class="detail-left-100">
						<?php echo "ไฟล์บัตรประชาชน"; ?>
					</div>
					<div class="detail-right">
						<div class="clearfix beforespace-10">
					<?php if((isset($data[2]['member_file_link'])?$data[2]['member_file_link']:"") != ""){?>
						<a href="uploads/<?php echo $cmd->getParam('session','teamid')?>/<?php echo $data[2]['member_file_link']?>">Download</a>
	                <?php }else{
	                ?>
	                	ยังไม่มี
	                <?php } ?>
	                    </div>
					</div>
				</div>
			</td>
			<td id="4" style="border-top-style: solid; border-top-width: 1px; border-top-color: #d7d7d7;padding-top5px;padding-bottom:10px">
				 <div class="block-regis">
					<div class="detail-left-100"></div>
					<div class="detail-right"><?php echo "สมาชิกคนที่ 4"; ?></div>
				</div>
				
				<div class="block-regis">
					<div class="detail-left-100">
					   <?php echo "คำนำหน้าชื่อ"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  class="txtbox" value="<?php (isset($data[3]['member_title'])?print($data[3]['member_title']):"");?>" name="member_title4">
					</div>
				</div>
				 
				  <div class="block-regis">
					<div class="detail-left-100">
						<?php echo "สมาชิกคนที่ 4 - ชื่อ"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  class="txtbox" value="<?php (isset($data[3]['member_first_name'])?print($data[3]['member_first_name']):"");?>" name="memberfirstname4">
					</div>
				</div>
				<div class="block-regis">
					<div class="detail-left-100">
						<?php echo "นามสกุล"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  class="txtbox" value="<?php (isset($data[3]['member_last_name'])?print($data[3]['member_last_name']):"");?>" name="memberlastname4">
					</div>
				</div>
				<div class="block-regis">
					<div class="detail-left-100">
						<?php echo "ชั้นปีที่กำลังศึกษาอยู่"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  class="txtbox" value="<?php (isset($data[3]['level'])?print($data[0]['level']):"");?>" name="level4">
					</div>
				</div>
				<div class="block-regis">
					<div class="detail-left-100">
						<?php echo "หมายเลขบัตรประชาชน"; ?>
					</div>
					<div class="detail-right">
						<input type="textbox"  maxlength="13" class="txtbox" value="<?php (isset($data[3]['member_id'])?print($data[3]['member_id']):"");?>" name="memberid4">
					</div>
				</div>
				<div class="block-regis">
					<div class="detail-left-100">
						<?php echo "ไฟล์บัตรประชาชน"; ?>
					</div>
					<div class="detail-right">
						<div class="clearfix beforespace-10">
					<?php if((isset($data[3]['member_file_link'])?$data[3]['member_file_link']:"") != ""){?>
						<a href="uploads/<?php echo $cmd->getParam('session','teamid')?>/<?php echo $data[3]['member_file_link']?>">Download</a>
	                <?php }else{
	                ?>
	                	ยังไม่มี
	                <?php
	                	}
	                ?>
	                    </div>
					</div>
				</div>
			</td>
		</tr>
		</table>
	</div>
	<!-- -->

    <div class="detail-user-info">
     	<div class="block-regis"> <!-- File-->
            <div class="detail-left-100">
                <?php echo "เอกสารรับรอง"; ?>
            </div>
            <div class="detail-right">
				<div class="clearfix beforespace-10">
				<?php if((isset($data[0]['file_link'])?$data[0]['file_link']:"") != ""){?>
					<a href="uploads/<?php echo $cmd->getParam('session','teamid')?>/<?php echo $data[0]['file_link']?>">Download</a>
	            <?php }else{
	            ?>
	            	ยังไม่มี
	            <?php
	            	}
	            ?>
            	</div>
            </div>
        </div>
     	<div class="block-regis"> <!-- Video-->
            <div class="detail-left-100">
                <?php echo "วิดีโอ"; ?>
            </div>
            <div class="detail-right">
				<div class="clearfix beforespace-10">
				<?php if((isset($data[0]['video_link'])?$data[0]['video_link']:"") != ""){?>
					<div>
		                <video style="margin-left: 20px;" controls preload="auto" src="views/UserInfo/video.php?team=<?php echo $cmd->getParam('session','teamid')?>" width="560" height="315"></video>
		            </div>
					<a href="uploads/<?php echo $cmd->getParam('session','teamid')?>/<?php echo $data[0]['video_link']?>">Download</a>
	            <?php }else{
	            ?>
	            	ยังไม่มี
	            <?php
	            	}
	            ?>
            	</div>
            </div>
        </div>
    </div>	
</form>
	<!-- Button -->
	<div class="btn-submit">
		<div class="detail-left-100"></div>
    	<div class="button-1" onclick="saveDetailData()">บันทึก </div>
	    <div class="button-1" onclick="redirect('<?php echo $cmd->getParam('session','url')?>')">ย้อนกลับ</div>
	</div>
	<input type="hidden" name="password" id="password" value="">
	<!-- -->
<?php
}
?>