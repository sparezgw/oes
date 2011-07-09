<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//题目
class Question extends CI_Controller {
	function Question(){
		parent::__construct();
	}
		
	function index(){
		$data=array();
    }
    
    
    function set_question_form_rules($num){
    	$row['qTypeID']=array('qTypeID','题目类型','required');
    	$row['qSubjectID']=array('qSubjectID','题目科目','trim|required');
    	$row['qTitle']=array('qTitle', '标题', 'required');
    	
    	for($i=1,$str_num=65;i<=$num;$i++,$str_num++){
    		$str=chr ($str_num);
    		$row['op'.$i]=array('op'.$i,'选项'.$str,'trim|required');
    	}
    	
    	$row['qAnswers']=array('qAnswers','题目答案','trim|required');
    	$row['aTages']=array('aTages','题目标签','required');
    	$row['qRank']=array('aRank','题目难度','required');
    	$row['qMemo']=array('qMemo','题目备注','trim|required');
    }
	
	function set_question(){		
		$this->form_validation->set_message('required', '必须填写%s');
		$this->form_validation->set_error_delimiters('<label style="color:red;">', '</label>');
		
		$title=$this->input->post('title');
		
		
		
		$this->set_question_form_rules();
		if($this->validation->run()==true){
			
		/*
    		for($a=1;$a<26;$a++){
    			$str='op'.$num;
    			echo $str;
    			$str=$this->input->post('op'.$a);
    		}
    		*/
    		
    		
			$op1=$this->input->post('op1');
			$op2=$this->input->post('op2');
			$op3=$this->input->post('op3');
			$op4=$this->input->post('op4');
			
			
			$key=$this->input->post('key');
			
			$question_arrary=array(
				'A'=>$op1,
				'B'=>$op2,
				'C'=>$op3,
				'D'=>$op4
			);
			
			$question = json_encode($question_arrary); 
			
			$data=array(
				'title'=>$title,
				'question'=>$question,
				'key'=>$key
			);
			
			$this->load->model('question_model');
			$result=$this->question_model->insert_question($data);
			
			if($result){
				$this->load->view('set_question_suess',$data);
			}else{
				$this->load->view('set_question_view');
			}	
	
		}
	}
	
	function query_question(){
		$data['query']=$this->db->get('question');
		$this->load->view('query_question_view',$data);
	}
}
?>