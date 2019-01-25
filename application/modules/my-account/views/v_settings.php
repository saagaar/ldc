<?php 

  $name=$userdetail['name'];
$tempname=explode(' ',$name);
$first_name=$tempname['0'];
if(isset($tempname['1']))
$last_name=$tempname['1'];
else $last_name='';
$company_name=$userdetail['company_name'];
$company_website=$userdetail['company_website'];
$phone=$userdetail['company_phone'];
$email=$userdetail['email'];  
$company_add1=$userdetail['company_address1'];
$company_add2=$userdetail['company_address2'];
$city=$userdetail['company_city'];
$state=$userdetail['company_state'];
$zip=$userdetail['company_zipcode'];
$country=$userdetail['company_country'];
 $menu=$this->input->post('formtype');

?>
<div class="mid-part margin_0">      
<div role="tabpanel" class="col-xs-12">
          <div class="row">
            <div class="col-xs-3"> <!-- required for floating --> 
              <!-- Nav tabs -->
              <ul class="list-unstyled msz_menu">
                <li class="active"><a href="#form1" data-toggle="tab"><span>General &nbsp; <?php if(validation_errors() && ($menu=='generalsettings')){ ?><i class="fa fa-exclamation-triangle text-danger"></i><?php } ?><i class="fa fa-exclamation-triangle hidden generalsettings  text-danger"></i></span></a></li>
                <li><a href="#form2" data-toggle="tab"><span>Address &nbsp; <?php if(validation_errors() && ($menu=='address')){ ?><i class="fa fa-exclamation-triangle text-danger"></i><?php } ?><i class="fa fa-exclamation-triangle hidden address text-danger"></i></span></a></li>
                <li><a href="#form3" data-toggle="tab"><span>Notification&nbsp; <?php if(validation_errors() && $menu=='notification'){ ?><i class="fa fa-exclamation-triangle text-danger"></i><?php } ?><i class="fa fa-exclamation-triangle hidden notification text-danger"></i></span></a></li>
                <li><a href="#form4" data-toggle="tab"><span>Change Password&nbsp; <?php if(validation_errors() && $menu=='changepassword'){ ?><i class="fa fa-exclamation-triangle text-danger"></i><?php } ?><i class="fa fa-exclamation-triangle hidden changepassword text-danger"></i></span></a></li>
                <li><a href="#form5" data-toggle="tab"><span>Points &amp; Referrals&nbsp; <?php if(validation_errors() && $menu=='referrals'){ ?><i class="fa fa-exclamation-triangle text-danger"></i><?php } ?><i class="fa fa-exclamation-triangle hidden referrals text-danger"></i></span></a></li>
                <li><a href="#form6" data-toggle="tab"><span>Hire History&nbsp; <?php if(validation_errors() && $menu=='hirehistory'){ ?><i class="fa fa-exclamation-triangle text-danger"></i><?php } ?><i class="fa fa-exclamation-triangle hidden hirehistory text-danger"></i></span></a></li>
              </ul>
            </div>
            <div class="col-xs-9 msz_sec">
              <div class="tab-content messages">
                
                <div class="tab-pane fade in active" id="form1">
                 <form method="post" id="generalsettingform" action="<?php echo site_url('/'.MY_ACCOUNT.'settings')?>" class="advance_search col-xs-12 col-sm-10 col-md-9">
                 <div class="form">
                      <input type="hidden" name="formtype" value="generalsettings">
                      <div class="form-group">
                         <label class="help-block">Company</label>
                         <input type="text" name="company_name" placeholder="company name" i class="form-control" value="<?php echo  $company_name; ?>">
                         <?php echo form_error('company_name'); ?>
                      </div>
                      <div class="form-group">
                          <label class="help-block">Company Website</label>
                             <input type="text" name="company_website" placeholder="Enter website" class="form-control" value="<?php echo $company_website; ?>">
                             <?php echo form_error('company_website'); ?>
                        </div>
                      <div class="form-group"><label class="help-block">First Name</label>
                            <input type="text" name="first_name" placeholder="Subject" class="form-control"  value="<?php echo $first_name ?>">
                            <?php echo form_error('first_name'); ?>
                      </div>
                      <div class="form-group"><label class="help-block">Last Name</label>
                        <input type="text" name="last_name" placeholder="Last Name" class="form-control"  value="<?php echo $last_name;?>">
                         <?php echo form_error('last_name'); ?>
                      </div>
                      <div class="form-group"><label class="help-block">Phone</label>
                          <input type="text" name="phone" placeholder="phone" class="form-control"  value="<?php echo $phone;?>">
                           <?php echo form_error('phone'); ?>
                      </div>
                      <div class="form-group"><label class="help-block">Email</label>
                          <input type="text" name="email" placeholder="Email" class="form-control"  value="<?php echo $email;?>">
                           <?php echo form_error('email'); ?>
                      </div>
                      <h5 style="margin:20px 0;">Note: Changing this email address will change your login email! </h5>
                        <div class="form-group">
                          <div class="error-message" style="display:none;color:red"></div>
                          <button class="btn btn-info" type="submit" id="generalsettingbtn">
                                       <div class="btn-img" style="float:left">
                                          <div class="img-loader" style="z-index:1000;display: none">
                                                  <img src="<?php echo site_url('/'.USER_IMG_DIR.'ajax_loader.gif');?>">
                                          </div>
                                         <i class="fa fa-save createcheck"></i> 
                                      </div>
                                      Save
                          </button>
                        </div>
                
                  <div class="clearfix"></div>
                  </div>
                   </form>
                </div>
                 
                <div class="tab-pane fade in" id="form2">
                  <form method="post" id="addressform" class="advance_search col-xs-12 col-sm-10 col-md-9" action="<?php echo site_url('/'.MY_ACCOUNT.'settings')?>">
                  <input type="hidden" name="formtype" value="address">
                   
                  <div class="form-group row"><label class="help-block col-xs-12">Street</label>
                  <div class="col-xs-6">
                          <input type="text" name="company_address1" placeholder="Street 1" class="form-control" value="<?php echo trim($company_add1);?>
                          "> <?php echo form_error('company_address1'); ?>
                  </div>
                  <div class="col-xs-6">
                      <input type="text" name="company_address2" placeholder="Street 2" class="form-control" value="<?php echo trim($company_add2);?>">
                      <?php echo form_error('company_address2'); ?>
                  </div>
                  </div>
                  <div class="form-group"><label class="help-block">City</label>
                        <input type="text" name="company_city" placeholder="City" class="form-control" value="<?php echo $city;?>">
                           <?php echo form_error('company_city'); ?>
                  </div>
                  <div class="form-group"><label class="help-block">State/Province</label>
                      <input type="text" name="company_state" placeholder="State" class="form-control"  value="<?php echo $state; ?>">
                         <?php echo form_error('company_state'); ?>
                  </div>
                  <div class="form-group"><label class="help-block">ZIP/Postal Code</label>
                      <input type="text" name="company_zipcode" placeholder="Zip code" class="form-control" value="<?php echo $zip;?>">
                         <?php echo form_error('company_zipcode'); ?>
                  </div>
                  <div class="form-group"><label class="help-block">Country</label>
                      <select class="form-control" name="company_country">
                      <option value="">----select------</option>
                        <?php foreach($allcountry as $value){
                            ?>
                            <option value="<?php echo $value->id;?>" <?php if($country==$value->id) echo 'selected="selected"'?>><?php echo $value->country;?></option>
                          <?php }?>
                      </select>
                         <?php echo form_error('company_country'); ?>
                  </div>
                      <div class="form-group">
                          <div class="error-message" style="display:none;color:red"></div>
                          <button class="btn btn-info" type="submit" id="addressbtn">
                                       <div class="btn-img" style="float:left">
                                          <div class="img-loader" style="z-index:1000;display: none">
                                                  <img src="<?php echo site_url('/'.USER_IMG_DIR.'ajax_loader.gif');?>">
                                          </div>
                                         <i class="fa fa-save createcheck"></i> 
                                      </div>
                                      Save
                          </button>
                        </div>
                  </form>
                  <div class="clearfix"></div>
                </div>
                <div class="tab-pane fade in" id="form3">
                  <form method="post" class="advance_search col-xs-12 col-sm-10 col-md-9">
          <label>Delivery Frequency:</label>
                    <div class="form-group">
                    <div class="radio">
  <label>
    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1"><strong>Never <br></strong>  No notification alerts are sent out. Notifications remain visible on the platform.
  </label>
