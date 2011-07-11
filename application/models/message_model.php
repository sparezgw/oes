<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Message_model extends CI_Model{
	var $mID;
	var $mFrom;
	var $mTo;
	var $mTitle;
	var $mBody;
	var $mPID;
	var $mTpye;
	
	function Message_model(){
		parent::__construct();
	}
	
	function add_message(){
		$mTime=date('Y-m-d H:i:s');
		$this->db->set('mID',null);
		$this->db->set('mFrom',$this->mFrom);
		$this->db->set('mTo',$this->mTo);
		$this->db->set('mTitle',$this->mTitle);
		$this->db->set('mBody',$this->mBody);
		$this->db->set('mPID',0);
		$this->db->set('mTime',$mTime);
		$this->db->set('mRead',0);
		$this->db->set('mType',$this->mType);
		
		return $this->db->insert('message');
	}
	
	
	function list_all_message(){
		return $this->db->get('message');
	}
	
	
	//根据用户名 返回所有收到的消息
	function list_to_message($uID){
		return $this->db->get_where('message',array('mTo'=>$uID));
		
	}
	
	//根据用户名 返回所有发出的消息
	function list_from_message($uID){
		return $this->db->get_where('message',array('mFrom'=>$uID));
		
	}
	
	
	function del_message(){
		$this->db->where('mID',$this->mID);
		return $this->db->delete('message');
	}
	
	function reply_message($mID,$mPID){
		$mTime=date('Y-m-d H:i:s');
		$this->db->set('mID',null);
		$this->db->set('mFrom',$this->mFrom);
		$this->db->set('mTo',$this->mTo);
		$this->db->set('mTitle',$this->mTitle);
		$this->db->set('mBody',$this->mBody);
		$this->db->set('mTime',$mTime);
		$this->db->set('mRead',0);
		$this->db->set('mType',$this->mType);
		
		if($mPID==0){
			$this->db->set('mPID',$mID);
		}else{
			$this->db->set('mPID',$mPID);
		}
		return $this->db->insert('message');
	}
	
	function get_message(){
		$mID=$this->mID;
		$this->db->where('mID',$mID);
		return $query=$this->db->get('message');
	}
}
?>
