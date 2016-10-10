<?php $data = getDetail();?>
    <div class="page-info">
    <!-- Header -->
        <div class="clearfix head-title">
            <div class="detail-left"></div>
            <div class="detail-right font-info">ข้อมูลสมาชิก</div>
        </div>
    <!-- -->
    <!-- Detail -->
        <div class="detail-info">
            <div class="block-regis">
                <div class="head-txt">
                    <?php echo "หัวหน้าทีม"; ?>
                </div>
                <div class="detail-left">
                    <?php echo "ชื่อ"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php (isset($data[0]['leader_first_name'])?print($data[0]['leader_first_name']):"");?>" name="leaderfirstname">
                </div>
                <div class="detail-left">
                    <?php echo "นามสกุล"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php (isset($data[0]['leader_last_name'])?print($data[0]['leader_last_name']):"");?>" name="leaderlastname">
                </div>
                <div class="detail-left">
                    <?php echo "หมายเลขบัตรประชาชน"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php (isset($data[0]['leader_id'])?print($data[0]['leader_id']):"");?>" name="leaderid">
                </div>
            </div>
            <div class="block-regis">
                <div class="head-txt">
                    <?php echo "สมาชิกคนที่ 1"; ?>
                </div>
                <div class="detail-left">
                    <?php echo "ชื่อ"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php (isset($data[0]['member_first_name'])?print($data[0]['member_first_name']):"");?>" name="memberfirstname1">
                </div>
                <div class="detail-left">
                    <?php echo "นามสกุล"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php (isset($data[0]['member_last_name'])?print($data[0]['member_last_name']):"");?>" name="memberlastname1">
                </div>
                <div class="detail-left">
                    <?php echo "หมายเลขบัตรประชาชน"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php (isset($data[0]['member_id'])?print($data[0]['member_id']):"");?>" name="memberid1">
                </div>
            </div>
            <div class="block-regis">
                <div class="head-txt">
                    <?php echo "สมาชิกคนที่ 2"; ?>
                </div>
                <div class="detail-left">
                    <?php echo "ชื่อ"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php (isset($data[1]['member_first_name'])?print($data[1]['member_first_name']):"");?>" name="memberfirstname2">
                </div>
                <div class="detail-left">
                    <?php echo "นามสกุล"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php (isset($data[1]['member_last_name'])?print($data[1]['member_last_name']):"");?>" name="memberlastname2">
                </div>
                <div class="detail-left">
                    <?php echo "หมายเลขบัตรประชาชน"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php (isset($data[1]['member_id'])?print($data[1]['member_id']):"");?>" name="memberid2">
                </div>
            </div>
            <div class="block-regis">
                <div class="head-txt">
                    <?php echo "สมาชิกคนที่ 3"; ?>
                </div>
                <div class="detail-left">
                    <?php echo "ชื่อ"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php (isset($data[2]['member_first_name'])?print($data[2]['member_first_name']):"");?>" name="memberfirstname3">
                </div>
                <div class="detail-left">
                    <?php echo "นามสกุล"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php (isset($data[2]['member_last_name'])?print($data[2]['member_last_name']):"");?>" name="memberlastname3">
                </div>
                <div class="detail-left">
                    <?php echo "หมายเลขบัตรประชาชน"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php (isset($data[2]['member_id'])?print($data[2]['member_id']):"");?>" name="memberid3">
                </div>
            </div>
            <div class="block-regis">
                <div class="head-txt">
                    <?php echo "สมาชิกคนที่ 4"; ?>
                </div>
                <div class="detail-left">
                    <?php echo "ชื่อ"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php (isset($data[3]['member_first_name'])?print($data[3]['member_first_name']):"");?>" name="memberfirstname4">
                </div>
                <div class="detail-left">
                    <?php echo "นามสกุล"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php (isset($data[3]['member_last_name'])?print($data[3]['member_last_name']):"");?>" name="memberlastname4">
                </div>
                <div class="detail-left">
                    <?php echo "หมายเลขบัตรประชาชน"; ?>
                </div>
                <div class="detail-right">
                    <input type="textbox" class="txtbox" value="<?php (isset($data[3]['member_id'])?print($data[3]['member_id']):"");?>" name="memberid4">
                </div>
            </div>
        </div>
    <!-- -->
        <!-- Button -->
        <div class="btn-submit">
        <div class="detail-left"></div>
            <div class="button-1" onclick="saveDetailData()">
                บันทึก
            </div>
            <div class="btn-submit" >
                <div class="button-1">
                    ยกเลิก
                </div>
            </div>
        </div>
        <!-- -->
    </div>