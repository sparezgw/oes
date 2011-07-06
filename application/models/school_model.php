<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class School_model extends CI_Model{
	var $sID;
	var $sName;
	var $strname;
	
	function School_model(){
		parent::__construct();
	}
	
	//增加一个学校
	function add_school(){
		$this->db->set('sName',$this->sName);
		return $this->db->insert('school');
	}
	
	//查询所有学校
	function list_school(){
		$query=$this->db->get('school');
		if($row=$query->row_array()){
			return $row;
		}
		return array();
	}
	
	//搜索学校
	function search_school(){
		$strname=$this->strname;
		$query=$this->db->query('select sID,sName from school where sName like %$strname%');
		if($row=$query->row_array()){
			return $row;
		}
		return array();
	}
	
	
	
	//删除学校
	function delete_school(){
		$this->db->where('sID',array('sID'=>$this->sID));
		return $this->db->delete('school');
	}
	
	//修改学校
	function edit_school(){
		$this->db->where('sID',array('sID'=>$this->sID));
		$this->db->set('sName',$this->sName);
		return $this->db->update('school');
	}
	
}

?>