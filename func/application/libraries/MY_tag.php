<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_tag{
	function MY_tag(){
				
	}	
	
	function add_tag($qTage,$uID){
		//获取所有标签,例如："aerg,wf,etrv,wev" 和uID

		$tUserID=$uID;
		
		//将获取的标签转化为数组，例如：Array ( [0] => aerg [1] => wf [2] => etrv [3] => wev )
		$qTags_arr=explode(',',$qTags);
			
		//计算数组个数,例如：4
		$qTags_num=count($qTags_arr);
			
		//定义question表中装qTage的id的array
		$qTage_id_arr=array();
			
		//如果存在，返回该tID。如果不存在，增加tag，返回增加的tID。
			
			
		for($i=0;i<$qTags_num;$i++){
			//逐个检测该用户的该标签名是否存在.存在返回该tID，不存在返回false
			$this->load->model('tag_model');
			$this->tag_model->tName=$qTags_arr[i];
			$this->tag_model->tUserID=$uID;
			$tag_query=$this->tag_model->check_tag();
		
			if($query){
				array_push($qTage_id_arr,$tag_query);
			}else{
				//增加该标签

				$this->load->model('tag_model');
				$this->tag_model->tName=$qTags_arr[i];
				$this->tag_model->tUserID=$uID;
				$tag_query=$this->tag_model->add_tag();
				
				$tID=$this->db->insert_id();
				
				array_push($qTage_id_arr, $tID);
			}
		}
		
		return $qTage_id_arr;
	}
	
	//标签数加一，并且在标签中加入相应tQuertionID或者tPaperID
	function add_tag_one($qTage_id_arr,$uID,$qID){
		$tUserID=$uID;

		$qTags_num=count($qTage_id_arr);
		for($i=0;i<$qTags_num;$i++){

			$qID=$qTage_id_arr[i];
			$this->load->model('tag_model');
			$this->tag_model->qID=$qID;
			$tQuestion_id_json=$this->tag_model->find_tag_qid();
			
			$tQuestion_id_arr=json_decode($tQuestion_id_json);
			
			array_push('$tQuestion_id_arr','$qID');
			
			$tQuestion_id_json=json_encode($tQuestion_id_arr);
			
			$this->model_tag->tQuestionID=$tQuestion_id_json;
			$this->model_tag->addone_tag();
		}
		
	}
	
	
	
	
}



?>