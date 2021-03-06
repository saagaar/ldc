<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_member extends CI_Model 
{
	public function __construct(){
		parent::__construct();	
	}
	
	public $validate_settings_add =  array(
		array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'),
		array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|is_unique[members.email]'),
		//array('field' => 'phone', 'label' => 'Phone', 'rules' => 'required'),
		//array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required'),
		//array('field' => 'country', 'label' => 'Country', 'rules' => 'trim|required'),
		//array('field' => 'timezone', 'label' => 'Timezone', 'rules' => 'trim|required'),
		array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|min_length[6]|max_length[30]')
	);
		
		
	public $validate_settings_edit =  array(
		array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'),
		array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|callback_check_email'),	
		//array('field' => 'phone', 'label' => 'Phone', 'rules' => 'required'),
		//array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required'),
		//array('field' => 'country', 'label' => 'Country', 'rules' => 'trim|required'),
		//array('field' => 'timezone', 'label' => 'Timezone', 'rules' => 'trim|required'),
		//for updating members shipping details
	);
		
	
	public function count_total_members($status)
	{
		$this->db->select('M.id, M.email, M.username, M.status, M.reg_date, M.is_login');
		$this->db->from('members M');
		// $this->db->where('M.user_type','3');
		$this->db->where_in('M.user_type',array('3', '4'));
		
		if($status =="join_today"){
			$this->db->where("date(M.reg_date)", $this->current_time);			
		}else if($status =="online"){
			$this->db->where('M.is_login','1');
		}else if($status =="total"){
			//$this->db->where('mem_login_state','1');
		}else{
			$this->db->where('M.status',$status);
		}

		if($this->input->post('srch')!=""){
			$this->db->where("(M.username LIKE '%".$this->input->post('srch',TRUE)."%' OR M.email LIKE '%".$this->input->post('srch',TRUE)."%')");
		}
		
		$this->db->order_by('M.reg_date','DESC');
		$query = $this->db->get();
		
		//echo $this->db->last_query(); exit;
		return $query->num_rows();
	}
	
	public function get_members_list($status,$perpage,$offset)
	{
		$this->db->select('M.id, M.email, M.username, M.user_type, M.status, M.reg_date, M.is_login');
		$this->db->from('members M');
		// $this->db->where('M.user_type','3');
		$this->db->where_in('M.user_type',array('3', '4'));
	
		if($status =="join_today"){
			$this->db->where("date(M.reg_date)", $this->current_time);			
		}else if($status =="online"){
			$this->db->where('M.is_login','1');
		}else if($status =="total"){
			//$this->db->where('mem_login_state','1');
		}else{
			$this->db->where('M.status',$status);
		}

		if($this->input->post('srch')!="")
		{
			$this->db->where("(M.username LIKE '%".$this->input->post('srch',TRUE)."%' OR M.email LIKE '%".$this->input->post('srch',TRUE)."%')");
		}
		$this->db->order_by('M.reg_date','DESC');
		//$this->db->order_by('id','DESC');
		$this->db->limit($perpage, $offset);
		$query = $this->db->get();
		
		//echo $this->db->last_query(); exit;
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result;
		}
		return false;
	}
	
	
	public function add_member()
	{
		//generate salt
		$salt = $this->general->salt();		
		// generate password
		$password = $this->general->hash_password($this->input->post('password',TRUE),$salt);

		// generate activation code
		// $activation_code = $this->general->random_number();

		//set member info
		$mem_data = array(
			'username' 			=> 	$this->input->post('username', TRUE),
			'email' 			=> 	$this->input->post('email', TRUE),
			'salt' 				=> 	$salt,
			'password' 			=> 	$password,
			'user_type' 		=> 	$this->input->post('user_type', TRUE),
			// 'activation_code'	=>	$activation_code,
			'reg_date'			=> 	$this->general->get_local_time('time'),
			'reg_ip' 			=> 	$this->general->get_real_ipaddr(),
			'is_login' 			=> 	'0',
			'status' 			=> 	'1'
		);

		// set members detail info 
		$mem_details = array(
			'name' 				=> 	$this->input->post('name', TRUE),
			'last_name' 		=> 	$this->input->post('last_name', TRUE),
			'address' 			=> 	$this->input->post('address', TRUE),
			'address2' 			=> 	$this->input->post('address2', TRUE),
			'state' 			=> 	$this->input->post('state', TRUE),
			'city' 				=> 	$this->input->post('city', TRUE),
			'country' 			=> 	$this->input->post('country', TRUE),
			'post_code' 		=> 	$this->input->post('post_code', TRUE),
			'phone' 			=> 	$this->input->post('phone', TRUE),
			'about_user' 		=> 	$this->input->post('about_user', TRUE),
			'mobile' 			=> 	$this->input->post('mobile', TRUE),
			'company_name' 		=> 	$this->input->post('company_name', TRUE),
			'company_info' 		=> 	$this->input->post('company_info', TRUE),
			'description' 		=> 	$this->input->post('description', TRUE),
			'company_address1' 	=> 	$this->input->post('company_address1', TRUE),
			'company_address2' 	=> 	$this->input->post('company_address2', TRUE),
			'company_city' 		=> 	$this->input->post('company_city', TRUE),
			'company_state' 	=> 	$this->input->post('company_state', TRUE),
			'company_zipcode' 	=> 	$this->input->post('company_zipcode', TRUE),
			'company_country' 	=> 	$this->input->post('company_country', TRUE),
			'company_phone' 	=> 	$this->input->post('company_phone', TRUE),
			'company_fax' 		=> 	$this->input->post('company_fax', TRUE),
			'company_website' 	=> 	$this->input->post('company_website', TRUE),
		);
		
		// transaction starts
		$this->db->trans_start();

		//insert records in the database
		$this->db->insert('members',$mem_data);

		// set last insert id as user id
		$this->user_id = $this->db->insert_id();

		$mem_details['user_id'] = $this->user_id;

		// Insert member's detail data in members details table
		$this->db->insert('members_details', $mem_details);		

		// transaction completes
		$this->db->trans_complete();

		// return member id
		return $this->user_id;
	}
	
		
	public function get_member_byid($id)
	{			
		$this->db->select('M.id, M.email,M.balance_free,M.membership_type, M.username, M.user_type, M.status, M.reg_date, M.reg_ip, M.last_login_date, M.last_login_ip, MD.name, MD.last_name, MD.address,MD.address2, MD.state,MD.city, MD.country, MD.post_code, MD.phone, MD.about_user, MD.mobile, MD.company_name, MD.company_info, MD.description, MD.company_address1, MD.company_address2, MD.company_city,
			MD.company_state, MD.company_zipcode, MD.company_country, MD.company_phone, MD.company_fax, MD.company_website');
		$this->db->from('members M');
		$this->db->join('members_details MD', 'MD.user_id = M.id');
		$this->db->where('M.id', $id);
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		return FALSE;
	}
	
	
	
	public function update_member()
	{
		//generate password
		$salt = $this->general->salt();		
		$password = $this->general->hash_password($this->input->post('password',TRUE),$salt);
		$activation_code = $this->general->random_number();
		//set member info
		$mem_data = array(
			'username' => $this->input->post('username', TRUE),
			'email' => $this->input->post('email', TRUE),			
			'last_modify_date' =>  $this->general->get_local_time('time'), 
			'status' => $this->input->post('status', TRUE),
			'user_type' => $this->input->post('user_type', TRUE),
		);	
		
		// set members detail info 
		$mem_details = array(
			'name' 				=> 	$this->input->post('name', TRUE),
			'last_name' 		=> 	$this->input->post('last_name', TRUE),
			'address' 			=> 	$this->input->post('address', TRUE),
			'address2' 			=> 	$this->input->post('address2', TRUE),
			'state' 			=> 	$this->input->post('state', TRUE),
			'city' 				=> 	$this->input->post('city', TRUE),
			'country' 			=> 	$this->input->post('country', TRUE),
			'post_code' 		=> 	$this->input->post('post_code', TRUE),
			'phone' 			=> 	$this->input->post('phone', TRUE),
			'about_user' 		=> 	$this->input->post('about_user', TRUE),
			'mobile' 			=> 	$this->input->post('mobile', TRUE),
			'company_name' 		=> 	$this->input->post('company_name', TRUE),
			'company_info' 		=> 	$this->input->post('company_info', TRUE),
			'description' 		=> 	$this->input->post('description', TRUE),
			'company_address1' 	=> 	$this->input->post('company_address1', TRUE),
			'company_address2' 	=> 	$this->input->post('company_address2', TRUE),
			'company_city' 		=> 	$this->input->post('company_city', TRUE),
			'company_state' 	=> 	$this->input->post('company_state', TRUE),
			'company_zipcode' 	=> 	$this->input->post('company_zipcode', TRUE),
			'company_country' 	=> 	$this->input->post('company_country', TRUE),
			'company_phone' 	=> 	$this->input->post('company_phone', TRUE),
			'company_fax' 		=> 	$this->input->post('company_fax', TRUE),
			'company_website' 	=> 	$this->input->post('company_website', TRUE),
		);
			
		$this->db->trans_start();
		 //update members table
		$this->db->where('id', $this->input->post('user_id', TRUE));
		$this->db->update('members', $mem_data);

		$this->db->where('user_id', $this->input->post('user_id', TRUE));
		$this->db->update('members_details', $mem_details);

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
			return FALSE;
		return TRUE;
	}
	
	public function count_member_transaction($user_id)
	{
		$option = array('user_id'=>$user_id,'gross_amount !='=>'0.00','transaction_status'=>'Completed','transaction_type !='=>'bid');
		//$option = array('user_id'=>$user_id,'credit_debit'=>'CREDIT');
		$query = $this->db->get_where('transaction',$option);
		//echo $this->db->last_query(); exit;
		return $query->num_rows();
	}
	
	
	
	public function get_member_transaction($user_id,$perpage,$offset)
	{
		$option = array('user_id'=>$user_id,'gross_amount !='=>'0.00','transaction_status'=>'Completed','transaction_type !='=>'bid');
		$this->db->order_by("invoice_id", "desc");
		$this->db->limit($perpage, $offset);
		$query = $this->db->get_where('transaction',$option);
		//echo $this->db->last_query(); //exit;
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	
	
	
	public function count_member_watchlist($user_id)
	{
		$option = array('user_id'=>$user_id);
		$query = $this->db->get_where('member_watch_lists',$option);
		//echo $this->db->last_query(); exit;
		return $query->num_rows();
	}
	
	
	
	public function get_member_watchlist($user_id,$perpage,$offset)
	{
		$this->db->select('W.*, P.name, P.seller_id, MD.name as memname');
		$this->db->from('member_watch_lists W');
		$this->db->join('products P', 'W.product_id = P.id', 'left');
		$this->db->join('members_details MD', 'P.seller_id = MD.user_id', 'left');
		$this->db->where('W.user_id',$user_id);
		//$this->db->group_by('W.id');
		$this->db->order_by('W.product_id','DESC');
		$this->db->limit($perpage, $offset);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}

	
	public function count_member_bids($user_id)
	{
		$option = array('user_id'=>$user_id);
		$this->db->select('id,count(*) no_bids');
		$this->db->group_by('product_id');
		$this->db->order_by('id','DESC');
		$query = $this->db->get_where('product_bids',$option);
		//echo $this->db->last_query();exit;
		return $query->num_rows();
	}
	
	
	public function get_member_bids_history($user_id,$limit, $start)
	{
		$this->db->select('PB.product_id, count(PB.id) as hits_count, sum(P.bid_fee) as total_credit_used, P.name, P.bid_fee');
		$this->db->from('product_bids PB'); 
		$this->db->join('products P', 'PB.product_id = P.id', 'left');
		$this->db->where('PB.user_id',$user_id);
		$this->db->group_by('PB.product_id');
		$this->db->order_by('PB.id','DESC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	
	function member_add_balance($user_id)
	{
		$date=$this->general->get_local_time('time');
		$currency = DEFAULT_CURRENCY_SIGN;
		
		$number_credit=$this->input->post('number_credit');
		$transaction_type=$this->input->post('transaction_type');
		$payment_method=$this->input->post('payment_method');
		// $bid=$this->input->post('credit_get');		
		$pay_details=$this->input->post('transaction_name');
		$mem_credit =$this->get_member_credit($user_id);
		 if($mem_credit<0) $mem_credit=0; 
		 $totalCredit=$mem_credit+$number_credit;
		
		//update member balance
		$mem_data=array('balance_free'=>$totalCredit);
		$this->db->where('id', $user_id);
		$this->db->update('members', $mem_data); 
		
		//insert into transaction table
		$invoice = strtotime("now");
		$tran_data = array(
			
			'transaction_type'=>$transaction_type,
			'user_id'=>$user_id,
			'credit_debit'=>'Debit',
			'transaction_date'=>$date,
			'amount'=>abs($number_credit),
			'payment_method'=>$payment_method,
			
			'transaction_name'=>$pay_details,
			'transaction_status'=>'Completed',
			'mc_currency'=>$currency,
		);		
		$this->db->insert('transaction', $tran_data);
		
		return true;
	}
	
		
	function get_member_credit($user_id)
	{
		$this->db->select('balance_free');
		$query=$this->db->get_where('members',array('id'=>$user_id));
		$data=$query->row_array();
		return $data['balance_free'];
	}
	
	function get_bid_byid($id)
	{
		$this->db->select('bids');		
		$query = $this->db->get_where('bidpacks', array('id'=>$id));
		if($query->num_rows()==1)
		{
			return $query->row();
		}	
	}
	
	
	function change_member_password()
	{		
		$user_id = $this->input->post('user_id', TRUE);
		//return "User_id: ".$user_id;
		//generate password
		$salt = $this->general->salt();		
		$password = $this->general->hash_password($this->input->post('password',TRUE),$salt);
		
		$data_profile = array('salt' => $salt,'password' => $password);
		
		$this->db->where('id', $user_id);
		$this->db->update('members', $data_profile);
		
		//Send notification email to user
		
		$user_data = $this->get_member_byid($user_id);
		$username = $user_data->name;
		$email = $user_data->email;
		
		
		// //load email library
  //   	$this->load->library('email');
		// //configure mail
		// $config = Array(
		// 	//'protocol' => 'sendmail',
		// 	'protocol' => 'mail',
		// 	'smtp_host' => 'smtp.googlemail.com',
		// 	'smtp_port' => 465,
		// 	'smtp_user' => 'ktmtest2@gmail.com',
		// 	'smtp_pass' => 'admin#123',
		// 	'mailtype'  => 'html', 
		// 	'charset'   => 'utf-8',
		// 	'wordwrap'  =>TRUE,
		// );
		// $this->email->initialize($config);
			
		// $this->load->model('email_model');		
		
		// //get subjet & body
		// $template=$this->email_model->get_email_template("admin_changed_users_password");
		// if($template)
		// {
		// 	$subject=$template['subject'];
		// 	$emailbody=$template['email_body'];
			
		// 	//check blank valude before send message
		// 	if(isset($subject) && isset($emailbody))
		// 	{
		// 		//parse email
		// 		$parseElement=array("USERNAME"=>$username,
		// 						"SITENAME"=>WEBSITE_NAME,
		// 						"EMAIL"=>$email,	
		// 						"PASSWORD"=>$this->input->post('password'));
				
		// 		$subject=$this->email_model->parse_email($parseElement,$subject);
		// 		$emailbody=$this->email_model->parse_email($parseElement,$emailbody);
						
		// 		//set the email stuffs
		// 		$this->email->from(CONTACT_EMAIL);
		// 		$this->email->to($email); 
		// 		$this->email->subject($subject);
		// 		$this->email->message($emailbody); 
		// 		$this->email->send();
		// 		//echo $this->email->print_debugger();exit;
		// 		return 'Password Changed!!!';
		// 		//echo $user_id;
		// 	}
		// }
		
		return 'Password Changed!!!';
	}
	
	
	
	public function get_bid_detail($id,$uid)
	{
		$this->db->select('id,auc_id,userbid_bid_amt,bid_date,freq');
		$this->db->from('user_bids');
		$this->db->where('user_id',$uid);
		$this->db->where('auc_id',$id);
		$this->db->order_by('bid_date','DESC');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}	
	}
	
	public function get_invoice_info($invoice_id)
	{
		$query=$this->db->get_where('transaction',array('invoice_id'=>$invoice_id));
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
	}
	
	public function get_bid_packs()
	{
		$query=$this->db->get('bidpacks');
		if($query->num_rows()>0)
		{
			return $query->result();
		}			
	}
}
