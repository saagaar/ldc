<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_module extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();
		
	}
	
	public $validate_settings =  array(				
		array('field' => 'username', 'label' => 'User Id', 'rules' => 'trim|required|max_length[100]'),
		array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|min_length[6]|max_length[15]')
	);
	public $validate_settings_student =  array(				
		array('field' => 'username', 'label' => 'Email', 'rules' => 'trim|required|max_length[100]'),
		array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|min_length[6]|max_length[15]')
	);
	public $validate_rules_reset_password = array(
		array('field' => 'password' , 'label' => 'New Password' , 'rules' => 'required|min_length[6]|max_length[20]'),
		array('field' => 'repassword' , 'label' => 'New Password Confirmation' , 'rules' => 'required|min_length[6]|max_length[20]|matches[password]'),
	);

	public function check_email()
	{
		$options = array('email'=>$this->input->post('email',TRUE));
        $query = $this->db->get_where('members',$options);
		return $query->num_rows();
	}

	public function get_user_by_email($email)
	{
		$options = array('AES_DECRYPT(email,salt)'=>$email);
		$this->db->select('*,AES_DECRYPT(email,salt) as email');
        $query = $this->db->get_where('members',$options);
		if($query->num_rows()>0)
		{
            return $query->row();
        }
        else
        {
            return FALSE;
        }
	}
	
	public function send_forget_password_link($user_id, $email,$user_type)
	{

		$template_id ='forget_password';
		// $this->load->model('email_model');
		//get subjet & body
		// $template = $this->email_model->get_email_template("send_password_reset_link");
		if($template_id)
		{

			$activation_key = $this->generate_password_activation_code($user_id, $email);	
			$encoded_email = base64_encode($email);				
			$reset_link = "<a href='".site_url('/user/login/reset_password/'.$user_type).'/?key='.urlencode($activation_key).'&auth='.urlencode($encoded_email)."'>".site_url('/user/login/reset_password/'.$user_type).'/?key='.urlencode($activation_key).'&auth='.urlencode($encoded_email)."</a>";
			$parseElement=array(

									"CONFIRM"		=>	$reset_link,
									"SITENAME"		=>	WEBSITE_NAME
								);


			$from=SYSTEM_EMAIL;
			$to=$email;
			$response=$this->notification->send_email_notification($template_id, '', $from, $to, '', '', $parseElement, array());	
			return true;
		}
		else 
		{
			return FALSE;
		}
	}
	
	
	
	public function generate_password_activation_code($id,$email){
        /*The activation code is only valid for next 24hrs
         * +24 hours   = for next 24 hrs
         * +6 hours    = for next 6 hrs
         */
        
     
        $this->load->helper('string');
        
        $data = array(
            'forgot_password_code' => random_string('unique'),
            'forgot_password_code_expire' => date('Y-m-d H:i:s',strtotime("+24 hours"))
        ); 
        $this->db->update('members', $data, array('id' => $id,'aes_decrypt(email,salt)' => $email));
       $this->db->last_query();
        return $data['forgot_password_code'];
    }
	
	
	 public function is_user_ready_reset_password($email,$code){
        $this->db->select('forgot_password_code_expire');
        $query = $this->db->get_where('members', array('forgot_password_code' => $code, 'aes_decrypt(email,salt)' => $email));
       $this->db->last_query();
        if($query->num_rows()>0){
            return $query->row();
        }
        else{
            return FALSE;
        }
    }
	
	
	public function change_users_password($email){
		$password_tmp  = $this->input->post('password');
		$uuser=$this->general->get_single_row('members',array('aes_decrypt(email,salt)' => $email));
		// Create a random salt
			
		$password = $this->general->hash_password($password_tmp, $uuser->salt);
        
        $data = array(
            'password' => $password,
            'salt' => $uuser->salt,
            'forgot_password_code' => '',
			'forgot_password_code_expire' => '0000-00-00 00:00:00',
        );
        
        $this->db->update('members', $data,array('id' => $uuser->id));
        return $this->db->affected_rows();
    }















	
	
	
	
	
}
