<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//学校
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
		$this->form_validation->set_rules('sName','学校','trim|required|min_length[3]');
		$this->form_validation->set_message('required', '必须填写%s');
		$this->form_validation->set_message('min_length','%s名称必须大于三个字!');
		$this->form_validation->set_error_delimiters('<label style="color:red;">', '</label>');
		
		if($this->form_validation->run() == TRUE){
			$this->load->model('school_model');
			$this->school_model->sName=$sName;
			$this->school_model->add_school();
			
			$data['url']='list_school';
			$data['show']='添加成功';
			$this->load->view('get_meg_view',$data);
		}else{
			$this->load->view('add_school_view');
		}
		
	}
	
	
	//修改学校
	function edit_school(){
		$sID=$this->uri->segment(3);
		$sName=$this->input->post('sName');
		
		$this->form_validation->set_rules('sName','学校','trim|required|min_length[3]');
		$this->form_validation->set_message('required', '必须填写%s');
		$this->form_validation->set_message('min_length','%s名称必须大于三个字!');
		$this->form_validation->set_error_delimiters('<label style="color:red;">', '</label>');
		
		if($this->form_validation->run() == TRUE){
			$this->load->model('school_model');
			$this->school_model->sID=$sID;
			$this->school_model->sName=$sName;
			$this->school_model->edit_school($sID);
			
			$data['url']='../list_school';
			$data['show']='修改成功';
			$this->load->view('get_meg_view',$data);
		}else{			
			$this->load->model('school_model');
			$this->school_model->sID=$sID;
			$data['query']=$this->school_model->get_school_name();
			$this->load->view('edit_school_view',$data);
		}
	}
	
	//查询所有学校
	function list_school(){
		$this->load->model('school_model');
		$data['query']=$this->school_model->list_school();
		$this->load->view('list_school_view',$data);
	}
	
	
	
	//删除学校
	function del_school(){
		//获取学校ID
		$sID=$this->uri->segment(3);
		
		$this->load->model('school_model');
		$this->school_model->sID=$sID;
		$query=$this->school_model->del_school();	
		if($query){
			$data['url']='../list_school';
			$data['show']='删除成功';
			$this->load->view('get_meg_view',$data);
		}else{
			$data['url']='../list_school';
			$data['show']='删除失败';
			$this->load->view('get_meg_view',$data);
		}	
		
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
	
}

?>