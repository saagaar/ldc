<div class="dealer-report sales-status">
    <div class="chart-tittle rds_to">

        
<?php
$userid='';
  if($userdata) $userid= $userdata->id;
    $edit_profile_class = 'btn btn-default';
    $pendingclass = 'btn btn-default';
?>
<?php if($userdata!==false):    ?>
   
  <a class="btn btn-success printhidden "  style="float:right;" data-toggle="modal"  data-target="#approve_users_modal" type="submit">Add New</a>
<?php endif;?>
<?php       

if($userdata!==false):          
        ?>
<span class="printhidden">
<b>Customer Id</b> : C<?php echo $userdata->id;?> &nbsp; <b>Customer Name</b> : <?php echo $userdata->customer_name;?><br/>&nbsp; 
</span>
<?php endif;?>
</div>

<!--         <a href="<?php echo site_url('/' . ADMIN . '/staff_management/pending') ?>" class="<?php echo $pendingclass; ?>  col-xs-6" >Approve New Staff</a>
        <a href="<?php echo site_url('/' . ADMIN . '/staff_management/edit_profile') ?>" class="<?php echo $edit_profile_class; ?>  col-xs-6">Approve Change Information</a> -->
        <div class="clearfix"></div>
    </div>

   
        <div>
         <form name="approveusers" method="post" class="printhidden" >
            <div class="row ">
                <div class="mt-15 mb-15">
                    <!-- <h3 class="mt-0 fw-6 col-xs-5"><?php if (isset($job)) echo $job; ?></h3> -->
                    <div class=" mt-20 pl-20">
                        <div class="col-xs-3 pl-35">
                        <!-- <em class="frm">From</em> -->
                                <!-- <div class="date p-relative"> -->
                              <div class="input-group">
                                <input class="form-control no-radius filterfromdate " readonly id="from-nepali-calendar" name="fromdate" placeholder="YYYY-MM-DD" type="text" value="<?php echo set_value('fromdate'); ?>">
                                <!-- <div class="input-group-addon no-radius"><i class="fa fa-calendar"></i></div> -->
                              </div>
                            <!-- </div> -->
                          </div>
                          <div class="col-xs-3">
                          <!-- <em>To</em> -->
                            <!-- <div class="date p-relative"> -->
                              <div class="input-group  ">
                                <input class="form-control no-radius filtertodate" readonly id="to-nepali-calendar" name="todate" placeholder="YYYY-MM-DD" type="text" value="<?php echo set_value('todate'); ?>">
                                <!-- <div class="input-group-addon no-radius"><i class="fa fa-calendar"></i></div> -->
                              </div>
                            <!-- </div> -->
                          </div>
                          
                         
                           <div class="col-xs-2   ">
                          
                      <?php if(isset($members) && is_array($members) && (count($members)>0) ):?>
                      <select class="filter filteruserid form-control no-radius">
                      <option value="">---Select---</option>
                      <?php foreach($members as $eachmembers): ?>
                        <option value="<?php echo $eachmembers->member_id?>"><?php echo $eachmembers->customer_name;?></option>
                      <?php endforeach;?>
                      </select>
                      <?php else: ?>
                         <select class="filter filteruserid form-control no-radius">
                         <option value="<?php echo $userdata->id?>"><?php echo $userdata->customer_name;?></option>
                         </select>
                      <?php endif;?>
                     
                          </div>
                          <div class="col-xs-2">
                          <select class="filterlimit form-control filter" name="filterlimit">
                            <option value="">--Select--</option>
                            <option value="1">1</option>
                            <option value="10">10</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                          </select>
                          </div>
                           <div class="col-xs-2">
                          <label></label>   
                            <button class="btn btn-success  filteroptname" type="submit">Apply filter</button>
                            <!-- <a class="btn btn-pink">Download Sales Report</a> -->
                          </div>
                    </div>
                                <div class="clearfix"></div>
                </div>
            </div>
            </form>
            <div class="filterview lite_gre_bg  ">

                <?php $this->load->view('v_transaction_partial'); ?>
                
            </div>
            <div class="col-sm-12 col-xs-12 text-right ar pt-10 pr-5 printhidden">
                          <button class="btn btn-primary btn-sm  printclick" >Print</button>
                            <button class=" multipleselect btn btn-danger btn-sm hidden" formAction="<?php echo site_url('/' . ADMIN . '/reject_member_data') ?>" onclick="return doconfirmreject();">Reject</button>
                </div>
        </div>
   
</div>

<script type="text/javascript">

   var filterurl="<?php echo site_url('/'.ADMIN.'/ajax_transaction/'.$userid)?>"
   var addreceipturl = '<?php echo site_url('/' . ADMIN . '/transaction/'); ?>';
   $('.printclick').click(function(){
    // $('body').not('.divToPrint').hide();
    //  $('.divToPrint').show();
   window.print();
   // $('body').show();
   })
</script>