
<div class= "block-header">
	<div class="head_left">
		<img src="img/logo.jpg" width="220px">
	</div>
	<div class="head_right" >
		<div class="img_right1" ><img src="img/header_right.png"></div>
	</div>
</div>

<div class="clearfix block-menu">
	<div class="container">
	  <ul class="nav nav-pills">
	    <li <?php ($cmd->getParam('get','menu')=='home')?print('class="active"'):''?>><a class="tab-menu" href="?menu=home">หน้าแรก</a></li>
	    <li <?php ($cmd->getParam('get','menu')=='project')?print('class="active"'):''?>><a class="tab-menu" href="?menu=project">รายละเอียดโครงการ</a></li>
		<li <?php ($cmd->getParam('get','menu')=='aboutus')?print('class="active"'):''?>><a class="tab-menu" href="?menu=aboutus">ติดต่อเรา</a></li>
	  
	  	<?php 
			if($cmd->getParam('session','user')==""){
		?>		
					<li <?php ($cmd->getParam('get','menu')=='register')?print('class="active"'):''?>><a class="tab-menu" href="?menu=register">ลงทะเบียนเข้าร่วมโครงการ</a></li>
					<li <?php ($cmd->getParam('get','menu')=='user')?print('class="active"'):''?>><a class="tab-menu" href="?menu=user">เข้าสู่ระบบ</a></li>
		<?php
			}else{
				if($cmd->getParam('session','admin')==true){
		?>
					<li <?php ($cmd->getParam('get','menu')=='adminsearch')?print('class="active"'):''?>><a class="tab-menu" href="?menu=adminsearch">ค้นหาทีม</a></li>
		<?php
					$cmd->setParam('session','teamid','');
					if($cmd->getParam('session','teamid')!="" || $cmd->getParam('get','teamid')!=""){
		?>
						<li <?php ($cmd->getParam('get','menu')=='teaminfo')?print('class="active"'):''?>><a class="tab-menu" href="?menu=teaminfo">ข้อมูลทีม	</a></li>
		<?php
					}
		?>
					<li><a class="tab-menu"href="?logout=true">ออกจากระบบ</a></li>
		<?php 
				}else{
		?>
					<li <?php ($cmd->getParam('get','menu')=='info1')?print('class="active"'):''?>><a class="tab-menu" href="?menu=info1">ทีม <?php echo $cmd->getParam('session','teamname')?> </a></li>
					<li <?php ($cmd->getParam('get','menu')=='info2')?print('class="active"'):''?>><a class="tab-menu" href="?menu=info2">ข้อมูลทีม	</a></li>
					<li <?php ($cmd->getParam('get','menu')=='info4')?print('class="active"'):''?>><a class="tab-menu" href="?menu=info4">ข้อมูลวีดีโอ</a></li>
					<li><a class="tab-menu"href="?logout=true">ออกจากระบบ</a></li>
		<?php 
				}
			}
		?>
	    
	  </ul>
	</div>
</div>