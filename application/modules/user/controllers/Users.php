<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (SITE_STATUS == '2') {
            redirect(site_url('/offline'));
            exit;
        } else if (SITE_STATUS == '3') {
            //check whetheh logged in or not. if logged in as maintaince user, let them visit site. else redirect to maintainance page
            if (!$this->session->userdata('MAINTAINANCE_KEY') OR $this->session->userdata('MAINTAINANCE_KEY') != 'YES') {
                redirect(site_url('/maintainance'));
                exit;
            }
        }

        //check banned IP address
        $this->general->check_banned_ip();

        //load library
        $this->load->library('upload');
        $this->load->library('image_lib');
        //CI Formvalidation
        $this->load->library('form_validation');

        //load module
        $this->load->model('users_model');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');  
    }
     public function feedback($view = 'staff') {

        if ($userid = $this->session->userdata(SESSION . 'user_id') && !$this->input->post('contact_us')) {
            $this->form_validation->set_rules($this->users_model->validate_feedback_userid);
        } elseif($this->input->post('contact_us')=='contact_us') {
            $this->form_validation->set_rules($this->users_model->validate_contact_us);
        }else{
            $this->form_validation->set_rules($this->users_model->validate_feedback_staff);
        }
        
        if ($this->form_validation->run() == TRUE) {
            $trans = $this->users_model->add_feedback();
            if ($trans == TRUE) {
                if ($this->input->post('feedback_type') == 'technical') {
                    $this->session->set_flashdata('success_message', 'The Feedback Sent Successfully to Our Technical Support Team');
                    redirect(site_url('/dealer/settings'));
                } else if($this->input->post('contact_us')=='contact_us') {
                    $this->session->set_flashdata('success_message', 'Your form has been submitted successfully.');
                    redirect(site_url('/dealer/settings'));
                }else{
                    $this->session->set_flashdata('success_message', 'Your form has been submitted successfully.');
                    redirect(site_url('/login/staff'));
                }
            } else {
                $this->session->set_flashdata('error_message', 'The Feedback Could not be sent. Try again');
                redirect(site_url('/dealer/settings'));
            }
        }
//        redirect(site_url('dealer/settings'));
        $this->data['meta_keys'] = WEBSITE_NAME;
        $this->data['meta_desc'] = WEBSITE_NAME;
        $this->data['account_menu_active'] = '';
        $this->page_title = WEBSITE_NAME . ' - Staff Feedback';
       if ($userid = $this->session->userdata(SESSION . 'user_id')){
        $this->data['account_menu_active'] = 'dealer';
        $this->data['sub_menu_active'] = 'settings';
        
        $this->template
                ->set_layout('dealer_dashboard')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_settings', $this->data);
       }else{
           $this->template
                ->set_layout('feedback_layout')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_staff_feedback', $this->data);
       }
   }

//     public function feedback($view = 'staff') {
// //        print_r($_POST);print_r($_FILES);exit;
//         if ($userid = $this->session->userdata(SESSION . 'user_id')) {
//             $this->form_validation->set_rules($this->users_model->validate_feedback_userid);
//         } else {
//             $this->form_validation->set_rules($this->users_model->validate_feedback_staff);
//         }

//         if ($this->form_validation->run() == TRUE) {

//             $trans = $this->users_model->add_feedback();

