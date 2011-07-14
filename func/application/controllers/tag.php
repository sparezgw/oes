<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tag extends CI_Controller{
	function Tag(){
		parent::__construct();
			
	}
		
	function list_tag(){
		$this->load->model('tag_model');
		$query=$this->tag_model->list_tag();
		
		if($query){
			foreach ($query->result() as $row){
				$item=array(
					'tID'         =>$row->tID,
					'tUserID'     =>$row->tUserID,
					'tName'       =>$row->tName,
					'tQuestionID' =>$row->tQuestionID,
					'tPaperID'    =>$row->tPaperID,
					'tCount'      =>$row->tCount
				);
				$this->data[]=$item;
			}
				
			$this->success = true;
			$this->message = '读取标签列表成功';
		}else{
			$this->message = '读取标签列表失败';
		}
		echo $this->to_json();
		}
	}
	
	//列出某人全部标签
	function list_tag_uid(){
		$tUserID=$this->session->userdata('uID');
		
		$this->load->model('tag_model');
		$this->tag_model->tUserID=$tUserID;
		$query=$this->tag_model->list_tag_uid();
		
		if($query){
			foreach ($query->result() as $row){
				$item=array(
					'tID'         =>$row->tID,
					'tUserID'     =>$row->tUserID,
					'tName'       =>$row->tName,
					'tQuestionID' =>$row->tQuestionID,
					'tPaperID'    =>$row->tPaperID,
					'tCount'      =>$row->tCount
				);
				$this->data[]=$item;
			}
		
			$this->success = true;
			$this->message = '读取标签列表成功';
		}else{
			$this->message = '读取标签列表失败';
		}
		echo $this->to_json();
		
	}
	
	//创建云标签
	function getcloud_tag( $data = array(), $minFontSize = 12, $maxFontSize = 30 ){
		$minimumCount=min(array_values($data));
		$maximumCount=max(array_values($data));
		$spread=$maximumCount-$minimumCount;
		$cloudHTML = '';
		$cloudTags = array();
		$spread==0&&$spread=1;
		foreach($data as $tag=>$count){
			$size=$minFontSize+($count-$minimumCount)*($maxFontSize-$minFontSize)/$spread;
			$cloudTags[]='<a style="font-size: '.floor($size).'px'.'"href="#" title="\"'.$tag.'\'returned a count of '.$count.'">'.htmlspecialchars(stripslashes($tag)).'</a>';
		}
		return join("\n",$cloudTags)."\n";
	}
	
}

?>
