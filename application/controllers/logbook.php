<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logbook extends CI_Controller{
	function Logbook(){
		parent::__construct();
	}
	
	function index(){
		$data=array();
	}
	
	function list_logbook(){
		$this->load->model('logbook_model');
		$data['query']=$this->logbook_model->list_logbook();
		$this->load->view('list_logbook_view',$data);
	}
	
	function del_logbook(){
		$lID=$this->uri->segment(3);
		
		$this->load->model('logbook_model');
		$this->logbook_model->lID=$lID;
		
		$query=$this->logbook_model->del_logbook();
		if($query){
			$data['url']='../list_logbook';
			$data['show']='删除成功';
			$this->load->view('get_meg_view',$data);
		}else{
			$data['url']='../list_logbook';
			$data['show']='删除失败';
			$this->load->view('get_meg_view',$data);
		}
	}
		
}

?>
