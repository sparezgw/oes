<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Message extends CI_Controller{
	
	function Message(){
		parent::__construct();
	}
	
	function index(){
		$data=array();
	}
	
	function add_message(){
		$mFrom=$this->input->post('mFrom');
		$mTo=$this->input->post('mTo');
		$mTitle=$this->input->post('mTitle');
		$mBody=$this->input->post('mBody');
		$mType=$this->input->post('mType');
		
		$this->form_validation->set_rules('mFrom','发件人','required');
		$this->form_validation->set_rules('mTo','收件人','required');
		$this->form_validation->set_rules('mTitle','主题','required');
		$this->form_validation->set_rules('mBody','内容','required');
		
		if($this->form_validation->run() == TRUE){
			$this->load->model('message_model');
			
			$this->message_model->mFrom=$mFrom;
			$this->message_model->mTo=$mTo;
			$this->message_model->mTitle=$mTitle;
			$this->message_model->mBody=$mBody;
			$this->message_model->mType=$mType;
			$query=$this->message_model->add_message();
			
			if($query){				
				$data['url']='list_all_message';
				$data['show']='添加成功';
				$this->load->view('get_meg_view',$data);
			}else{
				$data['url']='list_all_message';
				$data['show']='添加失败';
				$this->load->view('get_meg_view',$data);
			}
			
			
		}else{
 			$this->load->view('add_message_view');
		}
	}
	
	//查看所有消息
	function list_all_message(){
		$this->load->model('message_model');
		$data['query']=$this->message_model->list_all_message();
		$this->load->view('list_all_message_view',$data);
	}
	
	//根据用户名 查看所有收到的消息
	function list_to_message(){
		$uID=$this->uri->segment(3);
		$this->load->model('message_model');
		$data['query']=$this->message_model->list_to_message($uID);
		$this->load->view('list_to_message_view',$data);
	}
	
	//根据用户名 查看所有发出的消息
	function list_from_message(){
		$uID=$this->uri->segment(3);
		$this->load->model('message_model');
		$data['query']=$this->message_model->list_from_message($uID);
		$this->load->view('list_from_message_view',$data);
	}
	
	function del_message(){
		$mID=$this->uri->segment(3);
		
		$this->load->model('message_model');
		$this->message_model->mID=$mID;
		
		$query=$this->message_model->del_message();
		if($query){
			$data['url']='../list_all_message';
			$data['show']='删除成功';
			$this->load->view('get_meg_view',$data);
		}else{
			$data['url']='../list_all_message';
			$data['show']='删除失败';
			$this->load->view('get_meg_view',$data);
		}	
	}
	
	//回复
	function reply_message(){
		$mID=$this->uri->segment(3);
		$mPID=$this->uri->segment(4);
		
		$mFrom=$this->input->post('mFrom');
		$mTo=$this->input->post('mTo');
		$mTitle=$this->input->post('mTitle');
		$mBody=$this->input->post('mBody');
		$mType=$this->input->post('mType');
		
		$this->form_validation->set_rules('mFrom','发件人','required');
		$this->form_validation->set_rules('mTo','收件人','required');
		$this->form_validation->set_rules('mTitle','主题','required');
		$this->form_validation->set_rules('mBody','内容','required');
		
		if($this->form_validation->run() == TRUE){
			$this->load->model('message_model');
				
			$this->message_model->mFrom=$mFrom;
			$this->message_model->mTo=$mTo;
			$this->message_model->mTitle=$mTitle;
			$this->message_model->mBody=$mBody;
			$this->message_model->mType=$mType;
			
			$query=$this->message_model->reply_message($mID,$mPID);
			
			if($query){
				$data['url']='../../list_all_message';
				$data['show']='回复成功';
				$this->load->view('get_meg_view',$data);
			}else{
				$data['url']='../../list_all_message';
				$data['show']='回复失败';
				$this->load->view('get_meg_view',$data);
			}
				
		}else{
			$this->load->model('message_model');
			$this->message_model->mID=$mID;
			$data['query']=$this->message_model->get_message();
			$this->load->view('reply_message_view',$data);
		}
	}
}

