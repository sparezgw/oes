<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Action extends CI_Controller{
	function Action(){
		parent::__construct();
	}
	
	function index(){
		$data=array();
	}
	
	function get_meg($url,$show='操作成功!'){
		$data['url']=$this->$url;
		$data['show']=$this->$show;
		$this->load->view('get_meg_view',$data);
	}
	
	
}

?>
