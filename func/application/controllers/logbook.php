<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//日志
class Logbook extends MY_Controller{
	function Logbook(){
		parent::__construct();
	}
	
	
	function list_logbook(){
		$this->load->model('logbook_model');
		$query=$this->logbook_model->list_logbook();
		
		if($query){
			foreach ($query->result() as $row){
				$item=array(
					'lID'    =>$row->lID,
					'lTime'  =>$row->lTime,
					'lUserID'=>$row->lUserID,
					'lAction'=>$row->lAction
				);
				$this->data[]=$item;
			}
			
			$this->success = true;
			$this->message = '读取日志列表成功';
		}else{
			$this->message = '读取日志列表失败';	
		}
		echo $this->to_json();
		
	}
	
	
	function del_logbook(){
		$this->get_request();
		
		$lID=$this->params->lID;
		
		$this->load->model('logbook_model');
		$this->logbook_model->lID=$lID;
		$query=$this->logbook_model->del_logbook();
		
		if($query){
			$this->success = true;
			$this->message = '删除成功！';
		}else{
			$this->message = '删除失败！';
		}
		
		echo $this->to_json();
	}
		
}

?>
