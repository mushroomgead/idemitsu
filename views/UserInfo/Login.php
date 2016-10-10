<form id="form_login" autocomplete="off">
	<div class="page-register">

	    <!-- Head -->
		<div class="head_left"><img src="img/login2.png"></div>

		<!-- Detail -->
		<div class="detail-regis">
			<div class="block-regis"> <!-- Username-->
				<div class="detail-left">
					ชื่อผู้ใช้งาน
				</div>
				<div class="detail-right">
					<input type="textbox" class="txtbox required" value="" name="username" title="ชื่อผู้ใช้งาน">
				</div>
			</div>
			<div class="block-regis"> <!-- Password-->
				<div class="detail-left">
					รหัสผ่าน
				</div>
				<div class="detail-right">
					<input type="password" class="txtbox required" value="" name="password" title="รหัสผ่าน">
				</div>
			</div>
			<div class="block-regis"> <!-- Error message-->
				<div class="detail-error"></div>
			</div>
		</div>

		<!-- Button -->
		<div class="btn-submit">
			<div class="detail-left"></div>
			<div class="button-1" onclick="Login()">
				เข้าสู่ระบบ
			</div>
			<a href="/?menu=fpwd"><div class="button-1">
				ลืมรหัสผ่าน
			</div></a>
			<div class="button-1" onclick="window.location.reload()">
				ยกเลิก
			</div>
		</div>
			<BR>
	<BR>
	</div>

</form>