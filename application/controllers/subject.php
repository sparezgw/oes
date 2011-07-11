<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//科目表
class Subject extends CI_Controller{
	function Subject(){
		parent::__construct();
	}
	
	function index(){
		$data=array();
	}
	
	function add_subject(){
		$sTitle=$this->input->post('sTitle');
		$this->form_validation->set_rules('sTitle','科目','trim|required');
		if($this->form_validation->run() == TRUE){
			$this->load->model('subject_model');
			$this->subject_model->sTitle=$sTitle;
			$this->subject_model->add_subject();
			
			$data['url']='list_subject';
			$data['show']='添加成功';
			$this->load->view('get_meg_view',$data);
		}else{
			$this->load->view('add_subject_view');
		}
		
	}
	
	function edit_subject(){
		$sID=$this->uri->segment(3);
		$sTitle=$this->input->post('sTitle');
		
		$this->form_validation->set_rules('sTitle','科目','trim|required');

		if($this->form_validation->run() == TRUE){
			$this->load->model('subject_model');
			$this->subject_model->sID=$sID;
			$this->subject_model->sTitle=$sTitle;
			$this->subject_model->edit_subject($sID);
			
			$data['url']='../list_subject';
			$data['show']='修改成功';
			$this->load->view('get_meg_view',$data);
		}else{			
			$this->load->model('subject_model');
			$this->subject_model->sID=$sID;
			$data['query']=$this->subject_model->get_subject_name();
			$this->load->view('edit_subject_view',$data);
		}
	}
	

	function list_subject(){
		$this->load->model('subject_model');
		$data['query']=$this->subject_model->list_subject();
		$this->load->view('list_subject_view',$data);
	}
	
	
	

	function del_subject(){
		$sID=$this->uri->segment(3);		
		$this->load->model('subject_model');
		$this->subject_model->sID=$sID;
		$query=$this->subject_model->del_subject();	
		if($query){
			$data['url']='../list_subject';
			$data['show']='删除成功';
			$this->load->view('get_meg_view',$data);
		}else{
			$data['url']='../list_subject';
			$data['show']='删除失败';
			$this->load->view('get_meg_view',$data);
		}	
		
	}	
}

?>