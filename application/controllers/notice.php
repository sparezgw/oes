<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//公告
//0:网站管理员；1:学生；2:普通教师；3:学校管理员
//网站管理员、学校管理员能对学校进行增加、修改和删除

class Notice extends CI_Controller{
	
	function Notice(){
		parent::__construct();
		if (!$this->session->userdata('userin')){
			redirect('home/login');
			exit();
		}
	}
	
	function index(){
		$data=array();		
	}
	
	function add_notice(){
		if ($this->session->userdata('uIdentify')!=WEB_ADMIN){
			echo "您没有操作权限！";
			exit();
		}	
		
	
		$nSchoolID=$this->input->post('nSchoolID');
		$nTitle=$this->input->post('nTitle');
		$nBody=$this->input->post('nBody');
		
		$this->form_validation->set_rules('nSchoolID','所属学校','trim|required');
		$this->form_validation->set_rules('nTitle','公告标题','trim|required');
		$this->form_validation->set_rules('nBody','公告内容','trim|required');
		
		
		if($this->form_validation->run() == TRUE){
			$this->load->model('notice_model');
			$this->notice_model->nSchoolID=$nSchoolID;
			$this->notice_model->nTitle=$nTitle;
			$this->notice_model->nBody=$nBody;	
			$query=$this->notice_model->add_notice();
			$nID = $this->db->insert_id();
			
			if($query){
				$lUserID=3;
				$this->load->model('logbook_model');
				$this->logbook_model->add_logbook($lUserID,'新建公告、ID='.$nID);
				
				$data['url']='list_notice';
				$data['show']='添加成功';
				$this->load->view('get_meg_view',$data);
			}else{
				$data['url']='list_notice';
				$data['show']='添加失败';
				$this->load->view('get_meg_view',$data);
			}
		}else{
			$this->load->view('add_notice_view');
		} 
	}
	
	function list_notice(){
		$this->load->model('notice_model');
		$data['query']=$this->notice_model->list_notice();
		$this->load->view('list_notice_view',$data);
	}
	
	function del_notice(){
		$nID=$this->uri->segment(3);
		$this->load->model('notice_model');
		$this->notice_model->nID=$nID;
		$query=$this->notice_model->del_notice();
		
		if($query){
			$data['url']='../list_notice';
			$data['show']='删除成功';
			$this->load->view('get_meg_view',$data);
		}else{
			$data['url']='../list_notice';
			$data['show']='删除失败';
			$this->load->view('get_meg_view',$data);
		}
	
	}
	
	function get_notice(){
		$nID=$this->uri->segment(3);
		$this->load->model('notice_model');
		$this->notice_model->nID=$nID;
		$data['query']=$this->notice_model->get_notice();
		
		$this->load->view('get_notice_view',$data);	
	}
	
}


?>