<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//试题表
//所有试题保存后不能组卷、可以修改，提交后可以组卷、不能修改
//只有老师才能新建题目
class Question extends MY_Controller {
	public $success,$message,$data,$params;
	
	function Question(){
		parent::__construct();
	}
	
	function list_question(){
		$this->load->model('question_model');
		$query=$this->question_model->list_question();
		
		if($query){
			foreach ($query->result() as $row){
				$item=array(
					'qID'       =>$row->qID,
					'qTypeID'   =>$row->qTypeID,
					'qSubjectID'=>$row->qSubjectID,
					'qTitle'    =>$row->qTitle,
					'qOptions'  =>$row->qOptions,
					'qAnswers'  =>$row->qAnswers,
					'qTags'     =>$row->qTags,
					'qRank'     =>$row->qRank,
					'qLimit'    =>$row->qLimit,
					'qPublic'   =>$row->qPublic,
					'qState'    =>$row->qState, 
					'qMemo'     =>$row->qMemo
				);
				$this->data[]=$item;
			}
			$this->success = true;
			$this->message = '读取试题列表成功';
		}else{
			$this->message = '读取试题列表失败';
		}
		
		echo $this->to_json();
		
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
		
		$this->laod->model('question_model');

		$this->qusetion_mdoel->qTypeID=$qTypeID;
		$this->qusetion_mdoel->qSubject=$qSubject;
		$this->qusetion_mdoel->qTitle=$qTitle;
		$this->qusetion_mdoel->qQption=$qOptions;
		$this->qusetion_mdoel->qAnswers=$qAnswers;
		$this->qusetion_mdoel->qTags=$qTags;
		$this->qusetion_mdoel->qRank=$qRank;
		$this->qusetion_mdoel->qLimit=$qLimit;
		$this->qusetion_mdoel->qPublic=$qPublic;
		$this->qusetion_mdoel->qState=$qState;
		$this->qusetion_mdoel->qMemo=$qMemo;
		
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
			$this->message = '试题添加失败!';
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
			
			if($question_author==$this->session->userdata('uID')){
				$this->load->model('question_model');
				$this->question_model->qID=$qID;
				$query=$this->question_model->del_question();
					
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
	
	
}
?>