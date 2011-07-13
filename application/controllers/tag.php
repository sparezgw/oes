<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tag extends CI_Controller{
	function Tag(){
		parent::__construct();
			
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
