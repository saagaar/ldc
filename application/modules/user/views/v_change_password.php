
<div class="mid-part">

<div class="main-ttl">
  <h3>Password Recovery</h3>
<div class="clearfix"></div>
</div>

  <div class="reg-inner">
    <!--   <p>Reset Password</p> -->
        <div class="log-form">
            <div class="row">
              <div class="col-sm-12">
                  <form method="post" action="">
          <fieldset>
                    <?php
                      if($this->session->flashdata('success_message'))
                      {
                        echo "<span class='text-success'>".$this->session->flashdata('success_message')."</span>";
                      } else if($this->session->flashdata('error_message')) {
                        echo "<span class='text-error'>".$this->session->flashdata('error_message')."</span>";
                      }
                    ?>
                <!-- <h4><i class="fa fa-user">&nbsp;</i> Enter your email & we will send a new password.</h4> -->
                <div class="form-group">
                                <!-- <label>New Password</label> -->
                <input type="password" name="password" class="form-control mb-15 no-radius" placeholder="New Password">
                <?php echo form_error('password'); ?>
                </div>
                 <div class="form-group">
                                <!-- <label>Confirm Password</label> -->
                <input type="password" name="repassword" class="form-control mb-15 no-radius" placeholder="Confirm Password">
                <?php echo form_error('repassword'); ?>
                </div>
                <div class="text-right">
                <button type="submit" name="button" class="btn btn-pink">Reset Password</button>
                </div>
          </fieldset>
        </form>
                </div>
               <!--  <div class="col-md-6 col-sm-12">
                  <div class="gray_box">
                        <p class="b_txt">Not yet registered?</p>
                        <p>Register today...</p>
            <p>It only take's 'two ticks' to register now...</p>
                        <div class="btn_sec"><a href="<?php echo site_url('user/register/buyer'); ?>">Buyer Register</a> <a href="<?php echo site_url('user/register/supplier'); ?>">Supplier Register</a></div>
                    </div>
                </div> -->
            </div>              
            </div>        
    </div>  
<div class="clearfix"></div>

<div class="clearfix"></div>
</div>