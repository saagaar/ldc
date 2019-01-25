<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *Module :admin 
 */
class Admin extends CI_Controller {

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
            /**
             *check whether logged in or not. if logged in as maintaince user, let them visit site. else redirect to maintainance page
             */
            if (!$this->session->userdata('MAINTAINANCE_KEY') OR $this->session->userdata('MAINTAINANCE_KEY') != 'YES') 
            {
                redirect(site_url('/maintainance'));
                exit;
            }
        }
        if ((!$this->session->userdata(SESSION . 'user_id')) && $this->session->userdata(SESSION.'usertype')!='1') 
        {
            $this->session->set_flashdata('error_message', "Please Login to access this page.");
            redirect(site_url('/login/admin'), 'refresh');
            exit;
        }
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->load->library('Ajax_pagination');
        $this->load->model('admin_model', 'model');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function dealer_management() 
    {
        $this->data['account_menu_active'] = 'admin';
        $this->data['sub_menu_active'] = 'dealer_management';
        $this->data['dealerlist'] = $this->general->get_dealers_list();
        $this->data['topdealer'] = isset($this->data['dealerlist']['0']->id) ? $this->data['dealerlist']['0']->id : false;
        $this->data['outletlist'] = $this->model->get_outlet_by_dealer($this->data['topdealer']);
        $this->data['meta_keys'] = WEBSITE_NAME;
        $this->data['meta_desc'] = WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME . ' - Login';
        $this->template
                ->set_layout('admin_dashboard')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_dealer_management', $this->data);
    }
    public function ajax_dealer_management() 
    {
       if ($this->model->get_outlet_by_dealer()) 
       {
            $this->data['outletlist'] = $this->model->get_outlet_by_dealer();
       } 
       else 
       {
            $this->data['outletlist'] = '';
       }
        $this->data['dealer_id'] = $this->input->post('filterdealer', true);
        echo $this->load->view('ajax_dealer_management', $this->data, true);
    }
    Public function add_dealer($id = false) 
    {
     if($id) $this->form_validation->set_rules($this->model->validate_dealer_edit());
     else $this->form_validation->set_rules($this->model->validate_dealer_add());

        $this->data['dealer'] = false;
        $this->data['outlet'] = false;
        if ($this->form_validation->run() === TRUE) 
        {
            $response = $this->model->add_dealer($id);
            if (isset($response['success_message'])) 
            {
                $this->session->set_flashdata('success_message', $response['success_message']);
                redirect(site_url('/' . ADMIN . '/dealer_management'));
            } else 
            {
                $this->session->set_flashdata('error_message', $response['error_message']);
                redirect(site_url('/' . ADMIN . '/add_dealer'));
            }
        }
        if ($id) 
        {
            $this->data['dealer'] = $this->model->get_user_details($id);
            $this->data['outlet'] = $this->general->get_data('outlet', array('dealer_id' => $id,'status'=>'1'));
        }
        $this->data['action_type']='add';
        if($id)
        $this->data['action_type']='edit';
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

    public function delete_dealer($id=false)
    {
        $this->load->library('user_agent');
        try
        {
            if(!$id) throw new Exception('No Delete Record found',1);
            $userid=$this->session->userdata(SESSION.'user_id');
            $res=$this->general->update_data('members',array('status'=>'4'),array('id'=>$id));
            $this->db->last_query();
                if($this->db->affected_rows()>0) 
                {
                    if(LOG_ADMIN_ACTIVITY == 'Y')
                    {
                            $this->general->log_admin_activity(array('user_id' => $this->session->userdata(SESSION.'user_id'), 'user_type' =>  $this->session->userdata(SESSION.'usertype'), 'module' => 'Delete Dealer', 'module_desc' => 'Delete Management', 'action' => 'Delete', 'extra_info' => 'Member id: '.$id));
                    }
                    $this->session->set_flashdata('success_message','Member Deleted Succesfully');
                }
                else $this->session->set_flashdata('success_message','Member Delete Failed');
                            redirect($this->agent->referrer());exit;
        }
        catch(exception $e)
        {
            $this->session->set_flashdata('error_message',$e->getMessage());
             redirect($this->agent->referrer());exit;
        }
    }
    public function product_management() 
    {
        /***************for product addition******** */
        $this->form_validation->set_rules($this->model->validate_add_product);
        if ($this->form_validation->run() === TRUE) 
        {
            $response = $this->model->add_product();
            echo json_encode($response);
            exit;
        }
        $config['base_url'] = site_url('/' . ADMIN . '/ajax_management');
        $config['target'] = '.filterview';
        // $config['total_rows'] = $this->model->count_products();
        $config['total_rows'] = $this->model->get_products(false,false,true);
        $config['per_page'] = FRONTEND_SMALL_LIST_PAGE;
        $config['show_count']=true;
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
    public function ajax_management() 
    {
        $page = $this->input->post('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }
        $config['total_rows'] = $this->model->get_products(false,false,true);
        $config['target'] = '.filterview';
        $config['base_url'] = site_url('/' . ADMIN . '/ajax_management');
        $config['per_page'] = FRONTEND_SMALL_LIST_PAGE;
        $this->ajax_pagination->initialize($config);
        $this->data['products'] = $this->model->get_products($config['per_page'], $offset);
        $this->data["links"] = $this->ajax_pagination->create_links();
        echo $this->load->view('ajax_product_management', $this->data, true);
    }
    public function upload_product()
    {    
        $this->load->library('excel');
        $time=$this->general->get_local_time('time');
        $fdata=$this->excel->upload_excel_file('excelupload',EXCEL_UPLOAD_PATH,false);
        if(isset($fdata['error_message']))
        {
            $this->session->set_flashdata($fdata);
            redirect('/'.ADMIN.'/product_management');
        }
        $get_all_models=$this->general->get_product_model();
        foreach($get_all_models as $val)
        {
            $model[]=$val->id;
        }
     
       $data=$this->excel->get_excel_data('./upload_files/excel-uploads/'.$fdata['file_name']);
       $prodarr=array();
      
       foreach ($data as $Row) 
       {
                     $checkimei=$this->general->check_imei_available($Row['3']);
            if($checkimei)
            {
               if(in_array($Row['0'],$model))
                {
                    $prodarr[] =array('model_number'=>$Row['0'],'imei'=>$Row['3'],'date'=>$time,'color'=>$Row['2'],'suffix'=>$Row['1'],'status'=>'1','sales_status'=>'1');
                }
            }
       }
        if(count($prodarr)>0)
         {
             $this->db->insert_batch('products',$prodarr);
             if($this->db->affected_rows()>0)
             {
                if(LOG_ADMIN_ACTIVITY == 'Y')
                {
                    $this->general->log_admin_activity(array('user_id' => $this->session->userdata(SESSION.'user_id'), 'user_type' =>  $this->session->userdata(SESSION.'usertype'), 'module' => 'Add Product', 'module_desc' => 'Product Added with excel Upload', 'action' => 'Add', 'extra_info' => 'Original Excel file Name: '.$fdata['orig_name']));
                }
                echo json_encode(array('success_message'=>count($prodarr).' Products Added Succesfully'));
             }
             else
             {
                 echo json_encode(array('error_message'=>'Something went wrong ,Please try again in a while'));
             }
         }
        else
        {
             echo json_encode(array('error_message'=>'No Data to Add'));
        }
    }
    public function staff_list($id = false) 
    {
        $config['base_url'] = site_url('/' . ADMIN . '/ajax_staff_list/' . $id);
        $config['target'] = '.filterview';
        $config['total_rows'] = $this->model->get_all_staff(false, $id, false, 'registered', true);
        $config['per_page'] = FRONTEND_LARGE_LIST_PAGE;
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

    public function ajax_staff_list($id = false) 
    {
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
        echo $this->load->view('ajax_staff_list', $this->data, true);
    }

    public function staff_management($type = 'pending') 
    {
        $dealerid = $this->session->userdata(SESSION . 'user_id');
        $this->data['dealerlist'] = $this->general->get_dealers_list();
        $this->data['sub_menu_active'] = 'staff_management';
        if ($type == 'pending') 
        {
            $this->data['admin_work'] = 'approve_users';
            $this->data['secondary_view'] = 'v_staff_pending';

            $this->data['userdetails'] = $this->model->get_all_staff(false, false, false, 'dealer_approved');
            $this->data['sub_menu'] = 'approve_staff';
            $this->data['job'] = 'Approve New Staff';
        } 
        elseif ($type == 'edit_profile') 
        {
            $this->data['admin_work'] = 'approve_profile_edit';
            $this->data['secondary_view'] = 'v_staff_pending';
            $this->data['userdetails'] = $this->model->get_all_edit_request();
            $this->data['sub_menu'] = 'approve_edit';
            $this->data['job'] = 'Approve Profile Changes';
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
        if ($type == 'pending')
        {
           
            $this->data['admin_work'] = 'approve_users';
            $this->data['userdetails'] = $this->model->get_all_staff(false, false, false, 'dealer_approved');
            $this->data['sub_menu'] = 'approve_staff';
            $this->data['job'] = 'Approve New Staff';
        }
        else
        {
            $this->data['type'] = 'edit_profile';
            $this->data['admin_work'] = 'approve_profile_edit';
            $this->data['secondary_view'] = 'v_staff_pending';
            $this->data['userdetails'] = $this->model->get_all_edit_request();
            $this->data['sub_menu'] = 'approve_edit';
            $this->data['job'] = 'Approve Profile Changes';
        }
         $view = 'v_staff_pending';

        echo $this->load->view($view, $this->data, true);
    }

   
    public function reject_member_data($id = false) 
    {
        $this->load->library('user_agent');
        try {
            if (!($id || $this->input->post() ))  throw new Exception('No Delete Record found', 1);
            if ($id) $userlist[] = $id;
            else  $userlist = $this->input->post('selectusers');
            $userid = $this->session->userdata(SESSION . 'user_id');
            foreach ($userlist as $key => $value) 
            {
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
        } catch (exception $e) 
        {
            $this->session->set_flashdata('error_message', $e->getMessage());
            redirect($this->agent->referrer());
            exit;
        }
    }
     public function reject_profile_edit_req($id = false) 
    {
        $this->model->reject_profile_edit($id);
        $this->session->set_flashdata('success_message', 'Members Profile edit request was rejected successfully');
        redirect($this->agent->referrer());
        exit;
    }
    public function approve_profile_edit_req($id = false) 
    {
        $data=$this->model->update_old_info($id);
        if($data['success_message'])
        {
         $this->session->set_flashdata('success_message', $data['success_message']);     
        }else
        {
             $this->session->set_flashdata('error_message', $data['error_message']);     
        }
       
        redirect($this->agent->referrer());
    }

    public function approve_user($id = false) 
    {
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
                if ($this->db->affected_rows() > 0) 
                {
                    if (LOG_ADMIN_ACTIVITY == 'Y') 
                    {
                        $this->general->log_admin_activity(array('user_id' => $this->session->userdata(SESSION . 'user_id'), 'user_type' => $this->session->userdata(SESSION . 'usertype'), 'module' => 'Approve Staff by Admin ', 'module_desc' => 'Staff Management(staff approve)', 'action' => 'Approve', 'extra_info' => 'Member id: ' . $value));
                    }
                    $template_id = 'register_notification';
                    $parseElement = array(
                        'USERNAME' => $response->username,
                        'DEALER_NAME' => $response->dealer_name,
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
        try 
        {
            if (!$userid)
                throw new Exception("Error getting result", 1);

            $dealer = $this->session->userdata(SESSION . 'user_id');
            $response = $this->model->get_all_staff(false, FALSE, $userid);
            // print_r($response);exit;
            echo json_encode($response);
        } 
        catch (exception $e) 
        {
            echo json_encode('error_message', $e->getMessage());
        }
    }

    public function get_new_info_staff($userid = false) {
        try 
        {
            if (!$userid) throw new Exception("Error getting result", 1);
            $response = $this->model->get_detail_new_info($userid);
             // print_r($response);exit;
            echo json_encode($response);
        } 
        catch (exception $e) 
        {
            echo json_encode('error_message', $e->getMessage());
        }
    }

    public function news_management() 
    {
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

    public function add_news_promotion($id=false)
    {
        $newsid=$this->input->post('id',true);
        $this->form_validation->set_rules($this->model->validate_add_news);
        if ($this->form_validation->run() === TRUE) 
        {
            $response=$this->model->add_news_promotion($newsid);
            if(isset($response['success']))
            {
                if(isset($newsid) && $newsid!='')
                {
                    echo json_encode(array('success_message'=> "News Updated Successfully."));
                }
                else
                {
                        echo json_encode(array('success_message'=> 'News Added Successfully.'));    
                }
            }
            else 
            {
                    echo json_encode(array('error_message'=> $response['error']));
            }
         }
    }
    Public function model_management()
    {
          /***************for product addition******** */
        $this->form_validation->set_rules($this->model->validate_add_model);
        if ($this->form_validation->run() === TRUE) {
            $response = $this->model->add_model();
            echo json_encode($response);
            exit;
        }
        $cond=array('status'=>'1');
        $config['base_url'] = site_url('/' . ADMIN . '/ajax_model_management');
        $config['target'] = '.filterview';
        $config['total_rows'] = $this->general->count_all_data('model',$cond);
        $config['per_page'] = FRONTEND_SMALL_LIST_PAGE;
        $this->ajax_pagination->initialize($config);
        $this->data['models'] = $this->general->get_data('model',array('status'=>'1'),'id','desc',true,$config['per_page'], 0);
        $this->data["links"] = $this->ajax_pagination->create_links();
        $this->data['account_menu_active'] = 'admin';
        $this->data['sub_menu_active'] = 'model_management';
        $this->data['meta_keys'] = WEBSITE_NAME;
        $this->data['meta_desc'] = WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME . ' - Admin';
        $this->template
                ->set_layout('admin_dashboard')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_model_management', $this->data);
    }

     public function ajax_model_management() 
     {
        $page = $this->input->post('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }
        $cond="status='1'";
        if($this->input->post('filtername'))
        {
            $name=trim($this->input->post('filtername',true));
            $cond=$cond." and model_name like ('%$name%')";
        }
        $config['total_rows'] = $this->general->count_all_data('model',$cond);
        //pagination configuration
        $config['target'] = '.filterview';
        $config['base_url'] = site_url('/' . ADMIN . '/ajax_model_management');
        $config['per_page'] = FRONTEND_SMALL_LIST_PAGE;

        $this->ajax_pagination->initialize($config);
        $this->data['models'] = $this->general->get_data('model',$cond,'id','desc',true,$config['per_page'], $offset);
        $this->data["links"] = $this->ajax_pagination->create_links();
        echo $this->load->view('ajax_model_management', $this->data, true);
    }
    public function incentive_setting() 
    {
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

    /**************for downloading sample for product upload using Excel*************/
    public function sample_download()
    {
        $filecontent= file_get_contents(site_url('/'.EXCEL_SAMPLE_PATH.'/sample.xlsx'));
        $this->load->helper('download');
        force_download('sample.xlsx',$filecontent);
    }
    
    public function add_incentive($id = false) 
    {
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
        if($id) {

            $this->data['listincentivedealer'] = $this->general->get_data('dealer_incentive', array('incentive_id' => $id));
            $this->data['incentive'] = $this->general->get_single_row('incentive', array('id' => $id));

            $this->data['incentivedealer'] = $this->general->get_data('incentive_target', array('incentive_id' => $id, 'target_type' => 'D'));
            $this->data['incentivestaff'] = $this->general->get_data('incentive_target', array('incentive_id' => $id, 'target_type' => 'S'));
        }
        $this->data['incentiveid']=$id;
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
    public function get_news_promotion_by_id($id = false) 
    {
        $data = $this->model->get_news_promotion($id);
        echo json_encode($data);
        exit;
    }

    public function staff_reward()
    {
        $config['base_url'] = site_url('/' . ADMIN . '/ajax_staff_reward/');
        $config['target'] = '.filterview';
        $config['total_rows'] = $this->model->get_staff_reward(false,false,true);
        $config['per_page'] = '5';
        $config['uri_segment'] = '4';
        $this->ajax_pagination->initialize($config);
        $this->data['staff_reward']=$this->model->get_staff_reward($config['per_page'], 0);
        $this->data["links"] = $this->ajax_pagination->create_links();
        $this->data['account_menu_active'] = 'admin';
        $this->data['sub_menu_active'] = 'incentive_settings';
        $this->data['meta_keys'] = WEBSITE_NAME;
        $this->data['meta_desc'] = WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME . ' - Admin';

        $this->template
                ->set_layout('admin_dashboard')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_staff_reward', $this->data);
    }
    public function ajax_staff_reward()
    {
        $page = $this->input->post('page');
            if(!$page){
                $offset = 0;
            }else{
                $offset = $page; 
            }
            $config['total_rows'] = $this->model->get_staff_reward(false,false,true);
            $config['target']      = '.filterview';
            $config['base_url'] = site_url('/' . ADMIN . '/ajax_staff_reward');
            $config['per_page']    = 5  ;
            $this->ajax_pagination->initialize($config);
             $this->data["links"] = $this->ajax_pagination->create_links();
            
            $this->data['staff_reward']=$this->model->get_staff_reward($config['per_page'], $offset);
        echo $this->load->view('ajax_staff_reward', $this->data, true);
    }

    /******Check if date for adding incentive is available****/
    public function check_date_available_incentive($id=false)
    {
        $from=$this->input->post('fromdate');
        $to=$this->input->post('todate');
        $model=$this->input->post('modelid');
        $dealers=$this->input->post('dealers');
        $ndealer=implode(',', $dealers);
        $prefix=$this->db->dbprefix;
        $cond='1=1';
        if($id) $cond=$cond.' and (i.id!='.$id.')';

        $query= $this->db->query("
                                 select * from
                                  ".$prefix."incentive i
                                   join emts_dealer_incentive d on (d.incentive_id=i.id)

                                    where ".
                                    $cond." and
                                    model_id=$model AND 
                                    ((date(start_date) <='$from' and date(end_date) >='$from')
                                     or (date(start_date) <='$to' and date(end_date) >= '$to')
                                     or (date(start_date)<='$from' and date(end_date)>='$to')
                                     or(date(start_date)>='$from' and date(end_date)<='$to'))
                                     AND d.dealer_id in ($ndealer)
                               ");
           $this->db->last_query();

        if($query->num_rows()>0)
        {
            echo 'taken';
        }else{
            echo 'available';
        }
    }

    /*******************Check unique incentive name***************************/

    public function check_incentive_name_unique($id=false) 
    {
       if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $name = trim($this->input->post('name'));
        // if the username exists return a 1 indicating true
        $result = $this->model->incentive_name_exists($name, $id);

        if (count($result) > 0) {
            echo 'taken';
        } else {
            echo 'available';
        }
    }
    public function email_taken() 
    {
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
            $this->form_validation->set_message('check_equal_less', 'This field must be higher than the previous tier final target field.');
            return false;
        } else {
            return true;
        }
    }
    function check_greater_by_unit($second_field, $first_field) {
        if ($second_field == $first_field+1) {
           
            return true;
        } else {
             $this->form_validation->set_message('check_greater_by_unit', 'This field must be higher than the previous tier final target field by 1 unit.');
            return false;
        }
    }
    public function sales_report()
    {
        $userid=$this->session->userdata(SESSION.'user_id');
        $config['base_url'] = site_url('/' . ADMIN . '/ajax_sales_report');
        $config['target']      = '.filterview';
        $config['per_page']    =FRONTEND_SMALL_LIST_PAGE;
        $this->load->model('staff/staff_model');
        $config['total_rows'] = $this->staff_model->get_sales_report('','',true,false);
        $this->ajax_pagination->initialize($config);
         
        $this->data['sales_report']=$this->staff_model->get_sales_report($config['per_page'],0,false,false);
        $this->data["links"] = $this->ajax_pagination->create_links();
        $this->data['allmodels']=$this->general->get_product_model();
        $this->data['allstaff']=$this->general->get_staff_by_dealer($userid);
        $this->data['outlet']=$this->general->get_outlets_by_dealer($userid);
        $this->data['account_menu_active']='admin';
        $this->data['sub_menu_active']='sales_report';
        $this->data['meta_keys']= WEBSITE_NAME;
        $this->data['meta_desc']= WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME.' - Login';
        $this->template
            ->set_layout('admin_dashboard')
            ->enable_parser(FALSE)
            ->title($this->page_title)
            ->build('v_sales_report', $this->data); 
    }
    public function ajax_sales_report()
    {
        $this->load->model('staff/staff_model');
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page; 
        }
        $userid=$this->session->userdata(SESSION.'user_id');
        $config['base_url'] = site_url('/' . ADMIN . '/ajax_sales_report');
        $config['target']      = '.filterview';
        $config['per_page']    = FRONTEND_SMALL_LIST_PAGE;
        $config['total_rows'] = $this->staff_model->get_sales_report('','',true,false);
        $this->ajax_pagination->initialize($config);
       
        $this->data['sales_report']=$this->staff_model->get_sales_report($config['per_page'],$offset,false,false);
        $this->data["links"] = $this->ajax_pagination->create_links();
        $this->data['allmodels']=$this->general->get_product_model();
        $this->data['outlet']=$this->general->get_outlets_by_dealer($userid);
        $this->load->view('ajax_sales_report',$this->data); 
    }
   public function sales_report_update_status($id=false,$action=false)
    {
        $this->load->library('user_agent');
        $time=$this->general->get_local_time('time');
        $userid=$this->session->userdata(SESSION.'user_id');
        try
        {
            if(!$action) throw new Exception('No Action found',1);
            if (($id=='false') && (!$this->input->post('selectsalesreport')))
                throw new Exception('No Record Selected', 1);

            if ($id!='false')
                $reportlist = array($id);
            else 
                $reportlist = $this->input->post('selectsalesreport');
            
            if($this->session->userdata(SESSION.'usertype')=='1')
            {
              
                foreach ($reportlist as  $eachreport) 
                {
                    $this->db->trans_start();                 
                    $productdata=$this->general->get_single_row('sales_report',array('id'=>$eachreport));
                     $this->general->update_data('sales_report',array('status'=>"$action",'approved_date'=>$time),array('id'=>$eachreport));
                 if($this->db->affected_rows()>0) 
                    {
                        if($action=='dealer_reject' || $action=='admin_reject')
                          $this->general->update_data('products',array('sales_status'=>'1'),array('id'=>$productdata->product_id));
                        if(LOG_ADMIN_ACTIVITY == 'Y'){
                        $this->general->log_admin_activity(array('user_id' => $this->session->userdata(SESSION.'user_id'), 'user_type' =>  $this->session->userdata(SESSION.'usertype'), 'module' => 'Update Sales Report status', 'module_desc' =>' Sales Report Management', 'action' => 'update status', 'extra_info' =>' sales report id: '.$eachreport.',status:'.$action.',time:'.$time));
                        }
                        
                    }
                    $this->db->trans_complete();
                        if ($this->db->trans_status() === TRUE)
                        {

                            $member=$this->model->get_member_email_by_sales_id($eachreport);

                             if($action=='accepted')
                            {
                                 $template_id='sales_report_accepted';
                                $parseElement=array(
                                                    'WEBSITE_NAME'    =>      WEBSITE_NAME
                                                 );
                                $from=SYSTEM_EMAIL;

                                $to=$member->email;
                                $this->notification->send_email_notification($template_id, '', $from, $to, '', '', $parseElement, array());
                                $status='Accepted' ;
                            }
                            else
                            {
                                $template_id='sales_report_rejected';
                                $parseElement=array(
                                                    'WEBSITE_NAME'    =>      WEBSITE_NAME
                                                   );
                                $from=SYSTEM_EMAIL;

                                $to=$member->email;
                                $this->notification->send_email_notification($template_id, '', $from, $to, '', '', $parseElement, array());
                                $status='Rejected';
                            }
                          
                         }  
                }
                 $this->session->set_flashdata('success_message','Sales record '.ucfirst($status).' Successfully');
                redirect($this->agent->referrer());exit;
            }
            else
            {
                $this->session->set_flashdata('error_message','You are not authorized to perform this operation!!');
                    redirect($this->agent->referrer());exit;
            }                    
        }
        catch(exception $e)
        {
            $this->session->set_flashdata('error_message',$e->getMessage());
             redirect($this->agent->referrer());exit;
        }
    
    }
    // added by shiva
    public function report_management()
    {
    $this->data['account_menu_active']='admin';
    $this->data['sub_menu_active']='report_management';
    
    $this->data['dealers_list'] = $this->general->get_dealers_list();
    $this->data['sales_report'] = $this->model->get_sales_report();
    $this->data['model_list'] = $this->general->get_product_model();

    $this->data['meta_keys']= WEBSITE_NAME;
    $this->data['meta_desc']= WEBSITE_NAME;
    $this->page_title = WEBSITE_NAME.' - Login';
    $this->template
        ->set_layout('admin_dashboard')
        ->enable_parser(FALSE)
        ->title($this->page_title)
        ->build('v_admin_sales_report', $this->data);    
    }   

    public function ajax_report_management()
    {
        $this->data['sales_report'] = $this->model->get_sales_report();
        echo $this->load->view('ajax_admin_sales_report',$this->data,true);
    }
    public function download_sales_report($type='staff')
    {
         $file="./upload_files/sales_report/sales_report_".date('Y-m-d h:i:s').".xls";
          $this->data['tab_active'] =$type;
        $this->data['sales_report'] = $this->model->get_all_sales_report();
        $data= $this->load->view('ajax_admin_sales_report_excel',$this->data,true);
         
        $f = fopen($file, 'w');
        fwrite($f, $data);
        fclose($f);
        header('Content-Description: File Transfer');
        // header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate,post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
          exit;
    }
    public function incentive_report()
    {
    $this->data['account_menu_active']='admin';
    $this->data['sub_menu_active']='report_management';
    $this->data['tab_active'] = 'staff';
    $this->data['dealers_list'] = $this->general->get_dealers_list();
    // $this->dealer_id = $this->data['dealers_list'][0]->id;
    $initial_admin_incentive_list = $this->model->get_admin_incentive_report($tab_active);
                $finalarray = array();
                if($initial_admin_incentive_list){
                  foreach($initial_admin_incentive_list as $list){
                    $finalarray[$list->display_name][$list->incentiveid][]=$list;      
                   }
                }
    $this->data['admin_incentive_report'] = $finalarray;
    $this->data['model_list'] = $this->general->get_product_model();

    $this->data['meta_keys']= WEBSITE_NAME;
    $this->data['meta_desc']= WEBSITE_NAME;
    $this->page_title = WEBSITE_NAME.' - Login';
    $this->template
        ->set_layout('admin_dashboard')
        ->enable_parser(FALSE)
        ->title($this->page_title)
        ->build('v_incentive_report', $this->data);  
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
      public function incentive($incentivetype='staff')
    {
        $this->data['account_menu_active']='admin';
        $this->data['sub_menu_active']='incentive';
        $this->userid = $this->session->userdata(SESSION.'user_id');
        $this->data['tab_active'] = $incentivetype;
        $this->data['dealers_list'] = $this->general->get_dealers_list();
        $initial_incentive_list = $this->model->get_admin_incentive_report($incentivetype);
        $this->data['outletlist'] = $this->general->get_outlets_by_dealer($this->userid);
        $this->data['stafflist'] = $this->general->get_staff_by_dealer($this->userid);
        $finalarray = array();
        if($initial_incentive_list)
        {
          foreach($initial_incentive_list as $list)
          {
             $finalarray[$list->display_name][$list->incentiveid][]=$list;
          }
        }
        // echo '<pre>';
        // print_r($finalarray);
        $this->data['incentive_list'] = $finalarray;
        $this->data['color_list'] = $this->general->get_graph_color_list();
        $this->data['model_list'] = $this->general->get_product_model();
        $this->data['meta_keys']= WEBSITE_NAME;
        $this->data['meta_desc']= WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME.' - Staff';
        $this->template
            ->set_layout('admin_dashboard')
            ->enable_parser(FALSE)
            ->title($this->page_title)
            ->build('v_incentive', $this->data);  
    }


    public function ajax_incentive($incentivetype="staff")
    {
            $model_id = $this->input->post('filtermodel',TRUE);
            $this->userid = $this->session->userdata(SESSION.'user_id');
            $initial_incentive_list = $this->model->get_admin_incentive_report($incentivetype);
            $finalarray = array();
            if($initial_incentive_list)
            {
              foreach($initial_incentive_list as $list)
              {
                  $finalarray[$list->display_name][$list->incentiveid][]=$list;
              }
            }
            if($incentivetype=='staff')
            {
                $view='ajax_incentive';
            }
            else
            {
                $view='ajax_incentive_dealer';
            }
            $this->data['tab_active'] = $incentivetype;
            $this->data['incentive_list'] = $finalarray;
            $this->data['color_list'] = $this->general->get_graph_color_list();
            $this->data['model_list'] = $this->general->get_product_model();
            echo $this->load->view($view,$this->data,TRUE);
    }

    public function incentive_history($incentivetype="staff")
    {
         $this->data['dealers_list'] = $this->general->get_dealers_list();
        $this->data['account_menu_active']='admin';
        $this->data['sub_menu_active']='incentive';
        $this->userid = $this->session->userdata(SESSION.'user_id');
        $initial_incentive_list = $this->model->get_admin_incentive_history($incentivetype);
        $finalarray = array();
        if($initial_incentive_list){
          foreach($initial_incentive_list as $list){
            $finalarray[$list->display_name][$list->incentiveid][]=$list;
           }
        }
        $this->data['tab_active'] = $incentivetype;
        $this->data['incentive_list'] = $finalarray;
        $this->data['color_list'] = $this->general->get_graph_color_list();
        $this->data['outletlist'] = $this->general->get_outlets_by_dealer($this->userid);
        $this->data['stafflist'] = $this->general->get_staff_by_dealer($this->userid);
        $this->data['model_list'] = $this->general->get_product_model();
        $this->data['account_menu_active']='admin';

        $this->data['sub_menu_active']='';
        $this->data['meta_keys']= WEBSITE_NAME;
        $this->data['meta_desc']= WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME.' - Admin';
        $this->template
            ->set_layout('admin_dashboard')
            ->enable_parser(FALSE)
            ->title($this->page_title)
            ->build('v_incentive_history', $this->data);  
    }

    public function ajax_incentive_history($incentivetype="staff")
    {
        $this->userid = $this->session->userdata(SESSION.'user_id');
        $initial_incentive_list = $this->model->get_admin_incentive_history($incentivetype);
        $finalarray = array();
        if($initial_incentive_list)
        {
          foreach($initial_incentive_list as $list)
          {
            $finalarray[$list->display_name][$list->incentiveid][]=$list;
          }
        }
        if($incentivetype=='staff')
        {
            $view='ajax_incentive';
        }
        else
        {
            $view='ajax_incentive_dealer';
        }
        $this->data['tab_active'] = $incentivetype;
        $this->data['incentive_list'] = $finalarray;
        $this->data['color_list'] = $this->general->get_graph_color_list();
        $this->data['model_list'] = $this->general->get_product_model();
        echo $this->load->view($view,$this->data,TRUE);
    }
    function get_outlet_by_dealer($dealerid)
    {
        $this->db->select('*');
        $this->db->from('outlet');
        $this->db->where(array('status'=>'1','dealer_id'=>$dealerid));
        $response='<option value="">All Outlet</option>';
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
    function get_staff_by_dealer($dealerid)
    {
        $this->db->select('M.id,AES_DECRYPT(MD.first_name,salt) as first_name,AES_DECRYPT(MD.last_name,salt) as last_name');
        $this->db->from('members M');
        $this->db->join('members_details MD','M.id = MD.user_id');
        $this->db->where(array('M.status'=>'1','M.user_type'=>'4','M.dealer_id'=>$dealerid));
        $response='<option value="">All Staff</option>';
        $query=$this->db->get();
        if($query->num_rows()>0)
        {
            $data= $query->result();
            foreach($data as $val)
            {
                $response=$response.'<option value="'. $val->id.'">'. $val->first_name.' '.$val->last_name.'</option>';
            }
        }
        echo $response; 
    }
}
