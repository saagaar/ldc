<div class="lite_gre_bg cms_sec">
    <div class="bg-white">
        <!-- Nav tabs -->
        <ul class="nav-tabs text-center mt-30" role="tablist">
            <li role="presentation" class="active"><a href="#feedback" aria-controls="home" role="tab" data-toggle="tab">Feedback & Enquiry</a></li>
            <li role="presentation"><a href="#contact" aria-controls="profile" role="tab" data-toggle="tab">Contact Us</a></li>
            <li role="presentation"><a href="#term" aria-controls="messages" role="tab" data-toggle="tab">Terms & Conditions</a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="feedback">
            <div class="round_box p-30">
                <h3 class="mt-0"><b>Feedback &amp; Enquiry Form</b></h3>
                <p>If you don’t make any changes here, feedback will be sent to the author of the page and the option will be name of this page.</p>
                <form class="mt-30" id="feedbackform" enctype="multipart/form-data" method="post" action="<?php echo base_url('user/users/feedback'); ?>" class="form-horizontal">
                    <div class="col-md-6 p-0 clearfix mb-20">
                        <label>Please select option</label>
                        <span class="drop fa p-relative">
                            <select class="form-control no-radius" id="option" name="feedback_type">
                                <option value="">Select Option</option>
                                <option value="technical">Technical Feedback</option>
                                <option value="Staff">Staff Feedback</option>
                                <option value="customer">Customer Feedback</option>
                            </select> </span>
                        <?= form_error('feedback_type') ?>  
                        </span></div>
                    <div class="col-md-12 p-0">
                        <label>Feedback</label>
                        <fieldset class="add_file form-control no-radius mb-20">

                            <textarea class="no-border mt-10" rows="15" id="feedback" name="feedback" placeholder="Type your Feedback">
                                <?php echo set_value('feedback') ?></textarea>
                            <?= form_error('feedback') ?>  

                            <div class="file_sec">
                            <div style="position:relative;"><a class=''><i class="fa fa-paperclip"></i><input type="file" style='position:absolute;z-index:2;top:0;right:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent; width:30px;' name="file_source" size="40"  onchange='$("#upload-file-infos").html($(this).val());' id="img1"></a>&nbsp; 
                                <span class='label label-default' id="upload-file-infos"></span></div>
                                <!--<input name="file_source" type="file" id="img1" />-->
                            </div>
                            <?= form_error('file_source') ?>
                            <?php echo '<div class="error">' . $this->session->flashdata('error_img1') . '</div>'; ?>
                        </fieldset>
                        <div class="text-right">
                            <button type="reset" class="btn btn-default fw-6 mr-10">Cancel</button>
                            <button type="submit" class="btn btn-pink">Send</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="contact">
            <div class="round_box p-30">
                <h3 class="m-0">Contact Us</h3>
                <form class="row mt-20" action="<?php echo base_url('user/users/feedback/contact_us'); ?>" method="post">
                    <input type="hidden" name="contact_us" value="contact_us">
                    
                    <div class="form-group col-md-6 clearfix"><label>Your Name :</label><input type="text" name="name" class="form-control no-radius" value="<?php echo set_value('name') ?>">
                    <?= form_error('name') ?></div>
                    <div class="form-group col-md-6 clearfix"><label>Email :</label><input type="text" name="email" class="form-control no-radius" value="<?php echo set_value('email') ?>">
                    <?= form_error('email') ?>
                    </div>
                  
                    <div class="form-group col-md-6 clearfix"><label>Subject :</label><input type="text" class="form-control no-radius" name="subject" value="<?php echo set_value('subject') ?>">
                    <?= form_error('subject') ?></div>
                    <div class="form-group col-xs-12"><label>Message :</label><textarea name="message" class="form-control no-radius" rows="8"><?php echo set_value('message') ?></textarea>
                    <?= form_error('message') ?></div>
                    <div class="text-right col-xs-12"><button class="btn btn-pink">Submit</button></div>
                </form>
            </div>      
        </div>
        <div role="tabpanel" class="tab-pane" id="term">
            <div class="p-30">
                <h3 class="mt-0"><b>LG Website Terms & Conditions</b></h3>
                <p>Last modified : April 2017<br><br></p>
                <h4><b>Welcome to LG!.</b></h4>
                <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.<br><br></p>
                <h4><b>Using our Services.</b></h4>
                <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.</p>
                <h4><b>Welcome to LG!.</b></h4>
                <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.<br><br></p>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>