  <?php   if($this->session->flashdata('success_message'))
          {
            echo "<div class='alert alert-success text-success'>".$this->session->flashdata('success_message')."</div>";
          } else if($this->session->flashdata('error_message')) {
            echo "<div class='alert alert-success text-error'>".$this->session->flashdata('error_message')."</div>";
          } ?>
<h3 class="m-0">Welcome</h3>
  <p>Please enter your email ID and password</p>
      <form  method="post" class="mt-20">
            <div>
                 <input type="text" class="form-control mb-15 no-radius" autocomplete="off" placeholder="User ID" name="username">
                  <?php echo form_error('username'); ?>
            </div>
            <div>
                 <input type="password" class="form-control mb-15 no-radius" autocomplete="off" placeholder="Password" name="password">
                  <?php echo form_error('password'); ?>
            </div>
            <div class="row">
              <p class="col-xs-6">
                <a href="<?php echo site_url('/user/users/feedback')?>">Help & feedback</a>
              </p>
              <div class="col-xs-6 text-right">
                <button type="submit" class="btn btn-pink btn-login fs-16">Login</button>
                <a type="submit" href="<?php echo site_url('user/login/forget/dealer')?>" class="fs-8 pull-right mt-10">Forgot Password ?</a>
              </div>
              
            </div>      
      </form>

