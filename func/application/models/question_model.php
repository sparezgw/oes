<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//题目
class Question_model extends CI_Model{
	var $qID;
	var $qTypeID;
	var $qSubjectID;
	var $qTitle;
	var $qOptions;
	var $qAnswers;
	var $qTags;
	var $qRank;
	var $qLimit;
	var $qPublic;
	var $qState;
	var $qMemo;
	
	function __construct(){
		parent::__construct();
		
	}
	
	function add_qusetion(){
		$this->db->set('qID',null);
		$this->db->set('qTypeID',$this->qTypeID);
		$this->db->set('qSubjectID',$this->qSubjectID);
		$this->db->set('qTitle',$this->qTitle);
		$this->db->set('qOptions',$this->qOptions);
		$this->db->set('qAnswers',$this->qAnswers);
		$this->db->set('qTags',$this->qTags);
		$this->db->set('qRank',$this->qRank);
		$this->db->set('qLimit',$this->qLimit);
		$this->db->set('qPublic',$this->qPublic);
		$this->db->set('qState',$this->qState);
		$this->db->set('qMemo',$this->qMemo);
		
		return $this->db->insert('question');
	}
	
	function list_question(){
		return $this->db->get('question');		
	}
	
	function del_question(){
		$this->db->where('qID',$this->qID);
		return $this->db->delete('question');
	}
	
	function edit_question(){
		
	}
	
	
}

?>