<?php 


$first_name='';
$last_name='';
$mobile='';
$email='';
$password='';
$dob='';
$address='';
$blood_group='';
$join_date='';
$monthly_charge='';
$identification_office='';
$identification_no='';
$identificationdoc='';
$user_type='3';
$username='';
$user_id='';
$status='';
if($staff)
{
  $user_id=$staff->user_id;
	$first_name=$staff->first_name;
	$last_name=$staff->last_name;
	$mobile=$staff->mobile;
	$email=$staff->email;
	$username=$staff->username;
	$password='';
	$retype_password='';
	$gender=$staff->gender;
	$dob=$staff->dob;
	$address=$staff->paddress;
	$blood_group=$staff->blood_group;
	$type=$this->input->post('type');
	$join_date=$staff->join_date;
	$monthly_charge=$staff->monthly_charge;
	$identification_no=$staff->identification_no;
	$identification_office=$staff->identification_office;
	$identificationdoc=$staff->identification_doc;
	$user_type=$staff->user_type;
  $status=$staff->status;
}
if($this->input->post())
{
	$first_name=$this->input->post('first_name');
	$last_name=$this->input->post('last_name');
	$mobile=$this->input->post('mobile');
	$email=$this->input->post('email');
	$username=$this->input->post('username');
	$password=$this->input->post('password');
	$retype_password=$this->input->post('retype_password');
	$gender=$this->input->post('gender');
	$dob=$this->input->post('dob');
	$address=$this->input->post('address');
	$blood_group=$this->input->post('blood_group');
	$type=$this->input->post('type');
	$join_date=$this->input->post('join_date');
	$monthly_charge=$this->input->post('monthly_charge');
	$user_type=$this->input->post('user_type');
	$identification_no=$this->input->post('identification_no');
	$identification_office=$this->input->post('identification_office');	
  $status=$this->input->post('status');
}
if($action_type=='view'):
  ?>
  <style type="text/css">
  .form-control{
   outline: 0;
  border-width: 0 0 2px;
  border-color: blue
  }
  </style>
  <script type="text/javascript">
    $('.form-control').attr('readonly',true);
       $('.form-control').attr('disabled',true);
  </script>
