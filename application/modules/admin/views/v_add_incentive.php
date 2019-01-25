

  <?php


  $model='';
  $fromdate='';
  $todate='';
  $dealer=array();
  $dealer_incentive_type='';
  $staff_incentive_type='';
  $staff_incentive='';
  $dealer_incentive='';
  $dealer_initial_target=array();
  $dealer_final_target='';
  $initial_staff_target='';
  $final_staff_target='';
  $d_initial_target='';
  $d_final_target='';
  $d_incentive='';
  $s_initial_target='';
  $s_final_target='';
  $name='';
  $s_incentive='';
  if(isset($incentive))
  {

    foreach($listincentivedealer as $eacheincdealer)
    {
      $dealer[]=$eacheincdealer->dealer_id;
    }
    $dealer_incentive_type=$incentive->dealer_reward_type;
    $staff_incentive_type=$incentive->staff_reward_type;
    $model= $incentive->model_id;
    $todate=$incentive->end_date;
    $fromdate=$incentive->start_date;
    $name=$incentive->name;

  }
  else{
    $incentivestaff='';
    $incentivedealer='';
  }

if($this->input->post('model')) $model=$this->input->post('model');
if($this->input->post('name')) $name=$this->input->post('name');
if($this->input->post('fromdate')) $fromdate=$this->input->post('fromdate');
if($this->input->post('todate')) $todate=$this->input->post('todate');
if($this->input->post('dealer')) $dealer=$this->input->post('dealer');
if($this->input->post('dealer_incentive_type')) $dealer_incentive_type=$this->input->post('dealer_incentive_type');
if($this->input->post('staff_incentive_type')) $staff_incentive_type=$this->input->post('dealer_incentive_type');


if($this->input->post('dealer_incentive')) $dealer_incentive=$this->input->post('dealer_incentive');
if($this->input->post('staff_incentive')) $staff_incentive=$this->input->post('staff_incentive');
if($this->input->post('dealer_initial_target')) $dealer_initial_target=$this->input->post('dealer_initial_target');
if($this->input->post('dealer_final_target')) $dealer_final_target=$this->input->post('dealer_final_target');
if($this->input->post('staff_initial_target')) $staff_initial_target=$this->input->post('staff_initial_target');else $staff_initial_target;
if($this->input->post('staff_final_target')) $staff_final_target=$this->input->post('staff_final_target');else $staff_final_target;
$countstaff=0;
$countdealer=0;
if($this->input->post())

{
  $countdealer=count($dealer_incentive);
  $countstaff=count($staff_incentive);
}
elseif(!is_array($incentivedealer) && !is_array($incentivestaff))
{
   $countdealer=0;
   $countstaff=0;
}
else
{
  $countdealer=0;
  $countstaff=0;
  if((is_array($incentivestaff) && count($incentivestaff)>0))
  $countstaff=count($incentivestaff);
  if((is_array($incentivedealer) && count($incentivedealer)>0))
  $countdealer=count($incentivedealer);
}
  if($incentiveid)
    $title='Edit';
  else $title='Add';
