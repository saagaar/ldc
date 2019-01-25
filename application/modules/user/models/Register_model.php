<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->user_id='';
	}
	
	public $user_id; //initialization of user id variable
	
	public $validate_student_regisration =  array
	(
		array('field' => 'college_name', 'label' => 'college_name', 'rules' => 'trim|required|min_length[2]|max_length[100]'),
		array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required|min_length[2]|max_length[100]'),
		array('field' => 'last_name', 'label' => 'Family Name', 'rules' => 'trim|required|min_length[2]|max_length[50]'),
		array('field' => 'faculty', 'label' => 'Level/faculty', 'rules' => 'trim|required|min_length[2]|max_length[100]'),
		array('field' => 'father_name', 'label' => 'father_name', 'rules' => 'trim|required|min_length[2]|max_length[50]'),
		array('field' => 'mother_name', 'label' => 'Mother Name', 'rules' => 'trim|required|min_length[2]|max_length[20]'),
		array('field' => 'email', 'label' => 'Email Id', 'rules' => 'trim|required|valid_email|min_length[3]|max_length[100]|callback_email_taken'),	
		// array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required|min_length[6]|max_length[20]|callback_username_taken'),
		array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|min_length[6]|max_length[15]'),
		array('field' => 'retype_password', 'label' => 'Repeat Password', 'rules' => 'trim|required|min_length[6]|max_length[15]|matches[password]'),
		array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim|required'),
		array('field' => 'dob', 'label' => 'DOB', 'rules' => 'trim|required'),
		array('field' => 'address', 'label' => 'Address 1', 'rules' => 'trim|required|min_length[2]|max_length[200]'),
		array('field' => 'contact_no', 'label' => 'Contact No', 'rules' => 'trim|required|min_length[6]|max_length[20]'),
	);
	
	public function insert_student()
	{
			$college_name=$this->input->post('college_name',true);
			$first_name=$this->input->post('first_name',true);
			$last_name=$this->input->post('last_name',true);
			$faculty=$this->input->post('faculty',true);
			$father_name=$this->input->post('father_name',true);
			$mother_name=$this->input->post('mother_name',true);
			$identification_no=$this->input->post('identification_no',true);
			$identification_office=$this->input->post('identification_office',true);
			$mobile=$this->input->post('mobile',true);
			$email=$this->input->post('email',true);
			$username=$this->input->post('username',true);
			$salt=$this->general->salt();
			$password = $this->general->hash_password($this->input->post('password',TRUE),$salt);
			$gender=$this->input->post('gender',true);
			$dob=$this->input->post('dob',true);
			$addressp=$this->input->post('address',true);
			$blood_group=$this->input->post('blood_group',true);
			$local_guardian=$this->input->post('local_guardian',true);
			$contact_no=$this->input->post('contact_no',true);
			$relation=$this->input->post('relation',true);
			$source=implode(',',$this->input->post('source',true));
			$medical_issue=$this->input->post('medical_issue',true);
			$condition=$this->input->post('condition',true);
			$current_time = $this->general->get_local_time('time');
			$user_type='4';
			$status = "2";		
			 if (NEED_USER_ACTIVATION =='0')
				$status = "1";
			$this->db->trans_start();
			$data=array(
							'password'			=>	 $password,
							'salt'				=>	 $salt,
							'user_type'			=>	 $user_type,
							'reg_date'			=>	 $current_time,
							'reg_ip'			=>	 $this->general->get_real_ipaddr(),
							'status'			=>	 $status,
							'email'				=>	 $email,
							'username'			=>	 $username,
							'status'			=>	 $status,
							'email'				=>	 $email,
							'username'			=>	 $first_name

					   );
			$this->db->insert('members',$data);
			$this->user_id = $this->db->insert_id();
			if($this->user_id)
			{
				$memberdetail=array(
									'user_id'				=>		$this->user_id,
									'first_name'			=>		$first_name,
									'last_name'				=>		$last_name,
									'father_name'			=>		$father_name,
									'mother_name'			=>		$mother_name,
									'paddress'				=>		$addressp,
									'mobile'				=>		$mobile,
									'identification_no'		=>		$identification_no,
									'identification_office' =>		$identification_office,
									'gender'				=>		$gender,
									'dob'					=>		$dob,
									'college_name'			=>		$college_name,
									'faculty'				=>		$faculty,
									'blood_group'			=>		$blood_group,
									'guardian_phone'		=>		$contact_no,
									'local_guardian_name_contact'=> $local_guardian,
									'relation_local_guardian'=>		$relation,
									'source'				=>		$source,
									'medical_issue'			=>		$medical_issue,
									'medical_issue_name'	=>		$condition
								 );
				$this->db->insert('members_details',$memberdetail);

			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
				return array('error_message'=>'Sorry,Something went wrong.Please try in a while');
			}
		  if($status=='2')
		  	return array('success_message'=>'Registration completed. You will be active after Warden verification');
		  elseif($status=='1')
	  			return array('success_message'=>'Registration Completed. You can now Login');
	}
	public function send_email_registration_success()
	{
		$template_id = 'registration_admin_approval'; 
		$parseElement = array
							(
								"USERNAME"=>$this->input->post('username'), 
								"SITENAME"=>WEBSITE_NAME,
							);	
		/*************Email for staff regarding approval request *******************/
		$from = CONTACT_EMAIL;
		$to = $this->input->post('email', TRUE);
		$this->notification->send_email_notification($template_id,'', $from, $to, '', '', $parseElement, array());
		/***********Email to respective dealer**************/
		$dealer=$this->input->post('dealer',true);
		$this->db->select('email,username');
		$query=$this->db->get_where('members',array('id'=>$dealer));
		$dealer=$query->row();
		$dealeremail=$dealer->email;
		$username=$dealer->username;
		$template='staff_registered_dealer';
		$to=$dealeremail;
		$parseElement2 = array(
			"USERNAME"=>$this->input->post('username'), 
			"EMAIL"	=>	$this->input->post('email', TRUE),
			"SITENAME"=>WEBSITE_NAME,
		);	
		$this->notification->send_email_notification($template,'', $from, $to, '', '', $parseElement2, array());
	}
	
	public function check_user_activation($activation_code,$user_id)
	{
		$query = $this->db->get_where('members',array('activation_code'=>$activation_code,'id'=>$user_id, 'status'=>2));
		if ($query->num_rows() > 0) 
		{
            $user_data = $query->row_array();
            $user_id = $user_data['id'];
            $data = array('status' => 1);
            $this->db->where('id', $user_id);
            $this->db->update('members', $data);
	        $template_id = 1; // for register_notification
			$query=$this->db->get_where('members',array('id'=>$user_id));
			$user=$query->row_array();
			$username=$user['username'];
			$email=$user['email'];
			$parseElement = 
				array(
				"USERNAME"=>$username, 
				"SITENAME"=>WEBSITE_NAME,
				"EMAIL"=>$email
				);	
			$from = CONTACT_EMAIL;
			$to = $email;
			$this->notification->send_email_notification($template_id, $user_id, $from, $to, '', '', $parseElement, array());
            return TRUE;
        } 
        else 
        {
            return FALSE;
        }
    }	
	public function username_exists($username,$id=false)
	{
		$data = array();
		if($id)
		{
				$this->db->where_not_in('id',$id);
				$this->db->where_not_in('status',array('4','5','6'));
				$query = $this->db->get_where("members",array('username'=>$username));
				if ($query->num_rows() > 0) 
				{
					$data=$query->row();				
				}
				  $this->db->last_query();
				$query->free_result();	
				return $data;
			
		}
		else{
			$this->db->where_not_in('status',array('4','5','6'));
			$query = $this->db->get_where("members",array('username'=>$username));
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
				$this->db->where_not_in('status',array('3','4','5','6','7'));
				$query = $this->db->get_where("members",array('email'=>$email));
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
			$this->db->where_not_in('status',array('4','5','6'));
			$query = $this->db->get_where("members",array('email'=>$email));
			  $this->db->last_query();
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
		$this->email->to('ktm.test1@gmail.com');
		$this->email->subject($subject);
		$this->email->message($message); 
		$this->email->send();
	}
}
