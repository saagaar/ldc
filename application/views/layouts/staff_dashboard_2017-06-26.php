<?php $this->load->view('common/header');?>
<body>
<header>
  <div class="container">
    <div class="row mt-20 mb-20">
      <div class="col-xs-6"><h1 class="logo mt-0 mb-0"><img src="<?php echo site_url('/'.ADMIN_IMG_DIR);?>/logo_w.png" alt="LG" width="100"></h1></div>
      <div class="col-xs-6 text-right mt-15"><a href="<?php echo site_url('/logout/staff')?>" class="fs-16 fw-6 fc-pink">Logout</a></div>
    </div>
  </div>
<nav class="navbar no-radius no-border no-shadow">
  <div class="container p-0">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#m-menu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="m-menu">
      <ul class="nav navbar-nav">
        <li><a><b>Jackson</b></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="#">Incentive</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sales Report <span class="caret"></span></a>
          <ul class="dropdown-menu p-0">
            <li><a href="">Sales Report</a></li>
            <li><a href="<?php echo site_url('/'.STAFF.'submit_sales');?>">Submit Sales Report</a></li>
            <li><a href="<?php echo site_url('/'.STAFF.'sales_report');?>">Sales Report Sales</a></li>
          </ul>
        </li>
        <li><a href="#">News/Promotions</a></li>
        <li><a href="#" class="fs-3"><i class="fa fa-gears"></i></a></li>
      </ul>
    </div>
  </div>
</nav>    
</header>
<div class="main_loader img-loader hidden" >
        <!-- <img src="<?php echo site_url('/'.USER_IMG_DIR.'ajax_loader.gif');?>"> -->
        <i class="fa fa-spinner fa-spin"></i>
</div>


 <?php echo $template['body']; ?>
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

   $('.overlay_alert').addClass('hidden');
    $('.overlay_alert').removeClass('success');

  },3000);
</script>
  <?php 
} 
?>
<div class="overlay_alert alert  hidden">
 
</div>
<script type="text/javascript">
$(function() {
  $("#bars li .bar").each( function( key, bar ) {
    var percentage = $(this).data('percentage');    
    $(this).animate({
      'height' : percentage + '%'
    }, 1000);
  });
});</script>
<script src="<?php echo site_url('/'.USER_JS_DIR);?>/custom.staff.js"></script>
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