?>


   <form id="addincentiveform" method="post" action="">
          <div class="round_box incentive_setting mb-20">
            <div class="lite_gre_bg mb-10 p-15 fs-16"><b><?php echo $title?> Incentive</b></div>
            <div class="row p-10 m-0 no-border">
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Incentive Name</label>
                        <input type="text" class="form-control no-radius unitno-input" name="inc_name" placeholder="Incentive Name" value="<?php echo $name;?>">
                    </div>
                    <div class="col-sm-6">
                        <label>Model</label>
                        <span class="drop fa p-relative">
                            <input name="incentiveid" type="hidden" id="parentincid" value="<?php echo $incentiveid;?>">
                            <select class="form-control mb-15 no-radius "  id="modelid" name="model" >
                                <option value="">---Select---</option>
                                <?php
                                if(is_array($allmodels) && count($allmodels)>0):
                                foreach($allmodels as $eachmodel):?>
                                <option <?php if($model==$eachmodel->id) echo 'selected';?> value="<?php echo $eachmodel->id?>"><?php echo $eachmodel->model_name?></option>
                                <?php endforeach;
                                endif;
                                ?>
                            </select>
                            <?php echo form_error('model');?>
                        </span>
                    </div>
                </div>
              <div class="col-xs-12 form-group">
                <label>Date (Period)</label>
                <div class="row date_error">
                  <div class="col-xs-6">
                    <div class="initialdate p-relative">
                      <div class="input-group date">
                        <input class="form-control no-radius"  name="fromdate" placeholder="YYYY-MM-DD" type="text" id="fromdate" value="<?php echo $fromdate?>">
                        <div class="input-group-addon no-radius"><i class="fa fa-calendar"></i></div>
                         <?php echo form_error('fromdate');?>
                      </div>

                    </div>
                  </div>
                  
                  <div class="col-xs-6">
                       <em class="txt_date">To</em>
                    <div class="finaldate p-relative">
                      <div class="input-group date">
                        <input class="form-control no-radius" name="todate" placeholder="YYYY-MM-DD" type="text" id="todate" value="<?php echo $todate?>">
                        <div class="input-group-addon no-radius"><i class="fa fa-calendar"></i></div>
                          <?php echo form_error('todate');?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 mt-20 p-relative s_dealer">
                <label>Select Dealer</label>
                 <div class="checkbox">
                  <label>
                    <input type="checkbox" class="alldealer">
                    All Dealer </label>
                </div>
                 <?php
                   if(is_array($dealers) && count($dealers)>0):
                    foreach($dealers as $eachdealer):
                          ?>
                        <div class="checkbox">
                        <label>
                          <input type="checkbox" name="dealer[]"  class="checkboxindividual " <?php if(in_array($eachdealer->id,$dealer)) echo 'checked';?> value="<?php echo $eachdealer->id;?>">
                          <?php echo $eachdealer->display_name;?> </label>
                      </div>
                      <?php
                    endforeach;
                endif;
                ?>
                 <?php echo form_error('dealer[]');?>
              </div>

            </div>

            <div class="dealer-sec grandparentincentiveadd">
              <div class="lite_gre_bg p-10 mb-10 p-15 fs-16">
                <div class="col-xs-2 p-0 mt-10"><b>Dealer Target</b></div>
                <div class="col-xs-6">
                    <div class="p-relative fa drop">
                      <select class="form-control" name="dealer_incentive_type">
                          <option value=''>Select Incentive Type</option>
                          <option <?php if($dealer_incentive_type==1) echo 'selected';?> value="1">Incremental Tier Reward</option>
                          <option <?php if($dealer_incentive_type==2) echo 'selected';?> value="2">Target Tier Reward</option>
                      </select>

                    </div>
                    <?php echo form_error('dealer_incentive_type');?>
                </div>
                <div class="col-xs-4">
                  <a href="#" class="fc-pink fs-20 mr-10 info"><i class="fa fa-question-circle-o"></i></a>
                  <div class="info_div p-15" style="display:none;">
                    <p>Incremental Tier Reward – an addition of amount towards the achieved target.</p>
                    <p class="fc-pink">For example, achieved tier 1 at 1-150 units, total rewards is $150
                    (1unit=$1), upon achieve to tier 2 – 151 onwards, total rewards will be
                    $152 ($150 + $2) as reached to 151 units, 1 unit = $2. </p>
                    <p>Target Tier Reward – amount rewarded based on the specific target achieved.</p>
                    <p class="fc-pink"> For example, achieved tier 1 at 1-150 units, amount rewarded
                    is $150 (1unit=$1), upon achieve to tier 2 – 151 onwards, total rewards
                    will be calculates according to the incentive amount for tier 2 which is 1
                    units = $2.
                    -Tier 1: 150 units x $2 = $300
                    -Tier 2: 151 units = $2
                    Total: $300 + $2 = $302</p>
                  </div>
                  <a class="btn btn-pink addincentivebtn" > Add Target</a>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="rTable">
                <div class="row rTableRow rTableHeadrow p-10 p-15 m-0 fw-6 text-center">
                  <span class="rTableHead col-xs-1 pl-0">Tier.</span>
                  <span class="rTableHead col-xs-6">Target Amount (Unit)</span>
                  <span class="rTableHead col-xs-3">Incentive ($)</span>
                  <span class="rTableHead col-xs-2">Delete</span>
                </div>
                <div class="p-10 text-center parent_incentiveelement">
                  <?php

                  if($countdealer>0):
                   // echo validation_errors();
                   for($i=0 ;$i<$countdealer;$i++) :

                  $d_initial_target='';
                  $d_final_target='';
                  $d_incentive='';

                    if(($this->input->post()) && ($dealer_initial_target["a$i"])) $d_initial_target=$dealer_initial_target["a$i"]; elseif(isset($incentivedealer[$i]) && $incentivedealer) $d_initial_target=$incentivedealer[$i]->initial_target_amount;
                   if(($this->input->post()) && ($dealer_final_target["a$i"])) $d_final_target=$dealer_final_target["a$i"]; elseif(isset($incentivedealer[$i]) && $incentivedealer) $d_final_target=$incentivedealer[$i]->final_target_amount;
                    if(($this->input->post())&&($dealer_incentive["a$i"])) $d_incentive=$dealer_incentive["a$i"]; elseif((isset($incentivedealer[$i])) && $incentivedealer) $d_incentive=$incentivedealer[$i]->incentive;
                  ?>

                  <div class="row rTableRow p-10 m-0 no-border incentiveelement ">
                    <div class="rTableSmall">
                      <span class="rTableCell">Tier.</span>
                      <span class="rTableCell snoaddelemennt"><?php echo $i+1;?>.</span>
                    </div>
                    <div class="rTableSmall">
                    <span class="rTableCell">Target Amount</span>
                    <span class="rTableCell">
                      <div class="row">
                        <div class="col-xs-5 pr-0">
                          <input type="text" class="form-control no-radius inputelement" name="dealer_initial_target[a<?php echo $i;?>]" placeholder="Initial Target" value="<?php echo $d_initial_target;?>">
                           <?php echo form_error("dealer_initial_target[a$i]");?>
                        </div>
                        <div class="col-xs-2">To</div>
                        <div class="col-xs-5 pl-0">
                          <input type="text" class="form-control no-radius inputelement" name="dealer_final_target[a<?php echo $i;?>]" placeholder="Final Target" value="<?php echo $d_final_target;?>">
                           <?php echo form_error("dealer_final_target[a$i]");?>
                        </div>
                      </div>
                    </span>
                    </div>
                    <div class="rTableSmall">
                      <div class="rTableCell">Incentive ($)</div>
                      <div class="rTableCell">
                       <input type="text" class="form-control no-radius inputelement" name="dealer_incentive[a<?php echo $i;?>]" placeholder="Dealer Incentive" value="<?php echo $d_incentive;?>">
                        <?php echo form_error("dealer_incentive[a$i]");?>
                      </div>
                    </div>
                    <div class="rTableSmall">
                      <span class="rTableCell">Delete</span>
                      <span class="rTableCell col-xs-2"><a class="fs-25 text-muted remover"><i class="fa fa-trash-o"></i></a>
                      </span>
                    </div>
                  </div>


                  <?php endfor;
                  else: ?>

                  <div class="row rTableRow p-10 m-0 no-border incentiveelement ">
                    <div class="rTableSmall">
                      <span class="rTableCell">Tier.</span>
                      <span class="rTableCell  snoaddelemennt">1.</span>
                    </div>
                    <div class="rTableSmall">
                      <span class="rTableCell">Target Amount</span>
                      <span class="rTableCell">
                        <div class="row">
                          <div class="col-xs-5 pr-0">
                            <input type="text" class="form-control no-radius inputelement" name="dealer_initial_target[a0]" placeholder="Initial Target">
                          </div>
                          <div class="col-xs-2">To</div>
                          <div class="col-xs-5 pl-0">
                            <input type="text" class="form-control no-radius inputelement" name="dealer_final_target[a0]" placeholder="Final Target">
                          </div>
                        </div>
                      </span>
                    </div>
                    <div class="rTableSmall">
                      <span class="rTableCell">Incentive ($)</span>
                      <span class="rTableCell">
                       <input type="text" class="form-control no-radius inputelement" name="dealer_incentive[a0]" placeholder="Dealer Incentive">

                      </span>
                    </div>
                    <div class="rTableSmall">
                      <span class="rTableCell">Delete</span>
                      <span class="rTableCell">
                        <a class="fs-25 text-muted remover"><i class="fa fa-trash-o"></i></a>
                      </span>
                    </div>
                  </div>

                  <?php
                  endif;
                  ?>
                </div>
              </div>
            </div>
            <div class="dealer-sec grandparentincentiveadd">
              <div class="lite_gre_bg mb-10 p-15 fs-16"><div class="col-xs-2 p-0 mt-10"><b>Staff Target</b></div>
              <div class="col-xs-6">
                <div class="p-relative fa drop">
                  <select class="form-control" name="staff_incentive_type">
                    <option value="">Select Incentive Type</option>
                    <option <?php if($staff_incentive_type==1) echo 'selected';?> value="1">Incremental Tier Reward</option>
                    <option <?php if($staff_incentive_type==2) echo 'selected';?> value="2">Target Tier Reward</option>
                  </select>
                </div>
                <?php echo form_error('staff_incentive_type');?>
              </div>
              <div class="col-xs-4"><a href="#" class="fc-pink fs-20 mr-10"><i class="fa fa-question-circle-o"></i></a>
                <a class="btn btn-pink addincentivebtn" > Add Target</a></div>
                <div class="clearfix"></div>
              </div>

              <div class="rTable">

              <div class="row rTableRow rTableHeadrow p-10 p-15 m-0 fw-6 text-center">
                <span class="rTableHead col-xs-1 pl-0">Tier.</span>
                <span class="rTableHead col-xs-6">Target Amount (Unit)</span>
                <span class="rTableHead col-xs-3">Incentive ($)</span>
                <span class="rTableHead col-xs-2">Delete</span>
              </div>
              <div class="p-10 text-center parent_incentiveelement">

              <?php
                if($countstaff>0):
                 // echo validation_errors();
                 for($i=0 ;$i<$countstaff;$i++) :

                  $s_initial_target='';
                  $s_final_target='';
                  $s_incentive='';

                  if($this->input->post() && ($staff_initial_target["a$i"])) $s_initial_target=$staff_initial_target["a$i"]; elseif(isset($incentivestaff[$i])) $s_initial_target=$incentivestaff[$i]->initial_target_amount;
                 if($this->input->post() && ($staff_final_target["a$i"])) $s_final_target=$staff_final_target["a$i"]; elseif(isset($incentivestaff[$i])) $s_final_target=$incentivestaff[$i]->final_target_amount;
                  if( $this->input->post() && ($staff_incentive["a$i"])) $s_incentive=$staff_incentive["a$i"]; elseif(isset($incentivestaff[$i])) $s_incentive=$incentivestaff[$i]->incentive;
              ?>
               <div class="row rTableRow p-10 m-0 no-border incentiveelement ">
                  <div class="rTableSmall">
                    <span class="rTableCell">Tier.</span>
                    <span class="rTableCell snoaddelemennt"><?php echo $i+1;?>.</span>
                  </div>
                  <div class="rTableSmall">
                    <span class="rTableCell">Target Amount (Unit)</span>
                    <span class="rTableCell">
                      <div class="row">
                        <div class="col-xs-5 pr-0">
                          <input type="text" class="form-control no-radius inputelement" name="staff_initial_target[a<?php echo $i;?>]" placeholder="Initial Target" value="<?php echo $s_initial_target;?>">
                           <?php echo form_error("staff_initial_target[a$i]");?>
                        </div>
                        <div class="col-xs-2">To</div>
                        <div class="col-xs-5 pl-0">
                          <input type="text" class="form-control no-radius inputelement" name="staff_final_target[a<?php echo $i;?>]" placeholder="Final Target" value="<?php echo $s_final_target;?>">
                           <?php echo form_error("staff_final_target[a$i]");?>
                        </div>
                      </div>
                    </span>
                  </div>
                  <div class="rTableSmall">
                    <span class="rTableCell">Incentive ($)</span>
                    <div class="rTableCell">
                     <input type="text" class="form-control no-radius inputelement" name="staff_incentive[a<?php echo $i;?>]" placeholder="staff Incentive" value="<?php echo $s_incentive;?>">
                         <?php echo form_error("staff_incentive[a$i]");?>
                    </div>
                  </div>
                  <div class="rTableSmall">
                      <span class="rTableCell">Delete</span>
                      <span class="rTableCell"><a class="fs-25 text-muted remover"><i class="fa fa-trash-o"></i></a>
                      </span>
                  </div>
                </div>


            <?php endfor;
            else: ?>
                <div class="row rTableRow p-10 m-0 no-border incentiveelement ">
                  <div class="rtableSmall">
                    <span class="rTableCell">Tier.</span>
                    <span class="rTableCell snoaddelemennt">1.</span>
                  </div>  
                  <div class="rTableSmall">
                    <span class="rTableCell">Target Amount (Unit)</span>
                    <span class="rTableCell">
                      <div class="row">
                        <div class="col-xs-5 pr-0">
                          <input type="text" class="form-control no-radius inputelement" name="staff_initial_target[a0]" placeholder="Initial Target">
                        </div>
                        <div class="col-xs-2">To</div>
                        <div class="col-xs-5 pl-0">
                          <input type="text" class="form-control no-radius inputelement" name="staff_final_target[a0]" placeholder="Final Target">
                        </div>
                      </div>
                    </span>
                  </div>
                  <div class="rTableSmall">
                    <span class="rTableCell">Incentive ($)</span>
                    <span class="rTableCell">
                     <input type="text" class="form-control no-radius inputelement" name="staff_incentive[a0]" placeholder="Staff Incentive">
                    </span>
                  </div>
                  <div class="rTableSmall">
                    <span class="rTableCell">Delete</span>
                    <span class="rTableCell"><a class="fs-25 text-muted remover"><i class="fa fa-trash-o"></i></a>
                    </span>
                  </div>
                </div>



            <?php
            endif;
            ?>
            </div>
            </div>
            </div>
            <div class="text-right p-20"><a href="<?php echo site_url(ADMIN.'/incentive_setting')?>" class="btn btn-default fw-6 mr-10">Cancel</a> <button type="submit"  class="btn btn-pink fw-6" id="addincentivebtn">Save</button></div>
          </div>
        </form>

<script>
$(function(){
 $('.info').hover(function(){
     $('.info_div').slideToggle();
 });
});

var urlsaveincentive='<?php echo site_url(''.ADMIN.'/add_incentive');?>';
var checkduplicateIncentivename='<?php echo site_url(''.ADMIN.'/check_incentive_name_unique');?>';
var checkduplicateIncentivedate='<?php echo site_url(''.ADMIN.'/check_date_available_incentive');?>';
</script>
