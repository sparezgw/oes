<?php
class Home_model extends CI_Model{
	var $uName;
	var $uPassword;
	var $uTruename;
	var $uGender;
	var $uBday;
	//var $uInfo;
	var $uIdentify;
	
	function Home_model(){
		parent::__construct();
	}
	
	//������û�
	function create(){
		$uLast=data('Y-m-d H:i:s');
		$this->db->set('uName',$this->uName);
		$this->db->set('uPassword',md5($this->uPassword));
		$this->db->set('uTurename',$this->uTruename);
		$this->db->set('uGender',$this->uGender);
		$this->db->set('uBdat',$this->uBday);
		//$this->db->set('uInfo',$this->uInfo);
		$this->db->set('uLast',$uLast);
		$this->db->set('uIdentify',$this->uIdentify);
		return $this->db->insert('user');
	}
	
	//��ѯ�û��������û���Ϣ
	function check_user(){
		$query=$this->db->get_where('user',array('uName'=>$this->uName,'uPassword'=>md5($this->uPassword)));
		if($row=$query->row_array()){
			return $row;
		}
		return array();
	}
	
	//��ѯ�û����Ƿ����
	function check_uName($uName){
		$query=$this->db->get_where('user',array('uName'=>$uName));
		if($row=$query->row_array()){
			return true;
		}
		return false;
	}
	
	//�����û���Ϣ
	function update($uID){
		//$this->db->set('uName',$this->uName);
		//$this->db->set('uPassword',$this->password);
		$this->db->set('uTurename',$this->uTruename);
		$this->db->set('uGender',$this->uGender);
		$this->db->set('uBdat',$this->uBday);
		//$this->db->set('uInfo',$this->uInfo);
		$this->db->set('uLast',$uLast);
		$this->db->set('uIdentify',$this->uIdentify);
		
		$this->db->where('uID',$uID);
		return $this->db->update('user');
	}
	
	//��������
	function update_pwd($uID,$uPassword){
		$this->db->set('uPassword',md5($uPassword));
		$this->db->where('uID',$uID);
		return $this->db->update('user');
	}
}


?>