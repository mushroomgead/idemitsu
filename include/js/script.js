function saveData(){
	if(requiredValidate()){
		$.ajax({
			type: 'post',
			url: '../database/service.php?action=registeration',
			data: $("form#form_register").serialize(),
			success: function(msg){
				if(msg=="Success"){
					alert("บันทึกเรียบร้อย");
					window.location.href ="?menu=register&action=complete";
				}else if(msg=="CAPTCHA_NOT_MATCHED"){
					alert("กรุณายืนยัน Varify bot อีกครั้ง");
					$("#captcha").focus();
					$("#captcha").addClass("required-focus");
				}else if(msg=="PASSWORD_NOT_MATCHED"){
					alert("รหัสผ่านไม่ตรงกัน กรุณาใส่รหัสผ่านอีกครั้ง");
					$("[name=password]").focus();
					$("[name=password]").addClass("required-focus");
					$("[name=confirmpassword]").addClass("required-focus");
				}else if(msg=="TEAM_EXISTS"){
					alert("ชื่อทีมนี้ไม่สามารถใช้ได้ เนื่องจากมีผู้ใช้ชื่อนี้แล้ว");
					$("[name=teamname]").val("");
					$("[name=teamname]").focus();
					$("[name=teamname]").addClass("required-focus");
				}else if(msg=="USER_EXISTS"){
					alert("ชื่อผู้ใช้งานไม่สามารถใช้ได้ เนื่องจากมีผู้ใช้ชื่อนี้แล้ว");
					$("[name=username]").val("");
					$("[name=username]").focus();
					$("[name=username]").addClass("required-focus");
				}else if(msg=="ID_EXISTS"){
					alert("หมายเลขบัตรประชาชนนี้ไม่สามารถใช้ได้ เนื่องจากได้ถูกใช้ไปแล้ว");
					$("[name=leaderid]").val("");
					$("[name=leaderid]").focus();
					$("[name=leaderid]").addClass("required-focus");
				}else if(msg=="WRONG_ID_FORMAT"){
					alert("หมายเลขบัตรประชาชนผิด กรุณาใส่อีกครั้ง");
					$("[name=leaderid]").val("");
					$("[name=leaderid]").focus();
					$("[name=leaderid]").addClass("required-focus");
				}else if(msg=="PASSWORD_LENGTH"){
					alert("กรุณากำหนดรหัสผ่านตั้งแต่ 6 ตัวอักษรขึ้นไป");
				}else{
					//alert(msg);
					alert("เกิดปัญหาในการใช้งาน กรุณาแจ้งผู้ดูแลระบบ");
				}
				$(".verify-image").html('<img src="../include/captcha/captcha.php"/>');
				$("#captcha").val("");
				$("[name=password]").val("");
				$("[name=confirmpassword]").val("");
			}
		});
	}
}

function Login(){
	if(requiredValidate()){
		$.ajax({
			type: 'post',
			url: '../database/service.php?action=login',
			data: $("form#form_login").serialize(),
			success: function(msg){
				if(msg=="Success"){
					window.location.reload();
				}else if(msg=="USER_NOT_FOUND" || msg=="WRONG_PASSWORD"){
					$(".detail-error").html("ชื่อผู้ใช้งานหรือรหัสผ่านผิดพลาด");
				}else if(msg=="NOT_CONFIRMED"){
					$(".detail-error").html("ชื่อผู้ใช้งานนี้ยังไม่ได้ยืนยัน กรุณายืนยันตัวตนใน email ที่ลงทะเบียน  <div onclick='ReSendActivate()'> [ส่งอีเมล์การยืนยันไปที่อีเมล์อีกครั้ง]</div>");
				}else{
					alert("เกิดปัญหาในการใช้งาน กรุณาแจ้งผู้ดูแลระบบ");
				}
			}
		});
	}
}

function ReSendActivate(){
	if(requiredValidate()){
		$.ajax({
			type: 'post',
			url: '../database/service.php?action=resend',
			data: $("form#form_login").serialize(),
			success: function(msg){
				if(msg=="Success"){
					$(".detail-error").html("ส่งการ activate ไปที่อีเมล์เรียบร้อยแล้ว กรุณาตรวจสอบอีเมล์และทำการ activate");
				}else if(msg=="USER_NOT_FOUND" || msg=="WRONG_PASSWORD"){
					$(".detail-error").html("รหัสผู้ใช้ไม่ถูกต้อง");
				}else{
					// alert(msg);
					alert("เกิดปัญหาในการใช้งาน กรุณาแจ้งผู้ดูแลระบบ");
				}
			}
		});
	}
}

