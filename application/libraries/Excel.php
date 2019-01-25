<?php defined('BASEPATH') OR exit('No direct script access allowed');
 mb_internal_encoding("8bit");
 /**
  * Author @sagar
  */
 ini_set('precision', '15');
 
         require(APPPATH.'third_party/php-excel-reader/excel_reader2.php');
         require(APPPATH.'third_party/php-excel-reader/SpreadsheetReader.php');
         

    
  
class Excel
{

   function __construct(){
      $this->ci = & get_instance();
   }

public function get_excel_data($file)
{
    //  if(!is_readable($file)) {
    // $this->error =1 ;
    //  return array('error_message'=>'This file is unreadable');
    // }
    // 
    // 

 
   // echo      $file=APPPATH.'third_party/php-excel-reader/example.xlsx';exit;
   // chmod(base_url().'/upload_files/excel-upload',0777);
    // if (file_exists($file))
    // {
          $Reader = new SpreadsheetReader($file);
          return $Reader;
    // }
    // else
    // {
    //   return array('error_message'=>'This file is not found');
    // }
}

public function upload_excel_file($file, $location, $encrypt_filename = ''){

   $this->ci->load->library('upload');
        $config['upload_path'] = './' . $location;  
        $config['allowed_types'] = 'xlsx';
        $config['remove_spaces'] = TRUE;
        $config['max_size'] = '4048';
       
        if (!file_exists($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }
        if ($encrypt_filename = 'encrypt') {
            $config['encrypt_name'] = TRUE;
        }

        $this->ci->upload->initialize($config);
        $this->ci->upload->do_upload($file);
        if ($this->ci->upload->display_errors()) {
            $this->ci->error_img = $this->ci->upload->display_errors();
             
             return array('error_message'=> $this->ci->error_img);
            
        } else {
            $data = $this->ci->upload->data();
           
            return $data;
        }
   

}
}