<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//题目
class Question_model extends CI_Model{
	function __construct(){
		parent::__construct();
		
	}
	
	function insert_question($data){
		$query=$this->db->insert('question', $data); 
		return $query;
	}
	
	function query_question($data){
		$query=$this->db->query('select * from question');
		return $query;
	}
}

?>