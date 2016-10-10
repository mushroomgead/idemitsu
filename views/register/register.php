<form id="form_register" autocomplete="off">
	<div class="page-register">

	    <!-- Head -->
		<div class="head_left"><img src="img/register.png"></div>
		<!-- Detail -->
		<div class="detail-regis">
			<div class="block-regis"> <!-- TeamName-->
				<div class="detail-left">
					ชื่อทีม
				</div>
				<div class="detail-right required">
					<input type="textbox" class="txtbox required" value="" name="teamname" title="ชื่อทีม">กรุณาตั้งชื่อเป็นตัวอักษรหรือตัวเลขเท่านั้น
				</div>
			</div>
			<div class="block-regis"> <!-- InstituteName-->
				<div class="detail-left">
					ชื่อสถานศึกษา
				</div>
				<div class="detail-right required">
					<input type="textbox" class="txtbox required" value="" name="institutename" title="ชื่อสถานศึกษา">
				</div>
			</div>
			<div class="block-regis">
				<div class="detail-left">สถานศึกษา</div>
				<div class="detail-right required">
					<div class="radio-box ">
						<input type="radio" class="radiobtn" name="institutetype" value="HighScool" checked>มัธยมศึกษาหรือเทียบเท่า
					</div>
					<div class="radio-box">
						<input type="radio" class="radiobtn" name="institutetype" value="University">อุดมศึกษาหรือเทียบเท่า
					</div>
				</div>
			</div>
			<div class="block-regis"> <!-- FirstName-->
				<div class="detail-left">
					คำนำหน้าชื่อ (นาย/นาง/นางสาว)
				</div>
				<div class="detail-right required">
					<input type="textbox"  class="txtbox required" value="" name="leader_title" title="คำนำหน้าชื่อ">
					
				</div>
			</div>
			<div class="block-regis"> <!-- FirstName-->
				<div class="detail-left">
					ชื่อ
				</div>
				<div class="detail-right required">
					<input type="textbox"  class="txtbox required" value="" name="leaderfirstname" title="ชื่อ">
					(หัวหน้าทีม)
				</div>
			</div>
			<div class="block-regis"> <!-- LastName-->
				<div class="detail-left">
					นามสกุล
				</div>
				<div class="detail-right required">
					<input type="textbox"  class="txtbox required" value="" name="leaderlastname" title="นามสกุล">
				</div>
			</div>
			<div class="block-regis"> <!-- IDCard-->
				<div class="detail-left">
					หมายเลขบัตรประชาชน
				</div>
				<div class="detail-right required">
					<input type="textbox" maxlength="13"  class="txtbox required" value="" name="leaderid" title="หมายเลขบัตรประชาชน">
				</div>
			</div>
			<div class="block-regis"> <!-- EMail-->
				<div class="detail-left">
					อีเมล์
				</div>
				<div class="detail-right required">
					<input type="textbox"  class="txtbox required" value="" name="leaderemail" title="อีเมล์">ไม่แนะนำให้ใช้ gmail.com
				</div>
			</div>
			<div class="block-regis"> <!-- Tel-->
				<div class="detail-left">
					เบอร์โทรศัพท์ที่ติดต่อได้
				</div>
				<div class="detail-right required">
					<input type="textbox"  class="txtbox required" value="" name="telephone" title="เบอร์โทรศัพท์ที่ติดต่อได้">
				</div>
			</div>
			<div class="block-regis"> <!-- UserName-->
				<div class="detail-left">
					กำหนดชื่อผู้ใช้
				</div>
				<div class="detail-right required">
					<input type="textbox"  class="txtbox required" value="" name="username" title="กำหนดชื่อผู้ใช้">
				</div>
			</div>
			<div class="block-regis"> <!-- Password-->
				<div class="detail-left">
					กำหนดรหัสผ่าน
				</div>
				<div class="detail-right required">
					<input type="password"  class="txtbox required" value="" name="password" title="กำหนดรหัสผ่าน">
				</div>
			</div>
			<div class="block-regis"> <!-- RePassword-->
				<div class="detail-left">
					กำหนดรหัสผ่านอีกครั้ง
				</div>
				<div class="detail-right required">
					<input type="password"  class="txtbox required" value="" name="confirmpassword" title="กำหนดรหัสผ่านอีกครั้ง">
				</div>
			</div>
			<div class="block-captcha"> <!-- Confirm Captcha-->
				<div class="detail-left">
					Verify bot
				</div>
				<div class="detail-object-right">
					<input type="text" class="small-txtbox required" name="captcha" id="captcha" maxlength="6" size="6" title="Verify bot">
				</div>
				<div class="verify-image required">
					<img src="../include/captcha/captcha.php"/>
				</div>
			</div>
		</div>

		<!-- Button -->
		<div class="btn-submit">
			<div class="detail-left"></div>
			<div class="button-1" onclick="saveData()">
				บันทึก
			</div>
			<div class="button-1" onclick="window.location.reload()">
				ยกเลิก
			</div>
		</div>
	</div>
</form>