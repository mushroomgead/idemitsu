<?php 
    $cmd->setParam('session','url',$_SERVER['REQUEST_URI']);
    $data = getSearch($cmd->getParam('get','regdatefrom')
                , $cmd->getParam('get','regdateto')
                , $cmd->getParam('get','institutename')
                , $cmd->getParam('get','institutetype')
                , $cmd->getParam('get','teamname')
                , $cmd->getParam('get','status'));
?>
<script>
    $(document).ready(function(){
        $("#status").val('<?php echo $cmd->getParam('get','status')?>');
        $("#institutetype").val('<?php echo $cmd->getParam('get','institutetype')?>');
        $("#institutename").val('<?php echo $cmd->getParam('get','institutename')?>');
        $(".datepicker").datepicker({
            dateFormat: 'dd/mm/yy'
        });
    })
    function exportToExcel(){
        window.open('/Report/Team_report.php?'+$('form').serialize());
    }
</script>
<!-- Header -->
<div class="head-title">ค้นหาข้อมูลทีมและสมาชิก</div>
<div class="page-info">
<!-- Detail -->
    <form method="get" name="form_searchinfo" id="form_searchinfo" action="">
    <input type="hidden" name="menu" value="adminsearch">
    <div class="detail-user-info">
        <div class="block-regis"> <!-- TeamName-->
            <div class="detail-left-100">
                <?php echo "วันที่สมัคร"; ?>
            </div>
            <div class="detail-right">
                <input type="textbox" class="txtbox datepicker" value="<?php echo $cmd->getParam('get','regdatefrom')?>" name="regdatefrom">
            </div>
        </div> 
        <div class="block-regis"> <!-- TeamName-->
            <div class="detail-left-100">
                <?php echo "ถึง"; ?>
            </div>
            <div class="detail-right">
                <input type="textbox" class="txtbox datepicker" value="<?php echo $cmd->getParam('get','regdateto')?>" name="regdateto">
            </div>
        </div>

        <div class="block-regis">
            <div class="detail-left-100">สถานศึกษา</div>

            <div class="detail-right">
                <select class="selectbox long" name="institutetype" id="institutetype">
                    <option value="">เลือกทั้งหมด</option>
                    <option value="HighScool">มัธยมศึกษาหรือเทียบเท่า</option>
                    <option value="University">อุดมศึกษาหรือเทียบเท่า</option>
                </select>
            </div>
        </div>
		<div class="block-regis"> <!-- EducationName-->
            <div class="detail-left-100">
                <?php echo "ชื่อสถานศึกษา"; ?>
            </div>
            <div class="detail-right">
                <select class="selectbox long" name="institutename" id="institutename">
                    <option value="">เลือกทั้งหมด</option>
                    <?php echo getInstitute()?>
                </select>
            </div>
        </div>

        <div class="block-regis"> <!-- Status-->
            <div class="detail-left-100">
                <?php echo "สถานะ"; ?>
            </div>
            <div class="detail-right">
                <select class="selectbox long" name="status" id="status">
                    <option value="">เลือกทั้งหมด</option>
                    <option value="register">สมัครและยินยอมการเข้าใช้ระบบ</option>
                    <option value="information">กรอกข้อมูลทีมและสมาชิกครบถ้วน</option>
                    <option value="advisor">ให้อาจารย์ที่ปรึกษาเซ็นรับรอง</option>
                    <option value="video">Upload ไฟล์คลิป</option>
                </select>
            </div>
        </div>	
				<div class="block-regis"> <!-- TeamName-->
            <div class="detail-left-100">
                <?php echo "ชื่อทีม"; ?>
            </div>
            <div class="detail-right">
                <input type="textbox" class="txtbox" value="<?php echo $cmd->getParam('get','teamname')?>" name="teamname">
            </div>
        </div>
        <!-- Button -->
        <div class="btn-submit-search">
            <div class="button-1" onclick="$('form').submit();">ค้นหา</div>
            <div class="button-1" onclick="window.location.href='?menu=adminsearch'">รีเซ็ท</div>
            <div class="button-1" onclick="exportToExcel();">Export</div>
        </div>
        <!-- -->
	</div>
    </form>

    <div class="detail-user-info">
        <table class="table-search">
            <tr>
                <th class="table-head" width="100px">วันที่สมัคร</th>
                <th class="table-head" width="100px">ชื่อทีม</th>
                <th class="table-head" width="100px">ชื่อสถานศึกษา</th>
                <th class="table-head" width="100px">สถานศึกษา</th>
                <th class="table-head" width="100px">สถานะการสมัคร</th>
                <th class="table-head" width="100px">หัวหน้าทีม-ชื่อ</th>
                <th class="table-head" width="100px">นามสกุล</th>
                <th class="table-head" width="100px">เบอร์โทรศัพท์</th>
            </tr>
<?php
    $i = 0;
    if(isset($data)){
        foreach ($data as $key => $value) {
?>
             <tr>
                <td class="table-detail" width="100px"><?php echo $data[$key]['create_date']?></td>
                <td class="table-detail" width="100px"><a href="?menu=teaminfo&teamid=<?php echo $data[$key]['team_id']?>" target="_blank"><?php echo $data[$key]['team_name']?></a></td>
                <td class="table-detail" width="100px"><?php echo $data[$key]['institute_name']?></td>
                <td class="table-detail" width="100px"><?php echo $data[$key]['institute_type']?></td>
                <td class="table-detail" width="100px"><?php echo $data[$key]['status_desc']?></td>
                <td class="table-detail" width="100px"><?php echo $data[$key]['leader_first_name']?></td>
                <td class="table-detail" width="100px"><?php echo $data[$key]['leader_last_name']?></td>
                <td class="table-detail" width="100px"><?php echo $data[$key]['telephone']?></td>
            </tr> 
<?php
            $i++;
        }
    }

    if($i==0){
?>
            <tr>
                <td class="table-detail spannall" colspan="8">ไม่พบข้อมูล</td>
            </tr>
<?php
    }
?>
        </table>
    </div>
</div>
<!-- -->