function SendPwd(){
	if(requiredValidate()){
		$.ajax({
			type: 'post',
			url: '../database/service.php?action=fpwd',
			data: $("form#form_fpwd").serialize(),
			success: function(msg){
				if(msg=="Success"){
					$(".detail-error").html("ชื่อผู้ใช้งานและรหัสผ่าน ได้ส่งไปทางอีเมล์เรียบร้อยแล้ว");
				}else if(msg=="USER_NOT_FOUND" || msg=="WRONG_PASSWORD"){
					$(".detail-error").html("อีเมล์/บัตรประชาชน ไม่ถูกต้อง");
				}else if(msg=="NOT_CONFIRMED"){
					$(".detail-error").html("ชื่อผู้ใช้งานนี้ยังไม่ได้ยืนยัน กรุณายืนยันตัวตนใน email ที่ลงทะเบียน");
				}else{
					//alert(msg);
					$(".detail-error").html(msg);
					//alert("เกิดปัญหาในการใช้งาน กรุณาแจ้งผู้ดูแลระบบ");
				}
			}
		});
	}
}

function saveDetailData(){
	if(requiredValidate()){
		var formData = new FormData($("form#form_userinfo")[0]);
		$.ajax({
			type: 'post',
			url: '../database/service.php?action=updatedetail',
			data: formData,
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			success: function(msg){
				if(msg=="Success"){
					$.ajax({
						type: 'post',
						url: '../database/upload.php?action=uploaddetail',
						data: formData,
						enctype: 'multipart/form-data',
						processData: false,
						contentType: false,
						success: function(msg){
							if(msg=="Success"){
								alert("บันทึกเรียบร้อย");
								window.location.reload();
							}else if(msg.substring(0,13)=="CANNOT_UPLOAD"){
								alert("ไม่สามารถ Upload ไฟล์ได้");
								var fileseq = msg.substring(13,14);
								$("[name=file"+fileseq+"]").val("");
								$("[name=file"+fileseq+"]").focus();
								$("[name=file"+fileseq+"]").addClass("required-focus");
							}
						}
					});
				}else if(msg=="OLD_PASSWORD"){
					alert("กรุณาใส่รหัสผ่านเก่า");
				}else if(msg=="PASSWORD_LENGTH"){
					alert("กรุณากำหนดรหัสผ่านตั้งแต่ 6 ตัวอักษรขึ้นไป");
				}else if(msg=="SAME_PREVIOUS"){
					alert("รหัสผ่านใหม่ ต้องไม่ซ้ำกับรหัสผ่านเดิม");
				}else if(msg=="PASSWORD_NOT_MATCHED"){
					alert("รหัสผ่านไม่ตรงกัน กรุณาใส่รหัสผ่านอีกครั้ง");
				}else if(msg.substring(0,9)=="ID_EXISTS"){
					alert("หมายเลขบัตรประชาชนนี้ไม่สามารถใช้ได้ เนื่องจากได้ถูกใช้ไปแล้ว");
					var memberseq = msg.substring(9,10);
					if(memberseq!=""){
						$("[name=memberid"+memberseq+"]").val("");
						$("[name=memberid"+memberseq+"]").focus();
						$("[name=memberid"+memberseq+"]").addClass("required-focus");
					}else{
						$("[name=leaderid]").val("");
						$("[name=leaderid]").focus();
						$("[name=leaderid]").addClass("required-focus");
					}
				}else if(msg.substring(0,15)=="WRONG_ID_FORMAT"){
					alert("หมายเลขบัตรประชาชนผิด กรุณาใส่อีกครั้ง");
					var memberseq = msg.substring(15,16);
					if(memberseq!=""){
						$("[name=memberid"+memberseq+"]").val("");
						$("[name=memberid"+memberseq+"]").focus();
						$("[name=memberid"+memberseq+"]").addClass("required-focus");
					}else{
						$("[name=leaderid]").val("");
						$("[name=leaderid]").focus();
						$("[name=leaderid]").addClass("required-focus");
					}
				}else if(msg=="MEMBER_NO"){
					alert("กรุณาระบุ จำนวนสมาชิก");
				}else{
					 alert(msg);
					alert("เกิดปัญหาในการใช้งาน กรุณาแจ้งผู้ดูแลระบบ");
				}
				$("[name=oldpassword]").val("");
				$("[name=password]").val("");
				$("[name=confirmpassword]").val("");
			}
		});
	}
}

function requiredValidate(){
	var errorflag = "N";
	$("input.required, select.required").each(function(){
		if(($(this).val()).trim()==""){
			var title = $(this).attr("title");
			$(this).addClass("required-focus");
			if(errorflag == "N"){
				$(this).focus();
			}
			errorflag = "Y";
		}else{
			$(this).removeClass("required-focus");
		}
	});
	if(errorflag == "Y"){
		alert("กรุณาใส่ข้อมูลให้ครบถ้วน");
		return false;
	}else{
		return true;
	}
}

function hideShowMember(value){
	$(".userinfotable td").each(function(){
		if(parseInt($(this).attr('id')) > value){
			$(this).hide();
		}else{
			$(this).show();
		}
	})
}

function redirect(url){
	window.location.href = url;
}