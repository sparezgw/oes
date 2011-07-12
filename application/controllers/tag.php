<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tag extends CI_Controller{
	function Tag(){
		parent::__construct();
	}
	
	function index(){
		$data=array();
	}
	
	
	function add_tag(){
		$tName=$this->input->post('tName');
		$tUserID=$this->input->post('tUserID');
		
		$this->form_validation->set_rules('tName','标签名称','trim|required');
		$this->form_validation->set_rules('tUserID','用户ID','trim|required');
		
		if($this->form_validation->run() == TRUE){
			
			//分隔成单个标签
			$tName=explode(" ", $tName);
			//计算标签个数
			$num=count($tName);
			
			for($i=0;$i<$num;$i++){
				$this->load->model('tag_model');
				$this->tag_model->tName=$tName[$i];
				$this->tag_model->tUserID=$tUserID;
					
				if($this->tag_model->check_tag($tUserID,$tName[$i])==FALSE){
					echo "此用户的此标签不存在";
					$query=$this->tag_model->add_tag();
				
					if($query){
						$data['url']='list_tag';
						$data['show']='添加成功';
						$this->load->view('get_meg_view',$data);
					}else{
						echo "添加失败";
					}
					
				}else{
					echo "此用户的此标签已经存在";
					$this->load->model('tag_model');
					$query=$this->tag_model->addone_tag($tUserID,$tName[$i]);
				
					if($query){
						$data['url']='list_tag';
						$data['show']='增加成功';
						$this->load->view('get_meg_view',$data);
					}else{
						echo "增加失败";
					}
				
				}
			}
		}else{
			$this->load->view('add_tag_view');
		}
		
	}
		
	function list_tag(){
		$this->load->model('tag_model');
		$data['query']=$this->tag_model->list_tag();
		$this->load->view('list_tag_view',$data);
	}
	
	//创建云标签
	function getcloud_tag( $data = array(), $minFontSize = 12, $maxFontSize = 30 )
	{
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
