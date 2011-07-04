<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Question extends CI_Controller {
	
	function Question(){
		parent::__construct();
	}
		
	function index(){
		
    }
	
	function set_question(){
	
		$this->form_validation->set_rules('title', '��Ŀ', 'trim|required');
			
	
		
		for($a=65,$num=1;$a<69;$a++,$num++){
			$str=chr ($a);
			$this->form_validation->set_rules('op'.$num,'ѡ��'.$str,'trim|required');
		}
		
		
		/*
		$this->form_validation->set_rules('op1', 'ѡ��A', 'trim|required');
		$this->form_validation->set_rules('op2', 'ѡ��B', 'trim|required');
		$this->form_validation->set_rules('op3', 'ѡ��C', 'trim|required');
		$this->form_validation->set_rules('op4', 'ѡ��D', 'trim|required');
		*/
		
		$this->form_validation->set_rules('key','��','trim|required');
		
		$this->form_validation->set_message('required', '������д%s');
		
		$this->form_validation->set_error_delimiters('<label style="color:red;">', '</label>');
		
		if($this->form_validation->run() == FALSE){
			//$data['error']="����д��Ӧ��Ϣ!";
			$this->load->view('set_question_view');	
    	}else{
    		$title=$this->input->post('title');
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