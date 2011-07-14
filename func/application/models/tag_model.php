<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tag_model extends CI_Model{
	var $tID;
	var $tUserID;
	var $tName;
	var $tQuestionID;
	var $tPaperID;

	
	function Tag_model(){
		parent::__construct();
	}

	function add_tag(){
		$this->db->set('tID',null);
		$this->db->set('tUserID',$this->tUserID);
		$this->db->set('tName',$this->tName);
		$this->db->set('tCount',0);
		return $this->db->insert('tag');
	}
	

	function list_tag(){
		return $this->db->get('tag');		
	}
	
	function list_tag_uid(){
		return $this->db->get_where('tag',array('tUserID',$thi->tUserID));
	}
	
	//检测该用户的该标签名是否存在.存在返回该tID，不存在返回false.
	function check_tag(){
		$query=$this->db->get_where('tag',array('tUserID'=>$this->tUserID,'tName'=>$this->tName));
		if($query->num_rows()==0){
			return false;
		}else{
			$row=$query->row_array();
			return $row['tID'];
		}
	}
	
	
	
	//查找某人某标签的试题列表
	function find_tag_qid(){
		$query=$this->db->get_where('tag',array('tID'=>$this->tID));
		$row=$query->row_array();
		return $row['tQuestionID'];
	}
	
	
	
	//标签数增加一
	function addone_tag(){
		$this->db->set('tCount','tCount+1',FALSE);
		$this->db->set('tQuestionID',$this->tQuestionID);
		
		$this->db->where('tID',$this->tID);
		return $this->db->update('tag');
	} 
}

?>