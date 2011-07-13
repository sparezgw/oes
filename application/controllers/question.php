<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//试题表
//所有试题保存后不能组卷、可以修改，提交后可以组卷、不能修改
//只有老师才能新建题目
class Question extends CI_Controller {
	public $success,$message,$data,$params;
	
	function Question(){
		parent::__construct();
	}
	
	function get_user(){
		return uIDentify;
	}
		
	function list_question(){
		
	}
	
	function add_question(){
		
		$this->get_request();
		
		//增加标签
		$qTags=$this->params->qTags;
		
		/* $qTages_query=$this->add_tag($qTags);
		if($qTages_query==false){
			$this->success = false;
			$this->message = '增加标签失败';
		}else{
			$this->success = true;
			$this->message = '增加标签成功';
			$qTags=$qTages_query;
		} */
		
		$qTypeID=$this->params->qTypeID;
		$qSubjectID=$this->params->qSubject;
		$qTitle=$this->params->qTitle;
		$qOptions=$this->params->qOptions;
		$qAnswers=$this->params->qAnswers;
		$qRank=$this->params->qRank;
		$qLimit=$this->params->qLimit;
		$qPublic=$this->params->qPublic;
		$qState=$this->params->qState;
		$qMemo=$this->params->qMemo;
		
		

		$this->load->model('qusetion_mdoel')=$qTypeID;
		$this->load->model('qusetion_mdoel')=$qSubject;
		$this->load->model('qusetion_mdoel')=$qTitle;
		$this->load->model('qusetion_mdoel')=$qOptions;
		$this->load->model('qusetion_mdoel')=$qAnswers;
		$this->load->model('qusetion_mdoel')=$qTags;
		$this->load->model('qusetion_mdoel')=$qRank;
		$this->load->model('qusetion_mdoel')=$qLimit;
		$this->load->model('qusetion_mdoel')=$qPublic;
		$this->load->model('qusetion_mdoel')=$qState;
		$this->load->model('qusetion_mdoel')=$qMemo;
		
		$query=$this->question_model->add_school();
		
		if($query){
			$qID = $this->db->insert_id();
			
			//将标签数增加一
			
			$this->data =array(
				'qID'  =>$qID,
			);
			$this->success = true;
			$this->message = '试题添加成功！';
		}else{
			$this->message = '学校添加失败!';
		}
		
		echo $this->to_json();
	}
	
	
	//试题保存以后只能出题人删除、提交以后都不能删除
	//qState:题目状态.保存状态0,提交状态1.
	function del_question(){
		
		$this->get_request();
		
		$qID=$this->params->qID;
		$qState=$this->params->qState;
		$qLimit=$this->params->qLimit;
		
		if($qState==0){
			
			$user_list=json_decode($qLimit,true);
			//获取出卷人ID
			$question_author=$user_list['author'];
			
			if($question_author==$uID){
				$this->load->model('question_model');
				$this->load->question_model->qID=$qID;
				$query=$this->question->del_question();
					
				if($query){
					$this->success = true;
					$this->message = '删除成功！';
				}else{
					$this->message = '删除失败！';
				}
				
			}else{
				$this->message = '不是出卷人不能删除该题！';
			}

		}else{
			$this->message = '试题提交以后不能删除！';
		}
	}
	
	function edit_qurstion(){
		$this->get_request();
		
		$sID=$this->params->sID;
		$sName=$this->params->sName;
		
		
	}
}
?>