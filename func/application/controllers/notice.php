<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//公告
//0:网站管理员；1:学生；2:普通教师；3:学校管理员
//STUDENT:学生；TEACHER:普通教师；SCHOOLADMIN:学校管理员；ADMIN:网站管理员
//网站管理员、学校管理员能对公告进行增加、修改和删除

class Notice extends MY_Controller{
	
	function Notice(){
		parent::__construct();
		
	}
	
	function list_notice(){
		$this->load->model('notice_model');
// 		$identify = $this->session->userdata('uIdentify');
// 		$this->notice_model->nSchoolID = $this->session->userdata('uSchoolID');
		$identify = SCHOOLADMIN;
		$this->notice_model->nSchoolID = 1;
		
		$query=$this->notice_model->list_notice($identify);
	
		if($query){
			foreach ($query->result() as $row){
				if($identify==ADMIN){
					$nSchool = ($row->nSchoolID==0)?0:$row->sName;
				}else{
					$nSchool = ($row->nSchoolID==0)?0:'学校公告';
				}
				$item=array(
					'nID'=>$row->nID,
					'nSchool'=>$nSchool,
					'nTitle'=>$row->nTitle,
					'nBody'=>$row->nBody,
					'nTime'=>$row->nTime
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
	
	function test() {
		echo json_encode(array(
			'id' => 3,
			'sid' => 0,
			'identify' => SCHOOLADMIN
		));
	}
	function t1() {
		print_r($_POST);
	}
	
	function add_notice(){
		$this->get_request();
		
		$nSchoolID=$this->session->userdata('uSchoolID');
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
					'nID'  =>$nID
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