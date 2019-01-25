<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once '/var/www/html/AWSSDKforPHP/sdk.class.php';
class Amazons3 {
 
  function __construct( )
  {
    $this->ci =& get_instance();
  }
  
 
  public function upload_new_promotion($fileName,$fileTempName)
  {   
     
          
            // $s3 = new AmazonS3();
            // $bucket_name = 'lgrewards';
            // $key_name='news and promotion';
            // $s3 = S3Client::factory();
            // $opt = array(
            // 				'fileUpload' => $fileTempName,
            // 				'acl' => 'public-read'	
            // 			);

          
    // if(!$_FILES['Img'])
    //            echo $photoS3Url;
    
    //  if(!$_FILES['Img']['tmp_name'])
            
    //         echo $photoS3Url;
     

	$ext = "png";
        //passIcImg
	
	
	/* upload to s3 bucket */
	$s3 = new AmazonS3();
	$bucket_name = 'lgrewards';
	$opt = array('fileUpload' => $fileTempName,
					'acl' => AmazonS3::ACL_OPEN);
	
	$response = $s3->create_object($bucket_name, "feedbackimage/".$fileName, $opt);
	
	if($response->isOK())
	{
		$info = $response->header[_info];
		$photoS3Url = $info["url"];
	
                
	}
	 echo  $photoS3Url;
            return $response;
   
  }
}