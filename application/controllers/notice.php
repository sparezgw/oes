<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notice extends CI_Controller{
	function Notice(){
		parent::__construct();
	}
	
	function index(){
		$data=array();
		$this->load->view('notice_view');
	}
	
	function set_nitice_form_rules(){
		$row['nBody']=array('nBody','公告内容','trim|required');
		//$row['nTime']=array('nTime','发布时间','required');
		$row['nSchoolID']=array('nSchoolID', '所属学校', 'required');
	}
	
	function add_notice(){
		$nBody=$this->input->post('nBody');
		$nTitle=$this->input->post('nTitle');
		$nSchool=$this->input->post('nSchool');
		
		$this->load->library('form_validation');
		$this->set_nitice_form_rules();
		if($this->form_validation->run()==TRUE){
			$this->load->model('notice_model');
			$this->notice_model->nBody=$nBody;
			$this->notice_model->nTitle=$nTitle;
			$this->notice_model->nSchool=$nSchool;
			$this->notice_model->add_notice();
			
			$data['url']='notice/list_notice';
			$data['show']='添加成功';
			$this->load->view('action',$data);
			echo "成功";
		}else{
			$this->load->view('notice_view');
			echo "失败";
		}
	}
	
	function list_notice(){
	
	}
	
	function edit_notice(){
		$nID=$this->url->segment(3);
		$this->notice_model->nID=$nID;
	}
	
	function del_notice(){
		
	}
	
	
}


?>