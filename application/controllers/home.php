<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/*��¼��ע�ᡢע��*/
	class Home extends CI_Controller{
		function Home(){
			parent::__construct();
		}
		
		function index(){
			$data=array();
		}
		
		//ע��������֤��
		function yzm_img(){
			$this->load->help('captcha');
			code();
		}
		
		//��¼������֤��
		function yzm_img1(){
			$this->load->help('captcha');
			code();
		}
		
		//ע����֤����֤
		function check_yzm(){
			
		}
		
		//��¼��֤����֤
		function checl_yzm1(){
			
		}
		
		//ע�������֤
		function set_save_form_rules(){
			$rules['uName']=array('uName','�û���', 'trim|required|min_length[4]|max_length[12]');
			$rules['uPassword']=array('uPassword','����','trim|required|matches[uPassconf]|md5');
			$rules['uTruename']=array('uTruename','��ʵ����','trim|required|min_length[4]|max_length[12]');
			$rules['uPassconf']=array('uPassconf','ȷ������','trim|required|min_length[6]|max_length[16]');
			$rules['uGender']=array('uGender','�Ա�','trim|required');
			$rules['uBday']=array('uBday','��������','trim|required');
			//$rules['uInfo']=array('uInfo','������Ϣ','trim|required');
			$rules['uIdentify']=array('uidentify','���','trim|required');
			
			$this->form_validation->set_error_delimiters('<label style="color:red;">', '</label>');
			
		}
		
		//ע�ᡢ����ע����Ϣ
		function register(){
			//$this->check_yzm();
			$uName=$this->input->post('uNname');
			$uPassword=$this->input->post('uPassword');
			$uTruename=$this->input->post('uTruename');
			$uGender=$this->input->post('uGender');
			$uBday=$this->input->post('uBday');
			//$uInfo=$this->input->post('uInfo');
			$uIdentify=$this->input->post('uIdentify');
			
			//�Ѿ��Զ�����
			//$this->load->library('validation');
			$this->set_save_form_rules();
			if($this->validation->run()){
				$this->load->model('login_model');
				$this->login_model->uName=$uName;
				$this->login_model->uPassword=$uPassword;
				$this->login_model->uTruename=$uTruename;
				$this->login_model->uGender=$uGender;
				$this->login_model->uBday=$uBday;
				//$this->login_model->uInfo=$uInfo;
				$this->login_model->uIdentify=$uIdentify;
				
				/* $check_uName=$this->home_model->check_uName;
				if($check_uName==false){
					$data['error']='���û����Ѿ���ע��';
					redirect(home/index/regsiter)
				} */
				$this->home_model->create();
				$uID = $this->db->insert_id();
				
				//����session
				$user=array(
					'uID'=>$uID,
					'uTrueame'=>$Truename,
					'uIdentify'=>$uIdentify,
				);
				$this->session->set-userdata($user);
			}
		}
	
		
		//����
		function login(){
			//$this->check_yzm1();
			
			$uName=$this->input->post('uName');
			$uPassword=$this->input->poast('uPassword');
			
			$this->laod->model('home_model');
			$this->home_model->uName=$uName;
			$this->home_model->uPassword=$uPoassword;
			$user=$this->home_model->check_user();
			if($user){
				$user=array(
					'uID'=>$user['uID'],
					'uTruename'=>$user['uTruename'],
					'uIdentify'=>$user['uIdentify'],
					'userin'=>TRUE,
				);
				$this->session->set_userdata($user);
				
				redirect('index');
			}else{
				redirect('home/index/login');
			}
				
		}
		
		
		//ע��
		function logout(){
			$this->session->sess_destory();
			redirect('login');
		}
	}
?>