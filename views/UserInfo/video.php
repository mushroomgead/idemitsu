<?php
    require_once('../../database/Command.php');
	$cmd = new Command();
    require_once('../../database/VideoStream.php');
    $videostream = new VideoStream('../../uploads/'.$cmd->getParam('get','team').'/videoProject.mp4');
    $videostream->start();
	exit;
?>