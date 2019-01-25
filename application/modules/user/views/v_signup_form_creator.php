 <section class="section creator1" id="section0">
      <div class="container">
   <div class="bg_fff text-center"><h2><b>Only takes 30 seconds to join!</b></h2>
          <!-- Sign up. -->
          <div id="sign-up-div">
             
              <?php
              $name=$this->input->post('name');
              $email=$this->input->post('email');
            
              ?>
              <form method="post" action="<?php echo site_url('/user/register/'.$action)?>" id="creatorsignup" enctype="multipart/form-data">
                <fieldset>
                 <div class="form-group ">
                  <input type="text" value="" class="form-control"  name="name" placeholder="Name" value="<?php echo $name?>">
                  <p for="name" generated="true" ></p>
                    <?php echo form_error('name'); ?>
                 </div>
                 <div class="form-group">
                  <input type="text" value="" class="form-control" autocomplete="off" name="email" placeholder="Email" value="<?php echo $email?>">
                    <?php echo form_error('email'); ?>
                </div>
                 <div class="form-group">
                  <input type="password" value="" class="form-control" autocomplete="off" name="password" placeholder="Password">
                    <?php echo form_error('password'); ?>
                </div>

                <div class="form-group">
                <input type="submit" id="creator_registration" class="btn btn_green">
                </div>
                </fieldset>
              </form>
         </div>

        <p class="btm">By signing up you confirm that you accept our</a>  <a href="<?php echo site_url('sitesetup/termscondition')?>">Terms & condition.</p>
      </div>
      </div>
</section>









