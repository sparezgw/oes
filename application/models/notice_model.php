<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notice_model extends CI_Model{
	var $nID;
	var $nBody;
	var $nTitle;
	var $nSchool;
	function Notice_model(){
		parent::__construct();
	}
	
	function add_notice(){
		$nTime=date('Y-m-d H:i:s');
		$this->db->set('nBody',$this->nBody);
		$this->db->set('nTitle',$this->nTitle);
		$this->db->set('nSchool',$this->nSchool);
		$this->db->set('nTime',$nTime);
		return $this->db->insert('school');
	}
}


?>
