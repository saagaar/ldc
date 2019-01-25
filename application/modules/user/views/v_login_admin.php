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
                 <input type="text" class="form-control mb-15 no-radius" autocomplete="off" placeholder="Username" name="username">
                  <?php echo form_error('username'); ?>
            </div>
            <div>
                 <input type="password" class="form-control mb-15 no-radius" autocomplete="off" placeholder="Password" name="password">
                  <?php echo form_error('password'); ?>
            </div>
         
            <div class=" text-right"><button type="submit" class="btn btn-pink fs-16">Login</button></div></div>      
      </form>