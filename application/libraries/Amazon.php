<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Aws\S3\S3Client;
class Amazon {
 private $client;
  function __construct( )
  {
    define('AMAZON_ACCESS_KEY','AKIAJMDKUBCOWYPNONAQ');
    define('AMAZON_SECRET_KEY','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');
    define('AMAZON_REGION','us-east-1');
  }
  
 
  public function upload_new_promotion_ok($fileName,$fileTempName)
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
	// $s3 = new AmazonS3();
	$bucket_name = 'lgrewards';
	$opt = array('fileUpload' => $fileTempName,
					'acl' =>self:: ACL_OPEN);
	
	$response = $this->create_object($bucket_name, "feedbackimage/".$fileName, $opt);
	
	if($response->isOK())
	{
		// $info = $response->header[_info];
		// $photoS3Url = $info["url"];
	  return $response;
                
	}
	 echo  $photoS3Url;
            return $response;
   
  }

/************ upload all  file *********************/
 public function upload_files($fileName,$fileTempName)
  {   
  	 $s3 = S3Client::factory([
			'key' => AMAZON_ACCESS_KEY,
			'secret' => AMAZON_SECRET_KEY,
			'region' => AMAZON_REGION
		]);
    $bucket_name = 'lgrewards';
    $result = $s3->putObject(array(
    'Bucket'       => $bucket_name,
    'Key'          => $fileName,
    'SourceFile'   => $fileTempName,
    'ACL'          => 'public-read'
  ));

  return  $result['ObjectURL'];

 
  }

  /**************for uploading file in amazon s3 for upload excel file in product add from excel in product management*************8*/
  public function upload_stream_file($fileName,$fileTempName)
  {   
  	 $s3 = S3Client::factory([
			'key' => AMAZON_ACCESS_KEY,
			'secret' => AMAZON_SECRET_KEY,
			'region' => AMAZON_REGION
		]);
    $bucket_name = 'lgrewards';
    $s3->registerStreamWrapper();

   
  //   $result = $s3->putObject(array(
  //   'Bucket'       => $bucket_name,
    $key         = $fileName;
  //   'SourceFile'   => $fileTempName,
  //   'ACL'          => 'public-read'
  // ));
  $data=file_put_contents('s3://'.$bucket_name.'/'.$key, $fileTempName); 
  return $data; 
 
  }
/************to get all normal files that are uploaded*********************/
 public function get_object($fileName)
  {   
  	// echo $fileName;echo $fileTempName;exit;
     $s3 = S3Client::factory([
			'key' => AMAZON_ACCESS_KEY,
			'secret' => AMAZON_SECRET_KEY,
			'region' => AMAZON_REGION
		]);

    $bucket_name = 'lgrewards';
    $result = $s3->getObjectUrl(array(
    'Bucket'       => $bucket_name,
    'Key'          => $fileName,
   
  ));

  return $result['ObjectURL'];

 
  }

  public function get_stream_object($fileName)
  {
     $s3 = S3Client::factory([
      'key' => AMAZON_ACCESS_KEY,
      'secret' => AMAZON_SECRET_KEY,
      'region' => AMAZON_REGION
    ]);
      $bucket_name = 'lgrewards';
     $s3->registerStreamWrapper();
     $data = file_get_contents('s3://'.$bucket_name.'/'.$fileName,true);
     
       return $data;
  }

/**************for download sales report***************/
  public function get_stream_upload_fopen($fileName,$fileTempName){
     $s3 = S3Client::factory([
      'key' => AMAZON_ACCESS_KEY,
      'secret' => AMAZON_SECRET_KEY,
      'region' => AMAZON_REGION
    ]);
    $bucket_name = 'lgrewards';
    $s3->registerStreamWrapper();
    $stream = fopen("s3://{$bucket_name}/{$fileName}", 'w');
    fwrite($stream, $fileTempName);
    fclose($stream);
    header('Content-Description: File Transfer');
    // // header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="'.basename($fileName).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate,post-check=0, pre-check=0');
    header('Pragma: public');
    readfile("s3://{$bucket_name}/{$fileName}");
  }
}