 <?php if($this->session->userdata('registration_error')){
  ?>
 <section class="section creator1" id="section0">
      <div class="container">
      <div class="bg_fff text-center"><h2><b><?php echo WEBSITE_NAME;?></b></h2>
      
      <p><b>We've encountered an error with the account you were trying to link.</b></p>
      <div class="row form-group">
      	<ul class="text-red text-danger"><li>You must have at least 1 <?php echo $this->session->userdata('registration_error');?> Fan Page with over 5000 likes.</li></ul>
      </div>
       
      <p>Please <a href="<?php echo site_url('user/register/creator');?>" rel="nofollow" target="_self" class="font-bold">go back</a> and choose a different account.</p>
      <p>If you feel that you have seen this message in error, please contact support at <a href="mailto:<?php echo CONTACT_EMAIL?>"><?php echo CONTACT_EMAIL?></a></p>

      <p class="btm">&copy; 2016 popler, LLC.</p>
      </div>
    </div>
    </section>  
    <?php 

  }
  else{
    ?>
<section class="section creator1" id="section0">
      <div class="container">
      <div class="bg_fff text-center"><h2><b><?php echo WEBSITE_NAME;?></b></h2>
      
      <p><b>You have successfully registered to our system</b></p>
      <div class="row form-group">
        <ul class="text-red text-danger"><li>You must verify to get access to the system.Please look at the email we have send.</li></ul>
      </div>
       
      <p>Please <a href="<?php echo site_url('user/register/creator');?>" rel="nofollow" target="_self" class="font-bold">go back</a> and choose a different account.</p>
      <p>If you feel that you have seen this message in error, please contact support at <a href="mailto:<?php echo CONTACT_EMAIL?>"><?php echo CONTACT_EMAIL?></a></p>

      <p class="btm">&copy; 2016 popler, LLC.</p>
      </div>
    </div>
    </section>  
    <?php
  }

  ?>