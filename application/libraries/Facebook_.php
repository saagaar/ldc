<?php
session_start();

require_once __DIR__ . '/vendor/Facebook/autoload.php';
use Facebook\FacebookRequest;


$fb = new Facebook\Facebook([
  'app_id' => '288550634833929', // Replace {app-id} with your app id
  'app_secret' => 'eef5dc81b0103332b4bccf7578e88b71',
  'default_graph_version' => 'v2.7',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  if(isset($_SESSION['facebook_access_token']))
  {
   
    $accessToken=$_SESSION['facebook_access_token'];
  }
  else{
    $accessToken = $helper->getAccessToken();
  }

} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}


if (isset($accessToken)) {
  if (isset($_SESSION['facebook_access_token'])) {
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
  } else {
    // getting short-lived access token
    $_SESSION['facebook_access_token'] = (string) $accessToken;
      // OAuth 2.0 client handler
    $oAuth2Client = $fb->getOAuth2Client();
    // Exchanges a short-lived access token for a long-lived one
    $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
    $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
    // setting default access token to be used in script
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
  }
  // redirect the user back to the same page if it has "code" GET variable
  // if (isset($_GET['code'])) {
  //   header('Location: ./');
  // }
  // getting basic info about user
  try {
    $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
    $profile = $profile_request->getGraphNode()->asArray();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    session_destroy();
    // redirecting user back to app login page
    header("Location: ./");
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
 $getPostsLikes = $fb->get('/me/accounts');
  $getPostsLikes = $getPostsLikes->getGraphEdge()->asArray();
  echo '<pre>';
  print_r($getPostsLikes);
  // printing likes data as per requirements
  foreach ($getPostsLikes as $key) {
    if (isset($key['likes'])) {
      echo count($key['likes']) . '<br>';
      foreach ($key['likes'] as $key) {
        echo $key['name'] . '<br>';
      }
    }
  }

// print_r($profile);
  // printing $profile array on the screen which holds the basic info about user
  // print_r($profile);
    // Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
} else {
$helper = $fb->getRedirectLoginHelper();

$permissions = ['email','user_likes','user_friends']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/famebit/fb-callback.php', $permissions);
$loginUrlgoogle = $helper->getLoginUrl('http://localhost/famebit/google-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '"><img src="images/facebook.png"></a>';
echo '<a href="' . htmlspecialchars($loginUrl) . '"><img src="images/google.png"></a>';
  }