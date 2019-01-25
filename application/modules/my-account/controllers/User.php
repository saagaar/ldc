<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class User extends CI_Controller {
	function __construct() {
		parent::__construct();
		    $this->load->library('Ajax_pagination');
		//load custom language library
		// if(SITE_STATUS == '2')
		// {
		// redirect(site_url('/offline'));exit;
		// }
		// else if(SITE_STATUS == '3')
		// {
		// 	//check whether logged in or not. if logged in as maintaince user, let them visit site. else redirect to maintainance page
		// 	if(!$this->session->userdata('MAINTAINANCE_KEY') OR $this->session->userdata('MAINTAINANCE_KEY')!='YES'){
		// 		redirect(site_url('/maintainance'));exit;
		// 	}
		// }
		// if(!$this->session->userdata(SESSION.'user_id'))
  //       {
  //         	$this->session->set_flashdata('loginerror', "Please Login to access this page.");
		// 	redirect(site_url('/'),'refresh');exit;
  //       }
		 //check brandanned IP address
		$this->general->check_banned_ip();
		//load CI library
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library('form_validation');
		$this->load->library("pagination");	
		$this->load->helper('text');
		$this->load->model('account_module');
		$this->load->model('paypal_module');
		$this->load->model('email-settings/admin_email_settings');
		//Changing the Error Delimiters
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');		
	}

	public function delete_data($id=false,$table=false,$message='Product')
	{
		$this->load->library('user_agent');

		try
		{
			if(!$id) throw new Exception('No Delete Record found',1);
			if(!$table) throw new Exception('No Table found',1);
			$res=$this->general->update_data($table,array('status'=>'0'),array('id'=>$id));
			 $affectedrows=$this->db->affected_rows();
			if($res)
			{
				if(LOG_ADMIN_ACTIVITY == 'Y'){
						$this->general->log_admin_activity(array('user_id' => $this->session->userdata(SESSION.'user_id'), 'user_type' =>  $this->session->userdata(SESSION.'usertype'), 'module' => 'Delete '.$message, 'module_desc' => $message.' Management', 'action' => 'Delete', 'extra_info' => $message.' id: '.$id));
					}
			}

			 if ($this->input->is_ajax_request()) 
			 {
	            if($affectedrows>0) 
	            {
	            	echo json_encode(array('success_message'=>$message.' Deleted Successfully'));exit;
	            }
				else 
				{
					echo json_encode(array('error_message'=>$message.' Delete Failed'));
					exit;
				}
	         }
	        else
	        {
	        	if($affectedrows>0) $this->session->set_flashdata('success_message',$message.' Deleted Successfully');
				else $this->session->set_flashdata('success_message',$message.' Delete Failed');
						redirect($this->agent->referrer());exit;
	        }
			
		}
		catch(exception $e)
		{
			 if ($this->input->is_ajax_request()) 
			 {
	            echo json_encode(array('error_message'=>$e->getMessage()));exit;
				
	         }
	         else
	         {
	         	$this->session->set_flashdata('error_message',$e->getMessage());
						     redirect($this->agent->referrer());exit;
	         }
			
		}
	}
	
	public function get_member_by_id($id=false)
    {
    	try
		{
			if(!$id) throw new Exception('No Record found',1);
			$data=$this->account_module->get_members_by_id($id);
			
			if($data==false)
			{
				echo json_encode(array('error_message'=>'Error in data fetching'));
			}
			else{
				echo json_encode($data);
			}
			
		}
		catch(exception $e)
		{
			$this->session->set_flashdata('error_message',$e->getMessage());
		    redirect($this->agent->referrer());exit;
		}
    }

    public function get_model_by_id($id=false)
    {
    	try
		{
			if(!$id) throw new Exception('No Record found',1);
			$data=$this->account_module->get_model_by_id($id);
			
			if($data==false)
			{
				echo json_encode(array('error_message'=>'Error in data fetching'));
			}
			else{
				echo json_encode($data);
			}
			
		}
		catch(exception $e)
		{
			$this->session->set_flashdata('error_message',$e->getMessage());
		    redirect($this->agent->referrer());exit;
		}
    }

   	function get_outlet_by_dealer($dealerid)
   	{
   		$this->db->select('*');
   		$this->db->from('outlet');
   		$this->db->where(array('status'=>'1','dealer_id'=>$dealerid));
   		$response='<option value="">Select</option>';
   		$query=$this->db->get();
   		if($query->num_rows()>0)
   		{
   			$data= $query->result();
   			foreach($data as $val)
   			{
   				$response=$response.'<option value="'. $val->id.'">'. $val->outlet.'</option>';
   			}

   		}
   		echo $response;	
   	}
   	function get_staff_by_outlet($outletid=false)
   	{
   		$this->load->model('dealer/dealer_model');
   		$data=array();
   		if($outletid)
   		$data=$this->dealer_model->get_all_staff($outletid);
   		
   		$response='<option value="">Select</option>';
   			if(count($data)>0)
   			{
   				foreach($data as $val)
	   			{
	   				$response=$response.'<option value="'. $val->user_id.'">'. $val->username.'</option>';
	   			}
   			}
   			

   		
   		echo $response;	
   	}
   	function get_type_by_outlet($outletid=false)
   	{
   		if($outletid)
   		{
   			$this->db->select('*');
	   		$this->db->from('outlet');
	   		$this->db->where(array('status'=>'1','id'=>$outletid));
	   	
	   		$query=$this->db->get();
	   		if($query->num_rows()>0)
	   		{
	   			$data= $query->row();
	   			echo $data->type;
	   			
	   		}
   		}
   		
   		echo '';
   	}
	/**************************LG INCENTIVE***************************************/

	
}


