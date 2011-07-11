<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//学校
class Type extends CI_Controller{
	function Type(){
		parent::__construct();
	}
	
	function index(){
		$data=array();
	}
	
	function add_type(){
		$tTitle=$this->input->post('tTitle');
		$tRule=$this->input->post('tRule');
		
		$this->form_validation->set_rules('tTitle','题目类型','trim|required');
		$this->form_validation->set_rules('tRule','题目规则','trim|required');
		if($this->form_validation->run() == TRUE){
			$this->load->model('type_model');
			$this->type_model->tTitle=$tTitle;
			$this->type_model->tRule=$tRule;
			$this->type_model->add_type();
			
			$data['url']='list_type';
			$data['show']='添加成功';
			$this->load->view('get_meg_view',$data);
		}else{
			$this->load->view('add_type_view');
		}
		
	}
	
	
	
	function edit_type(){
		$tID=$this->uri->segment(3);
		$tTitle=$this->input->post('tTitle');
		$tRule=$this->input->post('tRule');
		
		$this->form_validation->set_rules('tTitle','题目类型','trim|required');
		$this->form_validation->set_rules('tRule','题目规则','trim|required');
		
		if($this->form_validation->run() == TRUE){
			$this->load->model('type_model');
			$this->type_model->tID=$tID;
			$this->type_model->tTitle=$tTitle;
			$this->type_model->tRule=$tRule;
			$this->type_model->edit_type($tID);
			
			$data['url']='../list_type';
			$data['show']='修改成功';
			$this->load->view('get_meg_view',$data);
		}else{			
			$this->load->model('type_model');
			$this->type_model->tID=$tID;
			$data['query']=$this->type_model->get_type_name();
			$this->load->view('edit_type_view',$data);
		}
	}
	
	
	function list_type(){
		$this->load->model('type_model');
		$data['query']=$this->type_model->list_type();
		$this->load->view('list_type_view',$data);
	}
	
	
	
	
	function del_type(){
		
		$tID=$this->uri->segment(3);
		
		$this->load->model('type_model');
		$this->type_model->tID=$tID;
		$query=$this->type_model->del_type();	
		if($query){
			$data['url']='../list_type';
			$data['show']='删除成功';
			$this->load->view('get_meg_view',$data);
		}else{
			$data['url']='../list_type';
			$data['show']='删除失败';
			$this->load->view('get_meg_view',$data);
		}	
		
	}	
}

?>
