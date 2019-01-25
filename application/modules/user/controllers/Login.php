<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		if(SITE_STATUS == '2')
		{
			redirect(site_url('/offline'));exit;
		}
		else if(SITE_STATUS == '3')
		{
			//check whetheh logged in or not. if logged in as maintaince user, let them visit site. else redirect to maintainance page
			if(!$this->session->userdata('MAINTAINANCE_KEY')=='YES' OR $this->session->userdata('MAINTAINANCE_KEY')!='YES'){
				redirect(site_url('/maintainance'));exit;
			}
		}
		
		if($this->session->userdata(SESSION.'user_id'))
		{
			if($this->session->userdata(SESSION.'usertype')=='1')
				redirect(site_url('/'.ADMIN_DASHBOARD_PATH), 'refresh');	
			else if(($this->session->userdata(SESSION.'usertype')=='3'))
			redirect(site_url('/'.STAFF_DASHBOARD_PATH.'/staff'),'refresh');
		else if(($this->session->userdata(SESSION.'usertype')=='4'))
			redirect(site_url('/'.STUDENT_DASHBOARD_PATH),'refresh');
		}
		 
		 //check banned IP address
		$this->general->check_banned_ip();
		
		//load CI library
		$this->load->library('form_validation');
			
		//Changing the Error Delimiters
		$this->form_validation->set_error_delimiters('<span generated="true" class="text-danger">', '</span>');
		
		//load module
		$this->load->model('login_module');
		
		// load text helper
		$this->load->helper('text');
		
		//load mailchimp library
		// $this->load->library('mailchimp_library');
	}
	
	public function index($type='student')
	{
		
		
		if($type!='student') $this->form_validation->set_rules($this->login_module->validate_settings);
		else $this->form_validation->set_rules($this->login_module->validate_settings_student);
		if($this->form_validation->run()==TRUE)
		{

			$email = $this->input->post('username',TRUE);
			$password = $this->input->post('password',TRUE);
			
			 $login_status = $this->general->check_login_process($email, $password,$type);
			
			if($login_status == "success")
			{

				
				if($this->session->userdata(SESSION.'usertype') == '1' || $this->session->userdata(SESSION.'usertype') == '2') 	redirect(site_url('/'.ADMIN_DASHBOARD_PATH), 'refresh');
				if($this->session->userdata(SESSION.'usertype') == '3')
				 	redirect(site_url('/'.STAFF_DASHBOARD_PATH.'/staff'), 'refresh');
				elseif($this->session->userdata(SESSION.'usertype') == '4')
					redirect(site_url('/'.ADMIN_DASHBOARD_PATH), 'refresh');
			}
			else
			{					
				if($login_status==='unregistered')
					$this->session->set_flashdata('error_message','You are not Registered. Please register first');
				else if($login_status==='unverified')
					$this->session->set_flashdata('error_message','You are not Verified yet.');
				else if($login_status==='suspended')
					$this->session->set_flashdata('error_message','You are Suspended.');
				else if($login_status==='close')
					$this->session->set_flashdata('error_message','Your Account is Deleted.');				
				else if($login_status==='invalid')
					$this->session->set_flashdata('error_message','Invalid Email/Username Or Password.');
				else if($login_status==='unavailable')
					$this->session->set_flashdata('error_message','You account is unavailable.');
				redirect(site_url('login/'.$type), 'refresh');
			}
		}
		if($type!='student' && $type!='staff' && $type!='admin')
		{

			redirect(site_url('login/admin'), 'refresh');
		}
		if($type=='student') $view='v_login_student';
		if($type=='staff') $view='v_login_staff';
		if($type=='admin') $view='v_login_admin';

		$this->data['account_menu_active']=$type;
		$this->data['sub_menu_active']='login';
		$this->data['meta_keys']= WEBSITE_NAME;
	    $this->data['meta_desc']= WEBSITE_NAME;
		$this->page_title = WEBSITE_NAME.' - Login';
		$this->template
			->set_layout('login')
			->enable_parser(FALSE)
			->title($this->page_title)
			->build($view, $this->data);	
	}
	
	
	public function user_login()
	{
		//return FALSE if it is not an ajax request
		if(!$this->input->is_ajax_request())
		{
			exit('No direct script access allowed');
        }
		$this->form_validation->set_rules($this->login_module->validate_settings);
		if($this->form_validation->run()==TRUE)
		{
			//print_r($_POST); exit;
			//echo "<pre>"; print_r($_COOKIE); echo "</pre>"; exit;
			$username = $this->input->post('email',TRUE);
			$password = $this->input->post('password',TRUE);
			
			$login_status = $this->general->check_login_process($username, $password);
			
			if($login_status == "success")
			{
				//set username and password to cookie if user checked stay signed in
				$remember_me = (($this->input->post('rememberme',TRUE) && $this->input->post('rememberme',TRUE)!='')?'yes':'');
				
				if($remember_me=="yes"){
					setcookie('email', $username, time()+3600*24*10);
					setcookie('password', $password, time()+3600*24*10);
					//echo "<pre>"; print_r($_COOKIE); echo "</pre>"; exit;
				}else{
					setcookie('email', '',0);
					setcookie('password', '',0);
				}
				
				$return_data = array(
					'success_message'=>'Login Sucessful.',
		
					'return_url' =>($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:site_url(),
				);
			}
			else
			{
				$return_data['status'] = "error";
					
				if($login_status==='unregistered')
					$return_data['error_message'] =  "You are not Registered. Please register first";
				else if($login_status==='unverified')
					 $return_data['error_message'] = "You are not Verified yet.";
				else if($login_status==='suspended')
					$return_data['error_message'] = "You are Suspended.";
				else if($login_status==='close')
					$return_data['error_message'] = "Your Account is Deleted.";
				else if($login_status==='invalid')
					$return_data['error_message'] = "Invalid Email/Username Or Password.";
				else if($login_status==='unavailable')
					$return_data['error_message'] = "You account is unavailable";
			}
		}else{
			$return_data = array(
				'error_message'=>validation_errors(),
				
			);
		}
		//print_r(json_encode($_POST)); exit;
		print_r(json_encode($return_data)); exit;
	}
	public function forget($usertype='staff')
	{		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if($this->form_validation->run()==TRUE)
		{
			 //check email from our database record
			$user_info = $this->login_module->get_user_by_email($this->input->post('email',TRUE));
			if($user_info)
			{
				if($user_info->status == '1')
				{
					$email = $this->login_module->send_forget_password_link($user_info->id, $user_info->email,$usertype);
                   	if($email)
					{
						$this->session->set_flashdata('success_message','Password reset link sent to your email. Pleae Check your email.');
                 	}
                    else
					{	
						$this->session->set_flashdata('error_message','Unable to send email. Please Try Again.');
					}
           		}
                else
				{
					$this->session->set_flashdata('error_message','Account is not active');
				}
				redirect('/');
			}
			else
			{
				$this->session->set_flashdata('error_message','Account Doesnot exists');
				redirect('/');
			}
		}
		$this->data['account_menu_active']='';
		$this->data['sub_menu_active']='forget';
		$this->data['meta_keys']= WEBSITE_NAME;
	    $this->data['meta_desc']= WEBSITE_NAME;
		$this->page_title = WEBSITE_NAME.' - Reset Password';
		$this->template
			->set_layout('login')
			->enable_parser(FALSE)
			->title($this->page_title)
			->build('v_forget_password', $this->data);	
		
	}
	
	
	public function reset_password($usertype='staff')
	{
		 $code = urldecode($this->input->get('key'));
          $email = (base64_decode(urldecode($this->input->get('auth'))));
		
		$user = $this->login_module->is_user_ready_reset_password($email,$code);
		if($user)
		{
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
           	  	$this->form_validation->set_rules($this->login_module->validate_rules_reset_password);
                if($this->form_validation->run()==TRUE){
					
                    $trans_stat = $this->login_module->change_users_password($email);
                    if($trans_stat){
                        $this->session->set_flashdata('success_message', 'Password changed successfully');
                        redirect('/login/'.$usertype); exit();
                    }  else {
                       $this->session->set_flashdata('forget_message', 'Unable to change password');
                        redirect('login/forgot_password/?key='.urlencode($code).'&auth='.  urlencode(base64_encode($email))); exit(); 
                    }
                }
            }
			
			if(strtotime($user->forgot_password_code_expire)> time()){
                $this->data['allow_reset'] = TRUE;
            
            }else{
                $this->data['allow_reset'] = FALSE;
              
                $this->session->set_flashdata('error_message',"Session has expired,Please request a new reset link");
                redirect(site_url('user/login/forget'));
            }
            $this->data['account_menu_active']='';
			$this->data['sub_menu_active']='reset_password';
			$this->data['meta_keys']= '';
		    $this->data['meta_desc']= '';
			$this->page_title = WEBSITE_NAME.' - Reset Password';
			
			$this->template
				->set_layout('login')
				->enable_parser(FALSE)
				->title($this->page_title)			
				->build('v_change_password', $this->data);
		}
		else
		{
			$this->session->set_flashdata('error_msg',"Enter your Email");
			redirect(site_url(''));
		}	
	}
}