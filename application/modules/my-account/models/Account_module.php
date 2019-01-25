<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_module extends CI_Model
{
	public function __construct() 
	{
		parent::__construct();
		$this->image_name_path='';
	}

//validation for add/edit product in inventory
	public $validate_campaign_creation =  array(	
		array('field' => 'name', 'label' => 'Campaign Title', 'rules' => 'trim|required|min_length[2]|max_length[100]'),
		array('field' => 'description', 'label' => 'Description', 'rules' => 'trim|required|min_length[2]|max_length[300]'),
		array('field' => 'product_url', 'label' => 'Product URL', 'rules' => 'trim|required'),
		array('field' => 'price_range', 'label' => 'Price Range', 'rules' => 'trim|required'),
		array('field' => 'category', 'label' => 'Category', 'rules' => 'trim|required'),
		array('field' => 'submission_deadline', 'label' => 'Submission Deadline', 'rules' => 'trim|required'),
		

	);

//validation rules for change password
	public $validate_changepassword = array(
		array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required'),
		array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'trim|required|min_length[6]|max_length[20]'),
		array('field' => 're_new_password', 'label' => 'Confirm New Password', 'rules' => 'required|matches[new_password]'),	
	);	
	public $validate_generalsettings=array(
	 	array('field' => 'company_name', 'label' => 'Company Name', 'rules' => 'trim|required|min_length[2]|max_length[100]'),
		array('field' => 'company_website', 'label' => 'Company Website', 'rules' => 'trim|required|min_length[2]|max_length[300]'),
		array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required'),
		array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim|required'),
		array('field' => 'phone', 'label' => 'Phone', 'rules' => 'trim|required'),
		array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
	 );
	public $validate_address=array(
	 	array('field' => 'company_address1', 'label' => 'Street Name 1', 'rules' => 'trim|required|min_length[2]|max_length[100]'),
		array('field' => 'company_address2', 'label' => 'Street Name 2', 'rules' => 'trim|required|min_length[2]|max_length[100]'),
		array('field' => 'company_city', 'label' => 'City', 'rules' => 'trim|required|min_length[2]|max_length[50]'),
		array('field' => 'company_state', 'label' => 'State', 'rules' => 'trim|required|min_length[2]|max_length[50]'),
		array('field' => 'company_zipcode', 'label' => 'Zip Code', 'rules' => 'trim|required|min_length[2]|max_length[10]'),
		array('field' => 'company_country', 'label' => 'Country', 'rules' => 'trim|required'),
	 );
	public $validate_communication=array(
	 	array('field' => 'message', 'label' => 'Message', 'rules' => 'trim|required|max_length[200]')
	 );
	
	
	public function get_model_by_id($id)
	{
		$query=$this->db->get_where('model',array('id'=>$id,'status'=>'1'));
		if($query->num_rows()>0){
			return $query->row();
		}
		else return false;
	}
	public function save_feedback_form()
	{
		$email=$this->input->post('email',true);
		$type=$this->input->post('type',true);
		$description=$this->input->post('description',true);

	}
	//	 get member detail
	public function get_members_details($user_id='')
	{
		if($user_id!='')
		{
			$this->db->where('id',$user_id);
		}
		$query = $this->db->get('members');
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		return FALSE;
	}

	
	// public function insert_new_product($product_id=false)
	// {
	// 	$socialmediaid=explode(',',$this->input->post('brandmediaid',true));
	// 	$name=$this->input->post('name',TRUE);
	// 	$description=$this->input->post('description',TRUE);
	// 	$create_type=$this->input->post('create_type',TRUE);
	// 	$product_url=$this->input->post('product_url',TRUE);
	// 	$price_range=$this->input->post('price_range',TRUE);
	// 	$category_id=$this->input->post('category',TRUE);
	// 	$objective=$this->input->post('objective',TRUE);
	// 	$save_method=$this->input->post('save_method',TRUE);
	// 	if(!$category_id) $category_id=0;

	// 	$submission_deadline=$this->input->post('submission_deadline',TRUE);
	// 	$least_fan_count=$this->input->post('least_fan_count');
	// 	// $description=$this->input->post('description',TRUE);
	// 	$user_id = $this->session->userdata(SESSION.'user_id');
	// 	$product_code = strtotime('now').$user_id;		
	// 	$product_data = array(
			
	// 		'cat_id' 				=> $category_id,
	// 		'brand_id' 				=> $user_id,
	// 		'name' 					=> $name,
	// 		'description' 			=> $description,
	// 		'product_url' 			=> $product_url,	
	// 		'submission_deadline'	=> $submission_deadline,
	// 		'price_range'			=> isset($price_range)?$price_range:0,
	// 		'least_fan_count'		=> $least_fan_count,
	// 		'create_type'			=> $create_type,
	// 		'save_method'			=> $save_method,

			
	// 	);
	// 	$this->db->trans_start();
	// 	if($product_id)
	// 	{

	// 		$product_data['update_date']=$this->general->get_local_time('time');
	// 		$this->general->update_data('products',$product_data,array('id'=>$product_id));
	// 		if($_FILES['uploadimage']['name'])
	// 			{
	// 				$fdata=$this->file_settings_do_upload('uploadimage',PRODUCT_IMAGE_PATH,'encrypt');
	// 				if($fdata){
						
						
	// 					$imagearr=array(
	// 									'image'			=>  $fdata['file_name']
	// 									);
	// 					$this->db->update('product_images',$imagearr,array('product_id'=>$product_id));
	// 				}
	// 				else{
	// 					return array('error'=>$this->error_img);
	// 				}

	// 			}
	// 	}else{
	// 			if(AUCTION_POST_ACTIVATION == '1')
	// 			{
	// 				$product_data['status'] = '1'; // pending
	// 			}
	// 			else
	// 			{
	// 				$product_data['status'] = '2'; // activated		
					
	// 			}
	// 			$product_data['post_date']=$this->general->get_local_time('time');
	// 			$product_data['product_code']=$product_code;
	// 			$this->general->insert_data('products',$product_data);
	// 			$product_id = $this->db->insert_id();
	// 			if($_FILES)
	// 			{
	// 				$fdata=$this->file_settings_do_upload('uploadimage',PRODUCT_IMAGE_PATH,'encrypt');
	// 				if($fdata){
						
						
	// 					$imagearr=array(
	// 									'product_id'	=>	$product_id,
	// 									'image'			=>  $fdata['file_name']
	// 									);
	// 					$this->db->insert('product_images',$imagearr);
	// 				}
	// 				else{
	// 					return array('error'=>$this->error_img);
	// 				}

	// 			}
	// 		}
		
	// 		if(isset($_POST['brandmediaid']) && !empty($_POST['brandmediaid']))
	// 		{
	// 				$productsocialmedia=array();

	// 				$this->db->where(array('product_id'=>$product_id));
	// 				$this->db->delete('product_socialmedia');
	// 				foreach ($socialmediaid as $key=>$value){
	// 					array_push($productsocialmedia, array('product_id'=>$product_id, 'user_id'=>$user_id, 'socialmedia_id'=>$value));
	// 				}

	// 				$this->db->insert_batch('product_socialmedia', $productsocialmedia);
	// 		}

	// 		if(is_array($objective) && (count($objective)>0))
	// 		{
	// 				$objectivedata=array();

	// 				$this->db->where(array('product_id'=>$product_id));
	// 				$this->db->delete('product_objective');
	// 				foreach ($objective as $key=>$value){
	// 					array_push($objectivedata, array('product_id'=>$product_id, 'objective_id'=>$value));
	// 				}

	// 				$this->db->insert_batch('product_objective', $productsocialmedia);
	// 		}
	// 			//insert custom fields data if it is not empty
	// 			if(isset($_POST['meta']) && !empty($_POST['meta']))
	// 			{
	// 				$meta_data = array();
	// 				$this->db->where(array('product_id'=>$product_id));
	// 				$this->db->delete('meta_products');
					
	// 				foreach ($this->input->post('meta',TRUE) as $key=>$value){
	// 					array_push($meta_data, array('product_id'=>$product_id, 'meta_fields_id'=>$key, 'value'=>$value));
	// 				}
	// 				$this->db->insert_batch('meta_products', $meta_data);
	// 				//now change image location from temp to real db
	// 			}
	// 				$this->db->trans_complete();
				
	// 			//exit;
	// 			if ($this->db->trans_status() === FALSE){
	// 				return array('error'=>'Sorry,Something went wrong.Please try in a while');
	// 			}
	// 		  	return array('success'=>true);
		
	// }
	public function insert_new_product($product_id=false)
	{

		$socialmediaid=explode(',',$this->input->post('brandmediaid',true));
		$campaign_name=$this->input->post('campaign_name',TRUE);
		$description=$this->input->post('description',TRUE);
		$create_type=$this->input->post('create_type',TRUE);
		$company_name=$this->input->post('company_name',TRUE);
		$owner_name=$this->input->post('owner_name',TRUE);
		$contact_no=$this->input->post('contact_no',TRUE);
		$pan_no=$this->input->post('vatno',TRUE);
		$product_url=$this->input->post('product_url',TRUE);
		$price_range=$this->input->post('price_range',TRUE);
		$category_id=$this->input->post('category',TRUE);
		$budgetamount=$this->input->post('budgetamount',TRUE);
		$creatorselected=$this->input->post('creatorselected',TRUE);
		$campaign_type=$this->input->post('campaign_type',TRUE);
		$save_method=$this->input->post('save_method',TRUE);
	if(!$category_id) $category_id=0;

		$submission_deadline=$this->input->post('submission_deadline',TRUE);
		$least_fan_count=$this->input->post('least_fan_count',true);
		$user_id = $this->session->userdata(SESSION.'user_id');
		$product_code = strtotime('now').$user_id;		
		$product_data = array(
			
			'cat_id' 				=> $category_id,
			'brand_id' 				=> $user_id,
			'name' 					=> $campaign_name,
			'description' 			=> $description,
			'product_url' 			=> $product_url,	
			'submission_deadline'	=> $submission_deadline,
			'price_range'			=> isset($price_range)?$price_range:0,
			'company_name'			=> $company_name,
			'owner_name'			=> $owner_name,
			'pan_no'				=> $pan_no,
			'contact_no'			=> $contact_no,
			'create_type'			=> $create_type,
			'campaign_type'			=> $campaign_type,
			
		);
	
		$this->db->trans_start();
		if($product_id)
		{

			$product_data['update_date']=$this->general->get_local_time('time');
			$this->general->update_data('products',$product_data,array('id'=>$product_id));
			if(isset($_POST['brandmediaid']) && !empty($_POST['brandmediaid']))
			{
					$productsocialmedia=array();

					$this->db->where(array('product_id'=>$product_id));	
					$this->db->delete('product_socialmedia');
					foreach ($socialmediaid as $key=>$value){
						array_push($productsocialmedia, array('product_id'=>$product_id, 'user_id'=>$user_id, 'socialmedia_id'=>$value));
					}

					$this->db->insert_batch('product_socialmedia', $productsocialmedia);
			}
			if($_FILES)
			{
					if($_FILES['uploadimage']['name'])
						{

							$fdata=$this->file_settings_do_upload('uploadimage',PRODUCT_IMAGE_PATH,'encrypt');
							if($fdata)
							{	
								$imagearr=array(
												'image'			=>  $fdata['file_name']
											    );
								$this->db->update('product_images',$imagearr,array('product_id'=>$product_id));
							}
							else
							{
								return array('error'=>$this->error_img);
							}

						}
			}
		}
		else
		{
				if(AUCTION_POST_ACTIVATION == '1')
				{
					$product_data['status'] = '1'; // pending
				}
				else
				{
					$product_data['status'] = '2'; // activated		
				}
				$product_data['post_date']=$this->general->get_local_time('time');
				$product_data['product_code']=$product_code;
				$this->general->insert_data('products',$product_data);
				$product_id = $this->db->insert_id();
				if($_FILES)
				{
					$fdata=$this->file_settings_do_upload('uploadimage',PRODUCT_IMAGE_PATH,'encrypt');
					if($fdata){
						
						
						$imagearr=array(
										'product_id'	=>	$product_id,
										'image'			=>  $fdata['file_name']
										);
						$this->db->insert('product_images',$imagearr);
					}
					else{
						return array('error'=>$this->error_img);
					}

				}
			}

			if(is_array($objective) && (count($objective)>0))
			{
					$objectivedata=array();

					$this->db->where(array('product_id'=>$product_id));
					$this->db->delete('product_objective');
					foreach ($objective as $key=>$value){
						array_push($objectivedata, array('product_id'=>$product_id, 'objective_id'=>$value));
					}

					$this->db->insert_batch('product_objective', $productsocialmedia);
			}
		
			if(is_array($socialmediaid) &&isset($_POST['brandmediaid'])  && count($socialmediaid)>0 )
			{
					$productsocialmedia=array();

					$this->db->where(array('product_id'=>$product_id));
					$this->db->delete('product_socialmedia');
					foreach ($socialmediaid as $key=>$value){
						array_push($productsocialmedia, array('product_id'=>$product_id, 'user_id'=>$user_id, 'socialmedia_id'=>$value));
					}

					$this->db->insert_batch('product_socialmedia', $productsocialmedia);
			}
				//insert custom fields data if it is not empty
				if(is_array($creatorselected) && (count($creatorselected)>0))
				{
					$creatorlist=array();
					$this->db->where(array('product_id'=>$product_id));
					$this->db->delete('product_bids');
					foreach ($creatorselected as $key => $value) 
					{
						array_push($creatorlist,array('product_id'=>$product_id,'mediaid'=>null,'membermediaid'=>null,'productmediaid'=>null,'user_id'=>$value,'bid_date'=>$this->general->get_local_time()));
					}
					$this->db->insert_batch('product_bids', $creatorlist);
				}
					$this->db->trans_complete();
				
				if ($this->db->trans_status() === FALSE)
				{
					return array('error'=>'Sorry,Something went wrong.Please try in a while');
				}
				if(!$product_id)
				{
					$template='campaign_created_admin';
					$to=SYSTEM_EMAIL;
					$from=CONTACT_EMAIL;
					$parseElement=array(
											'username'		=>		$owner_name,
											'campaign_name'	=>		$campaign_name,
											'description'	=>		$description,
											'product_url'	=>		$product_url,
											'campaign_type'	=>		$campaign_type
									   );
					$this->notification->send_email_notification($template, '', $from, $to, '', '', $parseElement, array());
				}
			  	return array('success'=>true);
		
	}

	public function get_productdetail_by_id($productid)
	{

		
		$join='';
		$cond='';
		$prefix=$this->db->dbprefix;	
		if((trim($name)!=''))
		{
			$cond=$cond." and p.name like ('%$name%')";
		}
		if((trim($price_range)!=''))
		{
			
			$cond=$cond." and p.price_range=$price_range";
		}
		if(trim($category)!='')
		{

			$cond=$cond." and  p.cat_id=$category";
		}

		if(trim($media)!=''){
				
			$join='JOIN '.$prefix.'product_socialmedia psa ON (p.id=psa.product_id)';
			$cond=$cond." and psa.socialmedia_id=$media";
		}
		
		if($status){
			if($status=='open'){
				$cond=$cond."and p.save_method=1 and p.status not in (3,4)";
			}elseif($status=='draft'){
				$cond=$cond."and p.save_method=2";
			}elseif($status=='closed'){
				$cond=$cond."and p.status in (3,4)";
			}
		}
		$query=$this->db->query('
									SELECT 
										(
											SELECT image FROM '.$prefix.'product_images AS i WHERE i.product_id=p.id LIMIT 1 
										) as image,
										(
											SELECT GROUP_CONCAT(media_type SEPARATOR ",") FROM '.$prefix.'product_socialmedia  ps
											JOIN '.$prefix.'socialmedia_settings ss ON (ss.id=ps.socialmedia_id) WHERE ps.product_id=p.id
											GROUP BY ps.product_id 
										) as media,
										(
											SELECT count(id) from  '.$prefix.'product_bids pb where pb.product_id=p.id
										) as proposalcount,
										(
											SELECT count(id) from  '.$prefix.'product_bids pb where pb.product_id=p.id and pb.status in (1,2)
										) as productioncount,
										(
											SELECT count(id) from  '.$prefix.'product_bids pb where pb.product_id=p.id and pb.status in (3)
										) as completedcount,
										p.name AS product_name,p.id as product_id,p.status,p.submission_deadline,pr.price_range,p.description,p.product_url
									FROM '.$prefix.'products p 
									JOIN '.$prefix.'product_categories c ON p.cat_id=c.id
									JOIN '.$prefix.'pricerange pr ON (p.price_range=pr.id)'.
									$join.'
									WHERE p.create_type="'.$type.'" and brand_id='.$userid.'  '.$cond.'
								');
		
		 $this->db->last_query();
		
		$result=$query->result('array');
		if(count($result)>0) return $result;
		else return array();
		
	}

	public function send_message()
	{
				$date=$this->general->get_local_time('time');
				$bidid=$this->input->post('bidid');
				$messageby=$this->input->post('messageby');
				$productbids=$this->general->get_single_row('product_bids',array('id'=>$bidid));
				$product_id=$productbids->product_id;
				$product=$this->general->get_single_row('products',array('id'=>$product_id));		
				$message=$this->input->post('message');
				$bid_status=$productbids->status;
				
				$current_user = $this->session->userdata(SESSION.'user_id');		
				if($messageby=='brand'){
					if($current_user==$product->brand_id)
					{
						$receiver_id=$productbids->user_id;
						$sender_id=$current_user;
					}else{
						return array('error_message'=>'You are not authorized to message the user');
					}
					
				}else
				{
					if($current_user==$productbids->user_id)
					{
							$sender_id=$current_user;
							$receiver_id=$product->brand_id;
					}else{
						return array('error_message'=>'You are not authorized to message this user');
					}
				
				}
				$arraydata=array(
										'bid_id'		=>		$bidid,
										'product_id'	=> 		$product_id,
										'receiver_id'	=>		$receiver_id,
										'sender_id'		=>		$sender_id,
										'message'		=>		$message,
										'messagedate'	=>		$date,
										'bid_status'	=>		$bid_status
								);

				 $lastid=$this->general->insert_data('communication',$arraydata);
					$message='';
					// if($_FILES['attachmentcommunication'] && $lastid)
					// {
					// 	$name = time().$lastid.$_FILES["attachmentcommunication"]['name'];
					// 	$upload = $this->account_module->upload_attachments_files('attachmentcommunication', ATTACHMENT_UPLOAD_DIR,$name);
					// 	if($upload){
					// 		$dataatt=array(

					// 							'msg_id'		=>	$lastid,
					// 							'file_name'		=>	$_FILES['attachmentcommunication']['name'],
					// 							'file_size'		=>	$_FILES['attachmentcommunication']['size'],
					// 							'file_mimetype'	=>	$_FILES['attachmentcommunication']['type'],
					// 							'file_saved'	=>	$name
					// 					   );

					// 		$id=$this->account_module->insert_data('communication_attachment',$dataatt);
					// 		if($id)
					// 		$message='Attachement Uploaded';		
					// 		else $message='Attchment couldn\'t  be upload';
					// 	}
					// 	else{
						
					// 		return array('error_message'=>$this->upload->display_errors());
					// 	}
						if($lastid)
						{
							return array('success_message'=>'Message Sent Successfully.'.$message );
							
						}
						else
						{
							return array('success_message'=>'Error in Message sending.');
						}
				// }
	}
	public function getmessage($type='inbox')
	{

		    $userid=$this->session->userdata(SESSION.'user_id');
		    $string=$this->input->post('searchstr',true);
		    $cond='1=1';
		    $joincond=false;
			if($type=="inbox")
			{
				$cond=array('c.sender_id'=>$userid);
				// $joincond='';
			}
			if($type=='sent'){
				$cond=array('c.receiver_id'=>$userid);
				$joincond='c.receiver_id=m.id';
			}
			if($type=='action_required')
			{
				$cond=array('c.bid_status'=>1);
			}
			if($type=='review')
			{
				$cond=array('c.bid_status'=>2);
			}
			if($type=='production')
			{
				$cond=array('c.bid_status'=>3);
			}
			if($type=='completed')
			{
				$cond=array('c.bid_status'=>7);
			}
			if($string){
				$searchstr="m.email like '%$string%' or n.email like '%$string%' or c.message like '%$string%'";
			}
			$this->db->select('m.email as sender_email,n.email as receiver_email,c.message,ismsgseen,c.sender_id,c.receiver_id');
			$this->db->from('communication c');
			$this->db->join('communication_attachment ca','c.id=ca.msg_id','left');
			$this->db->join('members m','c.sender_id=m.id');
			$this->db->join('members n','c.receiver_id=n.id');
			$this->db->where($cond);
			if($string)
				$this->db->where($searchstr);

			$this->db->order_by('messagedate','DESC');
			$this->db->group_by('bid_id,bid_status,c.sender_id,c.receiver_id');
			$query=$this->db->get();
			$data=$query->result();

		if($data) return $data;
		else return false;

	}
/* sending email to supplier for matched category if auction type is public	 */
	public function send_email_notification_to_public($categories=array(),$parseElement=array()){
				$this->db->select('DISTINCT(email)');
				$this->db->from('member_expertise a');
				$this->db->join('members m','a.user_id=m.id');
				$this->db->where_in('category_id',$categories);
				$query=$this->db->get();
				$emailnotify=$query->result('array');
				$emailnotify = array_column($emailnotify, 'email');
				$toemail=implode(',',$emailnotify);
				$template_id='56';
				if($toemail!=''){
					$from=SYSTEM_EMAIL;
					$this->notification->send_email_notification($template_id, '', $from, $toemail, '', '', $parseElement, array());
				}
	}

	public function get_user_details($userid){
		try{
			if(!$userid)  throw new Exception("User id not found", 1);
			
			$this->db->select('*');
			$this->db->from('members m');
			$this->db->join('members_details md','m.id= md.user_id','left');
			$this->db->where('m.id',$userid);
			$query=$this->db->get();
			 $this->db->last_query();
			$result=$query->row_array();

			if(count($result)>0) return $result;
			else return array();
		}catch(Exception $e)
		{
			throw $e->getMessage()	;
		}
		
	}

	public function generalsettings(){
		$userid=$this->session->userdata(SESSION.'user_id');
		$company_name=$this->input->post('company_name');
		$company_website=$this->input->post('company_website');
		$first_name=$this->input->post('first_name');
		$last_name=$this->input->post('last_name');
		$phone=$this->input->post('phone');
		$email=$this->input->post('email');
		$datamembers=array(
							'email'	=>	$email
						  );


		$datamemberdetail=array(
								'company_name'		=>	$company_name,
								'company_website'	=>	$company_website,
								'name'				=>	$first_name.' '.$last_name,
								'company_phone'		=>	$phone
								);
		$this->db->trans_start();
		$this->general->update_data('members',$datamembers,array('id'=>$userid));
		$id=$this->general->update_data('members_details',$datamemberdetail,array('user_id'=>$userid));
		$this->db->trans_complete();
				
				//exit;
				if ($this->db->trans_status() === FALSE){
					return array('message'=>'Sorry,There was error saving data.Please try in a while');
				}else {
					if($id)
					return array('message'=>'General Settings are updated');
					else return array('message'=>'Nothing to update');
				}
	}

	public function address(){
		$userid=$this->session->userdata(SESSION.'user_id');
		$company_address1=$this->input->post('company_address1');
		$company_address2=$this->input->post('company_address2');
		$company_city=$this->input->post('company_city');
		$company_state=$this->input->post('company_state');
		$company_zipcode=$this->input->post('company_zipcode');
		$company_country=$this->input->post('company_country');
		$userid=$this->session->userdata(SESSION.'user_id');
		$data=array(
					'company_address1'			=>		$company_address1,
					'company_address2'			=>		$company_address2,
					'company_city'				=>		$company_city,
					'company_state'				=>		$company_state,
					'company_country'			=>		$company_country,
					'company_zipcode'			=>		$company_zipcode
					);
		$cond=array('user_id'=>$userid);
		$id=$this->general->update_data('members_details',$data,$cond);
		if($id) return array('message'=>'User address is updated');
		else return array('message'=>'Nothing to update');
	}

	public function changepassword(){
		if($this->input->post('new_password',TRUE)!=$this->input->post('re_new_password',TRUE))
		{
			return array('error_message'=>'New Password and Confirm Password must match');
		}
		$userid=$this->session->userdata(SESSION.'user_id');
		$pass = $this->general->get_single_row('members',array('id'=>$userid));		
		$salt=$pass->salt;
		$oldpassword = $this->general->hash_password($this->input->post('password',TRUE),$salt);
		if($oldpassword==$pass->password)
		{
			$data=$this->change_users_password($userid);
			if($data) {
					$this->session->unset_userdata(SESSION.'user_id');
					$this->session->unset_userdata(SESSION.'usertype');
					$this->session->unset_userdata(SESSION.'email');
					$this->session->unset_userdata(SESSION.'username');	
					$this->session->set_flashdata('success_message',"Password changed successfully.");
					return array('success_message'=>'Congratulation Password changed Successfully');
			}else{
					return array('error_message'=>'Some error occured');
			}
		}
		else{
			return array('error_message'=>'Your Current Password doesn\'t match');
		}
	}

	// // to edit auction
	// public function edit_auction($product_id, $product_status)
	// {	
	// 	$auction_type = $this->input->post('auction_type', TRUE);
	// 	$auction_start_time = $this->input->post('auc_start_time', TRUE);
	// 	$days = $this->input->post('auc_end_days', TRUE);
	// 	$status = $this->input->post('status', TRUE);
	// 	//set product details info
	// 	$product_data = array(
	// 		'cat_id' 			=> $this->input->post('cat', TRUE),
	// 		'sub_cat_id' 		=> $this->input->post('subcat', TRUE),
	// 		'seller_id' 		=> $this->session->userdata(SESSION.'user_id'),
	// 		'name' 				=> $this->input->post('name', TRUE),
	// 		'description' 		=> $this->input->post('description', TRUE),
	// 		'auction_type' 		=> $this->input->post('auction_type', TRUE),
	// 		'auc_start_time' 	=> $auction_start_time,
	// 		'auc_end_days' 		=> $days,
	// 		'auction_type' 		=> $auction_type,
	// 		'auction_time_zone' => $this->input->post('auction_time_zone', TRUE),
	// 		'currency' 			=> $this->input->post('currency', TRUE),	
	// 		'bid_decrement' 	=> $this->input->post('bid_decrement', TRUE),
	// 		'budget'				=> $this->input->post('price', TRUE),	
	// 		'update_date' => $this->general->get_local_time('time')
	// 	);
	// 	if($status = '2' && $product_status != '2')
	// 	{
	// 		$product_data['auc_end_time'] = $this->general->get_end_date($this->general->get_local_time('now'), $days);
	// 	}
	// 	$this->db->update('products',$product_data, array('id'=>$product_id));

	// 	//Now remove all the custom fields values for this product id
	// 	$sql = 'DELETE MP FROM meta_products MP LEFT JOIN meta_fields MF ON MP.meta_fields_id = MF.id WHERE MP.product_id = '.$product_id.' AND MF.type!="FILE"';
	// 	$this->db->query($sql);
	// 	//now add custom fields values in meta prodcuts table if it is not empty
	// 	if(isset($_POST['meta']) && !empty($_POST['meta']))
	// 	{
	// 		$meta_data = array();
	// 		foreach ($this->input->post('meta',TRUE) as $key=>$value){
	// 			array_push($meta_data, array('product_id'=>$product_id, 'meta_fields_id'=>$key, 'value'=>$value));
	// 		}
	// 		$this->db->insert_batch('meta_products', $meta_data); 
	// 		//now change image location from temp to real db
	// 	}
	// 	//now remove old files if found
	// 	if($this->input->post('old_metafile',TRUE))
	// 	{
	// 		foreach($this->input->post('old_metafile') as $key=>$value)
	// 		{
	// 		//remove this only if new file is uploaded to take its place if its a required field
	// 		if($_FILES['metafile_'.$value]['name']!=''){
	// 				$query = $this->db->get_where('meta_products', array('meta_fields_id' => $value,'product_id'=>$product_id));
	// 				if ($query->num_rows() > 0)
	// 				{
	// 					$data = $query->row();
	// 					$del = $this->db->delete('meta_products', array('meta_fields_id' => $value,'product_id'=>$product_id));
	// 					@unlink('/'.CUSTOM_FIELDS_FILES_PATH.$data->value);
	// 				}
	// 			}
	// 		}
	// 	}
	// 	if($_FILES)
	// 	{
	// 	//upload this file and store the content in database
	// 		$meta_data = array();
	// 		foreach($_FILES as $key => $value){
	// 			$upload = $this->upload_custom_fields_files($key, CUSTOM_FIELDS_FILES_PATH);
	// 			if($upload){
	// 				$meta_field_name = substr($key, 9);
	// 				array_push($meta_data, array('product_id'=>$product_id, 'meta_fields_id'=>$meta_field_name, 'value'=>$upload['file_name']));
	// 			}
	// 		}
	// 		if(!empty($meta_data)){
	// 			$this->db->insert_batch('meta_products', $meta_data);
	// 		}
	// 	}
	// }
	// 
	public function checkmessagevalidity($product_id,$bidid){
		$userid=$this->session->userdata(SESSION.'user_id');
		$usertype=$this->session->userdata(SESSION.'usertype');
		if($usertype==3)
		{
			$cond=array('p.seller_id'=>$userid,'p.id'=>$product_id);
		}
		if($usertype==4)
		{
			$cond=array('b.user_id'=>$userid,'p.id'=>$product_id);
		}
		$this->db->select('*');
		$this->db->from('products p');
		$this->db->join('product_bids b','p.id=b.product_id');
		$this->db->where($cond);
		$this->db->where('b.id',$bidid);
		$query=$this->db->get();
		$this->db->last_query();
		$result=count($query->result('array'));
		 return $result;
	}
	// to update member selected fields
	public function update_members_selected_fields($fields, $where)
	{
		$update = $this->db->update('members_details',$fields, $where);
		if($update)
		{
			return TRUE;
		}
		else 
		{
			return FALSE;
		}
	}

	public function get_members_paypal_accounts($user_id)
	{
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('members_paypal_accounts');
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		return false;
	}

	// upload users profile.
	public function change_profile_image($user_id)
	{
		//Upload image if file input is found and user id is not empty
		if($_FILES && $user_id)
		{
			//make file settins and do upload it
			$image_name = $this->file_settings_do_upload('profile_picture', USER_IMAGE_PATH, 'encrypt');
			if($image_name['file_name'])
			{				
				$this->image_name_path = $image_name['file_name'];
				//resize image
				$this->resize_image(USER_IMAGE_PATH,$this->image_name_path,$image_name['raw_name'].$image_name['file_ext'],100,80);
				//now remove old image
				@unlink(USER_IMAGE_PATH.$this->input->post('old'));
				$this->update_members_selected_fields(array('cover_image'=>$this->image_name_path), array('user_id'=>$user_id));
				return TRUE;
			}	
		}
		return FALSE;
	}

	public function change_users_password($member_id)
	{

		//generate password
		$salt = $this->general->salt();		
		$password = $this->general->hash_password($this->input->post('new_password',TRUE),$salt);
		$current_date = $this->general->get_local_time('time');
		//set member info
		$data = array(
		   'password' => $password,
		   'salt' => $salt,
		   'last_modify_date' => $current_date,
		);

		//insert records in the database
		$update = $this->db->update('members',$data,array('id'=> $member_id));
		if($update)
			return TRUE;
		return FALSE;
	}


	public function get_payment_gateway_byid($id)
	{
		$query = $this->db->get_where('payment_gateway',array('id'=>$id, 'is_display'=>'Yes'));
		if($query->num_rows()>0)
		{
			return $query->row();
		}
	}
	// to upload custom fields files
	public function upload_custom_fields_files($file,$location)
	{
		$config['upload_path'] = './'.$location;   //file upload location
		$config['allowed_types'] = 'doc|docx|xls|xlsx|pdf';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name'] = TRUE; 	
		$this->upload->initialize($config);
		$this->upload->do_upload($file);
		if($this->upload->display_errors())
		{
			$this->error_img = $this->upload->display_errors();
			return false;
		}
		else
		{
			$data = $this->upload->data();
			return $data;
		}	
	}
	public function upload_attachments_files($file,$location,$name)
	{
		$config['upload_path'] = './'.$location;   //file upload location
		$config['allowed_types'] = 'doc|docx|xls|xlsx|pdf|jpg|jpeg|png';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name'] = false;
		$config['max_size'] = '2000';
		$config['file_name'] = $name;
		$this->upload->initialize($config);
		$this->upload->do_upload($file);
		if($this->upload->display_errors())
		{
			$this->error_img = $this->upload->display_errors();
			return false;
		}
		else
		{
			$data = $this->upload->data();
			return $data;
		}	
	}
	public function file_settings_do_upload($file, $location, $encrypt_filename='')
 	{
		$config['upload_path'] = './'.$location;   //file upload location
		$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
		$config['remove_spaces'] = TRUE; 
		$config['max_size'] = '4000';
		$config['max_width'] = '2000';
		$config['max_height'] = '2000';
		if($encrypt_filename='encrypt')
		{
			$config['encrypt_name'] = TRUE;
		}
		$this->upload->initialize($config);
		$this->upload->do_upload($file);
		if($this->upload->display_errors())
		{
			 $this->error_img = $this->upload->display_errors();
			 return false;
		}
		else
		{
			$data = $this->upload->data();
			return $data;
		}
	}

	//function to resize images
	public function resize_image($location,$source_image,$new_image,$width,$height)
	{
        $config['image_library'] = 'gd2';
		$config['source_image'] = './'.$location.$source_image;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;
		$config['master_dim'] = 'width';
		$config['new_image'] = './'.$location.$new_image;
		$this->image_lib->initialize($config);
		$resize = $this->image_lib->resize();
	}
	public function copy_product_images($product_id,$new_product_code)
	{
		$i= 1;
		$temp_img_arr = array();
		$current_date = $this->general->get_local_time('time');
			//now get all the images in $product_id product and store to temp folder of $new_product_code product temp
		$previous_images = $this->get_product_images($product_id);
		if($previous_images){
			foreach($previous_images as $image){
			//create new name for product images
				$new_image_name = $new_product_code.$i.'.'.pathinfo($image->image, PATHINFO_EXTENSION);
				//copy product image to temp folder.
				copy(PRODUCT_IMAGE_PATH.''.$image->image, PRODUCT_IMAGE_PATH_TEMP.''.$new_image_name);
				array_push($temp_img_arr,array('product_code'=>$new_product_code,'image'=>$new_image_name,'added_date'=>$current_date));
				$i++;
			}
			//now bulk insert
			$this->db->insert_batch('product_images_temp',$temp_img_arr);
			return $this->get_product_temp_images($new_product_code);
		}
	}
	public function get_product_by_id($product_id, $user_id = 0)
	{
		$this->db->select('P.*, C.id as currency_id, C.currency_sign, C.currency_code');
		$this->db->from('products P');
		$this->db->join('product_currency C', 'P.currency = C.id');
		$this->db->where('P.id',$product_id);
		if($user_id && $user_id != 0 && $user_id >0)
		$this->db->where('seller_id',$user_id);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			$result = $query->row();
			$query->free_result();
			return $result;
		}
		return FALSE;
	}
	public function get_product_images($product_id)
	{
		$this->db->select('id, image');
		$this->db->where('product_id',$product_id);
		$query = $this->db->get('product_images');
		if($query->num_rows>0)
		{
			return $query->result();
		}
		return FALSE;
	}
	public function get_product_temp_images($product_code)
	{
		$this->db->select('id, image');
		$this->db->where('product_code',$product_code);
		$query = $this->db->get('product_images_temp');
		if($query->num_rows>0){
			return $query->result();
		}
		return FALSE;
	}
	public function delete_product_image($product_id, $image)
	{
		$this->db->where(array('product_id'=>$product_id,'image'=>$image));
		$query = $this->db->delete('product_images');
		if($query){
			//unlink all the images
			@unlink(PRODUCT_IMAGE_PATH.$image);
			@unlink(PRODUCT_IMAGE_PATH.'thumb_'.$image);
			@unlink(PRODUCT_IMAGE_PATH.'upcoming_'.$image);
			@unlink(PRODUCT_IMAGE_PATH.'live_'.$image);
			return TRUE;
	}
	return FALSE;
	}
	public function remove_product_images_temp($product_code)
	{
		$query = $this->db->get_where('product_images_temp',array('product_code'=>$product_code));
		if($query->num_rows()>0)
		{
			$data = $query->result();
			if($data){
				foreach($data as $img){
				@unlink(PRODUCT_IMAGE_PATH_TEMP.''.$img->image);
				}
			}
			$this->db->delete('product_images_temp',array('product_code'=>$product_code));
		}
	}		

	public function get_product_details_by_id_for_purchase($product_id)
	{
		$this->db->select('P.product_code, P.name, P.name, P.retail_price, P.buy_now_price, P.package_weight, P.free_shipping, P.shipping_charge, P.package_size, P.buy_now_quantity, P.order_quantity, PIMG.image');
		$this->db->from('products P');
		$this->db->join('product_images PIMG','P.id=PIMG.product_id','LEFT');
		$this->db->where(array('P.id'=>$product_id,'buy_now'=>'1'));
		$this->db->where('P.buy_now_quantity > ','P.order_quantity');
		$this->db->group_by('P.id');
		$query = $this->db->get('');
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
	}
	public function getallmessagecontent($product_id,$bidid)
	{
		$this->db->select('c.*,ca.*,m.username,ca.id as attachmentid,c.messagedate as senddate,md.cover_image');
		$this->db->from('communication c');
		$this->db->join('members m' ,'m.id=c.user_id');
		$this->db->join('members_details md' ,'m.id=md.user_id','left');
		$this->db->join('communication_attachment ca' ,'c.id=ca.msg_id','left');
		$this->db->where(array('c.product_id'=>$product_id,'c.bid_id'=>$bidid));
		$this->db->order_by('c.id','asc');
		$query=$this->db->get();
		 $this->db->last_query();
		$data=$query->result();
		return $data;
	}
	public function getoverallrating($user_id)
	{
		$this->db->select('COALESCE(AVG(overall_rating),0) AS averagerating');
		$this->db->from('member_rating');
		$this->db->where('to_user_id',$user_id.'A');
		$this->db->group_by('to_user_id');
		$query=$this->db->get();
		$result=$query->row();
		if($result) return $result;
		else return (object) array('averagerating'=>0);
	}
	public function getproductwiserating($user_id){
		    $products=$this->db->dbprefix('products');
			$member_rating=$this->db->dbprefix('member_rating');
			$members_detail=$this->db->dbprefix('members_details');
			$query=	$this->db->query('SELECT *,p.name as productname,
					( SELECT COALESCE(AVG(overall_rating),0) FROM '. $member_rating.' AS a WHERE a.to_user_id=mr.from_user_id  GROUP BY a.to_user_id ) AS rateduserrating 
					FROM '. $member_rating.' AS mr
					JOIN '.$products.' AS p ON (mr.product_id=p.id)
					join '.$members_detail.' as d on (d.user_id=mr.from_user_id)
					where mr.to_user_id='.$user_id
					);	
		 	$this->db->last_query();
			$data=$query->result();
			return $data;

		}	

	public function getbidbyproduct($product_id)
	{
		$this->db->select('user_bid_amt,bid_date,id,user_id,product_id');
		$query=$this->db->get_where('product_bids',array('product_id'=>$product_id));
		$data=$query->result('array');
		$chartdata=array();
		foreach ($data as  $value) {
			$date=$this->general->date_formate($value['bid_date']);
			$supplierid=$value['user_id'].'-'.$value['product_id'].'-'.$value['id'];
			$chartdata[]=array($date,round($value['user_bid_amt']));
		}
		return json_encode($chartdata);
	}

	public function gettransactionhistory($limit=5,$offset=0)
	{
		$user_id=$this->session->userdata(SESSION.'user_id');
		$this->db->select('*');
		$this->db->from('transaction as t');
		$this->db->join('membership_package as m','t.bidpackage_id=m.id');
		$this->db->where(array('t.user_id'=>$user_id,'t.transaction_status'=>'Completed'));
		$this->db->order_by('t.id','desc');
		$this->db->limit($limit, $offset);
		$query=$this->db->get();
		$result=$query->result();
		if(count($result)>0) return $result ;
		else return array();
	}
	public function update_buyer_profile($member_id)
	{
		$update_data = array(
			'name'				=> $this->input->post('first_name',TRUE),
			'last_name'			=> $this->input->post('last_name',TRUE),
			'phone'				=> $this->input->post('phone',TRUE),
			'about_user'		=> $this->input->post('about_user',TRUE),
			'address'			=> $this->input->post('address',TRUE),
			'address2'			=> $this->input->post('address2',TRUE),
			'city'				=> $this->input->post('city',TRUE),
			'state'				=> $this->input->post('state',TRUE),
			'post_code'			=> $this->input->post('post_code',TRUE),
			'country'			=> $this->input->post('country',TRUE),
			'company_name'		=> $this->input->post('company_name',TRUE),
			'description'		=> $this->input->post('description',TRUE),
			'company_address1'	=> $this->input->post('company_address1',TRUE),
			'company_address2'	=> $this->input->post('company_address2',TRUE),
			'company_city'		=> $this->input->post('company_city',TRUE),
			'company_state'		=> $this->input->post('company_state',TRUE),
			'company_zipcode'	=> $this->input->post('company_zipcode',TRUE),
			'company_country'	=> $this->input->post('company_country',TRUE),
			'company_phone'		=> $this->input->post('company_phone',TRUE),
			'company_website'	=> $this->input->post('company_website',TRUE),
		);

		// update the user details and return update status
		$this->db->where('user_id', $member_id);
		return $this->db->update('members_details', $update_data);
	}

	public function cancel_auction($auction_id)
	{
	$this->db->where('product_code', $auction_id);
		$data = array(
			'status' => '4'
		);
		$this->db->update('products', $data);
		return $this->db->affected_rows() > 0;
	}
	// get messages 
	public function get_messages($user_id)
	{
		$this->db->select('COM.id, M.username as sender, COM.subject, COM.message, COM.date');
		$this->db->from('communication COM');
		$this->db->join('members M', 'COM.sender = M.id');
		$this->db->where('COM.receiver', $user_id);
		$this->db->where('COM.inbox_status !=', '3');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$query->free_result();
			return $result;
		}
		return FALSE;
	}
	// get message details
	public function get_message_detail($user_id, $message_id)
	{
		$this->db->select('COM.id, COM.msg_root_id, M.email, COM.subject, COM.message, COM.date');
		$this->db->from('communication COM');
		$this->db->join('members M', 'COM.sender = M.id');
		$this->db->where('COM.receiver', $user_id);
		$this->db->where('COM.id', $message_id);
		$this->db->where('COM.inbox_status !=',  '3');
		$this->db->limit(1);
		$query = $this->db->get();		
		if($query->num_rows() > 0)
		{
			$result = $query->row();
			$query->free_result();
			return $result;
		}
		return FALSE;
	}

