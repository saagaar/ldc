<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>:: LG ::</title>
<!-- CSS -->
<link href="<?php echo site_url('/'.USER_CSS_DIR);?>/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo site_url(USER_CSS_DIR)?>/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="<?php echo site_url('/'.USER_CSS_DIR);?>/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo site_url('/'.USER_CSS_DIR);?>/style.css" rel="stylesheet">
 <script src="<?php echo site_url('/'.USER_JS_DIR);?>/jquery.min.js"></script> 
<div class="bg-sec sign-up"><!--<figure class="bg-img"><img src="images/bg.png" style="width:100%; height:100; position:absolute;"></figure>-->
   <?php echo $template['body']; ?>
</div>

<script src="<?php echo site_url('/'.USER_JS_DIR);?>/bootstrap.min.js"></script>

<script src="<?php echo site_url('/'.USER_JS_DIR);?>/bootstrap-datepicker.min.js"></script>
<script src="<?php echo site_url('/'.USER_JS_DIR);?>/jquery.validate.min.js"></script>
<script src="<?php echo site_url('/'.USER_JS_DIR);?>/validation.error.messages.js"></script>
<script src="<?php echo site_url('/'.USER_JS_DIR);?>/additional.methods.js"></script>
<script src="<?php echo site_url('/'.USER_JS_DIR);?>/users.form.validation.js"></script>
<?php
if($this->session->flashdata('error_message'))
{?>
<div class="overlay_alert alert  error">
    <?php echo $this->session->flashdata('error_message');?>
</div>
<script>
  setTimeout(function(){
    $('.overlay_alert').addClass('hidden');
      $('.overlay_alert').removeClass('error');
  },5000);
</script>
<?php 
}
if($this->session->flashdata('success_message'))
{
  ?>

  <div class="overlay_alert alert  success">
    <?php echo $this->session->flashdata('success_message');?>
</div>
<script>
  setTimeout(function(){

    $('.error').fadeOut();
     $('.error').remove();
  },3000);
</script>
  <?php 
} 
?>
<div class="overlay_alert alert  hidden">
 
</div>
</body>
</html>

<script>
///// For Date Picker )///
  $(document).ready(function(){
    var date_input=$('input[name="date"]'); //our date input has the name "date"
    var container=".date";
    date_input.datepicker({
      format: 'mm/dd/yyyy',
      container: container,
      todayHighlight: true,
      autoclose: true,
    })
  });
</script>