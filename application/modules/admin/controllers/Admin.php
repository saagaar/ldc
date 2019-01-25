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

  
    




    
    public function get_member_by_id($id=false)
    {
        try
        {
            if(!$id) throw new Exception('No Record found',1);
            $data=$this->model->get_members_by_id($id);
            
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
    public function transaction($userid= false)
    {
        $this->form_validation->set_rules($this->model->validate_receipt);
        if ($this->form_validation->run() === TRUE) 
        {
            $response = $this->model->add_receipt();
            echo json_encode($response);
            exit;
        }
        $userdata=false;
        if($userid!='all')
        {
            $userdata = $this->general->get_single_row('members',array('id'=>$userid));
            if(!$userdata && (!$this->input->post()))
            {
                $this->session->set_flashdata('error_message','No Customer with that id found');
                redirect(site_url(ADMIN.'member_management'));
            }  
            $this->data['sub_menu_active'] = 'transaction';
        }
        else
        {
            $this->data['sub_menu_active']='report_management';
            $this->data['members'] = $this->model->get_members();
        }
        if($this->input->post() && $this->form_validation->run() === FALSE)
        {
          echo json_encode(array('error_message'=>validation_errors())) ;exit;
        }

        $config['base_url'] = site_url('/' . ADMIN . '/ajax_transaction/'.$userid);
        $config['target'] = '.filterview';
        $config['total_rows'] = $this->model->get_transaction($userid,false,false,true);
         $limit=$this->input->post('filterlimit');
        if($limit) $config['per_page'] =$limit;
          else $config['per_page'] =FRONTEND_LARGE_LIST_PAGE;
        $config['uri_segment'] = '4';
        $config['show_count']=true;
        $this->ajax_pagination->initialize($config);
        $this->data['userdata'] = $userdata;
        $this->data['transaction'] = $this->model->get_transaction($userid,$config['per_page'], 0);
        $this->data["links"] = $this->ajax_pagination->create_links();

        
        $this->data['secondary_view'] = 'v_ajax_transaction';
        $this->data['sub_menu'] = 'transaction';
        $this->data['account_menu_active'] = 'admin';
        $this->data['meta_keys'] = WEBSITE_NAME;
        $this->data['meta_desc'] = WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME . ' - Admin';
        $this->template
                ->set_layout('admin_dashboard')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_transaction', $this->data);
    }

        public function ajax_transaction($userid=false) 
    {
         $page = $this->input->post('page');
          $userdata=false;
        if (!$page) 
        {
            $offset = 0;
        } 
        else 
        {
            $offset = $page;
        }
        if($userid!='all')
        {
            $userdata = $this->general->get_single_row('members',array('id'=>$userid));
        }
         else
        {
            $this->data['sub_menu_active']='report_management';
            $this->data['members'] = $this->model->get_members();
        }
        $this->data['userdata'] = $userdata;
        $config['uri_segment'] = '4';
        $config['total_rows'] = $this->model->get_transaction($userid,false,false,true);
        $config['target'] = '.filterview';
        $config['base_url'] = site_url('/' . ADMIN . '/ajax_transaction/'.$userid);
          $limit=$this->input->post('filterlimit');
         if($limit) $config['per_page'] =$limit;
          else $config['per_page'] =FRONTEND_LARGE_LIST_PAGE;
        $this->ajax_pagination->initialize($config);
        $this->data['transaction'] = $this->model->get_transaction($userid,$config['per_page'], $offset);
        $this->data["links"] = $this->ajax_pagination->create_links();
        echo $this->load->view('v_transaction_partial', $this->data, true);
    }
    public function member_management() 
    {
        /***************for product addition******** */
      
        $this->form_validation->set_rules($this->model->validate_add_member);
        if ($this->form_validation->run() === TRUE) 
        {
            $response = $this->model->add_member();
            echo json_encode($response);
            exit;
        }
        if($this->input->post('customer_name') && $this->form_validation->run() === FALSE)
        {
          echo json_encode(array('error_message'=>validation_errors())) ;exit;
        }
        $config['base_url'] = site_url('/' . ADMIN . '/ajax_management');
        $config['target'] = '.filterview';
        $config['total_rows'] = $this->model->get_members(false,false,true);
        $config['per_page'] = FRONTEND_SMALL_LIST_PAGE;
        $config['show_count']=true;
        $this->ajax_pagination->initialize($config);
        $this->data['members'] = $this->model->get_members($config['per_page'], 0); 
        $this->data["links"] = $this->ajax_pagination->create_links();
        $this->data['account_menu_active'] = 'admin';
        $this->data['sub_menu_active'] = 'member_management';
        $this->data['meta_keys'] = WEBSITE_NAME;
        $this->data['meta_desc'] = WEBSITE_NAME;
        $this->page_title = WEBSITE_NAME . ' - Login';
        $this->template
                ->set_layout('admin_dashboard')
                ->enable_parser(FALSE)
                ->title($this->page_title)
                ->build('v_member_management', $this->data);
    }
    public function ajax_management() 
    {
        $page = $this->input->post('page');
        if (!$page) 
        {
            $offset = 0;
        } 
        else 
        {
            $offset = $page;
        }
        $config['total_rows'] = $this->model->get_members(false,false,true);
        $config['target'] = '.filterview';
        $config['base_url'] = site_url('/' . ADMIN . '/ajax_management');
        $config['per_page'] = FRONTEND_SMALL_LIST_PAGE;
        $this->ajax_pagination->initialize($config);
        $this->data['members'] = $this->model->get_members($config['per_page'], $offset);
        $this->data["links"] = $this->ajax_pagination->create_links();
        echo $this->load->view('ajax_member_management', $this->data, true);
    }
    public function upload_product()
    {    
            $this->load->library('Phpexcelreader');
            $this->load->library('amazon');
            $time=$this->general->get_local_time('time');
            $extarr = ((explode(".", $_FILES['excelupload']['name'])));
            $ext=end($extarr);
            $fileName =  'xcel-uploads/excelupload'.time().'.'.$ext;
            $fileTempName = $_FILES['excelupload']['tmp_name'];
            $fdata=$this->amazon->upload_stream_file($fileName,$fileTempName);
            $exceldata=$this->amazon->get_stream_object($fileName);
            $data=$this->phpexcelreader->get_excel_data($exceldata);
            if(count($data)>0)
            {
                     $get_all_models=$this->general->get_product_model();
                    foreach($get_all_models as $val)
                    {
                        $model[]=$val->id;
                    }
                    
                   $prodarr=array();
                   foreach ($data as $Row) 
                   {
                    if(count($Row)>=4 && is_numeric($Row['3']))
                    {

                        $checkimei=$this->general->check_imei_available(number_format($Row['3'],0,'',''));
                        if($checkimei)
                        {
                           if(in_array($Row['0'],$model))
                            {
                                $prodarr[] =array('model_number'=>$Row['0'],'imei'=>number_format($Row['3'],0,'',''),'date'=>$time,'color'=>$Row['2'],'suffix'=>$Row['1'],'status'=>'1','sales_status'=>'1');
                            }
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
             else
             {
                     echo json_encode(array('error_message'=>'Upload Failed'));
             }
   }
        
  
    public function delete_data($id=false,$table=false,$message='Product')
    {
        $this->load->library('user_agent');

        try
        {
            if(!$id) throw new Exception('No Delete Record found',1);
            if(!$table) throw new Exception('No Table found',1);
            if($table=='members')
            {
            $res=$this->general->update_data($table,array('status'=>'0'),array('id'=>$id));    
            }
            else{
                $this->db->delete($table,array('id'=>$id));
            }
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
    public function file_settings_do_upload($file, $location, $encrypt_filename = '') {
        $this->load->library('upload');

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
   
    /**************for downloading sample for product upload using Excel*************/
    public function sample_download()
    {
        $filecontent= file_get_contents(site_url('/'.EXCEL_SAMPLE_PATH.'/sample.xlsx'));
        $this->load->helper('download');
        force_download('sample.xlsx',$filecontent);
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


    public function email_taken() 
    {
        $email = trim($this->input->post('email'));
        $id = trim($this->input->post('user_id'));
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
   
   

}
