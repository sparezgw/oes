<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//登录、注册、注销
class Home extends CI_Controller{
	
	function Home(){
		parent::__construct();
	}
	
	function index(){
		$data=array();
	}
	
	//注册验证码生成
	function yzm_img(){
		$this->load->help('captcha');
		code();
	}
	
	//登录验证码生成
	function yzm_img1(){
		$this->load->help('captcha');
		code();
	}
	
	//检验注册验证码
	function check_yzm(){
		
	}
	
	//检验登录验证码
	function checl_yzm1(){
		
	}
	
	//设置注册规则
	function set_register_form_rules(){
		$rules['uName']=array('uName','用户名', 'trim|required|min_length[4]|max_length[12]');
		$rules['uPassword']=array('uPassword','密码','trim|required|matches[uPassconf]|md5');
		$rules['uPassconf']=array('uPassconf','确认密码','trim|required|min_length[6]|max_length[16]');
		$rules['uTruename']=array('uTruename','真实姓名','trim|required|min_length[4]|max_length[12]');
		$rules['uGender']=array('uGender','性别','trim|required');
		$rules['uBday']=array('uBday','生日','trim|required');
		//$rules['uInfo']=array('uInfo','个人信息','trim|required');
		$rules['uIdentify']=array('uidentify','权限','trim|required');
		
		$this->form_validation->set_error_delimiters('<label style="color:red;">', '</label>');
		
	}
	
	//注册、保存注册信息
	function register(){
		//$this->check_yzm();
		$uName=$this->input->post('uNname');
		$uPassword=$this->input->post('uPassword');
		$uTruename=$this->input->post('uTruename');
		$uGender=$this->input->post('uGender');
		$uBday=$this->input->post('uBday');
		//$uInfo=$this->input->post('uInfo');
		$uIdentify=$this->input->post('uIdentify');
		
		//已经在autoload中载入
		//$this->load->library('validation');
		$this->set_register_form_rules();
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
				$data['error']='用户名已经存在';
				redirect(home/index/regsiter)
			} */
			$this->home_model->create();
			$uID = $this->db->insert_id();
			
			//加入session
			$user=array(
				'uID'=>$uID,
				'uTrueame'=>$Truename,
				'uIdentify'=>$uIdentify,
			);
			$this->session->set-userdata($user);
			//redirect('index');
		}else{
			//redirect('register');
		}
	}
	
	function list_user(){
		$this->load->model('home_model');
		$data['query']=$this->home_model->list_user();
		$this->load->view('list_user_view',$data);
	}

	
	//登入
	function login(){
		//$this->check_yzm1();
		
		$uName=$this->input->post('uName');
		$uPassword=$this->input->post('uPassword');
		
		$this->load->model('home_model');
		$this->home_model->uName=$uName;
		$this->home_model->uPassword=$uPassword;
		
		$this->form_validation->set_rules('uName','用户名','trim|required');
		$this->form_validation->set_rules('uPassword','密码','trim|required');
		
		
		if($this->form_validation->run() == TRUE){
			//$this->load->model('home_model');
			if($this->home_model->check_name($uName)==FALSE){
				echo "用户名不存在";
			}else{
				$query=$this->home_model->check_password($uName);
				$row=$query->result();		
				if($row[0]->uPassword!=$uPassword){
					echo "密码错误";
				}else{
					echo "登录成功";
					$user=$this->home_model->check_user();
					if($user){
						$user=array(
									'uID'=>$user['uID'],
									'uTruename'=>$user['uTruename'],
									'uIdentify'=>$user['uIdentify'],
									'userin'=>TRUE,
						);
					}
					$this->session->set_userdata($user);
				}			
			}
			
			
		}else{
			$this->load->view('login_view');
		}
	}
	
	
	
	
	//注销
	function logout(){
		$this->session->sess_destory();
		redirect('login');
	}
	
}
?>