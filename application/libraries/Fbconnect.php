<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once("fb_client/facebook.php");

class Fbconnect extends Facebook{
//            skilljoy facebook app
//            app id: 718847451488799
//            app secret: 26350cd534e6725f1c1d62ad1d30376a
	public function __construct(){
		$ci =& get_instance();
		$config = array('appId' => '718847451488799',
			'secret' => '26350cd534e6725f1c1d62ad1d30376a');
		
		parent::__construct($config);
	}
	
	
	
	public function sendback($val){
		return strtoupper($val);
	}
	
}
