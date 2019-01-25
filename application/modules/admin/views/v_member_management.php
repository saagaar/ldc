<div class="chart-tittle">
  <h4 class="fw-6">Customer Management</h4>
</div>
<div class="lite_gre_bg p-relative pro_mgmt">
 <!--  <a href="<?php echo site_url('/'.ADMIN.'/sample_download/')?>" class="sample_download_btn">Download Sample</a> -->
  <div class="title-sec product_ttl">
    <div class="row">      
        <div class="col-xs-12">
          <form class="p-relative mb-10">
            <input type="text" class="form-control filtername" placeholder="Search by Name,Address,Customer No.">
            <button class="btn btn-pink filteroptname"><i class="fa fa-search"></i></button>
          </form>
        </div>
        <div class="col-md-5 col-xs-12 pr-0">
          
         <!--  <span class="drop fa p-relative">
            <select class="filter filterstatus form-control">
              <option value="">--Select--</option>
              <option value="1">Available</option>
              <option value="0">Claimed</option>
            </select>
          </span> -->
        </div>
      <div class="col-md-7 col-xs-12 text-right">
        <div class="row">
        <div class="col-xs-8 mb-0">
       <!--  <form class="" role="form" method="post" enctype="multipart/form-data" id="exceluploadform"  action="<?php echo site_url('/'.ADMIN.'/upload_product');?>">      

          <input type="file" name="excelupload" class="form-control pro_fileUpload">
            <button type="submit" id="exceluploadbtn" class="btn btn-success btn-sm btn-upload" data-form="<?php echo site_url('/'.ADMIN.'/upload_product');?>" style="">Upload</button>
        </form>
         -->
         </div>
        <div class="col-xs-4"><a href="" class="btn btn-pink btn-block click-to-add-product" data-toggle="modal"  data-target="">Add Member</a></div>
        </div>
      </div>
    </div>
  </div>

          <?php 
          	$this->load->view('ajax_member_management');
        $model=$this->general->get_product_model();

          ?>

<!-- POPUP-SEC -->
<div class="modal fade bs-example-modal-sm" id="add-edit-product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog modal-lg add-product" role="document">
    <div class="modal-content edit-profile p-20 no-radius">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="fa fa-times fs-25"></span></button>
      <form class="clearfix p-15" method="post" id="addproductform" action="#">
        <input type="hidden" name="customerid" id="customer-id"  value="">
        <div class="col-md-8 mb-15">
          <label>Customer Name</label>
         <input type="text" id="customername" name="customer_name" class="form-control no-radius" placeholder="Customer Name" >
          <!--  <input type="text" id="model_number-prod" name="model_number" class="form-control no-radius" placeholder="Model Name"> -->
        </div>
        <div class="col-md-8 mb-15">
          <label>Address</label>
          <input type="text" id="address" name="address" class="form-control no-radius" placeholder="Address">
        </div>
        <div class="clearfix"></div>
        <div class="col-md-8 mb-15">
          <label>Phone No</label>
          <input type="text" id="phone" name="phone" class="form-control no-radius" placeholder="Phone">
        </div>
         <div class="clearfix"></div>
        <div class="col-md-8 mb-15">
          <label>Fat Rate</label>
          <input type="text" id="fat-rate" name="fat_rate" class="form-control no-radius" placeholder="Fat Rate">
        </div>
      
        <div class="col-md-8 mb-15">
          <label>SNF Rate</label>
          <input type="text" id="snf-rate" name="snf_rate" class="form-control no-radius" placeholder="SNF Rate">
        </div>
          <div class="clearfix"></div>
         <div class="col-md-8 mb-15">
          <label>TC Rate</label>
          <input type="text" id="rate" name="rate" class="form-control no-radius" placeholder="TC Rate">
        </div>
          <div class="clearfix"></div>
        <div class="col-md-8 mb-15">
          <label>Commission Rate</label>
          <input type="text" id="commission" name="commission_rate" class="form-control no-radius" placeholder="Commission Rate">
        </div>
        <div class="text-right mt-30 col-xs-12">
          <button type="submit" datatype="add" class="btn btn-pink" id="addcustomer">Save</button>
        </div>
        <div class="clearfix"></div>
      </form>    
    </div>
  </div>
</div>
</div>

 </div>

 <script type="text/javascript">
 	var addmember='<?php echo site_url('/'.ADMIN.'/member_management')?>';
 	var urlCheckDuplicateIMEI='<?php echo site_url('/'.ADMIN.'/check_imei_availability/')?>';
 var getmember='<?php echo site_url('/'.ADMIN.'get_member_by_id')?>'
 </script>