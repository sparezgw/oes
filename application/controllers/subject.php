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
			$query=$this->subject_model->add_subject();
			$sID = $this->db->insert_id();
			
			if($query){
				$lUserID=3;
				$this->load->model('logbook_model');
				$this->logbook_model->add_logbook($lUserID,'新建科目、ID='.$sID);
								
				$data['url']='list_subject';
				$data['show']='添加成功';
				$this->load->view('get_meg_view',$data);
			}else{
				$data['url']='list_subject';
				$data['show']='添加失败';
				$this->load->view('get_meg_view',$data);
			}
	
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
			$query=$this->subject_model->edit_subject($sID);
			
			if($query){
				$lUserID=3;
				$this->load->model('logbook_model');
				$this->logbook_model->add_logbook($lUserID,'更新科目、ID='.$sID);
								
				$data['url']='../list_subject';
				$data['show']='修改成功';
				$this->load->view('get_meg_view',$data);
			}else{
				$data['url']='../list_subject';
				$data['show']='修改失败';
				$this->load->view('get_meg_view',$data);
			}
			
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
			$lUserID=3;
			$this->load->model('logbook_model');
			$this->logbook_model->add_logbook($lUserID,'删除科目、ID='.$sID);
			
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