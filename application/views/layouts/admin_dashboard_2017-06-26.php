<?php echo $this->load->view('common/header');?>

<link href="<?php echo site_url(ADMIN_CSS_DIR)?>/owl.carousel.min.css" rel="stylesheet">
  
<body>
<header class="p-relative">
  <div class="container">
    <div class="row mt-20 mb-20">
      <div class="col-xs-6">
        <h1 class="logo mt-0 mb-0"><img src="<?php echo site_url('/'.ADMIN_IMG_DIR);?>/logo_w.png" alt="LG" width="100"></h1>
      </div>
    </div>
  </div>
  <nav class="navbar no-radius no-border mb-0">
    <div class="container p-0">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#m-menu" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="collapse navbar-collapse" id="m-menu">
        <ul class="nav navbar-nav">
          <!--<li><a>&nbsp;</a></li>-->
        </ul>
      </div>
    </div>
  </nav>
</header>
<div class="main_loader img-loader hidden" >
        <!-- <img src="<?php echo site_url('/'.USER_IMG_DIR.'ajax_loader.gif');?>"> -->
        <i class="fa fa-spinner fa-spin"></i>
</div>
<section class="profile-sec">
  <div class="container">
    <div class="row">
      <div class="col-sm-5 col-md-3 p-0">
        <ul class="profile-link text-uppercase fw-6">
          <li class="<?php if($sub_menu_active=='dealer_management') echo 'active'?>"><a href="<?php echo site_url('/'.ADMIN.'/dealer_management')?>"><i class="fa fa-user"></i> DEALER MANAGEMENT </a></li>
          <li class="<?php if($sub_menu_active=='product_management') echo 'active'?>"><a href="<?php echo site_url('/'.ADMIN.'/product_management')?>"><i class="fa fa-shopping-cart"></i> PRODUCT MANAGEMENT</a></li>
          <li <?php if($sub_menu_active=='report_management') echo 'active'?>><a href="<?php echo site_url('/'.ADMIN.'/product-management')?>"><i class="fa fa-file-text-o"></i> REPORT MANAGEMENT</a></li>
          <li class="<?php if($sub_menu_active=='news_management') echo 'active'?>"><a href="<?php echo site_url('/'.ADMIN.'/news_management')?>"><i class="fa fa-newspaper-o"></i> NEWS MANAGEMENT</a></li>
          <li><a href="<?php echo site_url('/'.ADMIN.'/incentive_setting')?>"><i class="fa fa-gears"></i> INCENTIVE SETTING</a></li>
          <li><a href="<?php echo site_url('logout/admin')?>"><i class="fa fa-sign-out"></i> LOGOUT</a></li>
        </ul>
        
        <p class="fc-white text-center text-uppercase small fw-6" style="margin-top:420px;">Website Setting, Configuration, Distribution and Publication</p>
      </div>
      <div class="col-sm-7 col-md-9 p-0 form-sec pb-0">
          <?php echo $template['body']; ?>
      </div>
    </div>
  </div>
</section>
<!-- For Global success and error messages --> 
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

<!-- jQuery (necessary JavaScript ) --> 
<script src="<?php echo site_url(ADMIN_JS_DIR)?>/custom.admin.js"></script> 
<?php if($sub_menu_active=='news_management'):?>


  <script src="<?php echo site_url(ADMIN_JS_DIR)?>/owl.carousel.js"></script>
  <script src="<?php echo site_url(ADMIN_JS_DIR)?>/bootstrap.file-input.js"></script> 
<?php endif;?>
<script>
$(function () 
{
     btnclk=$(this);
});
</script>
</body>
</html>