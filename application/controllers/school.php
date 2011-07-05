<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class School extends CI_Controller{
	function School(){
		parent::__construct();
	}
	
	function index(){
		$data=array();
	}
	
	function add_school(){
		$sName=$this->input->post('sName');
		
		
	}
	
}

?>