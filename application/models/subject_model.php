<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//科目
class Subject_model extends CI_Model{
	var $sID;
	var $sTitle;
	
	function Subject_model(){
		parent::__construct();
	}
	
	
	function add_subject(){
		$this->db->set('sID',null);
		$this->db->set('sTitle',$this->sTitle);
		return $this->db->insert('subject');
	}
	

	function list_subject(){
		return $this->db->get('subject');		
	}
	

	function del_subject(){
		$this->db->where('sID',$this->sID);
		return $this->db->delete('subject');
	}
	

	function edit_subject($sID){
		$sTitle=$this->sTitle;
		$data=array('sTitle'=>$sTitle);
		$sID=$this->sID;		
		$this->db->where('sID',$sID);
		return $this->db->update('subject',$data);
	}
	

	function get_subject_name(){
		$sID=$this->sID;
		$this->db->where('sID',$sID);
		return $query=$this->db->get('subject');
		
	}
}

?>