//             if ($trans == TRUE) {
//                 if ($this->input->post('feedback_type') == 'technical') {
//                     $this->session->set_flashdata('success_message', 'The Feedback Sent Successfully to Our Technical Support Team');
//                     redirect(site_url('/dealer/settings'));
//                 } else {
//                     $this->session->set_flashdata('success_message', 'The Feedback Sent Successfully to Our LG Support Team');
//                     redirect(site_url('/dealer/settings'));
//                 }
//             } else {
//                 $this->session->set_flashdata('error_message', 'The Feedback Could not be sent. Try again');
//                 redirect(site_url('/dealer/settings'));
//             }
//         }
// //        redirect(site_url('dealer/settings'));
//         $this->data['account_menu_active'] = 'dealer';
//         $this->data['sub_menu_active'] = 'settings';
//         $this->data['meta_keys'] = WEBSITE_NAME;
//         $this->data['meta_desc'] = WEBSITE_NAME;
//         $this->data['account_menu_active'] = '';
//         $this->page_title = WEBSITE_NAME . ' - Staff Feedback';
//         $this->template
//                 ->set_layout('dealer_dashboard')
//                 ->enable_parser(FALSE)
//                 ->title($this->page_title)
//                 ->build('v_settings', $this->data);
//     }

    // public function index($user_id)
    // {
    // 	if($user_id=='' OR !is_numeric($user_id)){redirect(site_url()); exit; }
    // 	$this->data['user_id'] = $this->session->userdata(SESSION.'user_id');
    // 	$this->data['seller'] = $this->users_model->get_seller_info_by_member_id($user_id);
    // 	//echo "<pre>"; print_r($this->data['seller']); echo "</pre>";// exit;
    // 	//redirect to home page if seller data is not found
    // 	if(!$this->data['seller']){redirect(site_url('/'),'refresh'); exit;}
    // 	$this->breadcrumbs->push('Profile :: '.ucwords($this->data['seller']->name), '/'); //second parameter is link
    // 	$this->current_date = $this->general->get_local_time('time');
    // 	$this->data['current_date'] = $this->current_date;
    // 	//$this->data['positive_feedback']=$this->users_model->get_total_positive_rating($seller);
    // 	//$this->data['negative_feedback']=$this->users_model->get_total_negative_rating($seller);
    // 	//$this->data['neutral_feedback']=$this->users_model->get_total_neutral_rating($seller);
    // 	//get total upcoming host auctions
    // 	$this->data['upcoming_auction_hosts'] = $this->users_model->get_sellers_upcoming_items($user_id);
    // 	//echo "<pre>"; print_r($this->data['upcoming_auction_hosts']); echo "</pre>";// exit;
    // 	//only fetch those products which are available for buy now and still available for buy
    // 	$this->data['store_products'] = $this->users_model->get_sellers_store_items($user_id);
    // 	//echo "<pre>"; print_r($this->data['store_products']); echo "</pre>";// exit;
    // 	//set SEO data
    // 	$this->page_title = $this->general->clean_url($this->data['seller']->name).' - '.WEBSITE_NAME;
    // 	$this->data['meta_keys'] = WEBSITE_NAME;
    // 	$this->data['meta_desc'] = WEBSITE_NAME;
    // 	$this->template
    // 		->set_layout('general')
    // 		->enable_parser(FALSE)
    // 		->title($this->page_title)
    // 		->build('v_sellers_profile', $this->data);
    // }
    // public function upload_profile_image()
    // {
    // 	if($this->input->server('REQUEST_METHOD')=='POST' && !empty($_FILES['profile_picture']['tmp_name']))
    // 	{
    // 		$this->data['user_id'] = $this->session->userdata(SESSION.'user_id');
    // 		//check whetehr user id are matched or not
    // 		if($this->input->post('uid',TRUE)==$this->data['user_id'])
    // 		{
    // 			//now upload image
    // 			$this->users_model->change_profile_image($this->data['user_id']);
    // 			//$this->session->set_flashdata('success_message', "Image Updated Successfully.");
    // 			redirect(site_url('user/'.$this->data['user_id'])); exit;
    // 		}
    // 	}
    // 	//redirect to home page
    // 	redirect(site_url());
    // }
    // public function ajax_send_message(){
    // 	if(!$this->input->is_ajax_request())
    // 	{
    // 		exit('No direct script access allowed');
    //        }
    // 	if($this->session->userdata(SESSION.'user_id') && $this->input->server('REQUEST_METHOD')=='POST')
    // 	{
    // 		if($this->session->userdata(SESSION.'user_id') == $this->input->post('sender',TRUE)){
    // 			//print_r(json_encode($_POST)); exit;
    // 			$query = $this->users_model->insert_contact_message();
    // 			if($query){
    // 				$response_array['status']='success';
    // 				$response_array['message']='Message Sent Successfully';
    // 			}else{
    // 				$response_array['status']='error';
    // 				$response_array['message']='Unable to Send Message';
    // 			}
    // 		}else{
    // 			$response_array['status']='error';
    // 			$response_array['message']='Invalid operation';
    // 		}	
    // 	}else{
    // 		$response_array['status']='error';
    // 		$response_array['message']='Invalid operation';
    // 	}
    // 	print_r(json_encode($response_array)); exit;
    // }
    // public function host_auction_detail($host_id){
    // 	if($host_id=='' OR !is_numeric($host_id)){redirect(site_url()); exit; }
    // 	$this->data['user_id'] = $this->session->userdata(SESSION.'user_id');
    // 	$this->data['reminder'] = false;
    // 	$this->data['host_terms_accepted'] = false;
    // 	//get host details
    // 	$this->data['host'] = $this->users_model->get_host_details_by_host_id($host_id);
    // 	if($this->data['host']==false){redirect(site_url()); exit;}
    // 	//echo "<pre>"; print_r($this->data['host']); echo "</pre>";// exit;
    // 	$this->current_date = $this->general->get_local_time('time');
    // 	$this->data['current_date'] = $this->current_date;
    // 	$this->data['header_menu_active'] = 'host_auction';
    // 	//get co-sellers in this auction
    // 	$this->data['cosellers'] = $this->users_model->get_host_auctions_co_sellers_by_host_id($host_id);
    // 	//echo "<pre>"; print_r($this->data['cosellers']); echo "</pre>";// exit;
    // 	//now calculate cosellers total auctios in this host
    // 	$this->data['cosellers_auctions'] = '';
    // 	if($this->data['cosellers']){
    // 		foreach($this->data['cosellers'] as $sellers){
    // 			$this->data['cosellers_auctions'] = $this->data['cosellers_auctions'] + $sellers->total_auctions;
    // 		}	
    // 	}
    // 	//get auctions in this 
    // 	$this->data['auctions'] = $this->users_model->get_auctions_in_host_by_host_id($host_id);
    // 	//echo "<pre>"; print_r($this->data['auctions']); echo "</pre>";// exit;
    // 	if($this->data['user_id'] && $this->data['host']){
    // 		//check whether this user have added this auction to reminder list or not
    // 		$this->data['reminder'] = $this->general->check_users_item_auction_reminder('host', $this->data['user_id'], $host_id, '' );
    // 		$this->data['host_terms_accepted'] = $this->general->check_host_terms_accepted_by_cohost($this->data['user_id'],$host_id);	
    // 	}
    // 	//var_dump($this->data['reminder']); 
    // 	$this->page_title = ''; //$this->general->clean_url($this->data['seller']->name).' - '.WEBSITE_NAME;
    // 	$this->data['meta_keys'] = WEBSITE_NAME;
    // 	$this->data['meta_desc'] = WEBSITE_NAME;
    // 	$this->template
    // 		->set_layout('general')
    // 		->enable_parser(FALSE)
    // 		->title($this->page_title)
    // 		->build('v_host_detail', $this->data);
    // }
    // public function ajax_accept_host_auction_terms(){
    // 	if(!$this->input->is_ajax_request())
    // 	{
    // 		exit('No direct script access allowed');
    //        }
    // 	if($this->session->userdata(SESSION.'user_id') && $this->input->post('accept',TRUE)=='yes'){
    // 		if($this->session->userdata(SESSION.'user_id') == $this->input->post('seller',TRUE)){
    // 			//print_r(json_encode($_POST)); exit;
    // 			$query = $this->users_model->insert_host_terms_accepted_by_cohost($this->session->userdata(SESSION.'user_id'), $this->input->post('host',TRUE));
    // 			if($query){
    // 				$response_array['status']='success';
    // 				$response_array['message']='Terms Accepted Successfully.';
    // 			}else{
    // 				$response_array['status']='error';
    // 				$response_array['message']='Error while registering accepted terms.';
    // 			}
    // 		}else{
    // 			$response_array['status']='error';
    // 			$response_array['message']='Invalid operation';
    // 		}	
    // 	}else{
    // 		$response_array['status']='error';
    // 		$response_array['message']='Invalid operation';
    // 	}
    // 	print_r(json_encode($response_array)); exit;
    // }
}
