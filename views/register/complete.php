<div class="page-register">
    <!-- Head -->

<div style="padding:20px;margin: 20px;text-align:center;">
	<!-- Detail -->
	
<?php 
	if ($cmd->getParam('get','action')=="confirmed"){
?>
		คุณได้ทำการสมัครเรียบร้อยแล้ว
		<br>
		กรุณาล๊อคอินเพื่อเข้าสู่ระบบ <br>
	<center><a href="/?menu=user"><div class="button-1">
				เข้าสู่ระบบ
	</div></a></center>
    <?php
	}else{
?>
    คุณได้ทำการสมัครเรียบร้อยแล้ว <br>
		กรุณาล๊อกอินเพื่อเข้าสู่ระบบ  <br><br>
	<center><a href="/?menu=user"><div class="button-1">
				เข้าสู่ระบบ
	</div></a></center>
    <?php
	}
?>
  </div>
<BR>
<BR>
<BR>
</div>