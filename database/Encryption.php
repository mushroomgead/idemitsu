<?php

class Encryption{

	private $key;
	private $mode;
	private $string;

	public function __construct($string, $mode){
		$this->key = 'mRNf1QS+ML19eSFPBLqRdX/x';
		$this->mode = $mode;
		$this->string = $string;
	}

	public function endecrypt(){
		if($this->mode=="en"){
			return $this->encrypt();
		}else{
			return $this->decrypt();
		}
	}

	public function encrypt(){
		$iv = mcrypt_create_iv(
		    mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC),
		    MCRYPT_DEV_URANDOM
		);

		$encrypted = base64_encode(
		    $iv .
		    mcrypt_encrypt(
		        MCRYPT_RIJNDAEL_128,
		        hash('sha256', $this->key, true),
		        $this->string,
		        MCRYPT_MODE_CBC,
		        $iv
		    )
		);

		return $encrypted;
	}

	public function decrypt(){
		$data = base64_decode($this->string);
		$iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

		$decrypted = rtrim(
		    mcrypt_decrypt(
		        MCRYPT_RIJNDAEL_128,
		        hash('sha256', $this->key, true),
		        substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)),
		        MCRYPT_MODE_CBC,
		        $iv
		    ),
		    "\0"
		);

		return $decrypted;
	}
}

?>