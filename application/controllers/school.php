<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class School extends CI_Controller{
	function School(){
		parent::__construct();
	}
	
	function index(){
		$data=array();
	}
	
	//增加一个学校
	function add_school(){
		$sName=$this->input->post('sName');
		$this->form_validation->set_rules('sName','学校','trim|required|min_length[6]');
		$this->form_validation->set_message('required', '必须填写%s');
		$this->form_validation->set_error_delimiters('<label style="color:red;">', '</label>');
		
		$this->set_save_form_rules();
		if($this->validation->run()){
			$this->load->model('school_model');
			$this->login_model->uSchool=$uSchool;
			$this->school_model->add_school();
			
			redirect('index');
		}else{
			redirect('add_school');
		}
		
	}
	
	//查询所有学校
	function query_school(){
		$this->load->model('school_model');
		$data['sName']=$this->school_model->query_school();
		//$this->load->view('query_school_view',$data);
	}
	
	
	
}

?>