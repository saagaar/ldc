<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}

	public $validate_feedback_staff =  array(				
		array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|min_length[6]|max_length[100]'),
		array('field' => 'feedback_type', 'label' => 'Please select option', 'rules' => 'trim|required'),
		array('field' => 'feedback', 'label' => 'Feedback', 'rules' => 'trim|required|max_length[500]'),
	);

	public $validate_feedback_userid= array(
         array('field' => 'feedback_type', 'label' => 'Please select option', 'rules' => 'trim|required'),
		 array('field' => 'feedback', 'label' => 'Feedback', 'rules' => 'trim|required|max_length[500]'),
		);
	 public $validate_contact_us=array(
        array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|min_length[6]|max_length[100]'),
        array('field' => 'subject', 'label' => 'Subject', 'rules' => 'trim|required|max_length[100]'),
        array('field' => 'message', 'label' => 'Message', 'rules' => 'trim|required|max_length[100]'),
        array('field' => 'name', 'label' => 'name', 'rules' => 'trim|required|max_length[100]')
    );
	
	
	public function get_seller_info_by_member_id($user_id){
		$this->db->select('M.id, M.name, M.email, M.username, M.reg_date, M.image, M.cover_image, M.city, M.country, SA.shop_url , SA.facebook_url, SA.twitter_url, SA.pinterest_url, MA.state, C.country');
		$this->db->from('members M');
		$this->db->join('seller_attributes SA','M.id=SA.user_id','LEFT');
		$this->db->join('members_address MA','SA.user_id=MA.user_id','LEFT');
		$this->db->join('country C','MA.country=C.id','LEFT');
		$this->db->where('M.id',$user_id);
		//$this->db->where('MA.is_mailing_address','yes');
		//$this->db->where('user_type','3');
		$query = $this->db->get('');
		//echo $this->db->last_query(); exit;
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
	}
	
	
	public function get_sellers_upcoming_items($user_id){
		$this->db->select('P.id as product_id, P.product_code, P.start_bid, P.buy_now, P.buy_now_quantity, P.buy_now_price, A.order as auction_order, HA.id as host_id, HA.host_name, HA.start_date_time, PIMG.image');
		
		$this->db->from('host_auctions HA');
		$this->db->join('auctions A','HA.id=A.host_id');
		
		/*$this->db->from('auctions A');
		$this->db->join('host_auctions HA','A.host_id=HA.id');*/
		
		$this->db->join('products P','A.product_id=P.id');
		$this->db->join('product_images PIMG','P.id=PIMG.product_id');
		$this->db->where('HA.start_date_time >',$this->current_date);
		$this->db->where('HA.host_status','1');
		$this->db->where('P.status','2');
		$this->db->where('P.seller_id',$user_id);
		$this->db->order_by('A.order','ASC');
		$this->db->group_by("HA.id");
		$query = $this->db->get();
		//echo $this->db->last_query(); //exit;
		if($query->num_rows()>0){
			return $query->result();
		}
		return false;
	}
	
	
	public function get_sellers_store_items($seller_id){
		$this->db->select('P.id as product_id, P.product_code, P.name, P.buy_now, P.buy_now_quantity, P.buy_now_price, PIMG.image');
		$this->db->from('products P');
		$this->db->join('product_images PIMG','P.id=PIMG.product_id');
		$this->db->where("(P.status ='1' OR P.status='2' )");
		$this->db->where('P.seller_id',$seller_id);
		$this->db->where('P.buy_now','1');
		$this->db->where('P.buy_now_quantity > ','P.order_quantity');
		$this->db->group_by("P.id");
		$query = $this->db->get();
		//echo $this->db->last_query(); //exit;
		if($query->num_rows()>0){
			return $query->result();
		}
		return false;
	}
	
	
	public function change_profile_image($user_id)
	{
		//Upload image if file input is found and user id is not empty
		if($_FILES && $user_id)
		{
			//make file settins and do upload it
			$image_name = $this->file_settings_do_upload('profile_picture', USER_IMAGE_PATH, 'encrypt');
			//print_r($image1_name); exit;
			if($image_name['file_name'])
			{				
				//echo $image1_name['file_name']; exit;
				$this->image_name_path = $image_name['file_name'];
				//resize image
				$this->resize_image(USER_IMAGE_PATH,$this->image_name_path,$image_name['raw_name'].$image_name['file_ext'],100,80);
				//now remove old image
				@unlink(USER_IMAGE_PATH.$this->input->post('old_file'));
				
				//supdate 
				$this->update_members_selected_fields(array('image'=>$this->image_name_path), array('id'=>$user_id));
				return TRUE;
			}	
		}
		return FALSE;
	}
	
	
	public function file_settings_do_upload($file, $location, $encrypt_filename='')
 	{
		$config['upload_path'] = './'.$location;   //file upload location
		$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
		$config['remove_spaces'] = TRUE;  
		$config['max_size'] = '5000';
		$config['max_width'] = '2000';
		$config['max_height'] = '2000';
		if($encrypt_filename='encrypt')
		{
			//$config['file_name'] = $new_file_name;
			$config['encrypt_name'] = TRUE;
		}
		$this->upload->initialize($config);
		//print_r($_FILES);
		
		$this->upload->do_upload($file);
		if($this->upload->display_errors()){
			$this->error_img = $this->upload->display_errors();
			//echo $this->error_img;
			return false;
		}else{
			$data = $this->upload->data();
			return $data;
		}
	}
	
	
	//function to resize images
	public function resize_image($location,$source_image,$new_image,$width,$height)
	{
		//echo "#Location :".$location.' #$original file : '.$source_image.' New file name :'.$new_image.' #width :'.$width.' #height'.$height;
		//echo './'.$location.$source_image;
		
        $config['image_library'] = 'gd2';
		$config['source_image'] = './'.$location.$source_image;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;
		$config['master_dim'] = 'width';
		$config['new_image'] = './'.$location.$new_image;
		
		$this->image_lib->initialize($config);
		$resize = $this->image_lib->resize();
		//var_dump($resize);
		//echo $this->image_lib->display_errors();
		// $this->image_lib->clear(); 
	}
	
	
	public function update_members_selected_fields($fields, $where)
	{
		$update = $this->db->update('members',$fields, $where);
		if($update){return true;}else {return false;}
	}
	
	
	public function insert_contact_message(){
		$current_time = $this->general->get_local_time('time');
		$data = array(
			'sender'=>$this->input->post('sender',TRUE),
			'receiver'=>$this->input->post('receiver',TRUE),
			'subject'=>'Feedback from profile page',
			'message'=>$this->input->post('message',TRUE),
			'date'=>$current_time
		);
		
		$query = $this->db->insert('communication',$data);
		if($query){return true;	}else{ return false; }
	}
	
	public function get_host_details_by_host_id($host_id){
		$this->db->select('HA.*, M.name as seller_name');
		$this->db->from('host_auctions HA');
		$this->db->join('members M','HA.seller_id=M.id');
		//$this->db->join('members M','HA.seller_id=M.id');
		$this->db->where('HA.id',$host_id);
		$query = $this->db->get('host_auctions');
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
	}
	
	public function get_host_auctions_co_sellers_by_host_id($host_id){
		$this->db->select('M.id, M.name, COUNT(A.id) as total_auctions, COUNT(CASE WHEN P.status = "3" THEN 1 END) AS closed_auction');
		$this->db->from('auctions A');
		$this->db->join('products P','A.product_id=P.id','LEFT');
		$this->db->join('members M','P.seller_id=M.id','LEFT');
		$this->db->where('A.host_id',$host_id);
		$this->db->where('A.type','cohost');
		$this->db->group_by('P.seller_id');
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows()>0){
			return $query->result();	
		}
		return false;
	}
	
	public function get_auctions_in_host_by_host_id($host_id){
		$this->db->select('P.id as product_id, P.product_code, P.name as product_name, P.description as product_description, P.buy_now, P.buy_now_quantity, P.buy_now_price, PIMG.image as product_image, P.start_bid, A.order');
		$this->db->from('auctions A');
		$this->db->join('products P','A.product_id=P.id','LEFT');
		$this->db->join('product_images PIMG','P.id=PIMG.product_id','LEFT');
		$this->db->where('A.host_id',$host_id);
		$this->db->order_by('A.order','ASC');
		$this->db->group_by('P.id');
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();	
		}
		return false;	
	}
	
	
	public function insert_host_terms_accepted_by_cohost($seller_id, $host_id){
		$data = array('seller_id'=>$seller_id,'host_id'=>$host_id);
		$query = $this->db->insert('cohost_accept_terms',$data);
		return $this->db->insert_id();
	}
	



	//define by suzan

	public function file_setting_do_upload($file)
	{				
		$config['upload_path'] = './'.FILE_PATH;//define in constants

			$config['allowed_types'] = 'PDF|pdf|jpg|png|PNG';
		
		$config['encrypt_name'] = TRUE;
		$config['remove_spaces'] = TRUE;		
		$config['max_size'] = '1100';
		$config['max_width'] = '2000';
		$config['max_height'] = '1500';
		//print_r($config);exit;
		$this->upload->initialize($config);
		
		$this->upload->do_upload($file);
		if($this->upload->display_errors())
		{
			echo "wrong upload type"; exit;
			$this->error_img = $this->upload->display_errors();
			return false;
		}
		else
		{
			$data = $this->upload->data();
			return $data;
		}				
	}
	
	
	public function upload_file()
	{
		
		$image_error = FALSE;
		if(($_FILES) || (!empty($_FILES['file_source']['name'])))
		{
			//make file settins and do upload it
			$image1_name = $this->file_setting_do_upload('file_source');
			
            if ($image1_name['file_name'])
            {
				$this->image_name = $image1_name['file_name'];
            }
            else
            {
		
			   $image_error = TRUE;
               $this->session->set_flashdata('error_img1',$this->error_img);
            }
		}
		
		// Upload image 2
		return $image_error;
	}
  public function send_email() {
      	if($this->session->userdata(SESSION . 'user_id')){
        $from = $this->general->get_user_mail($this->session->userdata(SESSION . 'user_id'));
      
		    }else{
		    	$from=$this->input->post('email');
		    }
        $cc = '';
        $bcc = '';
        
        if($this->input->post('contact_us')=='contact_us'){
            $subject=$this->input->post('subject');
            $message = $this->input->post('message');
        }else{
            $subject = $this->input->post('feedback_type') . "" . "feedback";
            $message = $this->input->post('feedback');
        }
        $emailto = $this->input->post('feedback_type');
        if ($emailto == 'technical') {
            $to =FEEDBACK_ADMIN_EMAIL;
        } else if ($emailto == 'staff' || $emailto == 'customer') {
            $to =FEED_BACK_CONTACT_EMAIL;
       }

        $body = '';
        
        if($this->image_name){
        $attachments = array(
            'path' => FILE_PATH,
            'name' => $this->image_name
        );
        }else{
            $attachments='';
        }

        $this->notification->send_email_direct($from, $to, $cc, $bcc, $subject, $body, $message, $attachments);
        return true;
    }

    //for inserting feedback attributes
    public function add_feedback() {
    //echo "asdf";exit;
        $userid = null;
        $current_time = $this->general->get_local_time('time');
        if ($this->session->userdata(SESSION . 'user_id')) {
            $userid = $this->session->userdata(SESSION . 'user_id');
            $userdetail = $this->general->get_user_details($userid);
            $email = $userdetail->email;
            $data['user_id']=$userid;
        } else {
            $email = $this->input->post('email', true);
        }
        $this->image_name = '';
        if (isset($_FILES['file_source']['name']) && $_FILES['file_source']['name'] != '') {
          
//        if($_FILES){
            $upload_result = $this->upload_file('file_source');
        }
        
        
        
        if(!$this->input->post('contact_us')){
            $data = array(
            'email' => $email,
            'feedback_type' => $this->input->post('feedback_type', TRUE),
            'description' => $this->input->post('feedback', TRUE),
            'attachments' => $this->image_name,
            'date' => $current_time
        );
            $query = $this->db->insert('feedback', $data);
        }
        
        
        $email = $this->send_email();
        if ($query || $email) { 
            return true;
        } else {
            return false;
        }
    }

	
	
}