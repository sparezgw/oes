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
		
		if($this->form_validation->run() == TRUE){
			$this->load->model('school_model');
			$this->school_model->uSchool=$uSchool;
			$this->school_model->add_school();
			
			redirect('index');
		}else{
			redirect('add_school');
		}
		
	}
	
	//查询所有学校
	function list_school(){
		$this->load->model('school_model');
		$data['sName']=$this->school_model->list_school();
		$this->load->view('list_school_view',$data);
	}
	
	//按学校名搜索
	function search_school(){
		$strname=$this->input->post('strname');
		$this->form_validation->set_rules('stename','学校名','trim|required|min_length[6]');
		$this->form_validation->set_message('required', '必须填写%s');
		$this->form_validation->set_error_delimiters('<label style="color:red;">', '</label>');
		
		if($this->form_validation->run() == TRUE){
			$this->load->model('school_model');
			$this->school_model->strname=$strname;
			$data['sName']=$this->school_model->search_school();
			$this->load->view('list_school_view',$data);
		}else{
			//redirect(search_school);
		}
	}
	
	//删除学校
	function delete_school(){
		//获取学校ID
		$sID=$this->uri->segment(3);
		
		$this->load->model('school_model');
		$this->school_model->sID=$sID;
		$this->school_model->delete_school();		
		
	}
	
	//修改学校
	function edit_school(){
		$sID=$this->uri->segment(3);
		$sName=$this->input->post('sName');
		$this->form_validation->set_rules('sName','学校','trim|required|min_length[6]');
		$this->form_validation->set_message('required', '必须填写%s');
		$this->form_validation->set_error_delimiters('<label style="color:red;">', '</label>');
		
		if($this->form_validation->run() == TRUE){
			$this->laod->model('school_model');
			$this->school_model->sID=$sID;
			$this->school_model->sName=$sName;
			$this->school_model->edit_school();
			//$this->load->view('scuss_school_view',$data);
			}else{
				//redirect(search_school);
		}
		
		
		
	}
	
	
}

?>