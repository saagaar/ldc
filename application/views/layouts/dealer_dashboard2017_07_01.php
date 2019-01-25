<?php $this->load->view('common/header');?>
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
          <li><a><b>User: <?php
         
         $display= $this->session->userdata(SESSION.'display_name');
         if(trim($display)!='') echo $display;
         else echo $this->session->userdata(SESSION.'username');
         ?></b></a></li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<div class="main_loader img-loader hidden" >
        <!-- <img src="<?php echo site_url('/'.USER_IMG_DIR.'ajax_loader.gif');?>"> -->
        <i class="fa fa-spinner fa-spin"></i>
</div>
<?php if($sub_menu_active!='approve_sales_report'):?>
<section class="profile-sec dealer-report sales-status">
  <div class="container">
    <div class="row">
      <div class="col-sm-5 col-md-3 p-0">
        <ul class="profile-link text-uppercase fw-6">
          <li class="<?php if($sub_menu_active=='sales_report') echo 'active'?>"><a href="<?php echo site_url('/'.DEALER_DASHBOARD_PATH);?>"><i class="fa fa-pie-chart"></i> OVERVIEW </a></li>
          <li class="<?php if($sub_menu_active=='staff_management') echo 'active'?>"><a href="<?php echo site_url('/'.DEALER.'staff_management');?>"><i class="fa fa-users"></i> STAFF MANAGMENT</a></li>
          <li class="<?php if($sub_menu_active=='settings') echo 'active'?>"><a href="<?php echo site_url('/'.DEALER.'settings');?>"><i class="fa fa-gears"></i> SETTING</a></li>
         <li><a href="<?php echo site_url('/logout/dealer')?>"><i class="fa fa-sign-out"></i> LOGOUT</a></li>
        </ul>
        <div class="text-center mt-30"><a href="<?php echo site_url(''.DEALER.'approve_sales_report');?>" class="btn btn-pink btn-sm">Approve Report</a></div>
      </div>
      <div class="col-sm-7 col-md-9 form-sec p-0">
       <?php echo $template['body']; ?>
        
      </div>
    </div>
  </div>
</section>
<?php 
else:
    echo $template['body'];
endif;
?>
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

    $('.overlay_alert').fadeOut();
     $('.overlay_alert').removeClass('success');
  },3000);
</script>
  <?php 
} 
?>
<div class="overlay_alert alert  hidden">
 
</div>
<!-- jQuery (necessary JavaScript ) --> 

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

  $('table.footable').footable(
  { 
  breakpoints: {
  tablet: 767,
  phone: 479
  }
}
);

    });
</script> 
<script src="<?php echo site_url(USER_JS_DIR)?>/custom.dealer.js"></script> 
<script src="<?php echo site_url(ADMIN_JS_DIR)?>/amcharts.js"></script> 
<script src="<?php echo site_url(ADMIN_JS_DIR)?>/pie.js"></script> 

</body>
</html>