
<div class="dealer-report sales-status rep_mgmt">
     <!--  <div class="chart-tittle rds_to"><a href="<?php echo site_url(ADMIN.'/report_management') ?>" class="btn  col-xs-6  <?php echo ($tab_active =='admin_sales_report')?'btn-danger':'btn-default' ?>">Sales Report</a>

      <a href="<?php echo site_url(ADMIN.'/incentive_report') ?>" class="btn lst col-xs-6 <?php echo ($tab_active =='admin_incentive_report')?'btn-danger':'btn-default' ?>">Incentive Report</a>
      <div class="clearfix"></div>
      </div> -->      
      <div class="chart-tittle lite_gre_bg">
          <form  method="post" action="<?php echo site_url(ADMIN.'/downloadexcel')?>">          
            <div class="row">
              <div class="col-xs-6">
              <label>Dealer Name : </label> <span class="drop fa p-relative">
                <select class="form-control filterdealer" name="filterdealer">
                  <option value="">All Dealer</option>
                  <?php if( $dealers_list) {

                    foreach($dealers_list as $dealer){

                   ?>

                  <option value="<?php echo $dealer->id; ?>" <?php if($this->input->post('dealer') == $dealer->id) echo 'selected="selected"'; ?>><?php echo $dealer->display_name; ?></option>
                 <?php   } } ?>
                </select>
                </span>
                </div>
                
              <div class="col-xs-6"><label>Model : </label>
               <span class="drop fa p-relative">
                <select class="form-control filtermodel" name="filtermodel">
                  <option value="">All Model</option>

                  <?php if($model_list){

                    foreach($model_list as $model){

                   ?>

                  <option value="<?php echo $model->id ?>"  <?php if($this->input->post('model') == $model->id) echo 'selected="selected"'; ?>><?php echo $model->display_name; ?></option>

                  <?php  } 
                  }  ?>
                </select>
                </span>
                </div>
            </div>
            <div class="row mt-20 pl-20">
            <div class="col-xs-3 pl-35"><em class="frm">From</em>
                <div class="date p-relative">
                  <div class="input-group initialdate date">
                    <input class="form-control no-radius filterfromdate" id="" name="filterfromdate" placeholder="MM/DD/YYYY" type="text" value="<?php echo set_value('fromdate'); ?>">
                    <div class="input-group-addon no-radius"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
              <div class="col-xs-3"><em>To</em>
                <div class="date p-relative">
                  <div class="input-group finaldate date">
                    <input class="form-control no-radius filtertodate" id="" name="filtertodate" placeholder="MM/DD/YYYY" type="text" value="<?php echo set_value('todate'); ?>">
                    <div class="input-group-addon no-radius"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
              
              <div class="col-xs-6 pl-0">
                <button class="btn btn-success mr-10 filteroptname" type="submit">Apply filter</button>
                <button type="submit" class="btn btn-pink" value="">Download Sales Report</button>
              </div>
            </div>
          </form>
        </div>
        <div class="filterview">
        <?php echo $this->load->view('ajax_admin_sales_report');?>
        </div>
        </div>
        
   <script type="text/javascript">
     var filterurl="<?php echo site_url('/'.ADMIN.'/ajax_report_management')?>"
   </script>