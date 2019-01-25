<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public $validate_add_product = array
    (
        array('field' => 'model_number', 'label' => 'Model Number', 'rules' => 'trim|required'),
        array('field' => 'imei', 'label' => 'IMEI', 'rules' => 'trim|required|max_length[20]|numeric'),
        array('field' => 'color', 'label' => 'Color', 'rules' => 'trim|required|max_length[10]|alpha'),
        array('field' => 'suffix', 'label' => 'Suffix', 'rules' => 'trim|required|max_length[20]'),
    );
     public $validate_add_model= array
    (
        array('field' => 'model_name', 'label' => 'Model Name', 'rules' => 'trim|required|max_length[20]'),
        array('field' => 'display_name', 'label' => 'Display Name', 'rules' => 'trim|required|max_length[20]'),
        array('field' => 'imei8', 'label' => '8 Imei digits', 'rules' => 'trim|required|max_length[8]'),
    );
    public $validate_add_news =  array
     (  
        array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required|max_length[200]'),
        array('field' => 'description', 'label' => 'description', 'rules' => 'trim|required|max_length[800]'),
    );
    public function validate_dealer_add() {
        $validate_add_dealer = array
            (
            array('field' => 'dealer_name', 'label' => 'Dealer Name', 'rules' => 'trim|required|min_length[2]|max_length[20]'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|min_length[3]|max_length[100]|callback_email_taken'),
            array('field' => 'username', 'label' => 'Dealer Id', 'rules' => 'trim|required|min_length[6]|max_length[20]|callback_username_taken'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|min_length[6]|max_length[15]'),
            array('field' => 'retype_password', 'label' => 'Repeat Password', 'rules' => 'trim|required|min_length[6]|max_length[15]|matches[password]'),
             array('field' => 'operator', 'label' => 'Operator', 'rules' => 'trim|required'),
        );

        for ($i = 0; $i < count($this->input->post('outletid')); $i++) {
            $validate_add_dealer[] = array('field' => "outletid[a$i]", 'label' => 'Outlet Id', 'rules' => 'trim|required|min_length[2]|max_length[20]');
            $validate_add_dealer[] = array('field' => "type[a$i]", 'label' => 'Outlet Type', 'rules' => 'trim|required|max_length[5]');
            $validate_add_dealer[] = array('field' => "outletname[a$i]", 'label' => 'Outlet Name', 'rules' => 'trim|required|min_length[2]|max_length[100]');
            $validate_add_dealer[] = array('field' => "streetname[a$i]", 'label' => 'Street Name', 'rules' => 'trim|required|min_length[2]|max_length[100]');
            $validate_add_dealer[] = array('field' => "unitno[a$i]", 'label' => 'Unit No', 'rules' => 'trim|required|max_length[10]');
             $validate_add_dealer[] = array('field' => "postalcode[a$i]", 'label' => 'Postal code', 'rules' => 'trim|required|integer|max_length[7]');
        }
        // echo '<pre>';
        // print_r($validate_add_dealer);
        return $validate_add_dealer;
    }

     public function validate_dealer_edit() {
        $validate_edit_dealer = array
            (
            array('field' => 'dealer_name', 'label' => 'Dealer Name', 'rules' => 'trim|required|min_length[2]|max_length[20]'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|min_length[3]|max_length[100]|callback_email_taken'),
            array('field' => 'username', 'label' => 'Dealer Id', 'rules' => 'trim|required|min_length[6]|max_length[20]|callback_username_taken'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|min_length[6]|max_length[15]'),
            array('field' => 'retype_password', 'label' => 'Repeat Password', 'rules' => 'trim|min_length[6]|max_length[15]|matches[password]'),
             array('field' => 'operator', 'label' => 'Operator', 'rules' => 'trim|required'),

        );

        for ($i = 0; $i < count($this->input->post('outletid')); $i++) {
            $validate_edit_dealer[] = array('field' => "outletid[a$i]", 'label' => 'Outlet Id', 'rules' => 'trim|required|min_length[2]|max_length[20]');
            $validate_edit_dealer[] = array('field' => "type[a$i]", 'label' => 'Outlet Type', 'rules' => 'trim|required|max_length[5]');
            $validate_edit_dealer[] = array('field' => "outletname[a$i]", 'label' => 'Outlet Name', 'rules' => 'trim|required|min_length[2]|max_length[100]');
            $validate_edit_dealer[] = array('field' => "streetname[a$i]", 'label' => 'Street Name', 'rules' => 'trim|required|min_length[2]|max_length[100]');
            $validate_edit_dealer[] = array('field' => "unitno[a$i]", 'label' => 'Unit No', 'rules' => 'trim|required|max_length[10]');
             $validate_edit_dealer[] = array('field' => "postalcode[a$i]", 'label' => 'Postal code', 'rules' => 'trim|required|integer|max_length[7]');
        }
        // echo '<pre>';
        // print_r($validate_add_dealer);
        return $validate_edit_dealer;
    }
    public function validate_incentive()
	{
		 $validate_add_incentive =  array
		 (
			array('field' => 'model', 'label' => 'Model', 'rules' => 'trim|required'),
            array('field' => 'inc_name', 'label' => 'Incentive Name', 'rules' => 'trim|required'),
			array('field' => 'fromdate', 'label' => 'From Date', 'rules' => 'trim|required'),	
			array('field' => 'todate', 'label' => 'To Date', 'rules' => 'trim|required'),
			array('field' => 'dealer[]', 'label' => 'Dealer', 'rules' => 'trim|required'),
			array('field' => 'dealer_incentive_type', 'label' => 'Reward Type', 'rules' => 'trim|required'),
			array('field' => 'staff_incentive_type', 'label' => 'Reward Type', 'rules' => 'trim|required'),
			
		);
		
		 for($i=0;$i<count($this->input->post('dealer_incentive'));$i++)
		 {
		 	$j=$i-1;
		 	$validate_add_incentive[]= array('field' => "dealer_initial_target[a$i]", 'label' => 'Initial Target', 'rules' => 'trim|required|integer|callback_check_greater_by_unit['.$this->input->post("dealer_final_target[a$j]").']');
		$validate_add_incentive[]=	array('field' => "dealer_final_target[a$i]", 'label' => 'Final Target', 'rules' => 'trim|required|integer|callback_check_equal_less['.$this->input->post("dealer_initial_target[a$i]").']');
			$validate_add_incentive[]=array('field' => "dealer_incentive[a$i]", 'label' => 'Incentive', 'rules' => 'trim|required|integer');
		
		 }
		 for($i=0;$i<count($this->input->post('staff_incentive'));$i++)
		 {
		 	$j=$i-1;
		 	$validate_add_incentive[]= array('field' => "staff_initial_target[a$i]", 'label' => 'Initial Target', 'rules' => 'trim|required|integer|callback_check_greater_by_unit['.$this->input->post("staff_final_target[a$j]").']');
			$validate_add_incentive[]=	array('field' => "staff_final_target[a$i]", 'label' => 'Final Target', 'rules' => 'trim|required|integer|callback_check_equal_less['.$this->input->post("staff_initial_target[a$i]").']');
			$validate_add_incentive[]=array('field' => "staff_incentive[a$i]", 'label' => 'Incentive', 'rules' => 'trim|required|integer');
		
		 }
		
		 return  $validate_add_incentive;
	}
	

	public function add_incentive($id=false)
	{
		$model=$this->input->post('model',true);
        $name=$this->input->post('inc_name',true);
		$fromdate=$this->input->post('fromdate',true);
		$todate=$this->input->post('todate',true);
		$dealer=$this->input->post('dealer',true);
		$dealer_incentive_type = $this->input->post('dealer_incentive_type',true);
		$staff_incentive_type = $this->input->post('staff_incentive_type',true);
		$current_time = $this->general->get_local_time('time');

		$this->db->trans_start();
		if(!$id)
		{		
				$data=array(
								'model_id'			=>	 $model,
								'added_date'		=>	 $current_time,
								'start_date'		=>	 $fromdate,
								'end_date'			=>	 $todate,
								'staff_reward_type' =>	 $staff_incentive_type,
								'dealer_reward_type'=>	 $dealer_incentive_type,
                                'name'              =>   $name
							);
				
				
				$this->db->last_query();
				$this->db->insert('incentive',$data);
				$incentiveid = $this->db->insert_id();
				if($incentiveid)
				{
					if(LOG_ADMIN_ACTIVITY == 'Y'){
						$this->general->log_admin_activity(array('user_id' => $this->session->userdata(SESSION.'user_id'), 'user_type' =>  $this->session->userdata(SESSION.'usertype'), 'module' => 'Add Incentive', 'module_desc' => 'Incentive Added', 'action' => 'Add', 'extra_info' => 'Incentive id: '.$incentiveid));
					}
				}
			
		}
		else
		{	
					$data=array(
								'model_id'			=>	 $model,
								'update_date'		=>	 $current_time,
								'start_date'		=>	 $fromdate,
								'end_date'			=>	 $todate,
								'staff_reward_type' =>	 $staff_incentive_type,
								'dealer_reward_type'=>	 $dealer_incentive_type,
                                'name'              =>   $name
							);
				$last_id=$this->db->update('incentive',$data,array('id'=>$id));

				if($last_id) 
				{
					$incentiveid=$id;
						if(LOG_ADMIN_ACTIVITY == 'Y'){
						$this->general->log_admin_activity(array('user_id' => $this->session->userdata(SESSION.'user_id'), 'user_type' =>  $this->session->userdata(SESSION.'usertype'), 'module' => 'Edit Incentive', 'module_desc' => 'Incentive Edited', 'action' => 'Edit', 'extra_info' => 'Incentive id: '.$incentiveid));
					}
				}
		}

		if($incentiveid)
			{
				foreach($dealer as $eachdealer)
				{
					$dealeradd[]=array('incentive_id'=>$incentiveid,'dealer_id'=>$eachdealer,'created_date'=>$current_time);
				}
				if(count($dealeradd)>0)
				{
					$this->db->delete('dealer_incentive',array('incentive_id'=>$incentiveid));
				 	$this->db->insert_batch('dealer_incentive',$dealeradd);
				}
				$dealer_initial_target=$this->input->post('dealer_initial_target',true);
				$dealer_final_target=$this->input->post('dealer_final_target',true);
				$dealer_incentive=$this->input->post('dealer_incentive',true);
				$staff_initial_target=$this->input->post('staff_initial_target',true);
				$staff_final_target=$this->input->post('staff_final_target',true);
				$staff_incentive=$this->input->post('staff_incentive',true);
				
				
				for($i=0; $i<count($dealer_incentive);$i++) 
				{
					$dealerincentive[]=array('incentive_id'=>$incentiveid,'initial_target_amount'=>$dealer_initial_target['a'.$i],'final_target_amount'=>$dealer_final_target['a'.$i],'incentive'=>$dealer_incentive['a'.$i],'target_type'=>'D');

				}	
				for($i=0; $i<count($staff_incentive);$i++) 
				{
					$staffincentive[]=array('incentive_id'=>$incentiveid,'initial_target_amount'=>$staff_initial_target['a'.$i],'final_target_amount'=>$staff_final_target['a'.$i],'incentive'=>$staff_incentive['a'.$i],'target_type'=>'S');

				}	
				if(is_array($dealerincentive) && count($dealerincentive)>0)
				{
					$this->db->delete('incentive_target',array('incentive_id'=>$incentiveid,'target_type'=>'D'));
				 	$this->db->insert_batch('incentive_target',$dealerincentive);
				}
				if( is_array($staffincentive) && count($staffincentive)>0)
				{
					$this->db->delete('incentive_target',array('incentive_id'=>$incentiveid,'target_type'=>'S'));
				 	$this->db->insert_batch('incentive_target',$staffincentive);
				}

			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
				return array('error_message'=>'Sorry,Something went wrong.Please try in a while');
			}
			if($incentiveid>0)
			{
				if($id) return array('success_message'=>'Incentive Edited Successfully.');
		  		else	return array('success_message'=>'Incentive Added Successfully.');
			}else{
				if($id)	return array('error_message'=>'Incentive Update Failed. Please try again');
		  		else	return array('error_message'=>'Incentive insertion Failed. Please try again');
			}
	}
    public function get_member_email_by_sales_id($id){
        $this->db->select('AES_DECRYPT(email,salt) as email');
        $this->db->from('sales_report s');
        $this->db->join('members m','s.user_id=m.id');
        $this->db->where(array('s.id'=>$id));
        $query=$this->db->get();
     
        if($query->num_rows()>0)
        {
            return $query->row();
        }
        return false;
    }
	public function get_incentive_model($id){
		$this->db->from('incentive i');
		$this->db->join('model m','i.model_id=m.id');
		$this->db->where(array('i.id'=>$id));
		$query=$this->db->get();
		if($query->num_rows>0)
		{
			return $query->result();
		}
		return false;
	}

    public function add_dealer($id = false) 
    {

        $email = $this->input->post('email', true);
        $username = $this->input->post('username', true);
        $dealer_name = $this->input->post('dealer_name', true);
        $operator=$this->input->post('operator',true);
        $passwordplain=$this->input->post('password', TRUE);
        $current_time = $this->general->get_local_time('time');
        $this->db->trans_start();
        if($this->input->post('password', TRUE))
        {
             $salt = $this->general->salt();
             $password = $this->general->hash_password($this->input->post('password', TRUE), $salt);
             $this->db->set('password', $password);
        }else
        {
            $user=$this->general->get_single_row('members',array('id'=>$id));
            $salt=$user->salt;
        }
        $this->db->set('email', "AES_ENCRYPT('{$email}','{$salt}')", FALSE);
        $this->db->set('username', "AES_ENCRYPT('{$username}','{$salt}')", FALSE);
        $this->db->set('display_name', "AES_ENCRYPT('{$dealer_name}','{$salt}')", FALSE);


        if (!$id) 
        {
            // $status = "2";		
            // if (NEED_USER_ACTIVATION =='0')
            $status = "1";

            $data = array(
                'user_type' => '3',
                'reg_date' => $current_time,
                'reg_ip' => $this->general->get_real_ipaddr(),
                'status' => $status,
                'salt' => $salt,
                'operator'=>$operator

            );
            $this->db->last_query();
            $this->db->insert('members', $data);
            $res = $this->db->insert_id();
            $outletid = $this->input->post('outletid', true);
            $type = $this->input->post('type', true);
            $unitno = $this->input->post('unitno', true);
            $outletname = $this->input->post('outletname', true);
            $streetname = $this->input->post('streetname', true);
            $postalcode = $this->input->post('postalcode', true);
            $parentid=$this->input->post('parentid',true);
            if(count($outletid)>0)
            {
                 for ($i = 0; $i < count($outletid); $i++) 
                {

                    $outletdata[] = array('outlet_id' => $outletid['a' . $i], 'type' => $type['a' . $i], 'unit_no' => $unitno['a' . $i], 'outlet' => $outletname['a' . $i], 'street_name' => $streetname['a' . $i], 'dealer_id' => $res,'postalcode'=>$postalcode['a' . $i]);

                    

                }  

                 $this->db->delete('outlet', array('dealer_id' => $res,'status'=>'1'));
                 $this->db->insert_batch('outlet', $outletdata);
            }
           
            if ($res) 
            {
                if (LOG_ADMIN_ACTIVITY == 'Y') 
                {
                    $this->general->log_admin_activity(array('user_id' => $this->session->userdata(SESSION . 'user_id'), 'user_type' => $this->session->userdata(SESSION . 'usertype'), 'module' => 'Add Dealer', 'module_desc' => 'Dealer Added', 'action' => 'Add', 'extra_info' => 'Dealer id: ' . $res));
                }
            }
        } else
         {

            $data = 
                array
                    (
                        'last_modify_date' =>   $current_time,
                        'salt'             =>   $salt,
                        'operator'         =>   $operator
                    );
            $last_id = $this->db->update('members', $data, array('id' => $id));
            $outletid = $this->input->post('outletid', true);
            $type = $this->input->post('type', true);
            $unitno = $this->input->post('unitno', true);
            $outletname = $this->input->post('outletname', true);
            $streetname = $this->input->post('streetname', true);
            $postalcode = $this->input->post('postalcode', true);
            $parentid=$this->input->post('parentid',true);
            $outletdatanew=array();

            if ($last_id) 
            {
                $res = $id;
                if(count($outletid)>0)
                {
                   for ($i = 0; $i < count($outletid); $i++) 
                    {
                        if(trim($parentid['a' . $i])!='')
                        {
                           $outletdata = array('outlet_id' => $outletid['a' . $i], 'type' => $type['a' . $i], 'unit_no' => $unitno['a' . $i], 'outlet' => $outletname['a' . $i], 'street_name' => $streetname['a' . $i], 'dealer_id' => $res,'postalcode'=>$postalcode['a' . $i]);

                            $this->general->update_data('outlet', $outletdata,array('id'=>$parentid['a' . $i]));  
                        }
                        else
                        {
                             $outletdatanew[] = array('outlet_id' => $outletid['a' . $i], 'type' => $type['a' . $i], 'unit_no' => $unitno['a' . $i], 'outlet' => $outletname['a' . $i], 'street_name' => $streetname['a' . $i], 'dealer_id' => $res,'postalcode'=>$postalcode['a' . $i]);
                        }

                    } 
                 
                    if(count($outletdatanew)>0)
                     $this->db->insert_batch('outlet', $outletdatanew);
                }
                
                if (LOG_ADMIN_ACTIVITY == 'Y') {
                    $this->general->log_admin_activity(array('user_id' => $this->session->userdata(SESSION . 'user_id'), 'user_type' => $this->session->userdata(SESSION . 'usertype'), 'module' => 'Edit Dealer', 'module_desc' => 'Dealer Edited', 'action' => 'Edit', 'extra_info' => 'Dealer id: ' . $res));
                }
            }

        }
      
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return array('error_message' => 'Sorry,Something went wrong.Please try in a while');
        }
        if ($res > 0) {
            if ($id)
                return array('success_message' => 'Dealer Edited Successfully.');
            else
            {
                /********Sendng email to dealer***************/
                    $template_id = 'dealer_registration_complete';
                    $parseElement = array(
                        'USERNAME' => $username,
                        'PASSWORD' => $passwordplain,
                        'EMAIL'    => $email,
                        'SITENAME' => SITENAME
                    );
                    $from = SYSTEM_EMAIL;
                    $to = $email;
                    $this->notification->send_email_notification($template_id, '', $from, $to, '', '', $parseElement, array());
                 return array('success_message' => 'Dealer Added Successfully.');
            }
        }else {
            if ($id)
                return array('error_message' => 'Dealer Update Failed. Please try again');
            else
                return array('error_message' => 'Dealer insertion Failed. Please try again');
        }
    }

    public function get_search_data() {
        $modal_id = $this->input->post('filtermodel', true);
        $dealer_id = $this->input->post('filteruserid', true);
        
        $fromdate = $this->input->post('filterfromdate', true);
        $todate = $this->input->post('filtertodate', true);

        $cond = '1=1';
        if ($modal_id) {
            $cond = $cond ." AND in.model_id=$modal_id";
        }
        if ($dealer_id) {
            $cond =$cond . " AND dl.dealer_id=$dealer_id";
        }
        if ($fromdate) {
            $cond = $cond ." AND date(in.start_date)>='$fromdate'";
        }
        if ($todate) {
            $cond =$cond . " AND date(in.end_date)<='$todate'";
        }
      
        

        $this->db->select('in.id as inc_id,in.name,mo.model_name,mo.id,in.start_date,in.end_date,  (SELECT GROUP_CONCAT(aes_decrypt(display_name,salt) SEPARATOR "/") FROM emts_members m join emts_dealer_incentive i on(m.id=i.dealer_id) where in.id=i.incentive_id) as dealer_names,in.update_Date as modified_date');
        $this->db->from('incentive in');
       if($dealer_id)
        $this->db->join('dealer_incentive dl', 'in.id=dl.incentive_id','left');
        $this->db->join('model mo', 'in.model_id=mo.id');
        $this->db->where($cond);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
//      $where->db->where('in.model_id',$modal_id);
    }

    public function add_product()
    {
        $id=trim($this->input->post('productid',true));
        $model_no=$this->input->post('model_number',true);
        $imei=$this->input->post('imei',true);
        $color=$this->input->post('color',true);
        $suffix=$this->input->post('suffix',true);
        $data=array(
                        'model_number'      =>  $model_no,
                        'imei'              =>  $imei,
                        'color'             =>  $color,
                        'suffix'            =>  $suffix
                   );
        if($id==false || $id=='')
        {
            $this->general->insert_data('products',$data);
            if($this->db->affected_rows()>0)
                return array('success_message'=>'Product inserted successfully');
            else 
                return array('error_message'=>'Product Insertion Failed');
        }
        else
        {
            $this->general->update_data('products',$data,array("id"=>$id));
            if($this->db->affected_rows()>0)
                return array('success_message'=>'Product updated successfully');
            else 
                return array('error_message'=>'No data to update');
        }
    }
    public function add_model()
    {
        $id=trim($this->input->post('modelid',true));
        $model_name=$this->input->post('model_name',true);
        $imei8=$this->input->post('imei8',true);
        $display_name=$this->input->post('display_name',true);
        $data=array(    
                        'model_name'        =>  $model_name,
                        'display_name'      =>  $display_name,
                        'imei8'             =>  $imei8
                   );
        if($id==false || $id=='')
        {
            $this->general->insert_data('model',$data);
            if($this->db->affected_rows()>0)
                return array('success_message'=>'Model inserted successfully');
            else 
                return array('error_message'=>'Model Insertion Failed');
        }
        else
        {
            $this->general->update_data('model',$data,array("id"=>$id));
            if($this->db->affected_rows()>0)
                return array('success_message'=>'Model updated successfully');
            else 
                return array('error_message'=>'No data to update');
        }
    }

    public function add_news_promotion($id=false)
    {
        $title=$this->input->post('title',true);
        $description=$this->input->post('description',true);
        $type=$this->input->post('type',true);  
        $url=$this->input->post('url',true);    
        $current_time=$this->general->get_local_time('time');
        $data=array(
                        'title'         =>  $title,
                        'description'   =>  $description,
                        'type'          =>  $type,
                        'url'           =>  $url,
                        'post_date'     =>  $current_time
                        
                   );

        $this->db->trans_start();
        if(trim($id)!=false || trim($id)!='')
        {
            
            $res=$this->general->update_data('news_letter',$data,array('id'=>$id));
            $last_id=$id;
            // $affected=$this->db->affect
        }
        else{
            
            $id=$this->general->insert_data('news_letter',$data);
            $last_id=$this->db->insert_id();

        }
         if($_FILES)
         {
        /************************Normal File Upload*******************************************************
       
            {
            // print_r($_FILES['uploadimage']);exit;
                    if($_FILES['uploadimage']['name'])
                        {

                            $fdata=$this->file_settings_do_upload('uploadimage',NEWS_IMAGE_PATH,'encrypt');
                            if($fdata){
                                
                                
                                $imagearr=array(
                                                'image'         =>  $fdata['file_name']
                                                );
                                $this->db->update('news_letter',$imagearr,array('id'=>$last_id));
                            }
                            else{
                                return array('error'=>$this->error_img);
                            }

                        }
           
      /***************************************************************************************************/
      /***********************************Amazon server  file upload to s3***************************************/
            $fileName =  $_FILES["uploadimage"]["name"];;
            $fileTempName = $_FILES['uploadimage']['tmp_name'];  
            $this->load->library('Amazons3');
            // print_r($fileName);echo '<br>';
            // print_r($fileTempName);exit;
            $response=$this->amazons3->upload_new_promotion($fileName,$fileTempName);
            print_r($response);
            if($response->isOK())
            {
                $info = $response->header[_info];
                $imagearr=array (
                                    'image'         => $info["url"]
                                );
                $this->db->update('news_letter',$imagearr,array('id'=>$last_id));
                echo $info["url"];exit;
            }
      /***************************************************************************************************/
       }
        $this->db->trans_complete();
                
                //exit;
                if ($this->db->trans_status() === FALSE){
                    return array('error'=>'Sorry,Something went wrong.Please try in a while');
                }
                if($last_id)
                {
                    return array('success'=>true);
                }
                
    }
    public function get_news_promotion($id = false, $type = false) {
        $this->db->select('*');
        $this->db->from('news_letter');
        if ($id)
            $this->db->where(array('id' => $id));
        if ($type)
            $this->db->where(array('type' => $type));
        $this->db->where(array('status' => '1'));
        $query = $this->db->get();
        $this->db->last_query();
        if ($query->num_rows() > 0) {

            if ($id)
                return $query->row();
            else
                return $query->result();
        } else
            return false;
    }

    public function count_products() {
        $name=$this->input->post('filtername',true);
        $type=$this->input->post('filtertype',true);
        $sales_status=$this->input->post('filterstatus',true);
        $cond = '1=1';
        if ($name) {
            $cond="imei like('%$name%') or color like ('%$name%') or display_name like('%$name%') or suffix like('$name%')";
        }
        if ($type) {
            $cond = $cond . " and model_number='$type'";
        }
        if($sales_status=='1' || $sales_status=='0')
        {
           
            $cond=$cond." and sales_status='$sales_status'";
        }

        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('status', '1');
        $this->db->join('model m','p.model_number=m.id');
        $this->db->where('p.status','1');
        $this->db->where($cond);
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_products($limit=false,$offset=false,$count=false)
    {
        $name=trim($this->input->post('filtername',true));
        $type=$this->input->post('filtertype',true);
        $sales_status=$this->input->post('filterstatus',true);
        $cond='1=1';
        if($name)
        {
            $cond=$cond." and (imei like('%$name%') or color like ('%$name%') or display_name like('%$name%') or suffix like('$name%') )";
        }
        if($type)
        {
            $cond=$cond." and model_number='$type'";
        }
        if($sales_status=='1' || $sales_status=='0')
        {
           
            $cond=$cond." and p.sales_status='$sales_status'";
        }

        $this->db->select('*,p.id as product_id');
        $this->db->from('products p');
        $this->db->join('model m','p.model_number=m.id');
        $this->db->where('p.status','1');
        $this->db->where($cond);
        $this->db->order_by('p.id','desc');
        if($limit)
        $this->db->limit($limit, $offset);
        $query=$this->db->get();
        $this->db->last_query();
        if($count)
        {
            return $query->num_rows();
        }
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else return false;
    }
    public function get_user_details($id) {
        $this->db->select('AES_DECRYPT(email,salt) as email,id,AES_DECRYPT(display_name,salt) as display_name,AES_DECRYPT(username,salt) as username,operator');
        $query = $this->db->get_where('members', array('id' => $id));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else
            return false;
    }

    public function get_outlet_by_dealer($dealerid = false) {
     
        $name = $this->input->post('filtername', true);
        $dealer = $this->input->post('filterdealer', true);

        $cond = '1=1';
        if ($name) {
            $cond = "(outlet like('%$name%') or type like ('%$name%'))";
        }
        if ($dealer) {
            $cond = $cond . " and dealer_id='$dealer'";
        }

        $this->db->select('*');
        $this->db->from('outlet o');
        $this->db->where($cond);
        $this->db->where(array('status' => '1'));
        if ($dealerid)
            $this->db->where(array('dealer_id' => $dealerid));
        $query = $this->db->get();
        $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $data = $query->result();
        }
        return false;
    }

    public function get_all_edit_request() 
    {
        $cond='1=1';

        $dealer = $this->input->post('filterdealer', true);
        if($dealer)
        {
            $cond=$cond.' and m.dealer_id='.$dealer;
        }
        $this->db->select('m.id as user_id,AES_DECRYPT(d.first_name,m.salt) as first_name,AES_DECRYPT(d.last_name,m.salt) as last_name,AES_DECRYPT(email,salt) as email, AES_DECRYPT(NRIC,salt) as nric,AES_DECRYPT(d.country,m.salt) as country, AES_DECRYPT(d.phone,m.salt) as phone');
        $this->db->from('members m');
        $this->db->join('members_details d', 'm.id=d.user_id');
        $this->db->where($cond);
        $this->db->where('m.edit_approve_status', '1');

        $query = $this->db->get('');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_detail_new_info($id) 
    {
        $this->db->select('m.id,AES_DECRYPT(lg.email,m.salt) as email,AES_DECRYPT(lg.first_name,m.salt) as first_name,AES_DECRYPT(lg.NRIC,m.salt) as nric, AES_DECRYPT(lg.display_name,m.salt) as display_name,AES_DECRYPT(lg.address,m.salt) as address,AES_DECRYPT(lg.address2,m.salt) as address2, AES_DECRYPT(lg.country,m.salt) as country,AES_DECRYPT(lg.postal_code,m.salt) as postal_code,AES_DECRYPT(lg.phone,m.salt) as phone,AES_DECRYPT(lg.about_user,m.salt) as about_user,AES_DECRYPT(ld.display_name,ld.salt) as dealer_name,lg.dealer_id,lg.gender,lg.dob,lg.cover_image,O.type,O.outlet');
        $this->db->from('members m');
        $this->db->join('members_log lg', 'm.id=lg.id','left');
       
        $this->db->join('members ld','ld.id=lg.dealer_id','left');
        $this->db->join('outlet O','O.id=lg.outlet_id','left');
        $this->db->where('lg.id', $id);
        $this->db->order_by('lg.updated_date', 'DESC');
        $this->db->limit('1');
        $query = $this->db->get('members_log');
        if ($query->num_rows() == 1) 
        {
            return $query->row();
        } else 
        {
            return false;
        }
    }
    public function reject_profile_edit($id){
        $member=$this->general->get_user_details($id);
        $this->db->where('id',$id);
        $this->db->update('members',array('edit_approve_status'=>'0'));
         /******Send email to staff after approve***********/
            $template='staff_profile_edit_reject';
            $from=CONTACT_EMAIL;
            $to= $member->email;
            $parseElement=array(
                                    'USERNAME'      =>      $member->username,
                                    'WEBSITE_NAME'  =>      SITENAME
                               );
            $this->notification->send_email_notification($template, '', $from, $to, '', '', $parseElement, array());

            return true;
         
    }

    public function update_old_info($id) 
    {
        $this->db->where('id', $id);
        $this->db->order_by('updated_date', 'DESC');
        $this->db->limit('1');
        $query = $this->db->get('members_log');

        if ($query->num_rows() == 1) {
            $data = $query->row();
        }

        $email = $data->email;

        $nric = $data->NRIC;
        $dealer_id = $data->dealer_id;
        $this->db->trans_start();


        $members = array(
            'NRIC' => $nric,
            'email' => $email,
            'display_name' => $data->display_name,
            'last_modify_date' => $this->general->get_local_time('time'),
            'edit_approve_status' => '0',
            'dealer_id' => $dealer_id,
            'outlet_id' =>$data->outlet_id
        );
        if ($data->password != '') {
            $members['password'] = $data->password;
        }

        $this->db->where('id', $id);
        $this->db->update('members', $members);

        

        $members_details = array(
            'first_name' => $data->first_name,
            'address' => $data->address,
            'address2' => $data->address2,
            'country' => $data->country,
            'postal_code' => $data->postal_code,
            'mobile' => $data->phone,
            'about_user' => $data->about_user,
            'gender' => $data->gender,
            'dob' => $data->dob,
            'cover_image' => $data->cover_image,
        );
        
        
        $this->db->where('user_id', $id);
        $this->db->update('members_details', $members_details);
        // update staff dealer relation
        $this->db->where('staff_id',$id);
        $this->db->update('staff_dealer',array('status'=>'0'));
        $this->db->insert('staff_dealer',array('staff_id'=>$id,'dealer_id'=>$dealer_id,'status'=>'1'));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            return array('error_message'=>'Sorry,Something went wrong.Please try in a while');
        }
        else
        {
             /******Send email to staff after approve***********/
            $member=$this->general->get_user_details($id);
            $template='staff_profile_edit_accept';
            $from=CONTACT_EMAIL;
            $to= $member->email;
            $parseElement=array(
                                    'USERNAME'      =>      $member->username,
                                    'WEBSITE_NAME'  =>      SITENAME
                               );
            $this->notification->send_email_notification($template, '', $from, $to, '', '', $parseElement, array());

              return array('success_message'=>'Member Profile update successfull');
        }
       
    }

    Public function get_all_staff($outletid = false, $dealerid = false, $userid = false, $type = "all", $count = false, $limit = false, $offset = false) {
        $name = $this->input->post('filtername', true);
        $dealer = $this->input->post('filterdealer', true);
        if ($dealer)
            $dealerid = $dealer;
        $cond = '1=1';
        $this->db->select('m.outlet_id,m.id as user_id,AES_DECRYPT(m.email,m.salt) as email,AES_DECRYPT(about_user,m.salt) as about_user,AES_DECRYPT(m.display_name,m.salt) as display_name,AES_DECRYPT(first_name,m.salt) as first_name,AES_DECRYPT(m.display_name,m.salt) as display_name,AES_DECRYPT(last_name,m.salt) as last_name,AES_DECRYPT(m.NRIC,m.salt) as nric,AES_DECRYPT(m.username,m.salt) as username,AES_DECRYPT(address,m.salt) as address,AES_DECRYPT(address2,m.salt) as address2,AES_DECRYPT(country,m.salt) as country,m.reg_date,AES_DECRYPT(phone,m.salt) as phone,AES_DECRYPT(cover_image,m.salt) as cover_image,AES_DECRYPT(postal_code,m.salt) as postal_code,gender,dob,O.outlet,O.type,AES_DECRYPT(n.display_name,n.salt) as dealer_name');
        $this->db->from('members m');
        $this->db->join('members_details md', 'm.id=md.user_id');
        $this->db->join('members n', 'n.id=m.dealer_id');
        $this->db->join('outlet O','O.id=m.outlet_id','left');
        
        // $this->db->join('outlet o','o.id=m.outlet_id');
        $this->db->where('m.user_type', '4');
//        if ($outletid) {
//            $cond = $cond . ' and m.outlet_id=' . $outletid;
//        }
        if ($dealerid) {
            $cond = $cond . ' and m.dealer_id=' . $dealerid;
        }
        if ($type == 'pending') {
            $cond = $cond . ' and m.status="2"';
        }
        if ($type == 'dealer_approved') {
            $cond = $cond . ' and m.status="0"';
        }
        if ($type == 'registered') {
            $cond = $cond . ' and m.status="1"';
        }
        if ($name) {
            $nametemp = explode(' ', trim($name));

            if (isset($nametemp[1]))
                $cond = $cond . " and AES_DECRYPT(first_name,salt) like('%$nametemp[0]%') and AES_DECRYPT(last_name,salt) like ('%$nametemp[1]%')";
            else
                $cond = $cond . " and AES_DECRYPT(first_name,salt) like('%$name%') or AES_DECRYPT(last_name,salt) like ('%$name%')";
        }
        if ($userid) {
            $cond = $cond . " and m.id=" . $userid;
        }
        $this->db->where($cond);
        $this->db->order_by('m.id', 'desc');
        if (!$count) {
            if ($limit)
                $this->db->limit($limit, $offset);
            if ($userid) {
                $this->db->limit(1);
            }

            $query = $this->db->get();
//            echo $this->db->last_query();exit;
            if ($query->num_rows() > 0) {
                 // print_r($query->result());exit;
                return $query->result();
            } else
                return false;
        }
        else {
            $query = $this->db->get();

//            echo $this->db->last_query();exit;
            return $query->num_rows();
        }
    }
    public function file_settings_do_upload($file, $location, $encrypt_filename = '') {

        $config['upload_path'] = './' . $location;   //file upload location
        $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
        $config['remove_spaces'] = TRUE;
        $config['max_size'] = '2048';
        $config['max_width'] = '1000';
        $config['max_height'] = '1000';
        if (!file_exists($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }
        if ($encrypt_filename = 'encrypt') {
            $config['encrypt_name'] = TRUE;
        }

        $this->upload->initialize($config);
        $this->upload->do_upload($file);
        if ($this->upload->display_errors()) {
            $this->error_img = $this->upload->display_errors();
            return false;
        } else {
            $data = $this->upload->data();
            return $data;
        }
    }

    public function get_all_sales_report()
    {
        $dealer=trim($this->input->post('filterdealer',true));
        $model=trim($this->input->post('filtermodel',true));
        $fromdate=trim($this->input->post('filterfromdate',true));
        $outlet=trim($this->input->post('filteroutlet',true));    
        $todate=trim($this->input->post('filtertodate',true));
        $today=$this->general->get_local_time();
        $cond='1=1';
        if($dealer)
        { 
            $cond=$cond." and S.dealer_id=$dealer";
        }
        if($model)
        {
            $cond=$cond." and P.model_number='$model'";
        }
        if($outlet)
        {
            $cond=$cond." and S.outlet_id='$outlet'";
        }
        if($fromdate!='' && $todate!='')
        {
            $cond=$cond." and date(S.invoice_date) between'". $fromdate."' and '".$todate."'";
        }
        elseif($fromdate){
            $cond=$cond." and date(S.invoice_date) between'". $fromdate."' and '".$today."'";
        }
        elseif($todate){
            $cond=$cond." and date(S.invoice_date) between'". $today."' and '".$todate."'";
        }
        $this->db->select('
                            (SELECT i.id FROM emts_incentive i
                            JOIN emts_dealer_incentive di ON i.id=di.incentive_id 
                            WHERE i.model_id=P.model_number AND S.dealer_id=di.dealer_id AND S.invoice_date 
                            BETWEEN i.start_date AND i.end_date  ) AS incentive,S.user_id,S.dealer_id,

                            aes_decrypt(m.display_name,m.salt) as dealer,aes_decrypt(n.display_name,n.salt) as staff,o.outlet,o.type,mo.display_name as model,P.imei,P.color,S.invoice_date,S.invoice_id,S.submit_date');
        $this->db->from('sales_report S');
        $this->db->join('members m','S.dealer_id=m.id');
        $this->db->join('members n','S.user_id=n.id');
        $this->db->join('outlet o','S.outlet_id=o.id','left');
        $this->db->join('products P','S.product_id = P.id');
        $this->db->join('model mo','mo.id=P.model_number');
        $this->db->where($cond);
        $this->db->where('S.status','accepted');
        $query = $this->db->get('');
         $this->db->last_query();
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else return false;

    }   

    public function get_staff_reward($limit=false,$offset=false,$count=false){
        $name=$this->input->post('filtername');
        $cond='1=1';
        if($name)
        {
            $nametemp=explode(' ', trim($name));

            if(isset($nametemp[1]))
            $cond=$cond." and (AES_DECRYPT(first_name,m.salt) like('%$nametemp[0]%') and AES_DECRYPT(last_name,m.salt) like ('%$nametemp[1]%'))";
            else
            $cond=$cond." and (AES_DECRYPT(first_name,m.salt) like('%$name%') or AES_DECRYPT(last_name,m.salt) like ('%$name%'))";
        }
        $this->db->select('outlet,type,m.dealer_id,m.id as user_id,AES_DECRYPT(d.first_name,m.salt) as first_name,'
                . 'AES_DECRYPT(d.last_name,m.salt) as last_name,'
                . 'AES_DECRYPT(d.address,m.salt) as address,'
                . 'AES_DECRYPT(d.address2,m.salt) as address2,'
                . 'AES_DECRYPT(d.country,m.salt) as country,'
                . 'AES_DECRYPT(d.postal_code,m.salt) as postal_code,'
                . 'AES_DECRYPT(d.phone,m.salt) as phone,'
                . 'cover_image,'
                . 'AES_DECRYPT(d.mobile,m.salt) as mobile,'
                . 'AES_DECRYPT(d.about_user,m.salt) as introduction,'
                . 'gender,'
                . 'd.dob,'
                . 'm.reg_date,'
                . 'AES_DECRYPT(m.NRIC,m.salt) as nric,'
                . 'AES_DECRYPT(n.display_name,n.salt) as dealer_name,'
                . 'AES_DECRYPT(m.display_name,m.salt) as display_name,'
                . 'AES_DECRYPT(m.email,m.salt) as email');
        $this->db->from('members m');
        $this->db->join('outlet o','m.outlet_id=o.id','left');
        $this->db->join('members_details d', 'm.id=d.user_id');
        $this->db->join('members n', 'n.id=m.dealer_id');
        $this->db->where(array('m.status' => '1','m.user_type'=>'4'));
         $this->db->where($cond);
        $this->db->order_by('m.id','desc');
        if($limit)
            $this->db->limit($limit,$offset);                                                                                                           
         $query = $this->db->get();
          $this->db->last_query();
        if($count)
        {
           return $query->num_rows();
        }
       if ($query->num_rows()>0) {
            return $query->result();
        }
        return false;
   
    }


public function get_admin_incentive_report($type='staff')
{
    $model=trim($this->input->post('filtermodel',true));
    $fromdate=trim($this->input->post('filterfromdate',true));
    $todate=trim($this->input->post('filtertodate',true));
    $outletid=trim($this->input->post('filteroutlet',true));
    $userid=trim($this->input->post('filterdealer',true));
    $today=$this->general->get_local_time(); 
   

    $cond='1=1';
     if($model)
    {
        $cond=$cond." and i.model_id=$model";
    }
     if($outletid)
    {
        $cond=$cond." and a.outlet_id=$outletid";
    }
    if($userid)
    {
        $cond=$cond." and a.dealer_id=$userid";
    }
    if($fromdate!='' && $todate!='')
    {
        $cond=$cond." and date(a.invoice_date) between '". $fromdate."' and '".$todate."'";
    }
    elseif($fromdate){
        $cond=$cond." and date(a.invoice_date) between '". $fromdate."' and '".$today."'";
    }
    elseif($todate){
        $cond=$cond." and date(a.invoice_date) between '". $today."' and '".$todate."'";
    }

    $this->db->select('i.id as incentiveid,i.*,m.display_name,count(a.id) as sales_count');
    $this->db->from('incentive as i');
    $this->db->join('dealer_incentive d','i.id=d.incentive_id');
    $this->db->join('products p','i.model_id=p.model_number');
    $this->db->join('sales_report a','a.product_id=p.id and d.dealer_id=a.dealer_id');
    $this->db->join('model m','m.id = i.model_id','left');
    $this->db->where("a.invoice_date BETWEEN i.start_date AND i.end_date and a.status='accepted' and i.end_date>='".$today."'");
    $this->db->where($cond);
    if($type=='staff')
    {
         $this->db->group_by('i.id,a.user_id');   
    }
    else
    {
         $this->db->group_by('i.id');   
    }
   
    $this->db->order_by('i.id','desc');
    $query = $this->db->get('');
       $this->db->last_query();
    if($query->num_rows()>0)
    {
        return $query->result();
    }

    else return false;
}
public function get_admin_incentive_history()
{
    $model=trim($this->input->post('filtermodel',true));
    $fromdate=trim($this->input->post('filterfromdate',true));
    $todate=trim($this->input->post('filtertodate',true));
    $outletid=trim($this->input->post('filteroutlet',true));
    $userid=trim($this->input->post('filterdealer',true));
    $today=$this->general->get_local_time(); 
   

    $cond='1=1';
     if($model)
    {
        $cond=$cond." and i.model_id=$model";
    }
     if($outletid)
    {
        $cond=$cond." and a.outlet_id=$outletid";
    }
    if($userid)
    {
        $cond=$cond." and a.dealer_id=$userid";
    }
    if($fromdate!='' && $todate!='')
    {
        $cond=$cond." and date(a.invoice_date) between '". $fromdate."' and '".$todate."'";
    }
    elseif($fromdate){
        $cond=$cond." and date(a.invoice_date) between '". $fromdate."' and '".$today."'";
    }
    elseif($todate){
        $cond=$cond." and date(a.invoice_date) between '". $today."' and '".$todate."'";
    }

    $this->db->select('i.id as incentiveid,i.*,m.display_name,count(a.id) as sales_count');
   
    $this->db->from('incentive as i');
    $this->db->join('dealer_incentive d','i.id=d.incentive_id');
    $this->db->join('products p','i.model_id=p.model_number');
    $this->db->join('sales_report a','a.product_id=p.id and d.dealer_id=a.dealer_id');
    $this->db->join('model m','m.id = i.model_id','left');
    $this->db->where("a.invoice_date BETWEEN i.start_date AND i.end_date and a.status='accepted' and i.end_date<'".$today."'");
    $this->db->where($cond);
    $this->db->group_by('i.id');   
    $this->db->order_by('i.id','desc');
    $query = $this->db->get('');
       $this->db->last_query();
    if($query->num_rows()>0)
    {
        return $query->result();
    }

    else return false;
}
public function incentive_name_exists($name,$id=false)
    {
        $data = array();
        if($id)
        {
            $this->db->where_not_in('id',$id);
            $query = $this->db->get_where("incentive",array('name'=>$name));
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
            $query = $this->db->get_where("incentive",array('name'=>$name));
            if ($query->num_rows() > 0) 
            {
                $data=$query->row();                
            }
            $query->free_result();  
            return $data;
        }
    }
}