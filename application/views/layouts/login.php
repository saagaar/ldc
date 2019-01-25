<?php $this->load->view('common/header');?>
<body>
<div class="bg-sec"><!--<figure class="bg-img"><img src="images/bg.png" style="width:100%; height:100; poecho sition:absolute;"></figure>-->
  <div class="container">
    <div class="login-page">
      <?php if($account_menu_active=='student'):?>
      <div class="col-md-5 col-sm-5">
        <h2 class="mb-15 mt-10 h1 fc-white">Register as Staff</h2>
        <p class="fc-white fs-16">A single account that allows for various interaction with LG </p>
        <a href="<?php echo site_url('user/register/student')?>" class="btn btn-white mt-15">Sign up</a> </div>
      <?php  endif;?>
      <div class="col-md-6 col-sm-7 pull-right">
      <?php if($sub_menu_active!='forget' || $sub_menu_active!='reset_password'):?>
        <ul class="nav nav-tabs no-border text-center">
         <!--  <li class="<?php  if($account_menu_active=='student') echo 'active';?>"><a href="<?php echo site_url('/login/student')?>">Student</a></li>
          <li class="<?php  if($account_menu_active=='staff') echo 'active';?>"><a href="<?php echo site_url('login/staff')?>">Staff</a></li> -->
          <li class="<?php  if($account_menu_active=='admin') echo 'active';?>"><a href="<?php echo site_url('/login/admin')?>"> Admin</a></li>
        </ul>
      <?php else: ?>
      <ul class="nav nav-tabs no-border text-center"><li class="active">Forgot Password</li></ul>
        <?php
          endif;
          ?>
        <div class="bg-white p-20">
          <h1 class="logo m-0 text-center"><img src="<?php echo site_url('/'.USER_IMG_DIR);?>/logo_w.png" alt="LG"></h1>
        </div>
        <div class="tab-content p-20 bg-white">
          <div role="tabpanel" class="tab-pane active" > <?php echo $template['body']; ?> </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
<!-- jQuery (necessary JavaScript ) --> 
<script src="<?php echo site_url('/'.USER_JS_DIR);?>/jquery.min.js"></script> 
<script src="<?php echo site_url('/'.USER_JS_DIR);?>/bootstrap.min.js"></script>
</body>
</html>