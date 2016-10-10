<?php $data = getHeader();?>
<div class="head-title">ข้อมูลคลิปวิดิโอ</div>
<div class="page-info">
    <form method="post" name="uploadvid" id="uploadvid" action="database/upload.php?action=uploadvideo" enctype="multipart/form-data">
    <div class="detail-user-info">
            <div class="block-regis"> <!-- Videoname-->
                <div class="detail-left-100">
                    <?php echo "ชื่อคลิปวีดีโอ"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php echo $data['video_name']?>" name="media_name">
                </div>
            </div>
            <div class="block-regis"> <!-- Videodescription-->
                <div class="detail-left-100">
                    <?php echo "คำบรรยายคลิปวีดีโอ"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php echo $data['video_description']?>" name="media_desc">
                </div>
            </div>
    <?php if($data['video_link']!=""){    ?>
            <div class="line_hr"></div>
            <div>
                <video style="margin-left: 20px;" controls preload="auto" src="views/UserInfo/video.php?team=<?php echo $cmd->getParam('session','teamid')?>" width="560" height="315"></video>
            </div>
            <div class="line_hr"></div>
    <?php } ?>
            <div class="block-regis"> <!-- Videodescription-->
                <div class="detail-left-100">
                    <?php echo "Upload คลิปวิดีโอ"; ?>
                </div>
                <div class="detail-left-300">
                    <div class="clearfix beforespace-10">
                        <input type="file" class="fileupload" value="" name="file">
                    </div>
                    <input type="hidden" name="teamid" id="teamid" value="<?php echo $cmd->getParam('session','teamid')?>">
                </div>
            </div>

            <!--<div class="block-regis">
                <div class="detail-left-100">
                    <?php echo "ความยาวโดยประมาณ"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="" name="media_time">
                </div>
            </div>
			<div class="block-regis">
                <div class="detail-left-100">
                    <?php echo "ชื่อไฟล์"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="" name="media_file_name">
                </div>
            </div>-->
        <!-- -->
	</div>
	  <!-- Button -->
	<div class="btn-submit">
	<div class="detail-left-100"></div>
		<div class="button-1" onclick="$('form').submit();">บันทึก </div>
		<div class="button-1" onclick="window.location.reload()">ยกเลิก</div>
	</div>
    </form>
</div>
<BR>
<BR>
