<div class="mid-part margin_0">
    <div class="msz_filter_sec">
    <div class="col-xs-6 col-sm-4 col-md-3">
    <form class="form-inline search" action='#'>
    <input type="text" class="form-control" id="filtersearchname" placeholder="Jane Doe"><button class="btn namefilterclick" type="submit"><i class="fa fa-search"></i></button></form>
    </div>
    <div class="col-xs-6 pull-right text-right">
    <ul class="list-unstyled">
                 <li>
                 <select class="btn btn-default"><option selected>All</option><option>Read</option><option>Unread</option></select></li>
                <li><a href="#" class="btn btn-default"><i class="fa fa-refresh"></i></a></li>
          </ul></div>
    <div class="clearfix"></div>
    </div> 
          
<div role="tabpanel" class="col-xs-12">
          <div class="row">
            <div class="col-xs-3"> <!-- required for floating --> 
              <!-- Nav tabs -->
              <ul class="list-unstyled msz_menu messagemenu">
                <li class="active"><a href="#inbox_msz" data-type="inbox" class="messagetype" data-toggle="tab"><span>Inbox</span></a></li>
                <li><a href="#sent_msz" class="messagetype" data-type="sent" data-toggle="tab"><span>Sent</span></a></li>
                <li><h4>CONTENT STATUS</h4></li>
                <li><a href="#all_msz" class="messagetype" data-type="all" data-toggle="tab"><span>ALL</span></a></li>
                <li><a href="#production_msz" class="messagetype" data-type="production" data-toggle="tab"><span>In Production</span></a></li>
                <li><a href="#review_msz" class="messagetype" data-type="review" data-toggle="tab"><span>In Review</span></a></li>
                <li><a href="#action_required_msz" class="messagetype" data-type="action_required" data-toggle="tab"><span>Changes Required</span></a></li>
                <li><a href="#completed_msz" class="messagetype" data-type="completed" data-toggle="tab"><span>Completed</span></a></li>
                <li><a hre  f="#create_msz"  class="messagetype" data-toggle="tab">Create Message</a></li>
              </ul>
            </div>
            <div class="col-xs-9 msz_sec">
              <div class="text-right">
                <ul class="list-inline all-link">
                  <li><a href="#" class="btn btn-info"><i class="fa fa-check-square-o"></i> Select All</a></li>
                  <li><a href="#" class="btn btn-info"><i class="fa fa-reply"></i> Reply</a> </li>
                  <li><a href="#" class="btn btn-info"><i class="fa fa-mail-forward"></i> Forward</a> </li>
                  <li><a href="#" class="btn btn-info"><i class="fa fa-close"></i> Delete</a></li>
                </ul>
              </div>
              <!-- Tab panes -->
              <div class="tab-content messages">
                <div class="tab-pane fade in" id="create_msz">
                  <form method="post" class="advance_search col-xs-12">
                  <div class="form-group row">
                  <div class="col-xs-6"><input type="text" name="" placeholder="to" class="form-control"></div>
                  <div class="col-xs-6"><input type="text" name="" placeholder="CC" class="form-control"></div>
                  </div>
                  <div class="form-group"><input type="text" name="" placeholder="Subject" class="form-control"></div>                    
                    <div class="form-group">
                      <textarea name="your-message" rows="5"  class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                      <button class="btn btn-info">Send</button></div>
                  </form>
                  <div class="clearfix"></div>
                </div>
                <div class="tab-pane fade in active" id="inbox_msz">
                  <table class="footable">
                    <tbody >
                    <?php $this->load->view('ajax_messages')?>
                    
                      
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade in" id="sent_msz">
                  <table class="footable">
                    <tbody >
                     
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade in" id="all_msz">
                  <table class="footable" >
                    <tbody >
                      
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade in" id="production_msz">
                  <table class="footable">
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
                 <div class="tab-pane fade in" id="review_msz">
                  <table class="footable">
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
                 <div class="tab-pane fade in" id="action_required_msz">
                  <table class="footable">
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
                 <div class="tab-pane fade in" id="completed_msz">
                  <table class="footable">
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
                 
                <div class="tab-pane fade in" id="review_msz">
                  <table class="footable msz_open">
                    <tbody>
                      <tr>
                        <td colspan="1"><b>Sunrise breakfast vistas</b> <a href="">uniquekamala@gmail.com</a> <a href="#" class="btn btn-sm btn-default"><i class="fa fa-reply"></i></a></td>
                      </tr>
                      <tr>
                        <td colspan="1"><p>Sir, i did get any mark for the quiz 2. Cars to pamper or creative spgh on your list? The enclosed carport is ready and waiting. Longing to build some raised garden beds? The generous Meyer lemon will dress your fresh veggies in style. 405 Canyon Vista Dr Spectacular mountain view, sublime privacy & endless flexibility converge right here on 1 of Mt Washington's favorite streets. Sunrise breakfast vistas, discreet gated entry & the luxury of an open loft office/den plus the 2/2 practicality let you love it just as it is or spend happy veranda hours contemplating expansive Dwell or HGTV dreams. <br>
                            <br>
                            <br>
                            Thank you <br>
                            Kiyara ghimire</p></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade in" id="changes_required_msz">
                  <table class="footable msz_open">
                    <tbody>
                      <tr>
                        <td colspan="1"><b>HGTV dreams project discussion</b> <a href="">mks_q1990@yahoo.com</a> <a href="#" class="btn btn-sm btn-default"><i class="fa fa-mail-forward"></i></a></td>
                      </tr>
                      <tr>
                        <td colspan="1"><p>Sir, i did get any mark for the quiz 2. Cars to pamper or creative spgh on your list? The enclosed carport is ready and waiting. Longing to build some raised garden beds? The generous Meyer lemon will dress your fresh veggies in style. 405 Canyon Vista Dr Spectacular mountain view, sublime privacy & endless flexibility converge right here on 1 of Mt Washington's favorite streets. Sunrise breakfast vistas, discreet gated entry & the luxury of an open loft office/den plus the 2/2 practicality let you love it just as it is or spend happy veranda hours contemplating expansive Dwell or HGTV dreams. <br>
                            <br>
                            <br>
                            Thank you <br>
                            Kiyara ghimire</p></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
    </div>
    </div>

    <script type="text/javascript">
      var viewmessage='<?php echo site_url('/'.MY_ACCOUNT.'ajax_messages');?>';
    </script>