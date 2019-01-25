<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->user_id='';
	}
	
	public $user_id; //initialization of user id variable
	
	public $validate_staff_regisration =  array
	(
		array('field' => 'display_name', 'label' => 'Name on card', 'rules' => 'trim|required|min_length[2]|max_length[100]'),
		array('field' => 'first_name', 'label' => 'Given Name', 'rules' => 'trim|required|min_length[2]|max_length[100]'),
		array('field' => 'last_name', 'label' => 'Family Name', 'rules' => 'trim|required|min_length[2]|max_length[50]'),
		array('field' => 'nric', 'label' => 'NRIC', 'rules' => 'trim|required|alpha_numeric|min_length[2]|max_length[20]'),
		array('field' => 'email', 'label' => 'Email Id', 'rules' => 'trim|required|valid_email|min_length[3]|max_length[100]|callback_email_taken'),	
		array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required|min_length[6]|max_length[20]|callback_username_taken'),
		array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|min_length[6]|max_length[15]'),
		array('field' => 'retype_password', 'label' => 'Repeat Password', 'rules' => 'trim|required|min_length[6]|max_length[15]|matches[password]'),
		array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim|required'),
		array('field' => 'country', 'label' => 'Country', 'rules' => 'trim|required'),
		array('field' => 'dob', 'label' => 'DOB', 'rules' => 'trim|required'),
		array('field' => 'address1', 'label' => 'Address 1', 'rules' => 'trim|required|min_length[2]|max_length[200]'),
		array('field' => 'address2', 'label' => 'Address 2', 'rules' => 'trim|required|min_length[2]|max_length[200]'),
		array('field' => 'dealer', 'label' => 'Dealer', 'rules' => 'trim|required'),
		// array('field' => 'outlet', 'label' => 'Outlet', 'rules' => 'trim|required'),
		// array('field' => 'type', 'label' => 'Type', 'rules' => 'trim|required'),
		array('field' => 'postal_code', 'label' => 'Postal Code', 'rules' => 'trim|required|max_length[7]'),
		array('field' => 'contact_no', 'label' => 'Constact No', 'rules' => 'trim|required|min_length[6]|max_length[20]'),
	);
	
	public function insert_staff()
	{
		$display_name=$this->input->post('display_name',true);
		$first_name=$this->input->post('first_name',true);
		$last_name=$this->input->post('last_name',true);
		$nric=$this->input->post('nric',true);
		$email=$this->input->post('email',true);
		$username=$this->input->post('username',true);
		$salt=$this->general->salt();
		$password = $this->general->hash_password($this->input->post('password',TRUE),$salt);
		$gender=$this->input->post('gender',true);
		$country=$this->input->post('country',true);
		$dob=$this->input->post('dob',true);
		$address1=$this->input->post('address',true);
		$address2=$this->input->post('address2',true);
		$dealer=$this->input->post('dealer',true);
		$outlet=$this->input->post('outlet',true);
		$type=$this->input->post('type',true);
		$postal_code=$this->input->post('postal_code',true);
		$contact_no=$this->input->post('contact_no',true);
		
		// $activation_code = $this->general->random_number();	
		$current_time = $this->general->get_local_time('time');
		$user_type='4';
		$status = "2";		
		 if (NEED_USER_ACTIVATION =='0')
			$status = "1";
		$this->db->trans_start();
		$this->db->set('email', "AES_ENCRYPT('{$email}','{$salt}')", FALSE);
		$this->db->set('username', "AES_ENCRYPT('{$username}','{$salt}')", FALSE);
		$this->db->set('display_name', "AES_ENCRYPT('{$display_name}','{$salt}')", FALSE);
		$this->db->set('nric', "AES_ENCRYPT('{$nric}','{$salt}')", FALSE);

		$this->db->set('password', $password);
		$data=array(
						'password'			=>	 $password,
						'salt'				=>	 $salt,
						'user_type'			=>	 $user_type,
						'reg_date'			=>	 $current_time,
						'reg_ip'			=>	 $this->general->get_real_ipaddr(),
						'status'			=>	 $status,
						'dealer_id'			=>	 $dealer

				   );
		$this->db->insert('members',$data);
		// echo $this->db->last_query().'<br>';
		$this->user_id = $this->db->insert_id();
		if($this->user_id)
		{
			$this->db->set('first_name', "AES_ENCRYPT('{$first_name}','{$salt}')", FALSE);
			$this->db->set('last_name', "AES_ENCRYPT('{$last_name}','{$salt}')", FALSE);
			$this->db->set('address', "AES_ENCRYPT('{$address1}','{$salt}')", FALSE);
			$this->db->set('address2', "AES_ENCRYPT('{$address2}','{$salt}')", FALSE);
			$this->db->set('country', "AES_ENCRYPT('{$country}','{$salt}')", FALSE);
			$this->db->set('postal_code', "AES_ENCRYPT('{$postal_code}','{$salt}')", FALSE);
			$this->db->set('phone', "AES_ENCRYPT('{$contact_no}','{$salt}')", FALSE);
			$this->db->set('gender', "$gender");
			$this->db->set('dob', $dob.false);
			$this->db->set('user_id', $this->user_id, FALSE);
			$this->db->insert('members_details');
			 $this->db->last_query();
			$res=$this->db->affected_rows();

			$dealerinfo=array(
								'staff_id'		=>		$this->user_id,
								'dealer_id'		=>		$dealer,
								'outlet_id'		=>		$outlet
							 );
			$this->db->insert('staff_dealer',$dealerinfo);

		}
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
				return array('error_message'=>'Sorry,Something went wrong.Please try in a while');
			}
			if($res>0)
			{
			  if($status=='2')
			  	return array('success_message'=>'Staff inserted. You will be active after admin verification');
			  elseif($status=='1')
		  			return array('success_message'=>'Staff inserted Successfully. You can now Login');
			}else{
				return array('error_message'=>'Staff insertion Failed. Please try again');
			}
			
	}
	//update balance in referral account and add referral tranaction
	public function update_referral_balance_and_bonus_records_transaction($referrer_id, $new_user_id)
	{
		$current_date = $this->general->get_local_time('time');
		
		//update referrers bonus
		$this->db->set('balance', 'balance+'.REFER_BONUS, FALSE);
		$this->db->where('id', $referrer_id);
		$this->db->update('members');
		
		//add transaction to transaction table
		$txn_data = array(
		   'user_id' => $referrer_id,		   		
		   'credit_get' => REFER_BONUS,
		   'credit_debit' => 'CREDIT',
		   'transaction_name' => lang('referral_bonus').' :'.$new_user_id,
		   'transaction_date' => $current_date,
		   'transaction_type' => 'referer_bonus',
		   'transaction_status' => 'Completed',
		   'payment_method' => 'direct',
		   'current_balance' => 'current_balance +'.$user_total_balance
			);
	
		$this->db->insert('transaction', $txn_data);
		return $this->db->insert_id(); 	
	}
	
		
	// public function insert_signup_bonus_records_transaction()
	// {
	// 	$invoice = strtotime("now");
	// 	$data = array(
	// 	   'invoice_id' => $invoice,
	// 	   'user_id' => $this->user_id,		   		
	// 	   'credit_get' => SIGNUP_BONUS,
	// 	   'credit_debit' => 'CREDIT',
	// 	   'transaction_type' => 'signup_bonus',
	// 	   'transaction_name' => lang('free_balance_for_signup'),
	// 	   'transaction_date' => $this->general->get_local_time('time'),
	// 	   'transaction_status' => 'Completed',
	// 	   'payment_method' => 'direct',
	// 	   //'current_balance' => SIGNUP_BONUS
	// 	);
	
	// 	$this->db->insert('transaction', $data);
	// 	return $this->db->insert_id(); 
	// }
	

	public function reg_confirmation_email($info,$activation_code)
	{			
		$template_id = 3; // for register_notification
		
		//parse email		
		$user_id=$this->session->userdata(SESSION.'user_id');	
		 $confirm="<a href='".site_url('/user/register/activation/'.$activation_code.'/'.$this->user_id)."'>".site_url('/user/register/activation/'.$activation_code.'/'.$this->user_id)."</a>";

		$parseElement = array(
			"USERNAME"=>$info['userinfo']['name'], 
			"CONFIRM"=>$confirm,
			"SITENAME"=>WEBSITE_NAME
		);	
		
		 $from = CONTACT_EMAIL;
		 $to = $info['userinfo']['email'];

		$this->notification->send_email_notification($template_id, $user_id, $from, $to, '', '', $parseElement, array());
		
		return true;
						
	}
	public function reg_complete_email()
	{			
		$template_id = 1; // for register_notification
		
	
		$parseElement = array(
			"USERNAME"=>$this->input->post('username'), 
			"SITENAME"=>WEBSITE_NAME,
			"EMAIL"=>$this->input->post("email"),
			"PASSWORD"=>$this->input->post('password')
		);	
		
		$from = CONTACT_EMAIL;
		$to = $this->input->post('email', TRUE);

		$this->notification->send_email_notification($template_id, $user_id, $from, $to, '', '', $parseElement, array());
						
	}
	
	
	public function send_welcome_mail_to_new_user($activation_code)
	{
		
		$this->load->library('email');
		
		$config = Array(
			//'protocol' => 'sendmail',
			'protocol' => 'mail',
			'smtp_host' => 'smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'ktmtest2@gmail.com',
			'smtp_pass' => 'admin#123',
			'mailtype'  => 'html', 
			'charset'   => 'utf-8',
			'wordwrap'  =>TRUE,
		);
		//initialize email configurations
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		
			
		$this->load->model('email_model');
		//get subjet & body
		$template = $this->email_model->get_email_template("welcome_email");
		$subject=$template['subject'];
		$emailbody=$template['email_body'];
		
		//check blank value before send message
		if(isset($subject) && isset($emailbody))
		{
			//parse email
			$parseElement = array(
				"FIRSTNAME"=>$this->input->post('first_name'), 
				"SITENAME"=>WEBSITE_NAME,
				"EMAIL"=>$this->input->post("email")
				
			);

			$subject = $this->email_model->parse_email($parseElement,$subject);
			$emailbody = $this->email_model->parse_email($parseElement,$emailbody);
					
			$this->email->to($this->input->post('email', TRUE)); 
			$this->email->from(CONTACT_EMAIL, WEBSITE_NAME);
			$this->email->subject($subject);
			$this->email->message($emailbody); 
			$this->email->send();
			
			/*echo $subject;
			echo "<br>";
			echo $emailbody;
			echo "<br><br><br><br>";
			exit;*/
			//echo $this->email->print_debugger();exit;
		}
	
	}
	
	public function check_user_activation($activation_code,$user_id)
	{
		$query = $this->db->get_where('members',array('activation_code'=>$activation_code,'id'=>$user_id, 'status'=>2));
		
		if ($query->num_rows() > 0) {
            $user_data = $query->row_array();
            $user_id = $user_data['id'];
            //$refer_id=$user_data['referer_id'];

            $data = array('status' => 1);
            $this->db->where('id', $user_id);
            $this->db->update('members', $data);

            $template_id = 1; // for register_notification
		$query=$this->db->get_where('members',array('id'=>$user_id));
		$user=$query->row_array();
		$username=$user['username'];
		$email=$user['email'];

	
		$parseElement = array(
			"USERNAME"=>$username, 
			"SITENAME"=>WEBSITE_NAME,
			"EMAIL"=>$email
		);	
		
		$from = CONTACT_EMAIL;
		$to = $email;

		$this->notification->send_email_notification($template_id, $user_id, $from, $to, '', '', $parseElement, array());

            return TRUE;
        } else {
            return FALSE;
        }
    }	
        public function get_succes_register_message($client){
            $this->db->where('cms_slug',$client);
            $query=$this->db->get('cms');
            if($query->num_rows()==1){
                return $query->row();
            }
        }
	
	public function username_exists($username,$id=false)
	{
		$data = array();
		if($id)
		{

				$this->db->where_not_in('id',$id);
				$query = $this->db->get_where("members",array('AES_DECRYPT(username,salt)'=>$username));
				if ($query->num_rows() > 0) 
				{
					$data=$query->row();				
				}
				  $this->db->last_query();
				$query->free_result();	
				return $data;
			
		}
		else{
			$query = $this->db->get_where("members",array('AES_DECRYPT(username,salt)'=>$username));
			if ($query->num_rows() > 0) 
			{
				$data=$query->row();				
			}
			$query->free_result();	
			return $data;
			}
		
	}
	
	public function email_exists($email,$id=false)
	{
		$data = array();
		if($id)
		{

				$this->db->where_not_in('id',$id);
				$this->db->where_not_in('status','4');
				$query = $this->db->get_where("members",array('AES_DECRYPT(email,salt)'=>$email));
				if ($query->num_rows() > 0) 
				{
					$data=$query->row();				
				}
				  $this->db->last_query();
				$query->free_result();	
				return $data;
			
		}
		else{
			$this->db->where_not_in('status','4');
			$query = $this->db->get_where("members",array('AES_DECRYPT(email,salt)'=>$email));
			if ($query->num_rows() > 0) 
			{
				$data=$query->row();				
			}
			$query->free_result();	
			return $data;
		}
		
	}

	public function imei_exists($imei,$id=false)
	{
		$data = array();
		if($id)
		{
			$this->db->where_not_in('id',$id);
			$query = $this->db->get_where("products",array('imei'=>$imei));
			if ($query->num_rows() > 0) 
			{
				$data=$query->row();				
			}
			  $this->db->last_query();
			$query->free_result();	
			return $data;
		}
		else
		{
			$query = $this->db->get_where("products",array('imei'=>$imei));
			if ($query->num_rows() > 0) 
			{
				$data=$query->row();				
			}
			$query->free_result();	
			return $data;
		}
	}
	
	
	
	function get_captcha()
	{
		$configs = array(
			'word' => strtolower(random_string('alnum', 8)),
			'img_path'     => './captcha/',
			'img_url'	 => base_url().CAPTCHA_PATH,
			'img_width'     => '150',
			'img_height' => 32,
			'char_set' 		=> "ABCDEFGHJKLMNPQRSTUVWXYZ2345689",
			'char_color' 	=> "#000000"
			); 
		$captcha = $this->antispam->get_antispam_image($configs);
		
		$cap=strtolower($captcha['word']); 
				
		$this->session->set_userdata('word',$cap);
		
		return $captcha['image'];
	}	
	
	
	private function delete_old_captcha(){
        /** define the captcha directory **/
        $dir = './'.CAPTCHA_PATH;
        
        /*** cycle through all files in the directory ***/
        foreach (glob($dir."*.jpg") as $file) {
        //echo filemtime($file); echo '<br/>';
        /*** if file is 24 hours (86400 seconds) old then delete it ***/
        if (filemtime($file) < time() - 3600) {
             @unlink($file);
             //echo $file;
            }
        }
    }
	
	
	//function to send test email
	public function send_test_email($subject,$message)
	{
		$this->load->library('email');

		$this->email->from('demo@nepaimpressions.com', 'Pradip');
		//$this->email->to('ktm.test1@gmail.com');		
		$this->email->to('ktm.test1@gmail.com');
		
		$this->email->subject($subject);
		$this->email->message($message); 
		
		$this->email->send();
	}
}
