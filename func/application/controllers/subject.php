<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//科目表
//只有网站管理员才能对科目进行增加、修改和删除
class Subject extends MY_Controller{
	function Subject(){
		parent::__construct();
	}

	function list_subject(){
		$this->load->model('subject_model');
		$query=$this->subject_model->list_subject();
	
		if($query){
			foreach ($query->result() as $row){
				$item=array(
					'sID'=>$row->sID,
					'sTitle'=>$row->sTitle
				);
				$this->data[]=$item;
			}
				
			$this->success = true;
			$this->message = '读取科目列表成功';
		}else{
			$this->message = '读取科目列表失败';
		}
		echo $this->to_json();
	}
	
	function add_subject(){
		/*
		if ($uIdentify!=WEB_ADMIN){
			echo "您没有操作权限！";
			exit();
		}
		*/
		$this->get_request();
	
		$sTitle=$this->params->sTitle;
	
		$this->load->model('subject_model');
		$this->subject_model->sTitle=$sTitle;
		$query=$this->subject_model->add_subject();
	
		if($query){
			/*
			$sID = $this->db->insert_id();
			$lUserID=$uID;
			$this->load->model('logbook_model');
			$this->logbook_model->add_logbook($lUserID,'新建科目,ID='.$sID);
			*/
				
			$this->data =array(
					'sID'  =>$sID,
					'sTitle'=>$sTitle
			);
			$this->success = true;
			$this->message = '科目添加成功！';
		}else{
			$this->message = '科目添加失败!';
		}
		echo $this->to_json();
	
	}
	
	function edit_subject(){
		
		/*
		if ($this->session->userdata('uIdentify')!=WEB_ADMIN){
		echo "您没有操作权限！";
		exit();
		}
		*/
		$this->get_request();
		$sID=$this->params->sID;
		$sTitle=$this->params->sTitle;
	
		$this->load->model('subject_model');
		$this->school_model->sID=$sID;
		$this->school_model->sTitle=$sTitle;
	
		$query=$this->subject_model->edit_subject();
	
		if($query){
			/*
			$lUserID=$uID;
			$this->load->model('logbook_model');
			$this->logbook_model->add_logbook($lUserID,'更新科目、ID='.$sID);
			*/
			$this->success = true;
			$this->message = '修改成功！';
		}else{
			$this->message = '修改失败！';
		}
	
		echo $this->to_json();
	}
	
	
	function del_subject(){
	
		/* if ($this->session->userdata('uIdentify')!=WEB_ADMIN){
		 echo "您没有操作权限！";
		exit();
		}
		*/
	
		$this->get_request();
	
		$sID=$this->params->sID;
	
		$this->load->model('subject_model');
		$this->subject_model->sID=$sID;
		$query=$this->subject_model->del_subject();
	
		if($query){
			/*
			$lUserID=$uID;
			$this->load->model('logbook_model');
			$this->logbook_model->add_logbook($lUserID,'删除科目、ID='.$sID);
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