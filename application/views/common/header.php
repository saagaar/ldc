<!DOCTYPE html>
<html lang="en">
<head class="printhidden">
<meta charset="utf-8">
<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title class="printhidden">:: LDC::</title>
<link href="<?php echo site_url(USER_CSS_DIR)?>/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo site_url(USER_CSS_DIR)?>/footable.core.min.css" media="all">
<link href="<?php echo site_url(USER_CSS_DIR)?>/bootstrap-datepicker.min.css" rel="stylesheet">

<script src="<?php echo site_url('/'.USER_JS_DIR);?>/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-1.11.1.js"></script> -->

<!-- <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> -->



<script src="<?php echo site_url('/'.USER_JS_DIR);?>/bootstrap.min.js"></script>
<script src="<?php echo site_url('/'.USER_JS_DIR);?>/bootstrap.file-input.js"></script>
<!----------------ADmin CSS---------------- -->

<?php if(isset($account_menu_active) && $account_menu_active=='admin'): ?>

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
<link rel="stylesheet" type="text/css" href="<?php echo site_url('/'.ADMIN_CSS_DIR);?>/nepali.datepicker.v2.2.min.css" />

<script type="text/javascript" src="<?php echo site_url('/'.ADMIN_JS_DIR);?>/nepali.datepicker.v2.2.min.js"></script>
<script src="<?php echo site_url('/'.USER_JS_DIR);?>/bootstrap-datepicker.min.js"></script> 
<script src="<?php echo site_url('/'.USER_JS_DIR);?>/common.js"></script> 
<script src="<?php echo site_url(USER_JS_DIR)?>/footable.js" type="text/javascript"></script> 
<script src="<?php echo site_url(USER_JS_DIR)?>/footable.sort.js" type="text/javascript"></script> 
 
<script src="<?php echo site_url(USER_JS_DIR)?>/jquery.validate.min.js" type="text/javascript"></script> 

<script src="<?php echo site_url(USER_JS_DIR)?>/validation.error.messages.js" type="text/javascript"></script> 
<script src="<?php echo site_url(USER_JS_DIR)?>/additional.methods.js" type="text/javascript"></script>

<script src="<?php echo site_url(USER_JS_DIR)?>/owl.carousel.js" type="text/javascript"></script>
<link href="<?php echo site_url('/'.ADMIN_CSS_DIR);?>/owl.carousel.min.css" rel="stylesheet">
<!----------------End of ADmin CSS---------------- -->


</head>