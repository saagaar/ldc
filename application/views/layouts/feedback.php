<?php echo $this->load->view('common/header');?>
<body>
<header>
  <div class="container">
    <div class="row mt-20 mb-20">
      <div class="col-xs-6"><h1 class="logo mt-0 mb-0"><img src="<?php echo site_url('/'.ADMIN_IMG_DIR);?>/logo_w.png" alt="LG" width="100"></h1></div>
      <div class="col-xs-6 text-right mt-15"><a href="<?php echo base_url(); ?>" class="fs-16 fw-6 fc-pink">Login</a></div>
    </div>
  </div>
<nav class="navbar no-radius no-border">
  <div class="container">
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
        <li class=""><a href="#">&nbsp;</a></li>
      </ul>
    </div>
  </div>
</nav>    
</header>

  <?php echo $template['body']; ?>

</body>
<script src="<?php echo site_url('/'.USER_JS_DIR);?>/feedback.js"></script>
     
</html>