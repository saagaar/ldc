<?php 
$faculty=$this->input->post('faculty');
$first_name=$this->input->post('first_name');
$last_name=$this->input->post('last_name');
$college_name=$this->input->post('college_name');
$father_name=$this->input->post('father_name');
$mother_name=$this->input->post('mother_name');
$last_name=$this->input->post('last_name');
$mobile=$this->input->post('mobile');
$email=$this->input->post('email');
$username=$this->input->post('username');
$password=$this->input->post('password');
$retype_password=$this->input->post('retype_password');
$gender=$this->input->post('gender');
$country=$this->input->post('country');
$dob=$this->input->post('dob');
$address1=$this->input->post('address');
$address2=$this->input->post('address2');
$dealer=$this->input->post('dealer');
$outlet=$this->input->post('outlet');
$type=$this->input->post('type');
$postal_code=$this->input->post('postal_code');
$contact_no=$this->input->post('contact_no');
$identification_no=$this->input->post('identification_no');

?>

<div class="container">
  <div class="login-page red_bg">
    <div class="col-sm-4 col-md-3 p-0 pl-20">
      <h2 class="h1 mb-0 fc-white">Register as</h2>
      <p class="fc-white fs-6">Student</p>
    </div>
    <div class="col-sm-8 col-md-9 p-0">
      <form name="staff_register" id="staffregnform" method="post">
        <div class="bg-white p-30">
          <h3 class="logo mt-0 mb-30">Sign Up <img src="<?php echo site_url(USER_IMG_DIR)?>/logo_w.png" alt="LG" width="80" class="pull-right"></h3>
          <div class="row">
           
            <div class="col-xs-6 mb-15">
              <label>First Name</label>
              <input type="text" class="form-control no-radius" name="first_name" placeholder="Given Name" value="<?php echo $first_name;?>">
              <?php echo form_error('first_name'); ?> 
            </div>
            <div class="col-xs-6 mb-15">
              <label>Last Name</label>
              <input type="text" class="form-control no-radius" placeholder="Name" name="last_name" value="<?php echo $last_name;?>">
              <?php echo form_error('last_name'); ?> 
             </div>
          </div>
          <div class="row">
            <div class="col-xs-6 mb-15">
              <label>College Name</label>
              <input type="text" class="form-control no-radius" placeholder="Name" name="college_name" value="<?php echo $college_name;?>">
              <?php echo form_error('college_name'); ?>
              </div> 
          
            <div class="col-xs-6 mb-15">
              <label>Level/Faculty</label>
              <input type="text" class="form-control no-radius" placeholder="Faculty" name="faculty" value="<?php echo $faculty ?>">
              <?php echo form_error('faculty'); ?> 
              </div>
          </div>
          <div class="row">
            <div class="col-xs-6 mb-15">
              <label>Father Name</label>
              <input type="text" class="form-control no-radius" placeholder="Father Name" name="father_name" value="<?php echo $father_name;?>">
              <?php echo form_error('father_name'); ?>
              </div> 
          
            <div class="col-xs-6 mb-15">
              <label>Mother Name</label>
              <input type="text" class="form-control no-radius" placeholder="Mother Name" name="mother_name" value="<?php echo $mother_name ?>">
              <?php echo form_error('mother_name'); ?> 
              </div>
          </div>
          <div class="row">
            <div class="col-xs-6 mb-15">
              <label>Email ID</label>
              <input type="text" name="email" class="form-control no-radius" placeholder="Email ID" value="<?php echo $email?>">
              <?php echo form_error('email'); ?> 
            </div>
            <div class="col-xs-6 mb-15">
              <label>Mobile No.</label>
              <input type="text" name="mobile" class="form-control no-radius" placeholder="Mobile" value="<?php echo $mobile?>">
              <?php echo form_error('mobile'); ?> 
            </div>
            </div>
           <div class="row">
            <div class="clearfix"></div>
            <div class="col-xs-6  mb-15">
              <label>Password</label>
              <input type="password" id="password" name="password" class="form-control no-radius" placeholder="Password" value="<?php echo $password;?>">
              <?php echo form_error('password'); ?> 
              </div>
            <div class="col-xs-6 mb-15">
              <label>Repeat Password</label>
              <input type="password" name="retype_password" class="form-control no-radius" placeholder="Repeat Password" value="<?php echo $retype_password ?>">
              <?php echo form_error('retype_password'); ?>
             </div>
          </div>
          <div class="row">
            <div class="clearfix"></div>
            <div class="col-xs-6  mb-15">
              <label>Citizenship no</label>
              <input type="text" id="password" name="identification_no" class="form-control no-radius" placeholder="Citizenship no" value="<?php echo $identification_no;?>">
              <?php echo form_error('identification_no'); ?> 
              </div>
            <div class="col-xs-6 mb-15">
              <label>Citizenship Provided by</label>
              <input type="text" name="identification_office" class="form-control no-radius" placeholder="Provided office" value="">
              <?php echo form_error('identification_office'); ?>
             </div>
          </div>

          <div class="row">
            <div class="col-xs-6 mb-15">
              <label>Gender</label>
              <span class="drop fa p-relative">
              <select name="gender" class="form-control no-radius">
                <option value="">Select</option>
                <option selected value="M">Male</option>
                <option value="F">Female</option>
              </select>
              </span> <?php echo form_error('gender'); ?> </div>
          <!--   <div class="col-xs-4 mb-15">
              <label>Country</label>
              <span class="drop fa p-relative">
              <select name="country" class="form-control no-radius">
                <option value=""> Select</option>
                <?php 

                            foreach($countrylist as $countrydata):?>
                <option value="<?php echo $countrydata->country;?>"><?php echo $countrydata->country;?></option>
                <?php endforeach;?>
              </select>
              </span> <?php echo form_error('country'); ?> </div> -->
            <div class="col-xs-6 mb-15">
              <label>Date of Birth</label>
              <div class="date p-relative">
                <div class="input-group date">
                  <input class="form-control no-radius" id="date" name="dob" placeholder="YYYY/MM/DD" type="text" value="<?php echo $dob;?>">
                  <div class="input-group-addon no-radius no-bg"><i class="fa fa-calendar"></i></div></div>
                  <?php echo form_error('dob'); ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 mb-15">
              <label>Permanent Address</label>
              <input type="text" name="address" class="form-control no-radius" placeholder="Address 1"  value="<?php echo $address1;?>">
              <?php echo form_error('address'); ?> </div>
            <div class="col-xs-6  mb-15">
              <label>Blood Group</label>
              <span class="drop fa p-relative">
              <select name="blood_group" class="form-control no-radius "  >
                <option  value="">Select</option>
                <option  value="A+">A+</option>
                <option  value="B+">B+</option>
                <option  value="AB+">AB+</option>
                <option  value="O+">O+</option>
                <option  value="A-">A-</option>
                <option  value="B-">B-</option>
                <option  value="AB-">AB-</option>
                <option  value="O-">O-</option>
                
              </select>
              </span> <?php echo form_error('blood_group'); ?>
             </div>
          </div>
         
          <div class="row">
            <div class="col-xs-4 mb-15">
              <label>Local Guardian</label>
              <input type="text" name="local_guardian"  class="form-control no-radius" placeholder="Local Guardian name/address " value="" >
              <?php echo form_error('local_guardian'); ?> </div>
            <div class="col-xs-4 mb-15">
              <label>Contact No</label>
              <input type="text" name="contact_no" class="form-control no-radius" placeholder="Contact No" value="<?php echo $contact_no ?>">
              <?php echo form_error('contact_no'); ?> </div>
            <div class="col-xs-4">
              <label>Relation</label>
              <input type="text" name="relation" class="form-control no-radius" placeholder="Relation with local guardian" value="">
              <?php echo form_error('relation'); ?> </div>
            </div>
             <div class="row">
            <div class="col-xs-6 mb-15">
              <label>Has serious medical issues?</label>
              <input type="radio" name="medical_issue"   value="Yes" >Yes
               <input type="radio" name="medical_issue"   value="No" >No
              <?php echo form_error('medical_issue'); ?> 
            </div>
            <div class="col-xs-6 mb-15">
              <label>Mention if any?</label>
              <input type="text" name="condition" class="form-control no-radius" placeholder="Mention if any" value="">
              <?php echo form_error('condition'); ?> </div>
           
            </div>
             <div class="row">
              <label>Source?</label>
                <input type="checkbox" name="source[]" value="website">Website
                <input type="checkbox" name="source[]" value="Facebook">Facebook
                <input type="checkbox" name="source[]" value="G oogle/Google map">Google/Google Map
                <input type="checkbox" name="source[]" value="Friends">Friends
                <input type="checkbox" name="source[]" value="Advertisment">Advertisment
                <input type="checkbox" name="source[]" value="Hoarding Board/brochure">Hoarding Board/brochure
                <input type="checkbox" name="source[]" value="others">Others 
            
          </div>
          <button type="submit" id="staffregbtn" class="btn btn-pink btn-block mt-25">Sign up</button>
          <div class="text-right fc-pink">
            <p class="mb-0">Get approve by Dealer HQ admin*</p>
          </div>
        </div>
      </form>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<script>
    var urlCheckDuplicateEmail = '<?php echo site_url("user/register/check_email_availability");?>';
    var urlCheckDuplicateUsername = '<?php echo site_url("user/register/check_username_availability");?>';

///// For Date Picker )///
    $(document).ready(function(){
        // var date_input=$('input[name="dob"]'); //our date input has the name "date"
        // var container=".date";
        // date_input.datepicker({
        //     format: 'yyyy/mm/dd',
        //     container: container,
        //     todayHighlight: true,
        //     autoclose: true,
        //      showDropdowns: true,

     
        // })
          $('.input-group').datepicker({
               format: 'yyyy/mm/dd',
           
            todayHighlight: true,
            autoclose: true,
             endDate:new Date()
        })
    });

</script> 
