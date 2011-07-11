<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logbook_model extends CI_Model{
	var $lID;
		
	function Logbook_model(){
		parent::__construct();
	}
	
	
	function add_logbook($lUserID,$lAction){
		$lTime=date('Y-m-d H:i:s');
		$this->db->set('lID',null);
		$this->db->set('lTime',$lTime);
		$this->db->set('lUserID',$lUserID);
		$this->db->set('lAction',$lAction);
		return $this->db->insert('logbook');
	}
	
	
	function list_logbook(){
		return $this->db->get('logbook');		
	}
	
	function del_logbook(){
		$this->db->where('lID',$this->lID);
		return $this->db->delete('logbook');
	}
	

}

?>