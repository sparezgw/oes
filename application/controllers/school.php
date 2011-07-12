<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//学校
//0:网站管理员；1:学生；2:普通教师；3:学校管理员
//只有网站管理员才能对学校进行增加、修改和删除
class School extends CI_Controller{
	public $success,$message,$data,$params;
	
	function School(){
		parent::__construct();
		
		/* 
		if (!$this->session->userdata('userin')){
			redirect('home/login');
			exit();
		}
		$uID=$this->session->userdata('uID');
		$uIdentify=$this->session->userdata('uIDentify');
		 */
		
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
		
	function list_school(){
		$this->load->model('school_model');
		$query=$this->school_model->list_school();
		
		if($query){
			foreach ($query->result() as $row){
				$item=array(
					'sID'=>$row->sID,
					'sName'=>$row->sName
				);
				$this->data[]=$item;
			}
			
			$this->success = true;
			$this->message = '读取学校列表成功';
		}else{
			$this->message = '读取学校列表失败';	
		}
		echo $this->to_json();
	}
	
	
	function add_school(){
		/* 
		if ($uIdentify!=WEB_ADMIN){
			echo "您没有操作权限！";
			exit();
		}
		 */
		$this->get_request();
		
		$sName=$this->params->sName;
		
		$this->load-model('school_mdoel')=$sName;
		$query=$this->school_model->add_school();
		
		if($query){
			/* 
			$sID = $this->db->insert_id();
			$lUserID=$uID;
			$this->load->model('logbook_model');
			$this->logbook_model->add_logbook($lUserID,'新建学校,ID='.$sID);
			 */
			
			$this->data =array(
				'sID'  =>$sID,
				'sName'=>$sName
			);
			$this->success = true;
			$this->message = '学校添加成功！';
		}else{
			$this->message = '学校添加失败!';
		}
		echo $this->to_json();	
		
	}
	
	
	function edit_school(){
		/* 
		if ($this->session->userdata('uIdentify')!=WEB_ADMIN){
			echo "您没有操作权限！";
			exit();
		}
		 */
		$this->get_request();
		$sID=$this->params->sID;
		$sName=$this->params->sName;
		
		$this->load->model('school_model');
		$this->school_model->sID=$sID;
		$this->school_model->sName=$sName;
		
		$query=$this->school_model->edit_school();
		
		if($query){
			/* 
			$lUserID=$uID;
			$this->load->model('logbook_model');
			$this->logbook_model->add_logbook($lUserID,'更新学校、ID='.$sID);
			 */
			$this->success = true;
			$this->message = '修改成功！';
		}else{
			$this->message = '修改失败！';
		}
		
		echo $this->to_json();
	}
	
	function del_school(){
		
		/* if ($this->session->userdata('uIdentify')!=WEB_ADMIN){
			echo "您没有操作权限！";
			exit();
		}
		 */
		
		$this->get_request();
		
		$sID=$this->params->sID;
		
		$this->load->model('school_model');
		$this->load->school_model->sID=$sID;
		$query=$this->school_model->del_school();
		
		if($query){
			/* 
			$lUserID=$uID;
			$this->load->model('logbook_model');
			$this->logbook_model->add_logbook($lUserID,'删除学校、ID='.$sID);
			 */	
			$this->success = true;
			$this->message = '删除成功！';
		}else{
			$this->message = '删除失败！';
		}
		
		echo $this->to_json();
	}
}

?>