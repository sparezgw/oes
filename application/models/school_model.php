<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class School_model extends CI_Model{
	var $sID;
	var $sName;
	
	function School_model(){
		parent::__construct();
	}
	
	//增加一个学校
	function add_school(){
		$this->db->set('sName',$this->sName);
		return $this->db->insert('school');
	}
	
	//查询所有学校
	function query_school(){
		$query=$this->db->get('school');
		if($row=$query->row_array()){
			return $row;
		}
		return array();
	}
	
}

?>