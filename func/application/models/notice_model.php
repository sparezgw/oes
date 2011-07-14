<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notice_model extends CI_Model{
	var $nID;
	var $nSchoolID;
	var $nTitle;
	var $nBody;
	
	
	function Notice_model(){
		parent::__construct();
	}
	
	
	function add_notice(){		
		$nTime=date('Y-m-d H:i:s');
		$this->db->set('nID',null);
		$this->db->set('nSchoolID',$this->nSchoolID);
		$this->db->set('nTitle',$this->nTitle);
		$this->db->set('nBody',$this->nBody);
		$this->db->set('nTime',$nTime);
		return $this->db->insert('notice');
	}
	
	function list_notice($identify){
		if($identify==ADMIN){
			$this->db->select('notice.*, school.sName');
			$this->db->from('notice');
			$this->db->join('school', 'notice.nSchoolID = school.sID', 'left');
			$this->db->order_by('nSchoolID asc, nTime asc');
			$query = $this->db->get();
			return $query;
		}else{
			$this->db->where('nSchoolID',0);
			$this->db->or_where('nSchoolID',$this->nSchoolID);
			$this->db->order_by('nSchoolID asc, nTime asc');
			return $this->db->get('notice');
		}
	}
	
	function del_notice(){
		$this->db->where('nID',$this->nID);
		return $this->db->delete('notice');
	}
	
	function edit_notice(){
		$nTime=date('Y-m-d H:i:s');
		$nSchool=$this->nSchoolID;
		$nBody=$this->nBody;
		$nTitle=$this->nTitle;
		$data=array('nSchool'=>$nSchool,'nTime'=>$nTime,'nBody'=>$nBody,'nTitle'=>$nTitle);
		
		$nID=$this->nID;
		
		$this->db->where('nID',$nID);
		return $this->db->update('notice',$data);
	}
	
}


?>