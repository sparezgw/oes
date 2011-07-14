<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//题目类型表
class Type extends MY_Controller{
	function Type(){
		parent::__construct();
	}
	
	function list_type(){
		$this->load->model('type_model');
		$query=$this->type_model->list_type();
		
		if($query){
			foreach ($query->result() as $row){
				$item=array(
					'tID'   =>$row->tID,
					'tTitle'=>$row->tTitle,
					'tRule' =>$row->tRule
				);
				$this->data[]=$item;
			}
			
			$this->success = true;
			$this->message = '读取题目类型列表成功';
		}else{
			$this->message = '读取题目类型列表失败';	
		}
		echo $this->to_json();
	}
	
	
	
}

?>
