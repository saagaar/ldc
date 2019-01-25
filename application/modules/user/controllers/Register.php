<?php

if (!defined('BASEPATH'))  exit('No direct script access allowed');
class Register extends CI_Controller {
   function __construct()
    {
        parent::__construct();
        if (SITE_STATUS == '2') 
        {
            redirect(site_url('/offline'));
            exit;
        } 
        else if (SITE_STATUS == '3') 
        {
            //check whetheh logged in or not. if logged in as maintaince user, let them visit site. else redirect to maintainance page
            if (!$this->session->userdata('MAINTAINANCE_KEY') == 'YES' OR $this->session->userdata('MAINTAINANCE_KEY') != 'YES') 
            {
                redirect(site_url('/maintainance'));
                exit;
            }
        }
        //check banned IP address
        $this->general->check_banned_ip();
        $this->load->library('form_validation'); 
        $this->load->model('register_model');
        $this->form_validation->set_error_delimiters('<span generated="true" class="text-danger">', '</span>');
    }

    public function email_taken() 
    {
        $email = trim($this->input->post('email'));
        // if the email exists return a 1 indicating true
        $result = $this->register_model->email_exists($email);
        if ($result) 
        {
           $this->form_validation->set_message('email_taken', "The email is already taken");
            return FALSE;
        } else 
        {
        return true;
        }
    }
     public function username_taken() 
     {
        $username = trim($this->input->post('username'));
        // if the email exists return a 1 indicating true
        $result = $this->register_model->username_exists($username);
        if ($result)
        {
           $this->form_validation->set_message('username_taken', "The Username is already taken");
            return FALSE;
        } 
        else 
        {
          return true;
        }
    }

    public function check_email_availability($id=false) {
        //exit if the request is not ajax
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $email = trim($this->input->post('email'));
        // if the username exists return a 1 indicating true
        $result = $this->register_model->email_exists($email,$id);
        
        if (count($result)>0) {
            echo 'taken';
        } else {
            echo 'available';
        }
    }

    public function check_username_availability($id=false) {
        //exit if the request is not ajax
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $username = trim($this->input->post('username'));
        // if the username exists return a 1 indicating true
        $result = $this->register_model->username_exists($username,$id);
        if ($result) {
            echo 'taken';
        } else {
            echo 'available';
        }
    }

     // buyer registration
    public function student() 
    {
        $this->form_validation->set_rules($this->register_model->validate_student_regisration);
        if ($this->form_validation->run() === TRUE) {
            $response = $this->register_model->insert_student();
          if(isset($response['success_message']))
          {
              $this->session->set_flashdata('success_message',$response['success_message']);
              $this->register_model->send_email_registration_success();
              redirect(site_url('/login/student'));

          }
          else
          {
              $this->session->set_flashdata('error_message',$response['error_message']);
              redirect(site_url('/user/register/student'));
          }
        }
        // $this->data['countrylist'] = $this->general->get_all_countries();
        // $this->data['dealerlist'] = $this->general->get_dealers_list();
        $this->data['meta_keys'] = WEBSITE_NAME;
        $this->data['meta_desc'] = WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME . ' - Student Registration';
        $this->template
                ->set_layout('general')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_student_registration', $this->data);
    }
  
    // member activation function
    public function activation($activation_code, $user_id) 
    {
        if (!isset($user_id) OR $user_id == '') 
        {
            redirect(site_url('/'));
        }
        if (!isset($activation_code) OR $activation_code == '') 
        {
            redirect(site_url('/'));
        }

        $user_type_data = $this->general->fetch_members_selected_fields(array('user_type'), array('id' => $user_id));
        $activation_status = $this->register_model->check_user_activation($activation_code, $user_id);
         if ($activation_status == TRUE)
          {
            $cms_id = 11;
        } else {
            $cms_id = 12;
        }
        $this->data['cms'] = $this->general->get_cms_details($cms_id);
        $seo_data = $this->general->get_seo(1);
        if ($seo_data) 
        {
            //set SEO data
            $this->page_title = $seo_data->page_title;
            $this->data['meta_keys'] = $seo_data->meta_key;
            $this->data['meta_desc'] = $seo_data->meta_description;
        } else 
        {
            //set SEO data
            $this->page_title = WEBSITE_NAME;
            $this->data['meta_keys'] = WEBSITE_NAME;
            $this->data['meta_desc'] = WEBSITE_NAME;
        }
        $this->template
                ->set_layout('general')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_cms_data', $this->data);
    }

    /* authentication un-successful */
    public function logout() 
    {
        $this->session->sess_destroy();
        redirect(site_url('user/register/creator'));
    }
}
