<!DOCTYPE html>
<html lang="en">
        <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Vid.energy</title>
        <!-- Bootstrap -->
        <link href="<?php echo base_url().USER_CSS_DIR; ?>bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url().USER_CSS_DIR; ?>jquery.fullPage.css">
        <link rel="stylesheet" href="<?php echo base_url().USER_CSS_DIR; ?>style.css">
        <!-- Custom CSS -->
        <link href="<?php echo base_url().USER_CSS_DIR; ?>simple-sidebar.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo base_url().USER_CSS_DIR; ?>bootstrap-datepicker.min.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="<?php echo base_url().USER_CSS_DIR; ?>font-awesome.min.css" rel="stylesheet">
        <!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900">-->
        <!-- Google Fonts embed code <!-- import Google font -->
        <script type="text/javascript">
            (function() {
                var link_element = document.createElement("link"),
                    s = document.getElementsByTagName("script")[0];
                if (window.location.protocol !== "http:" && window.location.protocol !== "https:") {
                    link_element.href = "http:";
                }
                link_element.href += "//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900";
                link_element.rel = "stylesheet";
                link_element.type = "text/css";
                s.parentNode.insertBefore(link_element, s);
            })();
        </script>
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        </head>
        <body>
<div id="wrapper"> 
 
<!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
     <li class="sidebar-brand text-center"><a href="#"><img src="<?php echo base_url().USER_IMG_DIR; ?>logo2.png" width="120"></a> </li>
             
      <?php if(isset($user_type) && $user_type=='creator'){ ?>
              <li <?php if($account_menu_active=='dashboard') { ?> class="active"<?php } ?>> <a href="<?php echo site_url('/'.MY_ACCOUNT.'creator')?>"><i class="fa fa-dashboard"></i> Dashboard</a> </li>
            
              <li <?php if($account_menu_active=='sponsorship') { ?> class="active"<?php } ?>> <a href="<?php echo site_url('/'.CREATOR.'sponsorship/public')?>"><i class="fa fa-dollar"></i> Sponsorships</a> </li>
              <li <?php if($account_menu_active=='collaboration') { ?> class="active"<?php } ?>> <a href="<?php echo site_url('/'.CREATOR.'collaborations')?>"><i class="fa fa-heart"></i> Collaborations</a> </li>
              <li <?php if($account_menu_active=='reward') { ?> class="active"<?php } ?>> <a href="<?php echo site_url('/'.CREATOR.'reward')?>"><i class="fa fa-gift"></i> Reward</a> </li>
              <li <?php if($account_menu_active=='messages') { ?> class="active"<?php } ?>> <a href="<?php echo site_url('/'.MY_ACCOUNT.'messages/inbox')?>"><i class="fa fa-envelope"></i> Messages</a> </li>
              <li <?php if($account_menu_active=='content') { ?> class="active"<?php } ?>> <a href="contetnt.html"><i class="fa fa-youtube-play"></i> Content</a> </li>
              <li <?php if($account_menu_active=='download-app') { ?> class="active"<?php } ?>> <a href="#"><i class="fa fa-apple"></i> Download App</a> </li>
        <?php }
            else{
              ?>
              <li  <?php if($account_menu_active=='dashboard') { ?> class="active"<?php } ?>> <a href="<?php echo site_url('/'.MY_ACCOUNT.'brand')?>"><i class="fa fa-dashboard"></i> Dashboard</a> </li>
              <li  <?php if($account_menu_active=='creator') { ?> class="active"<?php } ?>> <a href="<?php echo site_url('/'.BRAND.'creators')?>"><i class="fa fa-star"></i> Creators</a> </li>
              <li  <?php if($account_menu_active=='campaigns') { ?> class="active"<?php } ?>> <a href="<?php echo site_url('/'.BRAND.'campaigns')?>"><i class="fa fa-file-text"></i> Campaigns</a> </li>
              <li  <?php if($account_menu_active=='messages') { ?> class="active"<?php } ?>><a href="<?php echo site_url('/'.MY_ACCOUNT.'messages/inbox')?>"><i class="fa fa-envelope"></i> Messages</a> </li>
              <li  <?php if($account_menu_active=='content') { ?> class="active"<?php } ?>> <a href="<?php echo site_url('/'.MY_ACCOUNT.'contents')?>"><i class="fa fa-youtube-play"></i> Content</a> </li>
        <?php
            }

        ?>
            </ul>
