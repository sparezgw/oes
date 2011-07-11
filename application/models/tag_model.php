<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tag_model extends CI_Model{
	var $tID;
	var $tName;
	var $tUserID;
	
	function Tag_model(){
		parent::__construct();
	}

	function add_tag(){
		$this->db->set('tID',null);
		$this->db->set('tUserID',$this->tUserID);
		$this->db->set('tName',$this->tName);
		$this->db->set('tCount',1);
		return $this->db->insert('tag');
	}
	

	function list_tag(){
		return $this->db->get('tag');		
	}
	
	//检测此用户de此标签是否存在
	function check_tag($tUserID,$tName){
		$query=$this->db->get_where('tag',array('tUserID'=>$tUserID,'tName'=>$tName));
		if($row=$query->row_array()){
			return true;
		}
		return false;
	}
	
	//标签数加一
	function addone_tag($tUserID,$tName){
		$this->db->set('tCount','tCount+1',FALSE);
		$this->db->where('tUserID',$tUserID);
		$this->db->where('tName',$tName);
		return $this->db->update('tag');
	}
}

?>