<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//公告
//0:网站管理员；1:学生；2:普通教师；3:学校管理员
//网站管理员、学校管理员能对学校进行增加、修改和删除

class Notice extends MY_Controller{
	
	function Notice(){
		parent::__construct();
		
	}
	
	function list_notice(){
		$this->load->model('notice_model');
		$query=$this->notice_model->list_notice();
	
		if($query){
			foreach ($query->result() as $row){
				$item=array(
						'nID'=>$row->nID,
						'nTitle'=>$row->nTitle,
						'nBody'=>$row->nBody,
						'nTitle'=>$row->nTitle,
						'nSchoolID'=>$row->nSchoolID,
				);
				$this->data[]=$item;
			}
				
			$this->success = true;
			$this->message = '读取公告列表成功';
		}else{
			$this->message = '读取公告列表失败';
		}
		echo $this->to_json();
	}
	
	
	function add_notice(){
		$this->get_request();
	
		$nSchoolID=$this->params->nSchoolID;
		$nTitle=$this->params->nTitle;
		$nBody=$this->params->nBody;
	
		$this->load->model('school_model');
		
		$this->notice_model->nSchoolID=$nSchoolID;
		$this->notice_model->nTitle=$nTitle;
		$this->notice_model->nBody=$nBody;
		$query=$this->school_model->add_school();
	
		if($query){
				
			$nID = $this->db->insert_id();
						
			$this->data =array(
					'nID'  =>$nID,
					
			);
			$this->success = true;
			$this->message = '发布公告成功！';
		}else{
			$this->message = '发布公告失败!';
		}
		echo $this->to_json();
	
	}
	
	function del_notice(){
		$this->get_request();
	
		$nID=$this->params->nID;
	
		$this->load->model('notice_model');
		$this->notice_model->nID=$nID;
		
		$query=$this->notice_model->del_notice();
	
		if($query){
			$this->success = true;
			$this->message = '删除公告成功！';
		}else{
			$this->message = '删除公告失败！';
		}
	
		echo $this->to_json();
	}
	
	
	function edit_notice(){
		$this->get_request();
		
		$nID=$this->params->nID;
		$nSchoolID=$this->params->nSchoolID;
		$nTitle=$this->params->nTitle;
		$nBody=$this->params->nBody;
	
		$this->load->model('notice_model');
		
		$this->notice_model->nID=$nID;
		$this->notice_model->nSchoolID=$nSchoolID;
		$this->notice_model->nTitle=$nTitle;
		$this->notice_model->nBody=$nBody;
	
		$query=$this->notice_model->edit_notice();
	
		if($query){
			$this->success = true;
			$this->message = '修改公告成功！';
		}else{
			$this->message = '修改公告失败！';
		}
	
		echo $this->to_json();
	}
}


?>