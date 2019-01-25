 <script>
    var urlCheckDuplicateEmail = '<?php echo site_url("user/register/check_email_availability"); ?>';
 //   var urlCheckDuplicateUsername = '<?php echo site_url("user/register/check_username_availability"); ?>';
</script>
 <section class="section creator1" id="section0">
      <div class="container">
      <div class="bg_fff small_bg_fff"><h2 class="text-center"><b>Sign up</b></h2>
      <form method="post" action="" id="brand_registration">
            <div>
                  <input type="text" name="brand_name" class="form-control" placeholder="Brand Name" value="<?php echo $this->input->post('brand_name');?>">
                   <?php echo form_error('brand_name'); ?>
            </div>
            <div>
                  <input type="text" name="brand_url" class="form-control" placeholder="Brand Url" value="<?php echo $this->input->post('brand_url');?>">
                   <?php echo form_error('brand_url'); ?>
            </div>
            <div>
                  <input type="text" name="name" class="form-control" placeholder="Full Name" value="<?php echo $this->input->post('name');?>">
                  <?php echo form_error('name'); ?>
            </div> 
            <div>
                  <input type="text" name="email" class="form-control" placeholder="E-mail" value="<?php echo $this->input->post('email');?>">
                  <?php echo form_error('email'); ?>
            </div>
            
            <div class="form-group">
                  <input type="password" name="password" class="form-control" placeholder="Password">
                   <?php echo form_error('password'); ?>
            </div>
            <div class="checkbox">
                  <label>
                        <input type="checkbox" name="terms_condition"> By signing up you confirm that you accept the <a href="#">Terms &amp; Conditions</a>
                        <br/>
                        <?php echo form_error('terms_condition'); ?>
                  </label>
            </div>
            <button type="submit" class="btn btn-info btn-block " id="brandregbtn">Sign up</button>
      </form>
      <div class="btn-sec text-center">
      <p><b>Already have an account?</b></p>
      <div class=""><a href="login.html" class="btn btn-block btn-default"> Sign in</a></div>
      </div>
      <p class="btm text-center">&copy; 2016 popler, LLC.</p>
      </div>
    </div>