// to retrieve membership package by id for both buyer and supplie
 public function get_membership_package_byid($id)
    {
            $this->db->where("id", $id); 
            $query = $this->db->get('membership_package');
            if($query->num_rows()>0)
            {
                return $query->row();
            }
    }


// to retrieve membership package for both buyer and supplier
	public function get_membership_packages($member_type='')
	{

	   // 1 for buyer and 2 for supplier
		if($member_type =='buyer')
			$this->db->where('member_type', '1'); 
		else if($member_type == 'supplier' )
			$this->db->where('member_type', '2');
		$this->db->where('is_display','1');
		$query = $this->db->get('membership_package');
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$query->free_result();
			return $result;
		}
		return FALSE;
	}
	// to count total live public auction 
	public function count_all_live_public_auctions()
	{
		$current_time = $this->general->get_local_time('now');
		$category = $this->input->post('cat', TRUE);
		$subcategory = $this->input->post('subcat', TRUE);
		$this->db->where('auc_end_time >', $current_time); // auction end date > current date time
		$this->db->where('status', '2'); // status active
		$this->db->where('auction_type', '1');
		if($category && $category > 0)
			$this->db->where('cat_id', $category);
		if($subcategory && $subcategory > 0)
			$this->db->where('sub_cat_id', $subcategory);
		$query = $this->db->get('products');
		return $query->num_rows();
	}

	// to retrieve all public products
	public function get_live_public_products($limit=0, $offset=0)
	{
		$order=$this->input->post('order_data');
		$current_time = $this->general->get_local_time('now');
		$category = $this->input->post('cat', TRUE);
		$subcategory = $this->input->post('subcat', TRUE);
		$this->db->select('id, product_code, name, description, auc_start_time, auc_end_time, status');
		$this->db->where('auc_end_time >', $current_time); // auction end date > current date time
		$this->db->where('status', '2'); // status active
		$this->db->where('auction_type', '1');
		if($category && $category > 0)
			$this->db->where('cat_id', $category);
		if($subcategory && $subcategory > 0)
			$this->db->where('sub_cat_id', $subcategory);
	if($this->input->post('order_data') > 0 ){
			if($this->input->post('order_data')==1){
				$this->db->order_by('budget','ASC');
			}
			if($this->input->post('order_data')==2){
				$this->db->order_by('budget','DESC');
			}
			if($this->input->post('order_data')==3){
				$this->db->order_by('auc_end_time','ASC');
			}
			if($this->input->post('order_data')==4){
				$this->db->order_by('auc_start_time','DESC');
			}
		}else{
			$this->db->order_by('name','ASC');
		}
		if($limit)
			$this->db->limit($limit, $offset);
		$query = $this->db->get('products');
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$query->free_result();
			return $result;
		}
		return FALSE;
	}
	// to update supplier profile
	public function update_supplier_profile($member_id)
	{
	// prepare update data array
		$update_data = array(
			'name'				=> $this->input->post('first_name',TRUE),
			'last_name'			=> $this->input->post('last_name',TRUE),
			'phone'				=> $this->input->post('compnay_phone',TRUE),
			'address'			=> $this->input->post('company_address1',TRUE),
			'address2'			=> $this->input->post('company_address2',TRUE),
			'city'				=> $this->input->post('company_city',TRUE),
			'state'				=> $this->input->post('company_state',TRUE),
			'post_code'			=> $this->input->post('company_zipcode',TRUE),
			'country'			=> $this->input->post('company_country',TRUE),
			'company_name'		=> $this->input->post('company_name',TRUE),
			'description'		=> $this->input->post('description',TRUE),
			'company_address1'	=> $this->input->post('company_address1',TRUE),
			'company_address2'	=> $this->input->post('company_address2',TRUE),
			'company_city'		=> $this->input->post('company_city',TRUE),
			'company_state'		=> $this->input->post('company_state',TRUE),
			'company_zipcode'	=> $this->input->post('company_zipcode',TRUE),
			'company_country'	=> $this->input->post('company_country',TRUE),
			'company_phone'		=> $this->input->post('company_phone',TRUE),
			'company_website'	=> $this->input->post('company_website',TRUE),
		);	

		// update the user details and return update status
		$this->db->where('user_id', $member_id);
		return $this->db->update('members_details', $update_data);
	}

	// to retrieve suppliers live bids
	public function get_user_proposal_bids($user_id)
	{
		$this->db->select('P.id as prd_id, P.product_code, P.name, PB.user_bid_amt, PB.bid_date');
		$this->db->from('product_bids PB');
		$this->db->join('products P', 'P.id = PB.product_id');
		$this->db->where('PB.user_id', $user_id);
		$this->db->where('P.status', '2'); // status live
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$query->free_result();
			return $result;
		}
		return FALSE;
	}
	
	public function get_file_download($args=array())
	{
        $this->load->model('download/download_model');
		$this->download_model->set_args($args);
        $this->download_model->set_extensions();
        $this->download_model->prepare_download();
        if($this->download_model->download_hook['download'])
		{
        	$this->download_model->set_download();
			$this->download_model->start_download();
        }
        else
        {
            die($this->download_model->download_hook['message']);
        }
    }
    public function getbidsdetail($product_id,$limit=50,$offset=0)
 	{
		$this->db->select('p.*,b.*,m.*,w.bid_id as winnerbid,p.status as productstatus,p.id as product_id,b.id as bidid');
    	$this->db->from('products as p');
    	$this->db->join('product_bids as b','b.product_id=p.id');
    	$this->db->join('members as m','b.user_id=m.id');
    	$this->db->join('product_winner as w','b.product_id=w.product_id and b.id=w.bid_id and p.status=3','left');
    	$this->db->where('p.id',$product_id);
    	$this->db->order_by("b.id", "desc"); 
		$this->db->limit($limit, $offset);
    	$query=$this->db->get();
    	$this->db->last_query();
    	$result=$query->result();
    	if($result) return $result;
    	else return array();
    }
}



