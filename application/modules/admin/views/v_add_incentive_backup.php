<form>
        <div class="round_box incentive_setting mb-20">
          <div class="lite_gre_bg row p-10 m-0 mb-10 p-15 fs-16"><b>Add Incentive</b></div>
          <div class="row p-10 m-0 no-border">
            <div class="col-xs-5">
                <label>Model</label><span class="drop fa p-relative">
                     <select class="form-control mb-15 no-radius filtermodel" name="model" id="filtermodel">
                            <option value="">ALL models</option>
                            <?php
                               if(is_array($allmodels) && count($allmodels)>0):
                               foreach($allmodels as $eachmodel):?>
                              <option><?php echo $eachmodel->model_number?></option>
                            <?php endforeach; 
                              endif;
                            ?>
                    </select>
                    </span>
            </div>

            <div class="col-xs-7">
              <label>Date (Period)</label>
              <div class="row">
                <div class="col-xs-5 pr-0">
                  <div class="initialdate p-relative">
                    <div class="input-group">
                     <input class="form-control no-radius filterfromdate" id="fromdate" name="fromdate" placeholder="YYYY/MM/DD" type="text">
                      <div class="input-group-addon no-radius no-bg"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-1">To</div>
                <div class="col-xs-5">
                  <div class="finaldate p-relative">
                    <div class="input-group todate">
                      <input class="form-control no-radius filtertodate" id="todate" name="todate" placeholder="YYYY/MM/DD" type="text">
                      <div class="input-group-addon no-radius no-bg"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>            
            <div class="col-xs-12 mt-20">
            <label>Select Dealer</label>
            <div class="checkbox"><label><input type="checkbox" class="alldealer"> All Dealer </label></div>
            <!-- <div class="checkbox"><label><input type="checkbox"> StarHub </label></div>
            <div class="checkbox"><label><input type="checkbox"> Singtel </label></div> -->
            <?php foreach($dealerlist as $eachdealer):?>
                <div class="checkbox"><label><input type="checkbox" name="dealerlist[]" class="checkboxindividual" value="<?php echo $eachdealer->id;?>"> <?php echo $eachdealer->name;?> </label></div>
          <?php endforeach;?>
            <div class="mt-20"><button class="btn btn-pink addincentivebtn"> Add Target</button></div>
            </div>
          </div>
          
              <!-- <table class="table footable toggle-square-filled mb-0 add-dealer">
                <thead>
                  <tr class="bg-white ">
                    <th class="no_sort text-center" width="5%">No</th>
                    <th data-hide="phone,tablet" class="no_sort" width="15%">ID</th>
                    <th data-hide="phone,tablet" class="no_sort" width="10%">Type</th>
                    <th class="no_sort" width="20%">Outlet</th>
                    <th class="no_sort" width="10%">Unit No</th>
                    <th data-hide="phone" class="no_sort" width="20%">Street Name</th>
                    <th data-hide="phone,tablet" class="no_sort text-center" width="5%">Delete</th>
                  </tr>
                </thead>
                <tbody class="tbodyaddoutlet">
              
               <?php 
               $count='';
               if($count>0):
               // echo validation_errors();
               for($i=0 ;$i<$count;$i++) :
              
                $outletid='';
                          $type='';
                          $outletname='';
                          $unit_no='';
                          $streetname='';
                          $id='';
                         if(($this->input->post("outletid[a$i]"))) $outletid=$this->input->post("parentid[a$i]");elseif($outlet) $id=$outlet[$i]->id;
                if(($this->input->post("outletid[a$i]"))) $outletid=$this->input->post("outletid[a$i]"); elseif($outlet) $outletid=$outlet[$i]->outlet_id;
                if(($this->input->post("type[a$i]"))) $type=$this->input->post("type[a$i]"); elseif($outlet) $type=$outlet[$i]->type;
                if(($this->input->post("outletname[a$i]"))) $outletname=$this->input->post("outletname[a$i]"); elseif($outlet) $outletname=$outlet[$i]->outlet;
                if(($this->input->post("unitno[a$i]"))) $unit_no=$this->input->post("unitno[a$i]"); elseif($outlet) $unit_no=$outlet[$i]->unit_no;
                if(($this->input->post("streetname[a$i]"))) $streetname=$this->input->post("streetname[a$i]"); elseif($outlet) $streetname=$outlet[$i]->street_name;
                // echo validation_errors();
               ?>
                  <tr class="bg-white no-shadow outletelement">
                      
                      <td class="text-center snoaddelemennt"><?php echo $i+1;?>.</td>
                      <td>
                <input type="hidden"  class="inputelement form-control no-radius outletid-input" name="parentid[a<?php echo $i;?>]"  value="<?php echo $id;?>">
              
                        <input type="text" id="outlet_<?php echo $i+1?>" class="inputelement form-control no-radius outletid-input" name="outletid[a<?php echo $i;?>]" placeholder="Outlet id" value="<?php echo $outletid;?>">
                        <?php echo form_error("outletid[a$i]");?>
                      </td>
                      <td>
                        <input type="text" id="type_<?php echo $i+1?>" class="inputelement form-control no-radius type-input" name="type[a<?php echo $i;?>]" placeholder="Type" value="<?php echo $type;?>">
                        <?php echo form_error("type[a$i]");?>
                      </td>
                      <td>
                        <input type="text" id="name_<?php echo $i+1?>" class="inputelement form-control no-radius outlet-input" name='outletname[a<?php echo $i;?>]' placeholder="Outlet Name" value="<?php echo $outletname;?>">
                        
                        <?php echo form_error("outletname[a$i]");?>
              
                      </td>
                      <td>
                        <input type="text" id="unitno_<?php echo $i+1?>" class="inputelement form-control no-radius unitno-input" name="unitno[a<?php echo $i;?>]" placeholder="Unit No" value="<?php echo $unit_no;?>">
                        <?php echo form_error("unitno[a$i]");?>
                      </td>
                      <td>
                        <input type="text" id="streetname_<?php echo $i+1?>" class="inputelement form-control no-radius streetname-input" name="streetname[a<?php echo $i;?>]" placeholder="Street Name" value="<?php echo $streetname;?>">
                        <?php echo form_error("streetname[a$i]");?>
                      </td>
                      <td class="text-center"><a class="text-muted fs-20 delete_outlet"><i class="fa fa-trash-o"></i></a></td>
                  </tr>  
                 <?php 
                  endfor;
                  else:
                    
                 ?>
              <tr class="bg-white no-shadow outletelement">
                      <td class="text-center snoaddelemennt">1.</td>
                      <td>
                        <input type="text" class="inputelement  outletid-input form-control  no-radius" name="outletid[a0]" placeholder="Outlet id">
              
                        <?php echo form_error('outletid[a0]');?>
                      </td>
                      <td>
                        <input type="text" class="inputelement type-input form-control no-radius" name="type[a0]" placeholder="Type">
                        <?php echo form_error('type[a0]');?>
                      </td>
                      <td>
                        <input type="text" class="inputelement form-control outlet-input no-radius" name="outletname[a0]" placeholder="Outlet Name">
                        <input type="text" class="inputelement form-control no-radius" name='outletname[1]' placeholder="Outlet id">
                        <?php echo form_error('outletname[a0]');?>
                      </td>
                      <td>
                        <input type="text" class="inputelement form-control unitno-input no-radius" name="unitno[a0]" placeholder="Unit No">
                        <?php echo form_error('unitno[a0]');?>
                      </td>
                     <td>
                        <input type="text" class="inputelement form-control streetname-input no-radius" name="streetname[a0]" placeholder="Street Name">
                        <?php echo form_error('streetname[a0]');?>
                      </td>
                      <td class="text-center"><a class="text-muted fs-20 delete_outlet"><i class="fa fa-trash-o"></i></a></td>
                  </tr>  
              <?php
                  endif;
                 ?>   
                </tbody>
              </table> -->
          
          <div class="row p-10 p-15 m-0 fw-6"> <span class="col-xs-1 pl-0">&nbsp;</span> <span class="col-xs-5">Target Amount (Unit)</span> <span class="col-xs-3">Dealer Incentive</span> <span class="col-xs-3">Salesman Incentive</span></div>
          <div class="p-10 parent_incentiveelement">
          <div class="row p-10 m-0 no-border incentiveelement">
              <span class="col-xs-1 snoaddelemennt">1.</span> 
              <span class="col-xs-5">
                  <div class="row">
                    <div class="col-xs-5 pr-0">
                      <input type="text" class="form-control no-radius" name="initial_target[a0]" placeholder="Initial Target Unit">
                    </div>
                    <div class="col-xs-2">To</div>
                    <div class="col-xs-5 pl-0">
                      <input type="text" class="form-control no-radius" name="final_target[a0]" placeholder=" Final Target Unit">
                    </div>
                  </div>
              </span> 
              <span class="col-xs-3">
                  <input type="text" class="form-control no-radius" name="dealer_incentive[a0]" placeholder="Dealer incentive">
              </span> 
              <span class="col-xs-3">
                 <input type="text" class="form-control no-radius" name="salesman_incentive[a0]" placeholder="Salesman incentive">
              </span>
            </div> 

            </div>        
          </div>
          <div class="text-right"><a href="#" class="btn btn-default fw-6 mr-10">Cancel</a>
          <a href="#" class="btn btn-pink fw-6">Save</a></div>
          </form>