</div>



<!--JS-START-HERE--> 
<script src="<?php echo base_url().USER_JS_DIR; ?>jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as "4305186B4A"  needed --> 
<script src="<?php echo base_url().USER_JS_DIR; ?>bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(USER_JS_DIR.'jquery.validate.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url(USER_JS_DIR.'validation.error.messages.js'); ?>"></script>
<script src="<?php echo base_url().USER_JS_DIR; ?>bootstrap-datepicker.min.js"></script> 


<script src="<?php echo base_url().USER_JS_DIR; ?>masonry.pkgd.js"></script>
<script src="<?php echo base_url().USER_JS_DIR; ?>imagesloaded.pkgd.js"></script>
<?php 
if($account_menu_active=='settings')
{ ?>
       <script src="<?php echo base_url().USER_JS_DIR;?>settings.js"></script>          
<?php }
if($account_menu_active=='creator')
{ ?>
       <script src="<?php echo base_url().USER_JS_DIR; ?>creators.js"></script>          
<?php }

       
if(isset($user_type) && $user_type=='creator'){ ?>
<script src="<?php echo base_url().USER_JS_DIR; ?>sponsorship.js"></script> 
<script src="<?php echo base_url().USER_JS_DIR; ?>common_creator.js"></script> 


<?php 
}
  ?>
<script>
    $('.input-group.date').datepicker({
    format: "yyyy/mm/dd",
    startDate: "2016-01-01",
    endDate: "2016-12-30",
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true
    });
</script>
<!-- Menu Toggle Script --> 
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script> 

    
<!-- /#sidebar-wrapper --> 
          
<!-- Page Content -->
<div id="page-content-wrapper">
<header class="fix_header1">
<?php if($user_type=='creator'){

  ?>
              <div class="two_btns pull-left"><a href="#menu-toggle" class="fa fa-outdent btn btn-lg" id="menu-toggle"> </a>
              <a href="" class="btn btn-warning">Find Sponsorships </a>
        <button type="button" class="btn btn-success clb" data-toggle="modal" data-target="#myModal">Post Collab</button>
        <!-- Modal -->
     
        
      </div>

  <?php 
   $this->load->view('common/post_collab');
   ?>
     
   <?php
  }
  else
  {
    ?>
   <div class="two_btns pull-left"><a href="#menu-toggle" class="fa fa-outdent btn btn-lg" id="menu-toggle"> </a>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Create Campaign</button>
       
      </div>

  <?php

  }
  ?>
              <ul class="nav navbar-nav pull-right">
        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">E-multitech Solution <span class="caret"></span></a>
                  <ul class="dropdown-menu">
            <li><a href="#">Poplr Bucks</a></li>
            <li><a href="<?php echo site_url('/'.MY_ACCOUNT.'settings')?>">Setting</a></li>
            <li><a href="#">Help Center</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo site_url('user/logout')?>">Logout</a></li>
          </ul>
                </li>
      </ul>
              <div class="clearfix"></div>
            </header>

<div class="mid-part margin_0">
     <?php echo $template['body']; ?>
    
  </div>
</div>
</div>

<script src="<?php echo base_url().USER_JS_DIR; ?>common.js"></script> 

  <?php 
if($user_type=='brand'){
    $this->load->view('common/add_campaign');
    ?>

    <script src="<?php echo base_url().USER_JS_DIR; ?>common_brand.js"></script>
   <?php 
  }
  ?>

  </body>
</html>