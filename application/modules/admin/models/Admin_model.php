<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// require_once '/var/www/html/AWSSDKforPHP/sdk.class.php';

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public $validate_add_member = array
    (
        array('field' => 'customer_name', 'label' => 'Customer Name', 'rules' => 'trim|required|max_length[100]'),
        array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required|max_length[100]'),
        array('field' => 'phone', 'label' => 'Phone', 'rules' => 'trim|required|max_length[15]'),
        array('field' => 'fat_rate', 'label' => 'Fat Rate', 'rules' => 'trim|required|numeric'),
        array('field' => 'snf_rate', 'label' => 'SNF Rate', 'rules' => 'trim|required|numeric'),
        array('field' => 'rate', 'label' => 'Rate', 'rules' => 'trim|required|numeric'),
        array('field' => 'commission', 'label' => 'Commission', 'rules' => 'trim|numeric'),
    );
     public $validate_receipt= array
    (
        array('field' => 'fat', 'label' => 'Fat', 'rules' => 'trim|required|numeric'),
        array('field' => 'milk', 'label' => 'Milk', 'rules' => 'trim|required|numeric'),
        array('field' => 'lacto', 'label' => 'Lacto', 'rules' => 'trim|required|numeric'),
        array('field' => 'date', 'label' => 'Receipt Date', 'rules' => 'trim|required'),
    );
    public $validate_add_news =  array
     (  
        array('field' => 'title', 'label' => 'Title', 'rule(0[1-9]|1[0-9]|2[0-9]|3(0|1))s' => 'trim|required|max_length[200]'),
        array('field' => 'description', 'label' => 'description', 'rules' => 'trim|required|max_length[800]'),
    );
    public $validate_staff_add =  array
    (
       
        array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required|min_length[2]|max_length[100]'),
        array('field' => 'last_name', 'label' => 'Family Name', 'rules' => 'trim|required|min_length[2]|max_length[50]'),
       
        array('field' => 'email', 'label' => 'Email Id', 'rules' => 'trim|required|valid_email|min_length[3]|max_length[100]|callback_email_taken'),    
        array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|min_length[6]|max_length[15]'),
        array('field' => 'retype_password', 'label' => 'Repeat Password', 'rules' => 'trim|min_length[6]|max_length[15]|matches[password]'),
        array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim|required'),
        array('field' => 'dob', 'label' => 'DOB', 'rules' => 'trim|required'),
        array('field' => 'address', 'label' => 'Address 1', 'rules' => 'trim|required|min_length[2]|max_length[200]'),
        array('field' => 'mobile', 'label' => 'Mobile No', 'rules' => 'trim|required|min_length[6]|max_length[20]'),
        array('field' => 'identification_no', 'label' => 'Identification No', 'rules' => 'trim|required|min_length[3]|max_length[20]'),
        array('field' => 'identification_office', 'label' => 'Identification Office', 'rules' => 'trim|required|min_length[3]|max_length[20]'),
        array('field' => 'blood_group', 'label' => 'Blood Group', 'rules' => 'trim|required'),
        array('field' => 'monthly_charge', 'label' => 'Monthly Salary', 'rules' => 'trim|required'),
        array('field' => 'join_date', 'label' => 'Join Date', 'rules' => 'trim|required')
    );
    


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
	
 

    public function add_member()
    {

        
        $id=trim($this->input->post('customerid',true));
        $customer_name=$this->input->post('customer_name',true);
        $address=$this->input->post('address',true);
        $phone=$this->input->post('phone',true);
        $fat_rate=$this->input->post('fat_rate',true);
        $snf_rate=$this->input->post('snf_rate',true);
        $rate=$this->input->post('rate',true);
        $commission=$this->input->post('commission_rate',true);
        $data=array(
                        'customer_name'     =>  $customer_name,
                        'address'           =>  $address,
                        'phone'             =>  $phone,
                        'fat_rate'          =>  $fat_rate,
                        'snf_rate'          =>  $snf_rate,
                        'join_date'         =>  date('Y-m-d'),
                        'tc_rate'           =>  $rate,
                        'commission'        =>  isset($commission)?$commission:0,
                        'status'            =>  '1',
                        'user_type'         =>  '4'
                   );
       
        if($id==false || $id=='')
        {

            $this->general->insert_data('members',$data);
            if($this->db->affected_rows()>0)
                return array('success_message'=>'Customer inserted successfully');
            else 
                return array('error_message'=>'Customer Insertion Failed');
        }
        else
        {
            unset($data['join_date']);
            $this->general->update_data('members',$data,array("id"=>$id));
            if($this->db->affected_rows()>0)
                return array('success_message'=>'Customer updated successfully');
            else 
                return array('error_message'=>'No data to update');
        }
    }

    public function add_receipt($id=false)
    {

        
        $user_id=trim($this->input->post('user_id',true));
        $milk=$this->input->post('milk',true);
        $lacto=$this->input->post('lacto',true);
        $fat=$this->input->post('fat',true);
        $date=$this->input->post('date',true);
        $userdata = $this->general->get_single_row('members',array('id'=>$user_id));
        $data=array(
                        'milk'            =>  $milk,
                        'lacto'           =>  $lacto,
                        'fat'             =>  $fat,
                        'date'            =>  date('Y-m-d H:i:s'),
                        'invoice_date'    =>  $date,
                        'user_id'         =>  $user_id,
                        'tc_rate'         =>  $userdata->tc_rate,
                        'snf_rate'        =>  $userdata->snf_rate,
                        'fat_rate'        =>  $userdata->fat_rate,
                        'commission'      =>  $userdata->commission 
                        
                   );
    
        if($id==false || $id=='')
        {

            $this->general->insert_data('sales_report',$data);
            if($this->db->affected_rows()>0)
                return array('success_message'=>'Receipt inserted successfully');
            else 
                return array('error_message'=>'Receipt Insertion Failed');
        }
        else
        {
            unset($data['join_date']);
            $this->general->update_data('sales_report',$data,array("id"=>$id));
            if($this->db->affected_rows()>0)
                return array('success_message'=>'Receipt updated successfully');
            else 
                return array('error_message'=>'No data to update');
        }
    }
    
     public function get_transaction($userid=false,$limit=false,$offset=false,$count=false)
    {
        $name=trim($this->input->post('filtername',true));
        $postuserid=$this->input->post('filteruserid',true);
        $from=$this->input->post('filterfromdate',true);
        $to=$this->input->post('filtertodate',true);
        $cond='1=1';
        if(!$userid) $userid=$postuserid;
        if($name)
        {
            $cond=$cond." and (customer_name like('%$name%') or  phone like('%$name%') or   address like('%$name%') or CONVERT(id , CHAR(5)) like '$name%')";
        }
        if(($userid || $postuserid) && ($userid!='all'))
        {
             $cond=$cond." and s.user_id='$userid'";
        }

        if($from && !$to)
        {
            $to=date('Y-m-d');

        }
        if($to && !$from)
        {
            $from=$to;
        }

        if($from || $to)
        {
            $cond=$cond." and  s.invoice_date between '$from' and '$to'";
        }
        $this->db->select('s.*,m.id as member_id');
        $this->db->from('sales_report s');
        $this->db->join('members m','s.user_id=m.id');
        $this->db->where('m.user_type','4');
        $this->db->where($cond);

        $this->db->order_by('s.id','desc');
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
        $this->db->select('*');
        $this->db->from('members m');
        $this->db->join('members_details md','m.id=md.user_id');
        $this->db->where( array('m.id' => $id));
        $query=$this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else
            return false;
    }
    public function get_members_by_id($id)
    {
        $query=$this->db->get_where('members',array('id'=>$id,'status'=>'1'));
        if($query->num_rows()>0){
            return $query->row();
        }
        else return false;
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
                        'imei8'             =>  $imei8,
                   );
        if($id==false || $id=='')
        {
            $data['created_date']=date('Y-m-d H:i:s');
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

    public function get_members($limit=false,$offset=false,$count=false)
    {
        $name=trim($this->input->post('filtername',true));
        $status=$this->input->post('filterstatus',true);
        $cond='1=1';
        if($name)
        {
            $cond=$cond." and (customer_name like('%$name%') or  phone like('%$name%') or   address like('%$name%') or concat('c',CONVERT(id , CHAR(5))) like '$name%')";
            
        }
      
        if($status=='1' || $status=='0')
        {
           
            $cond=$cond." and m.status='$status'";
        }

        $this->db->select('*,m.id as member_id');
        $this->db->from('members m');
        $this->db->where('m.status','1');
        $this->db->where('m.user_type','4');
        $this->db->where($cond);
        $this->db->order_by('m.id','desc');
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
        $this->db->select('m.id as user_id,m.email,about_user,first_name,last_name,m.username,paddress,mobile,cover_image,gender,dob,');
        $this->db->from('members m');
        $this->db->join('members_details md', 'm.id=md.user_id');
        // $this->db->join('members n', 'n.id=m.dealer_id');
        // $this->db->join('outlet O','O.id=m.outlet_id','left');
        
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
        $config['max_size'] = '4048';
        $config['max_width'] = '2000';
        $config['max_height'] = '2000';
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

                            aes_decrypt(m.display_name,m.salt) as dealer,aes_decrypt(n.display_name,n.salt) as staff,o.outlet,o.type,mo.display_name as model,P.imei,P.color,S.invoice_date,aes_decrypt(n.nric,n.salt) as nric,S.invoice_id,S.submit_date');
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