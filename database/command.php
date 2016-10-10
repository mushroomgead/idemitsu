<?php

class Command{

	public function getParam($type, $name){
		if(strtolower($type)=="get"){
			return (isset($_GET[$name]))?trim($_GET[$name]):'';
		}else if(strtolower($type)=="post"){
			return (isset($_POST[$name]))?trim($_POST[$name]):'';
		}else if(strtolower($type)=="session"){
			return (isset($_SESSION[$name]))?trim($_SESSION[$name]):'';
		}
	}

	public function setParam($type, $name, $value){
		if(strtolower($type)=="get"){
			$_GET[$name] = $value;
		}else if(strtolower($type)=="post"){
			$_POST[$name] = $value;
		}else if(strtolower($type)=="session"){
			$_SESSION[$name] = $value;
		}
	}

	public function checkID($id){
		if(strlen($id) != 13){
			return false;
		}
	    for($i=0, $sum=0; $i<12;$i++){
	        $sum += (int)($id{$i})*(13-$i);
	    }
	    if((11-($sum%11))%10 == (int)($id{12})){
	        return true;
	    }else{
	    	return false;
	    }
	}

}

?>