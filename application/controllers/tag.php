<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tag extends CI_Controller{
	function Tag(){
		parent::__construct();
	}
	
	function index(){
		$data=array();
	}
	
	function add_tag(){
		$tName=$this->input->post('tName');
		$this->form_validation->set_rules('tName','标签名称','trim|required');

		if($this->form_validation->run() == TRUE){
			$this->load->model('tag_model');
			$this->tag_model->tName=$tName;
			$this->tag_model->add_tag();
			
			$data['url']='list_tag';
			$data['show']='添加成功';
			$this->load->view('get_meg_view',$data);
		}else{
			$this->load->view('add_tag_view');
		}
		
	}
		

	function list_tag(){
		$this->load->model('tag_model');
		$data['query']=$this->tag_model->list_tag();
		$this->load->view('list_tag_view',$data);
	}
	
}

?>