</div>
          <div class="radio">
  <label>
    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1"><strong>Never <br></strong>  No notification alerts are sent out. Notifications remain visible on the platform.
  </label>
</div>
          <div class="radio">
  <label>
    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1"><strong>Never <br></strong>  No notification alerts are sent out. Notifications remain visible on the platform.
  </label>
</div>
                  <div class="form-group">
                      <button class="btn btn-info" type="reset"><i class="fa fa-save"></i> Save</button></div>
                    </div>
                  </form>
                  <div class="clearfix"></div>
                </div>
                <div class="tab-pane fade in" id="form4">
                   <div class="" id="passwordchangeerror" style="display:none;color:red">
                     
                  <div class="alert alert-danger error-message">
                    
                  </div>
                   </div>
                   
                  <form method="post" action="<?php echo site_url('/'.MY_ACCOUNT.'settings')?>" id="changepasswordform"  class="advance_search col-xs-12 col-sm-10 col-md-9">
                  <h5 class="text-center" style="margin:20px 0;">Change your password by entering your old and new password below.</h5>
                    <input type="hidden" name="formtype" value="changepassword">
                    
                  <div class="form-group"><label class="help-block">Current Password</label>
                        <input type="password"  name="password"  class="form-control">
                         <?php echo form_error('password'); ?>
                  </div>
                  <div class="form-group"><label class="help-block">New Password</label>
                        <input type="password" id="new_password" name="new_password" class="form-control">
                         <?php echo form_error('new_password'); ?>
                  </div>
                  <div class="form-group"><label class="help-block">Confirm  Password</label>
                           <input type="password" name="re_new_password" class="form-control">
                            <?php echo form_error('re_new_password'); ?>
                  </div>
                   <div class="form-group">
                         <button class="btn btn-info" type="submit" id="changepasswordbtn">
                                       <div class="btn-img" style="float:left">
                                          <div class="img-loader" style="z-index:1000;display: none">
                                                  <img src="<?php echo site_url('/'.USER_IMG_DIR.'ajax_loader.gif');?>">
                                          </div>
                                         <i class="fa fa-save createcheck"></i> 
                                      </div>
                                      Save
                          </button>
                     </div>
                  </form>
                  <div class="clearfix"></div>
                </div>


                <div class="tab-pane fade in" id="form5">
                <div class="btn-info btn-block text-center"><h3>Earn Up to 100 FameBit Bucks For Every Brand Referral</h3>
                <p>Share your referral link with brands to receive FameBit Bucks for your campaigns. Once a referred brand spends $100 or more, 
                you'll start earning your Bucks!</p>
                <h5 class="btn-success"><span>$100 = 10 Bucks</span> | <span>$250 = 25 Bucks</span> | <span>$500 = 50 Bucks</span> | <span>$1,000 = 100 Bucks</span></h5>
                </div>
                  <form method="post" class="advance_search col-xs-12 col-sm-10 col-md-9">
                  <h5>&nbsp;</h5>
                  <div class="col-xs-4"><label class="help-block">https://famebit.com/b/</label></div>
                  <div class="col-xs-6"><input type="password" class="form-control"> </div>
                  <div class="col-xs-2"><button class="btn btn-info" type="reset"><i class="fa fa-copy"></i> Copy Link</button></div>
                  </form>
                  <div class="clearfix"></div>
                </div>
                <div class="tab-pane fade in" id="form6">
                <div class="content_sec inn_content">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#youtube" aria-controls="home" role="tab" data-toggle="tab">Youtube <span class="round_btn youtube"><i class="fa fa-youtube-play"></i></span></a></li>
    <li role="presentation"><a href="#twitter" aria-controls="profile" role="tab" data-toggle="tab">Twitter  <span class="round_btn twitter"><i class="fa fa-twitter"></i></span></a></li>
    <li role="presentation"><a href="#instagram" aria-controls="messages" role="tab" data-toggle="tab">Instagram  <span class="round_btn instagram"><i class="fa fa-instagram"></i></span></a></li>
    <li role="presentation"><a href="#vine" aria-controls="settings" role="tab" data-toggle="tab">Vine  <span class="round_btn vine"><i class="fa fa-vine"></i></span></a></li>
    <li role="presentation"><a href="#tumblr" aria-controls="messages" role="tab" data-toggle="tab">Tumblr  <span class="round_btn tumblr"><i class="fa fa-tumblr"></i></span></a></li>
    <li role="presentation"><a href="#facebook" aria-controls="settings" role="tab" data-toggle="tab">Facebook  
    <span class="round_btn facebook"><i class="fa fa-facebook-f"></i></span></a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="youtube">
    <div class="col-xs-3"><p>Videos</p><h3>0</h3></div>
    <div class="col-xs-3"><p>Views</p><h3>0</h3></div>
    <div class="col-xs-3"><p>Avg. CPV</p><h3>$0.00</h3></div>
    <div class="col-xs-3"><p>Avg. CPE</p><h3>$0.00</h3></div>
    <div class="clearfix"></div>
    </div>
    <div role="tabpanel" class="tab-pane fade in" id="twitter">
    <div class="col-xs-3"><p>Videos</p><h3>0</h3></div>
    <div class="col-xs-3"><p>Views</p><h3>0</h3></div>
    <div class="col-xs-3"><p>Avg. CPV</p><h3>$0.00</h3></div>
    <div class="col-xs-3"><p>Avg. CPE</p><h3>$0.00</h3></div>
    <div class="clearfix"></div>
    </div>
    <div role="tabpanel" class="tab-pane fade in" id="instagram">
    <div class="col-xs-3"><p>Videos</p><h3>0</h3></div>
    <div class="col-xs-3"><p>Views</p><h3>0</h3></div>
    <div class="col-xs-3"><p>Avg. CPV</p><h3>$0.00</h3></div>
    <div class="col-xs-3"><p>Avg. CPE</p><h3>$0.00</h3></div>
    <div class="clearfix"></div>
    </div>
    <div role="tabpanel" class="tab-pane fade in" id="vine">
    <div class="col-xs-3"><p>Videos</p><h3>0</h3></div>
    <div class="col-xs-3"><p>Views</p><h3>0</h3></div>
    <div class="col-xs-3"><p>Avg. CPV</p><h3>$0.00</h3></div>
    <div class="col-xs-3"><p>Avg. CPE</p><h3>$0.00</h3></div>
    <div class="clearfix"></div>
    </div>
    <div role="tabpanel" class="tab-pane fade in" id="tumblr">
    <div class="col-xs-3"><p>Videos</p><h3>0</h3></div>
    <div class="col-xs-3"><p>Views</p><h3>0</h3></div>
    <div class="col-xs-3"><p>Avg. CPV</p><h3>$0.00</h3></div>
    <div class="col-xs-3"><p>Avg. CPE</p><h3>$0.00</h3></div>
    <div class="clearfix"></div>
    </div>
    <div role="tabpanel" class="tab-pane fade in" id="facebook">
    <div class="col-xs-3"><p>Videos</p><h3>0</h3></div>
    <div class="col-xs-3"><p>Views</p><h3>0</h3></div>
    <div class="col-xs-3"><p>Avg. CPV</p><h3>$0.00</h3></div>
    <div class="col-xs-3"><p>Avg. CPE</p><h3>$0.00</h3></div>
    <div class="clearfix"></div>
    </div>
  </div>

</div>
                </div>
              </div>
            </div>
          </div>
  </div>
  </div>

  <script>
    
    var basicdetailurl='<?php echo site_url('/'.MY_ACCOUNT.'settings')?>';
    var loginpanelurl='<?php echo site_url('/user/login')?>';
  </script>