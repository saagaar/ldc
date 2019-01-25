

<section>
    <div class="container help-desk"><h4 class="mb-15"><b>Help & Feedback Form</b></h4>
        <p>If you don’t make any changes here, feedback will be sent to the author of the page and the option will be name of this page.</p>
        <form class="mt-30" id="feedbackform" enctype="multipart/form-data" method="post" action="<?php echo base_url('user/users/feedback'); ?>" method="post"  class="form-horizontal">
            <?php
            if ($this->session->flashdata('success_message')) {
                echo "<div class='alert alert-success text-success'>" . $this->session->flashdata('success_message') . "</div>";
            } else if ($this->session->flashdata('error_message')) {
                echo "<div class='alert alert-success text-error'>" . $this->session->flashdata('error_message') . "</div>";
            }
            ?>

            <?php if (!$this->session->userdata(SESSION . 'user_id')) { ?>
                <div>
                    <label>Email<span>*</span> :</label>
                    <input type="text" for class="form-control no-radius" placeholder="Type your email" id="email" name="email" value="<?php echo set_value('email') ?>">
                    <?= form_error('email') ?>                 
                </div>
            <?php } ?>

            <div class="col-md-6 p-0 clearfix mb-20">
                <label for="dd1">Please select option</label><span class="drop fa p-relative">
        <!-- <select name="dd1" id="dd1" class="required"> -->
                    <select class="form-control no-radius" id="option" name="feedback_type">
                        <option value="">Select Option</option>
                        <option value="technical">Technical Feedback</option>
                        <option value="Staff">Staff Feedback</option>
                        <option value="customer">Customer Feedback</option>
                    </select> </span>
                <?= form_error('feedback_type') ?>  
            </div>

            <div class="col-md-12 p-0">
                <label>Feedback</label>

                <fieldset class="add_file form-control no-radius mb-20">

                    <textarea class="no-border mt-10" rows="15" id="feedback" name="feedback" placeholder="Type your Feedback">
                        <?php echo set_value('feedback') ?></textarea>
                    <?= form_error('feedback') ?>  

                    <div class="file_sec">
                              <!-- <div style="position:relative;"><a class=''><i class="fa fa-paperclip"></i><input type="file" style='position:absolute;z-index:2;top:0;right:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent; width:30px;' name="file_source" size="40"  onchange='$("#upload-file-infos").html($(this).val());'></a>&nbsp; 
                              <span class='label label-default' id="upload-file-infos"></span></div> -->


                        <input name="file_source" type="file" id="img1" />

                    </div>
                    <?= form_error('file_source') ?>
                    <?php echo '<div class="error">' . $this->session->flashdata('error_img1') . '</div>'; ?>
                </fieldset>

            <div class="text-right"><a class="btn btn-default fw-6 mr-10" href="<?php echo site_url(); ?>">Cancel</a>
            <button type="submit"  id="feedbackbtn" class="btn btn-pink">Send</button></div>
            </div>
        </form>
    </div>
</section>






