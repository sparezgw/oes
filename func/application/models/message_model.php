<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Message_model extends CI_Model{
	var $mID;
	var $mFrom;
	var $mTo;
	var $mTitle;
	var $mBody;
	var $mPID;
	var $mRead;
	var $mTpye;
	
	function Message_model(){
		parent::__construct();
	}
	
	function add_message(){
		$mTime=date('Y-m-d H:i:s');
		
		$this->db->set('mFrom',$this->mFrom);
		$this->db->set('mTo',$this->mTo);
		$this->db->set('mTitle',$this->mTitle);
		$this->db->set('mBody',$this->mBody);
		$this->db->set('mTime',$mTime);
		$this->db->set('mRead',0);
		$this->db->set('mType',$this->mType);
		
		if($this->mID==null){
			//第一次留言
			$this->db->set('mID',null);
			$this->db->set('mPID',0);
		}else{
			//回复
			if($mPID==0){
				//第一次回复
				$this->db->set('mPID',$mID);
			}else{
				//以后回复
				$this->db->set('mPID',$mPID);
			}
		}
		return $this->db->insert('message');
	}
	
	function del_message(){
		$this->db->where('mID',$this->mID);
		return $this->db->delete('message');
	}
	
	
	//返回所有消息列表
	function list_all_message(){
		return $this->db->get('message');
	}
	
	//根据用户名，查看所有第一次收到的消息
	function list_to_message_first(){
		return $this->db->get_where('message',array('mTo'=>$this->mTo,'mPID'=>$this->mPID));
	}
	
	//根据用户名，查看所有第一次发出的消息
	function list_to_message_first(){
		return $this->db->get_where('message',array('mFrom'=>$this->mFrom,'mPID'=>$this->mPID));
	}
	
	//根据某条消息、查看所有相应的留言
	function list_reply(){
		return $this->db->get_where('message',array('mID'=>$this->mID));
	}
}
?>