<?php 
endif;
?>


   <form class="" method="post" enctype="multipart/form-data" id="addstaffform">
        <div class="lite_gre_bg">
		            <h4 class="m-0 p-20"><b><?php echo ucfirst($action_type)?> Staff</b></h4>
		           <div class="bg-white p-20">
		          
			          <div class="row mb-15">
                <?php if($action_type=='edit'):?>
                   <input type="hidden" class="form-control no-radius"  name="user_id" id="parentid" value="<?php echo $user_id;?>">
                  <?php
                  endif;
                  ?>
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
	          <!-- <div class="row">
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
	          </div> -->
          <div class="row">
            <div class="col-xs-6 mb-15">
              <label>Email ID</label>
              <input type="text" name="email" class="form-control no-radius" placeholder="Email ID" value="<?php echo $email?>">
              <?php echo form_error('email'); ?> 
            </div>
            <div class="col-xs-6 mb-15">
              <label>Username</label>
              <input type="text" name="username" class="form-control no-radius" placeholder="Username" value="<?php echo $username?>">
              <?php echo form_error('username'); ?> 
            </div>
            </div>
           <div class="row">
            <div class="clearfix"></div>
            <div class="col-xs-6  mb-15">
              <label>Password</label>
              <input type="password" id="password" name="password" class="form-control no-radius" placeholder="Password" value="">
              <?php echo form_error('password'); ?> 
              </div>
            <div class="col-xs-6 mb-15">
              <label>Repeat Password</label>
              <input type="password" name="retype_password" class="form-control no-radius" placeholder="Repeat Password" value="">
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
              <input type="text" name="identification_office" class="form-control no-radius" placeholder="Provided office" value="<?php echo $identification_office;?>">
              <?php echo form_error('identification_office'); ?>
             </div>
          </div>
           <div class="row">
            <div class="clearfix"></div>
             <?php 
             	if($action_type=='edit' &&  $identificationdoc!=''):
             ?>
           	 <div class="col-xs-3  mb-15">
              <label>Citizenship</label>
              <input type="file" name="identification_doc" class="form-control no-radius" placeholder="Identification " >
              <?php echo form_error('identification_doc'); ?> 
              </div>
               <div class="col-xs-3  mb-15">
              <label>Uploaded Document</label>
              	<?php if($identificationdoc)
              	{ ?>
              	<a class="btn btn-pink" data-src="<?php echo site_url(IDENTIFICATION_ATTACHMENT.$user_id.'/'.$identificationdoc);?>" id="myImg">View</a>

              	<?php
              	}
              	?>
              </div>
             <?php 
             elseif ($action_type=='view'):
               if(!$identificationdoc)
                {
                echo ' <div class="col-xs-6  mb-15">No document uploaded</div>'; 
                }
                else{
                  ?>
           <div class="col-xs-6  mb-15">
            <a class="btn btn-pink" data-src="<?php echo site_url(IDENTIFICATION_ATTACHMENT.$user_id.'/'.$identificationdoc)?>" id="myImg">View</a>
           </div>
                  <?php
                }
             ?>  

             <?php
             else:
             ?>
        	 <div class="col-xs-6  mb-15">
              <label>Citizenship</label>
              <input type="file" id="password" name="identification_doc" class="form-control no-radius" placeholder="Identification " >
              <?php echo form_error('identification_doc'); ?> 
              </div>	
     		<?php
             endif;
             ?>
            <div class="col-xs-6 mb-15">
              <label>Mobile No.</label>
              <input type="text" name="mobile" class="form-control no-radius" placeholder="Mobile" value="<?php echo $mobile?>">
              <?php echo form_error('mobile'); ?> 
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
              <input type="text" name="address" class="form-control no-radius" placeholder="Permanent Address "  value="<?php echo $address;?>">
              <?php echo form_error('address'); ?> </div>
            <div class="col-xs-6  mb-15">
              <label>Blood Group</label>
              <span class="drop fa p-relative">
              <select name="blood_group" class="form-control no-radius "  >
                <option  value="">Select</option>
                <option <?php if($blood_group=='A+') echo 'selected';?>  value="A+">A+</option>
                <option <?php if($blood_group=='B+') echo 'selected';?> value="B+">B+</option>
                <option <?php if($blood_group=='AB+') echo 'selected';?> value="AB+">AB+</option>
                <option <?php if($blood_group=='O+') echo 'selected';?> value="O+">O+</option>
                <option <?php if($blood_group=='A-') echo 'selected';?> value="A-">A-</option>
                <option <?php if($blood_group=='B-') echo 'selected';?> value="B-">B-</option>
                <option <?php if($blood_group=='AB-') echo 'selected';?> value="AB-">AB-</option>
                <option <?php if($blood_group=='O-') echo 'selected';?> value="O-">O-</option>
                
              </select>
              </span> <?php echo form_error('blood_group'); ?>
             </div>
          </div>
          <div class="row">
	         	<div class="col-xs-6 mb-15">
	              <label>Monthly Salary</label>
	              <input type="text" name="monthly_charge" class="form-control no-radius" placeholder="Monthly Salary"  value="<?php echo $monthly_charge	;?>">
	              <?php echo form_error('monthly_charge'); ?> 
	            </div>
	           	<div class="col-xs-6 mb-15">
               <label>User Type</label>
	           		 <select name="user_type" class="form-control no-radius "  >
               			<option  value="">Select</option>
		                <option <?php if($user_type=='2') echo 'selected';?>  value="2">Second Admin</option>
		                <option <?php if($user_type=='3') echo 'selected';?> value="3">Warden</option>
		                <option <?php if($user_type=='5') echo 'selected';?> value="5">Cook</option>
		                <option <?php if($user_type=='6') echo 'selected';?> value="6">Helper</option>
		                <option <?php if($user_type=='7') echo 'selected';?> value="7">Others</option>            
                 </select>
	           	</div>
         </div>
            <div class="row">
             <div class="col-xs-6 mb-15">
               <label>Date of Join</label>
              <div class="date p-relative">
                <div class="input-group date">
                  <input class="form-control no-radius" id="joindate" name="join_date" placeholder="YYYY/MM/DD" type="text" value="<?php echo $join_date;?>">
                  <div class="input-group-addon no-radius no-bg"><i class="fa fa-calendar"></i></div></div>
                  <?php echo form_error('join_date'); ?>
              </div>
           
            </div>
              <div class="col-xs-6 mb-15">
               <label>Status</label>
                 <select name="status" class="form-control no-radius "  >
                    <option  value="">Select</option>
                    <option <?php if($status=='1') echo 'selected';?>  value="1">Active</option>
                    <option <?php if($status=='2') echo 'selected';?> value="2">Inactive</option>
                    <option <?php if($status=='3') echo 'selected';?> value="3">Suspend</option>
                    <option <?php if($status=='4') echo 'selected';?> value="4">Delete</option>
                    
                 </select>
           
            </div>
            </div>
        <!--   <div class="row">
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
            
          </div> -->
          <?php 
          if($action_type!='view'):

          ?>
          <button  data-type="<?php echo $action_type;?>" type="submit" id="<?php echo $action_type;?>staffbtn" class="btn btn-pink btn-block mt-25">Save</button>
          <div class="text-right fc-pink">
            	
          </div>
        <?php endif;?>
          </div>
        </div>
      </form>

    <div class="clearfix"></div>

<script>
    var urlCheckDuplicateEmail = '<?php echo site_url("user/register/check_email_availability");?>';
    var urlCheckDuplicateUsername = '<?php echo site_url("user/register/check_username_availability");?>';
    $(document).ready(function()
    {
          $('.input-group').datepicker
          ({
               format: 'yyyy/mm/dd', 
               todayHighlight: true,
               autoclose: true,
               endDate:new Date()
          })
    });

</script> 


<div id="imgmodal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="imagebody">
  <div id="caption"></div>
</div>