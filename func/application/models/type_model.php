<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class type_model extends CI_Model{
	var $tID;
	var $tTitle;
	var $tRule;
	
	
	function type_model(){
		parent::__construct();
	}
	
	function add_type(){
		$this->db->set('tID',null);
		$this->db->set('tTitle',$this->tTitle);
		$this->db->set('tRule',$this->tRule);
		return $this->db->insert('type');
	}

	
	function list_type(){
		return $this->db->get('type');		
	}
	

	function del_type(){
		$this->db->where('tID',$this->tID);
		return $this->db->delete('type');
	}

	
	function edit_type($tID){
		$tTitle=$this->tTitle;
		$tRule=$this->tRule;
		$data=array('tTitle'=>$tTitle,'tRule'=>$tRule);
		$tID=$this->tID;		
		$this->db->where('tID',$tID);
		return $this->db->update('type',$data);
	}
	

	function get_type_name(){
		$tID=$this->tID;
		$this->db->where('tID',$tID);
		return $query=$this->db->get('type');
		
	}
}

?>