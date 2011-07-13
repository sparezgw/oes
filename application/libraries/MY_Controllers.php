<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller{
	public $success,$message,$data,$params;
	
	function MY_Controller(){
		parent::__construct();
		
		//检测是否存在登入session。如果有，返回用户ID和权限ID。如果没有，返回登入。
		if (!$this->session->userdata('userin')){
			redirect('home/login');
			exit();
		}
		$uID=$this->session->userdata('uID');
		$uIdentify=$this->session->userdata('uIDentify');
				
		$this->success = false;
		$this->message = '';
		$this->data    = array();
		$this->params  = array();
	}
	
	function get_request(){
		$raw='';
		$httpContent=fopen('php://input','r');
		while($kb=fread($htpContent, 1024)){
			$raw.=$kb;
		}
		$this->params=json_decode(stripslashes($raw));
	}
	
	function to_json(){
		return json_encode(array(
				'success' => $this->success,
				'message' => $this->message,
				'data'    => $this->data
		));
	}
	
	function add_tag($tags){
		//分隔成单个标签
		$tName=explode(" ", $tags);
		//计算标签个数
		$num=count($tName);
		
		$flag=true;
		$tagsID=array();
		
		$this->load->model('tag_model');
		$this->tag_model->tUserID=$uID;
		
		for($i=0;$i<$num;$i++){
			$this->tag_model->tName=$tName[$i];
			
			$tag_id=$this->tag_model->check_tag($tUserID,$tName[$i]);
			
			if(empty($tag_id)){
				//此用户的此标签不存在,添加该标签.
				$query=$this->tag_model->add_tag();
				if($query){
					$tID = $this->db->insert_id();
					array_push($tagsID,$tID);
				}else{
					$flag=false;
				}
			}else{
				//此用户的此标签已经存在,返回该标签ID
				$this->load->model('tag_model');
				array_push($tagsID,$tag_id);				
			}
		}
		
		if($flag==false){
			return false;
		}else{
			return $tagsID;
		}
		
	}
	
	function add_tags_one(){
		
	}
	
	
	
}

?>