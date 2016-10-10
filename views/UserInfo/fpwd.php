<form id="form_fpwd" autocomplete="off">
	<div class="page-register">

	    <!-- Head -->
		<div class="head-title">ขอรหัสผ่าน</div>

		<!-- Detail -->
		<div class="detail-regis">
			<div class="block-regis"> <!-- Username-->
				<div class="detail-left">
					อีเมล์ที่ลงทะเบียนไว้
				</div>
				<div class="detail-right">
					<input type="textbox" class="txtbox required" value="" name="email" title="อีเมล์">
				</div>
			</div>
			<div class="detail-left">
					รหัสบัตรประชาชน
				</div>
				<div class="detail-right">
					<input type="textbox" class="txtbox required" value="" name="IDNO" title="รหัสบัตรประชาชน">
				</div>
			</div>
			<div class="block-regis"> <!-- Error message-->
				<div class="detail-error"></div>
			</div>
		</div>

		<!-- Button -->
		<div class="btn-submit">
			<div class="detail-left"></div>
			<div class="button-1" onclick="SendPwd()">
				ขอรหัสผ่าน
			</div>
			<div class="button-1" onclick="location.href='/?menu=user'">
				ยกเลิก
			</div>
		</div>
			<BR>
	<BR>
	</div>

</form>