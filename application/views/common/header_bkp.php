<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>:: LG ::</title>
<link href="<?php echo site_url(USER_CSS_DIR)?>/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo site_url(USER_CSS_DIR)?>/footable.core.min.css" media="all">
<link href="<?php echo site_url(USER_CSS_DIR)?>/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="<?php echo site_url('/'.USER_JS_DIR);?>/jquery.min.js"></script> 
<script src="<?php echo site_url('/'.USER_JS_DIR);?>/bootstrap.min.js"></script>
<!----------------ADmin CSS---------------- -->

<?php if($account_menu_active=='admin'): ?>

<link href="<?php echo site_url('/'.ADMIN_CSS_DIR);?>/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo site_url('/'.ADMIN_CSS_DIR);?>/style.css" rel="stylesheet">
<!----------------End of ADmin CSS---------------- -->
<!----------------start of other user CSS---------------- -->
<?php 
else:
?>


<link href="<?php echo site_url('/'.USER_CSS_DIR);?>/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo site_url('/'.USER_CSS_DIR);?>/style.css" rel="stylesheet">

<?php endif;

?>
<script src="<?php echo site_url('/'.USER_JS_DIR);?>/bootstrap-datepicker.min.js"></script> 
<script src="<?php echo site_url('/'.USER_JS_DIR);?>/common.js"></script> 
<script src="<?php echo site_url(USER_JS_DIR)?>/footable.js" type="text/javascript"></script> 
<script src="<?php echo site_url(USER_JS_DIR)?>/footable.sort.js" type="text/javascript"></script> 
<script src="<?php echo site_url(USER_JS_DIR)?>/jquery.validate.min.js" type="text/javascript"></script> 
<script src="<?php echo site_url(USER_JS_DIR)?>/additional.methods.js" type="text/javascript"></script> 
<script src="<?php echo site_url(USER_JS_DIR)?>/validation.error.messages.js" type="text/javascript"></script> 
<!----------------End of ADmin CSS---------------- -->


</head>