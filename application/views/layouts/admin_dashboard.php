<?php echo $this->load->view('common/header');?>
<link href="<?php echo site_url(ADMIN_CSS_DIR)?>/owl.carousel.min.css" rel="stylesheet">

<body>
<header class="p-relative printhidden">
  <div class="container">
    <div class="row mt-20 mb-20">
      <div class="col-xs-6">
        <h2 class="logo mt-0 mb-0 text-success  ">Lumbini Dairy Milk<br/></h2>
        <h6>BUTWAL -6 PH:071-544383</h6>
      </div>
    </div>
  </div>
  <nav class="navbar no-radius no-border mb-0">
    <div class="container p-0">
      <div class="navbar-header">
        <a href="#" class="xs_btn btn visible-xs"><i class="fa fa-bars"></i></a>
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
  <i class="fa fa-spinner fa-spin"></i> </div>
<section class="profile-sec ">
  <div class="container fullwidth">
    <div class="row">
        <div class="col-sm-3 col-md-3 p-0 printhidden">
          <ul class="profile-link text-uppercase fw-6 xs_div">
           <!--  <li class="<?php if($sub_menu_active=='staff_management') echo 'active'?>"><a href="<?php echo site_url('/'.ADMIN.'/staff_management')?>"><i class="fa fa-user"></i> STAFF MANAGEMENT </a></li>
            <li <?php if($sub_menu_active=='student_management') echo 'active'?>><a href="<?php echo site_url('/'.ADMIN.'/student_management/pendingadmin')?>"><i class="fa fa-file-text-o"></i> STUDENT MANAGEMENT</a></li>
            <li class="<?php if($sub_menu_active=='model_management') echo 'active'?>"><a href="<?php echo site_url('/'.ADMIN.'/model_management')?>"><i class="fa fa-newspaper-o"></i> MODEL MANAGEMENT</a></li> -->
            <li class="<?php if($sub_menu_active=='member_management') echo 'active'?>"><a href="<?php echo site_url('/'.ADMIN.'member_management')?>"><i class="fa fa-shopping-cart"></i> CUSTOMER MANAGEMENT</a></li>
             <li class="<?php if($sub_menu_active=='report_management') echo 'active'?>"><a href="<?php echo site_url('/'.ADMIN.'transaction/all')?>"><i class="fa fa-shopping-cart"></i> Report MANAGEMENT</a></li>
           <!--  <li class="<?php if($sub_menu_active=='incentive') echo 'active'?>"><a href="<?php echo site_url('/'.ADMIN.'/incentive/staff')?>"><i class="fa fa-file-text-o"></i> REPORT MANAGEMENT</a></li>
            <li class="<?php if($sub_menu_active=='news_management') echo 'active'?>"><a href="<?php echo site_url('/'.ADMIN.'/news_management')?>"><i class="fa fa-newspaper-o"></i> NEWS MANAGEMENT</a></li>
            <li><a href="<?php echo site_url('/'.ADMIN.'/incentive_setting')?>"><i class="fa fa-gears"></i> INCENTIVE Management</a></li>
   -->          <li><a href="<?php echo site_url('logout/admin')?>"><i class="fa fa-sign-out"></i> LOGOUT</a></li>
          </ul>
          <p class="fc-white text-center text-uppercase small fw-6 hidden-xs" style="margin-top:420px;">Website Setting, Configuration, Distribution and Publication</p>
        </div>
      <div class="col-sm-9 col-md-9 p-0 form-sec pb-0"> <?php echo $template['body']; ?> </div>
    </div>
  </div>
</section>
<!-- For Global success and error messages -->
<?php
if($this->session->flashdata('error_message'))
{?>
<div class="overlay_alert alert  error"> <?php echo $this->session->flashdata('error_message');?> </div>
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
<div class="overlay_alert alert  success"> <?php echo $this->session->flashdata('success_message');?> </div>
<script>
  setTimeout(function(){
      $('.overlay_alert').addClass('hidden');
      $('.overlay_alert').removeClass('success');
  },5000);
</script>
<?php 
} 
?>
<div class="overlay_alert alert  hidden"> </div>

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
   
///// For Date Picker )///
    $(document).ready(function(){
       // $('.input-group').datepicker({
       //         format: 'yyyy/mm/dd',
           
       //      todayHighlight: true,
       //      autoclose: true,
       //  })
       
            $('.nepali-calendar').nepaliDatePicker(
              {
                npdMonth: true,
                npdYear: true,
                npdYearCount: 10
              });
            $('#from-nepali-calendar').nepaliDatePicker({
               npdMonth: true,
                npdYear: true,
                npdYearCount: 10
            });
            $('#to-nepali-calendar').nepaliDatePicker({
               npdMonth: true,
                npdYear: true,
                npdYearCount: 10  
            });
            
        // var container=".initialdate";
        // $('input[name="fromdate"]').datepicker({
        //        format: 'yyyy/mm/dd',
        //     container: container,
        //     todayHighlight: true,
        //     autoclose: true,
        // })
        //  var container=".finaldate";
        //  $('input[name="todate"]').datepicker({
        //        format: 'yyyy/mm/dd',
        //     container: container,
        //     todayHighlight: true,
        //     autoclose: true,
        })
      
</script>

<script>
$(function()
{
 $('.xs_btn').click(function(){
     $('.xs_div').slideToggle();
 }); 
});
  $('table.footable').footable(
  { 
  breakpoints: {
  tablet: 767,
  phone: 479
  }
}
);
</script>

</body>
</html>