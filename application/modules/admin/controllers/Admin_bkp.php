<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        // $this->load->library('Ajax_pagination');
        //load custom language library
        if (SITE_STATUS == '2') {
            redirect(site_url('/offline'));
            exit;
        } else if (SITE_STATUS == '3') {
            //check whether logged in or not. if logged in as maintaince user, let them visit site. else redirect to maintainance page
            if (!$this->session->userdata('MAINTAINANCE_KEY') OR $this->session->userdata('MAINTAINANCE_KEY') != 'YES') {
                redirect(site_url('/maintainance'));
                exit;
            }
        }
        if (!$this->session->userdata(SESSION . 'user_id')) {
            $this->session->set_flashdata('error_message', "Please Login to access this page.");
            redirect(site_url('/login/admin'), 'refresh');
            exit;
        }

        //check banned IP address
        // $this->general->check_banned_ip();
        //load CI library
        $this->load->library('upload');
        // $this->load->library('image_lib');
        $this->load->library('form_validation');
        $this->load->library('Ajax_pagination');
        // $this->load->library("pagination");
        // $this->load->helper('text');
        $this->load->model('admin_model', 'model');
        //Changing the Error Delimiters
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    // for create Campaign	
    public function dealer_management() {
        $this->data['account_menu_active'] = 'admin';
        $this->data['sub_menu_active'] = 'dealer_management';
        $this->data['dealerlist'] = $this->general->get_dealers_list();
        $this->data['topdealer'] = isset($this->data['dealerlist']['0']->id) ? $this->data['dealerlist']['0']->id : false;
        $this->data['outletlist'] = $this->model->get_outlet_by_dealer($this->data['topdealer']);
        $this->data['meta_keys'] = WEBSITE_NAME;
        $this->data['meta_desc'] = WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME . ' - Login';
//        echo $this->data['topdealer'];exit;
        $this->template
                ->set_layout('admin_dashboard')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_dealer_management', $this->data);
    }

    public function ajax_dealer_management() {

        // $page = $this->input->post('page');
        //     if(!$page){
        //         $offset = 0;
        //     }else{
        //         $offset = $page; 
        //     }
        //      // $config["cur_page"] = ($page+1)/2;
        //     //total rows count
        //     $config['total_rows'] = $this->model->count_products();
        //     //pagination configuration
        //     $config['target']      = '.filterview';
        //     $config['base_url'] = site_url('/' . ADMIN . '/ajax_management');
        //     $config['per_page']    = FRONTEND_LIST_PAGE	;
        //     $this->ajax_pagination->initialize($config);
        //get the posts data
        if ($this->model->get_outlet_by_dealer()) {
            $this->data['outletlist'] = $this->model->get_outlet_by_dealer();
        } else {
            $this->data['outletlist'] = '';
        }

        $this->data['dealer_id'] = $this->input->post('filterdealer', true);
        echo $this->load->view('ajax_dealer_management', $this->data, true);
    }

    Public function add_dealer($id = false) {


        $this->form_validation->set_rules($this->model->validate_dealer());
        $this->data['dealer'] = false;
        $this->data['outlet'] = false;
        if ($this->form_validation->run() === TRUE) {

            $response = $this->model->add_dealer($id);
            if (isset($response['success_message'])) {
                $this->session->set_flashdata('success_message', $response['success_message']);
                redirect(site_url('/' . ADMIN . '/dealer_management'));
            } else {
                $this->session->set_flashdata('error_message', $response['error_message']);
                redirect(site_url('/' . ADMIN . '/add_dealer'));
            }
        }
        if ($id) {
            $this->data['dealer'] = $this->model->get_user_details($id);
            $this->data['outlet'] = $this->general->get_data('outlet', array('dealer_id' => $id));
        }
        $this->data['operators'] = $this->general->get_operators();
        $this->data['account_menu_active'] = 'admin';
        $this->data['sub_menu_active'] = 'dealer_management';
        $this->data['meta_keys'] = WEBSITE_NAME;
        $this->data['meta_desc'] = WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME . ' - Login';
        $this->template
                ->set_layout('admin_dashboard')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_add_dealer', $this->data);
    }

    public function product_management() {
        /*         * *************for product addition******** */

        $this->form_validation->set_rules($this->model->validate_add_product);
        if ($this->form_validation->run() === TRUE) {
            $response = $this->model->add_product();
            echo json_encode($response);
            exit;
        }

        $config['base_url'] = site_url('/' . ADMIN . '/ajax_management');
        $config['target'] = '.filterview';
        $config['total_rows'] = $this->model->count_products();
        $config['per_page'] = FRONTEND_SMALL_LIST_PAGE;

        $this->ajax_pagination->initialize($config);
        $this->data['products'] = $this->model->get_products($config['per_page'], 0);
        $this->data["links"] = $this->ajax_pagination->create_links();
        $this->data['account_menu_active'] = 'admin';
        $this->data['sub_menu_active'] = 'product_management';
        $this->data['meta_keys'] = WEBSITE_NAME;
        $this->data['meta_desc'] = WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME . ' - Login';
        $this->template
                ->set_layout('admin_dashboard')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_product_management', $this->data);
    }

    public function ajax_management() {

        $page = $this->input->post('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }
        // $config["cur_page"] = ($page+1)/2;
        //total rows count
        $config['total_rows'] = $this->model->count_products();
        //pagination configuration
        $config['target'] = '.filterview';
        $config['base_url'] = site_url('/' . ADMIN . '/ajax_management');
        $config['per_page'] = FRONTEND_SMALL_LIST_PAGE;

        $this->ajax_pagination->initialize($config);
        //get the posts data
        $this->data['products'] = $this->model->get_products($config['per_page'], $offset);
        $this->data["links"] = $this->ajax_pagination->create_links();

        echo $this->load->view('ajax_product_management', $this->data, true);
    }

    public function staff_list($id = false) {

//        $this->data['outlet'] = $this->general->get_single_row('members', array('dealer_id' => $id));
//        if (count($this->data['outlet']) < 1) {
//            $this->session->set_flashdata('error_message', 'No records found');
//            redirect('/' . ADMIN . '/dealer_management');
//            exit;
//        }

        $config['base_url'] = site_url('/' . ADMIN . '/ajax_staff_list/' . $id);
        $config['target'] = '.filterview';
        $config['total_rows'] = $this->model->get_all_staff(false, $id, false, 'registered', true);
        $config['per_page'] = FRONTEND_LARGE_LIST_PAGE;
//        echo $config['total_rows'];exit;
        $config['uri_segment'] = '4';
        $this->ajax_pagination->initialize($config);

        $this->data['stafflist'] = $this->model->get_all_staff(false, $id, false, 'registered', false, $config['per_page'], 0);

        $this->data["links"] = $this->ajax_pagination->create_links();
        $this->data['account_menu_active'] = 'admin';
        $this->data['sub_menu_active'] = 'dealer_management';
        $this->data['meta_keys'] = WEBSITE_NAME;
        $this->data['meta_desc'] = WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME . ' - Admin';
        $this->template
                ->set_layout('admin_dashboard')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_staff_list', $this->data);
    }

    public function ajax_staff_list($id = false) {
        $page = $this->input->post('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }
        //total rows count
        $config['total_rows'] = $this->model->get_all_staff($id, false, false, 'registered', true);
        //pagination configuration
        $config['target'] = '.filterview';
        $config['base_url'] = site_url('/' . ADMIN . '/ajax_staff_list/' . $id);
        $config['per_page'] = FRONTEND_LARGE_LIST_PAGE;
        $config['uri_segment'] = '4';
        $this->ajax_pagination->initialize($config);
        $this->data["links"] = $this->ajax_pagination->create_links();
        //get the posts data
        $this->data['stafflist'] = $this->model->get_all_staff($id, false, false, 'registered', false, $config['per_page'], 0);
        // echo $this->data["links"]=$this->ajax_pagination->create_links();
        echo $this->load->view('ajax_staff_list', $this->data, true);
    }

    public function staff_management($type = 'pending') {

        $dealerid = $this->session->userdata(SESSION . 'user_id');
        $this->data['dealerlist'] = $this->general->get_dealers_list();
        $this->data['sub_menu_active'] = 'staff_management';

        if ($type == 'pending') {
            $this->data['admin_work'] = 'approve_users';
            $this->data['secondary_view'] = 'v_staff_pending';
            $this->data['userdetails'] = $this->model->get_all_staff(false, false, false, 'dealer_approved');
            $this->data['sub_menu'] = 'approve_staff';
            $this->data['job'] = 'Approve New Staff';
        } elseif ($type == 'edit_profile') {
            $this->data['admin_work'] = 'approve_profile_edit';
            $this->data['secondary_view'] = 'v_staff_pending';
            $this->data['userdetails'] = $this->model->get_all_edit_request(false, $type);
            $this->data['sub_menu'] = 'approve_edit';
            $this->data['job'] = 'Approve Profile Changes';
//            echo "<pre>";
//            print_r($this->data['userdetails']);exit;
        }
        $this->data['type'] = $type;
        $this->data['account_menu_active'] = 'admin';

        $this->data['meta_keys'] = WEBSITE_NAME;
        $this->data['meta_desc'] = WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME . ' - Admin';
        $this->template
                ->set_layout('admin_dashboard')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_staff_management', $this->data);
    }

    public function ajax_staff_management($type = 'pending') {
        $dealerid = $this->session->userdata(SESSION . 'user_id');
        if ($type == 'pending') {
            $view = 'v_staff_pending';
            $this->data['userdetails'] = $this->model->get_all_staff(false, false, false, 'dealer_approved');
        }
        // else
        // {
        //      $view='v_staff_registered';
        //      $this->data['userdetails']=$this->model->get_all_staff(false,$dealerid,false,'registered');
        // }
        echo $this->load->view($view, $this->data, true);
    }

    public function reject_member_data($id = false) {
        $this->load->library('user_agent');

        try {
            if (!($id || $this->input->post() ))
                throw new Exception('No Delete Record found', 1);
            if ($id)
                $userlist[] = $id;
            else {
                $userlist = $this->input->post('selectusers');
            }

            $userid = $this->session->userdata(SESSION . 'user_id');
            foreach ($userlist as $key => $value) {
                $response = $this->general->get_user_info($value);

                $res = $this->general->update_data('members', array('status' => '6'), array('id' => $value));
                $this->db->last_query();
                if ($this->db->affected_rows() > 0) {
                    if (LOG_ADMIN_ACTIVITY == 'Y') {
                        $this->general->log_admin_activity(array('user_id' => $this->session->userdata(SESSION . 'user_id'), 'user_type' => $this->session->userdata(SESSION . 'usertype'), 'module' => 'Reject Staff by Admin ', 'module_desc' => 'Staff Management(staff reject)', 'action' => 'Reject', 'extra_info' => 'Member id: ' . $value));
                    }
                    $template_id = 'registration_rejected';
                    $parseElement = array(
                        'USERNAME' => $response->username,
                        'WEBSITE_NAME' => WEBSITE_NAME
                    );
                    $from = SYSTEM_EMAIL;

                    $to = $response->email;
                    $this->notification->send_email_notification($template_id, '', $from, $to, '', '', $parseElement, array());
                }
            }
            $this->session->set_flashdata('success_message', 'Members Rejected Successfully');
            redirect($this->agent->referrer());
            exit;
        } catch (exception $e) {
            $this->session->set_flashdata('error_message', $e->getMessage());
            redirect($this->agent->referrer());
            exit;
        }
    }

    public function approve_profile_edit_req($id = false) {
        $this->model->update_old_info($id);
        $this->session->set_flashdata('success_message', 'Member updated Successfully');
        redirect($this->agent->referrer());
    }

    public function approve_user($id = false) {

        try {
            $this->load->library('user_agent');
            if (!($id || $this->input->post() ))
                throw new Exception('No Record Selected', 1);

            if ($id)
                $userlist = array($id);
            else {
                $userlist = $this->input->post('selectusers');
            }


            $userid = $this->session->userdata(SESSION . 'user_id');
            foreach ($userlist as $key => $value) {

                $response = $this->general->get_user_info($value);
                $this->db->last_query();

                $res = $this->general->update_data('members', array('status' => '1'), array('id' => $value));
                $this->db->last_query();
                if ($this->db->affected_rows() > 0) {
                    if (LOG_ADMIN_ACTIVITY == 'Y') {
                        $this->general->log_admin_activity(array('user_id' => $this->session->userdata(SESSION . 'user_id'), 'user_type' => $this->session->userdata(SESSION . 'usertype'), 'module' => 'Approve Staff by Admin ', 'module_desc' => 'Staff Management(staff approve)', 'action' => 'Approve', 'extra_info' => 'Member id: ' . $value));
                    }
                    $template_id = 'register_notification';
                    $parseElement = array(
                        'USERNAME' => $response->username,
                        'DEALER_NAME' => $response->username,
                        'WEBSITE_NAME' => WEBSITE_NAME
                    );
                    $from = SYSTEM_EMAIL;

                    $to = $response->email;
                    $this->notification->send_email_notification($template_id, '', $from, $to, '', '', $parseElement, array());
                }
            }
            $this->session->set_flashdata('success_message', 'Member Activated Successfully');
            redirect($this->agent->referrer());
            exit;
        } catch (exception $e) {
            $this->session->set_flashdata('error_message', $e->getMessage());
            redirect($this->agent->referrer());
            exit;
        }
    }

    public function get_staff($userid = false) {
        try {
            if (!$userid)
                throw new Exception("Error getting result", 1);

            $dealer = $this->session->userdata(SESSION . 'user_id');
            $response = $this->model->get_all_staff(false, FALSE, $userid);
            echo json_encode($response);
        } catch (exception $e) {
            echo json_encode('error_message', $e->getMessage());
        }
    }

    public function get_new_info_staff($userid = false) {
        try {
            if (!$userid)
                throw new Exception("Error getting result", 1);
            $response = $this->model->get_detail_new_info($userid);

            echo json_encode($response);
        } catch (exception $e) {
            echo json_encode('error_message', $e->getMessage());
        }
    }

    public function news_management() {

        $this->data['news'] = $this->model->get_news_promotion(false, 'news');
        $this->data['promotion'] = $this->model->get_news_promotion(false, 'promotion');

        $this->data["links"] = $this->ajax_pagination->create_links();
        $this->data['account_menu_active'] = 'admin';
        $this->data['sub_menu_active'] = 'news_management';
        $this->data['meta_keys'] = WEBSITE_NAME;
        $this->data['meta_desc'] = WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME . ' - Admin';
        $this->template
                ->set_layout('admin_dashboard')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_news_management', $this->data);
    }

    public function add_new_promotion($id = false) {

        $newsid = $this->input->post('id', true);
        $this->form_validation->set_rules($this->model->validate_add_news);
        if ($this->form_validation->run() === TRUE) {
            $response = $this->model->add_new_promotion($newsid);

            if (isset($response['success'])) {
                if (isset($newsid) && $newsid != '') {
                    echo json_encode(array('success_message' => "News Updated Successfully."));
                } else {
                    echo json_encode(array('success_message' => 'News Added Successfully.'));
                }
            } else {
                echo json_encode(array('error_message' => $response['error']));
            }
        }
    }

    public function incentive_setting() {

        $this->data['dealerlist'] = $this->general->get_dealers_list();
        $this->data['modal'] = $this->general->get_product_model();
        $this->data['result'] = $this->model->get_search_data();

        $this->data['account_menu_active'] = 'admin';
        $this->data['sub_menu_active'] = 'incentive_settings';
        $this->data['meta_keys'] = WEBSITE_NAME;
        $this->data['meta_desc'] = WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME . ' - Admin';
        $this->template
                ->set_layout('admin_dashboard')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_incentive_setting', $this->data);
    }

    public function ajax_incentive_setting() {

        $this->data['dealerlist'] = $this->general->get_dealers_list();
        $this->data['modal'] = $this->general->get_product_model();
        $this->data['result'] = $this->model->get_search_data();
        echo $this->load->view('ajax_incentive_setting', $this->data, true);
    }

    public function add_incentive($id = false) {
        $this->data['incentivedealer'] = false;
        $this->data['incentivestaff '] = false;
        $this->form_validation->set_rules($this->model->validate_incentive());
        if ($this->form_validation->run() === TRUE) {
            $response = $this->model->add_incentive($id);
            if (isset($response['success_message'])) {
                $this->session->set_flashdata('success_message', $response['success_message']);
                redirect(site_url('/' . ADMIN . '/incentive_setting'));
            } else {
                $this->session->set_flashdata('error_message', $response['error_message']);
                redirect(site_url('/' . ADMIN . '/incentive_setting'));
            }
        }

        if ($id) {

            $this->data['listincentivedealer'] = $this->general->get_data('dealer_incentive', array('incentive_id' => $id));
            $this->data['incentive'] = $this->general->get_single_row('incentive', array('id' => $id));

            $this->data['incentivedealer'] = $this->general->get_data('incentive_target', array('incentive_id' => $id, 'target_type' => 'D'));
            $this->data['incentivestaff'] = $this->general->get_data('incentive_target', array('incentive_id' => $id, 'target_type' => 'S'));
        }

        $this->data['allmodels'] = $this->general->get_product_model();
        $this->data['dealers'] = $this->general->get_dealers_list();
        $this->data['account_menu_active'] = 'admin';
        $this->data['sub_menu_active'] = 'incentive_settings';
        $this->data['meta_keys'] = WEBSITE_NAME;
        $this->data['meta_desc'] = WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME . ' - Admin';

        $this->template
                ->set_layout('admin_dashboard')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_add_incentive', $this->data);
    }

    public function get_news_promotion_by_id($id = false) {
        $data = $this->model->get_news_promotion($id);
        echo json_encode($data);
        exit;
    }

    public function check_imei_availability($id = false) {
        //exit if the request is not ajax
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $imei = trim($this->input->post('imei'));
        $this->load->model('user/register_model', 'register');
        // if the username exists return a 1 indicating true
        $result = $this->register->imei_exists($imei, $id);

        if (count($result) > 0) {
            echo 'taken';
        } else {
            echo 'available';
        }
    }

    public function email_taken() {
        $email = trim($this->input->post('email'));
        $id = trim($this->input->post('id'));
        $this->load->model('user/register_model', 'register');
        // if the email exists return a 1 indicating true
        $result = $this->register->email_exists($email, $id);

        if ($result) {
            $this->form_validation->set_message('email_taken', "The email is already taken");
            return FALSE;
        } else {
            return true;
        }
    }

    public function username_taken() {
        $username = trim($this->input->post('username'));
        $id = trim($this->input->post('id'));
        // if the email exists return a 1 indicating true
        $this->load->model('user/register_model', 'register');
        $result = $this->register->username_exists($username, $id);

        if ($result) {
            $this->form_validation->set_message('username_taken', "The Username is already taken");
            return FALSE;
        } else {
            return true;
        }
    }

    function check_equal_less($second_field, $first_field) {
        if ($second_field <= $first_field) {
            $this->form_validation->set_message('check_equal_less', 'The Previous fields must be smaller then current.');
            return false;
        } else {
            return true;
        }
    }
     public function reject_profile_edit_req($id = false) {
        $this->model->reject_profile_edit($id);
        $this->session->set_flashdata('success_message', 'Members Profile edit request was rejected successfully');
        redirect($this->agent->referrer());
        exit;
    }


}
