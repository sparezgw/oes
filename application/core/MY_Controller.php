<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller{
	public $success,$message,$data,$params;
	
	function MY_Controller(){
		parent::__construct();
		
		$this->success = false;
		$this->message = '';
		$this->data    = array();
		$this->params  = array();
		
// 		$this->is_logined();
	}
	
	//检测是否存在登入session。如果有，返回用户ID和权限ID。如果没有，返回登入。
	function is_logined() {
		if (!$this->session->userdata('userin')){
// 			redirect('home/login');
			$this->message = '登录失败，请重新登录！';
			echo $this->to_json();
			exit();
		}
	}
	
	function get_identify() {
		echo json_encode(array(
			'id' => $this->session->userdata('uID'),
			'identify' => $this->session->userdata('uIdentify'),
			'name' => $this->session->userdata('uTruename')
		));
	}
	
	function get_request(){
// 		$raw='';
// 		$httpContent=fopen('php://input','r');
// 		while($kb=fread($httpContent, 1024)){
// 			$raw.=$kb;
// 		}
// 		$this->params=json_decode(stripslashes($raw));
		$this->params=json_decode($raw);
		$raw=file_get_contents('php://input','r');
	}
	
	function to_json(){
		return json_encode(array(
				'success' => $this->success,
				'message' => $this->message,
				'data'    => $this->data
		));
	}
	
	
}

?>