<?php 
$display_name=$this->input->post('display_name');
$first_name=$this->input->post('first_name');
$last_name=$this->input->post('last_name');
$nric=$this->input->post('nric');
$email=$this->input->post('email');
$username=$this->input->post('username');
$password=$this->input->post('password');
$retype_password=$this->input->post('retype_password');
$gender=$this->input->post('gender');
$country=$this->input->post('country');
$dob=$this->input->post('dob');
$address1=$this->input->post('address1');
$address2=$this->input->post('address2');
$dealer=$this->input->post('dealer');
$outlet=$this->input->post('outlet');
$type=$this->input->post('type');
$postal_code=$this->input->post('postal_code');
$contact_no=$this->input->post('contact_no');

?>
<div class="container">
<div class="login-page red_bg">
  <div class="col-sm-4 col-md-3 p-0 pl-20"><h2 class="h1 mb-0 fc-white">Register as</h2><p class="fc-white fs-6">Staff</p></div>
  <div class="col-sm-8 col-md-9 p-0">
    <form name="staff_register" id="staffregnform" method="post">
    <div class="bg-white p-30"><h3 class="logo mt-0 mb-30">Sign Up <img src="<?php echo site_url(USER_IMG_DIR)?>/logo_w.png" alt="LG" width="80" class="pull-right"></h3>
            <div class="row">
                 <div class="col-xs-6"><label>Name on Card</label>
                        <input type="text" class="form-control mb-15 no-radius" placeholder="Name" name="display_name" value="<?php echo $display_name;?>">
                       <?php echo form_error('display_name'); ?>
                </div>
               <div class="col-xs-6"><label>Given Name</label>
                       <input type="text" class="form-control mb-15 no-radius" name="first_name" placeholder="Given Name" value="<?php echo $first_name;?>">
                          <?php echo form_error('first_name'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6"><label>Family Name</label>
                        <input type="text" class="form-control mb-15 no-radius" placeholder="Name" name="last_name" value="<?php echo $last_name;?>">
                        <?php echo form_error('last_name'); ?>
                </div>
                <div class="col-xs-6"><label>NRIC</label>
                        <input type="text" class="form-control mb-15 no-radius" placeholder="NRIC" name="nric" value="<?php echo $nric ?>">
                        <?php echo form_error('nric'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6"><label>Email ID</label>
                    <input type="text" name="email" class="form-control mb-15 no-radius" placeholder="Email ID" value="<?php echo $email?>">
                    <?php echo form_error('email'); ?>
                </div>
             <div class="col-xs-6"><label>Username</label>
                <input type="text"  name="username" class="form-control mb-15 no-radius" placeholder="Username  " value="<?php echo $username ?>">
                <?php echo form_error('username'); ?>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-6 col-sm-6 col-md-4"><label>Password</label>
                <input type="password" id="password" name="password" class="form-control mb-15 no-radius" placeholder="Password" value="<?php echo $password;?>">
                <?php echo form_error('password'); ?>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4"><label>Repeat Password</label>
                <input type="password" name="retype_password" class="form-control mb-15 no-radius" placeholder="Repeat Password" value="<?php echo $retype_password ?>">
                <?php echo form_error('retype_password'); ?>
            </div>
            </div>
            <div class="row">
                    <div class="col-xs-4 mb-15"><label>Gender</label><span class="drop fa p-relative">
                        <select name="gender" class="form-control no-radius">
                            <option value="">Select</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="O">Other</option>
                        </select>
                        </span>
                        <?php echo form_error('gender'); ?>
                    </div>
                    <div class="col-xs-4 mb-15"><label>Country</label><span class="drop fa p-relative">
                         <select name="country" class="form-control no-radius">
                            <option value=""> Select</option>
                            <?php 

                            foreach($countrylist as $countrydata):?>
                                    <option value="<?php echo $countrydata->country;?>"><?php echo $countrydata->country;?></option>
                            <?php endforeach;?>
                         </select>
                         </span>
                         <?php echo form_error('country'); ?>
                    </div>
                    <div class="col-xs-4 mb-15"><label>Date of Birth</label><div class="date p-relative">
                        <div class="input-group">
                            <input class="form-control no-radius" id="date" name="dob" placeholder="MM/DD/YYYY" type="text" value="<?php echo $dob;?>">
                            <div class="input-group-addon no-radius no-bg"><i class="fa fa-calendar"></i></div>
                            <?php echo form_error('dob'); ?>
                        </div></div>
                    </div>
            </div>
            <div class="row">
                <div class="col-xs-6"><label>Address 1</label>
                    <input type="text" name="address1" class="form-control mb-15 no-radius" placeholder="Address 1"  value="<?php echo $address1;?>">
                    <?php echo form_error('address1'); ?>
                </div>
                <div class="col-xs-6"><label>Address 2</label>
                <input type="text" name="address2" class="form-control mb-15 no-radius" placeholder="Address 2" value="<?php echo $address2;?>">
                 <?php echo form_error('address2'); ?>
                </div>
            </div> 
            <div class="row">
                <div class="col-xs-4"><label>Dealer</label><span class="drop fa p-relative">
                    <select name="dealer" class="form-control mb-15 no-radius chainselectmaster" data-childelement="#regnoutlet" data-url="<?php echo site_url('/'.MY_ACCOUNT.'get_outlet_by_dealer/')?>" >
                        <option  value="">Select</option>
                        <?php foreach($dealerlist as $perdealer):?>
                                <option value="<?php echo $perdealer->id;?>" <?php if($perdealer->id==$dealer) echo 'selected';?>><?php echo $perdealer->name;?></option>
                        <?php endforeach;?>
                    </select></span>
                      <?php echo form_error('dealer'); ?>
                </div>
                <div class="col-xs-4"><label>Outlet</label><span class="drop fa p-relative">
                    <select id="regnoutlet" name="outlet" class="form-control mb-15 no-radius chaininputmaster" data-url="<?php echo site_url('/'.MY_ACCOUNT.'get_type_by_outlet/')?>" data-childelement="#regntype">
                    <option  value="">Select</option>
                    </select>
                    </span>
                    <?php echo form_error('outlet'); ?>
                </div>
                <div class="col-xs-4"><label>Type</label><span class="drop fa p-relative">
                     <input type="text" readonly id="regntype" name="type" class="form-control mb-15 no-radius" placeholder="Type" value="<?php echo $type;?>">
                    <?php echo form_error('type'); ?>
                </div>
            </div>
            <div class="row">
                    <div class="col-xs-4"><label>Postal Code</label>
                        <input type="text" name="postal_code"  class="form-control mb-15 no-radius" placeholder="Postal Code"value="<?php echo $postal_code?>" >
                        <?php echo form_error('postal_code'); ?>
                    </div>
                    <div class="col-xs-4"><label>Contact No</label>
                        <input type="text" name="contact_no" class="form-control mb-15 no-radius" placeholder="Contact No" value="<?php echo $contact_no ?>">
                        <?php echo form_error('contact_no'); ?>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" id="staffregbtn" class="btn btn-pink btn-block mt-25">Sign up</button>
                    </div> 
            </div>
            <div class="text-right fc-pink"><p class="mb-0">Get approve by Dealer HQ admin*</p></div>
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
        var date_input=$('input[name="dob"]'); //our date input has the name "date"
        var container=".date";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    });

</script>
