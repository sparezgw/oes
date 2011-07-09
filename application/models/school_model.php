<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//学校
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
		return $this->db->get('school');
		//return $this->db->order_by("sID", "desc");
		
	}
	
	//删除学校
	function del_school(){
		$this->db->where('sID',$this->sID);
		return $this->db->delete('school');
	}
	
	//修改学校
	function edit_school(){
		$sName=$this->sName;
		$data=array('sName'=>$sName);
		$sID=$this->sID;
		$this->db->where('sID',$sID);
		return $this->db->update('school',$data);
		//$query=$this->db->query("update school set sName='$sName' WHERE sID='$sID'");
		//return $query;
	}
	
	//获取学校名
	function get_school_name($sID){
		$this->db->where('sID',$sID);
		$query=$this->db->get('school');
		$row=$query->result();
		return $row['sName'];
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
}

?>