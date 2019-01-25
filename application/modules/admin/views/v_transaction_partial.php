  <style type="text/css">
    @media print {
      
    .divToPrint {
        background-color: white;
        height: 100%;
        width: 100%;
        display: block;
        /*position: fixed;*/
        /*top: 0;
        left: 0;*/
        margin: 0;
        padding: 15px;
        font-size: 14px;
        line-height: 18px;
         /*page-break-before: always;*/
    }

    .printhidden{
      display: none;
    }
}
  </style>

    <div class="header divToPrint ">
    <div class="row" style="padding-left: 20px">
  <div class="text-center ml-20"><h2 style="font-family: Times New Roman;margin-bottom:0px ;-webkit-transform:scale(1.5,1);font-weight: 900">
    LUMBINI DAIRY MILK</h2></div>
    <div class="text-center"><b>
    BUTWAL -6 PH:071-544383 </b></div>
    <div class="text-left" style="margin-bottom: 20px"><b>
    Reg No. : 3126/058/059 </b></div>  
   
     <div class="text-left"><b>

  <?php
  
   if($userdata!==false && is_object($userdata) && count($userdata)>0):  ?>
     Name :  <?php echo $userdata->customer_name;?> &nbsp; <br/>
     Customer ID :  C<?php echo $userdata->id;?> </b>
   <?php endif;?>
     </div>  
      <div class="text-left"><b>
      <?php if($this->input->post('filterfromdate') && $this->input->post('filtertodate') ):?>
     Date : <?php echo $this->input->post('filterfromdate')?> &nbsp; To : <?php echo $this->input->post('filtertodate')?> </b>
   <?php endif;?>
     </div>  
     </div>
    
<table class="table footable toggle-square-filled mb-0">
  <thead>
    <tr class="" style="font-size: 14px">
      <th  class=" pl-10 no_sort " >SN</th>
      <th  class=" pl-10 no_sort" width="15%">Date</th>
      <th class="no_sort">Milk QTY</th>
      <th  class="no_sort">UF</th>
      <th class="no_sort" >FAT</th>
      <th class="no_sort" >SNF</th>
      <th class="no_sort" >T. SNF</th>
      <th class="no_sort" >TC</th>

      <th class="no_sort" >Fat Price</th>
      <th class="no_sort" >SNF Price</th>
      <th class="no_sort" >TC Price</th>
    <th class="no_sort" >Total</th>
      <!-- <th class="no_sort text-center" width="160px">Status</th> -->
      <th class="no_sort printhidden" width="5%"></th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $i=1;
    $allmilk=0;
    $allsnf=0;
    $alltotal=0;
    $allfat=0;
    $allsnfprice=0;
    $allfatprice=0;
    $alltcprice=0;

    $allcommission=0;
    $grandtotal=0;
    if(is_array($transaction) && count($transaction)>0):
    
      foreach($transaction as $eachtran):
        $snf=($eachtran->fat+$eachtran->lacto+2)/4;
        $totalfat=$eachtran->fat*$eachtran->milk;
        $totalsnf=$snf*$eachtran->milk;
        $tc=$eachtran->fat+$snf;
        $fatprice=$totalfat*$eachtran->fat_rate;
        $snfprice=$totalsnf*$eachtran->snf_rate;
        $tcprice=$tc*$eachtran->milk*$eachtran->tc_rate;
        $total=$fatprice+$snfprice+$tcprice;
        $allmilk=$allmilk+$eachtran->milk;
        $allsnf=$allsnf+$totalsnf;
        $alltotal=$alltotal+$total;
        $allfat=$totalfat+$allfat;
        $allsnfprice=$allsnfprice+$snfprice;
        $allfatprice=$fatprice+$allfatprice;
        $alltcprice=$alltcprice+$tcprice;
        $commission=$eachtran->milk*$eachtran->commission;
        $allcommission=$allcommission+$commission;
        $grandtotal=$alltotal+$allcommission;
      ?>
    <tr class="table-condensed">
      <td class="pl-10 "><b class="fc-pink"><?php echo $i;?></td>
      <td><?php echo $eachtran->invoice_date;?></td>
      <td><?php echo $eachtran->milk;?></td>
      
      <td><?php echo round($eachtran->fat,3);?></td>
      <td><?php echo round($totalfat,3)?></td>
      <td><?php echo round($snf,3);?></td>
      <td><?php echo round($totalsnf,3);?></td>
      <td><?php echo round($tc,3);?></td>
      <td><?php echo round($fatprice,3);?></td>
      <td><?php echo round($snfprice,3);?></td>
      <td><?php echo round($tcprice,3);?></td>
      <td><?php echo round($total,3);?></td>
     
       
       <td class="text-center printhidden">
        <a href="<?php echo site_url('/'.ADMIN.'delete_data/'.$eachtran->id.'/sales_report/Receipt')?>" class="text-muted ml-20  deleteitem" onclick="return doconfirm();"><i class="fa fa-trash-o fs-25"></i></a>
      <!--   <a href="<?php //echo site_url('/'.STAFF.'reject_member_data/'.$eachtran->user_id)?>" class="text-muted deleteitem btn btn-danger btn-sm" onclick="return doconfirm();">Reject</a>--></td> 
   
    </tr>
    <?php 
              $i++;
              endforeach;
           else:
              ?>
    <tr class="table-condensed">
      <td colspan="12 ">No Records</td>
     </tr>  
    <?php
            endif;
         ?>
  </tbody>
 <!--  <tfoot>
    <tr><td colspan="6">Customer Report</td></tr>
    <tr>
        <td >Total Milk</td>
        <td >234234</td>
        <td >Total SNF</td>
        <td >234234</td>
        <td >Total</td>
        <td >234234234.234</td>
    </tr>
    <tr>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
    </tr> 
  </tfoot> -->
</table>
<div class="clearfix"></div>  
<table class="footable toggle-square-filled mb-0">
  <tr >
      <td colspan="6"> <strong>Customer Report</strong></td>
  </tr>
  <tr>
        <td >Total Milk : </td>
        <td ><?php echo round($allmilk,3);?></td>
        <td >Total SNF : </td>
        <td ><?php echo round($allsnf,3);?></td>
        <td >Total : </td>
        <td ><?php echo round($alltotal,3);?></td>
  </tr>
    <tr>
        <td >Total Fat : </td>
        <td ><?php echo round($allfat,3);?></td>
        <td >Total SNF Price: </td>
        <td ><?php echo round($allsnfprice,3);?></td>
        <td >Total Commission: </td>
        <td ><?php echo round($allcommission,3);?></td>
  </tr>

    <tr>
        <td >Total Fat Price : </td>
        <td ><?php echo round($allfatprice,3);?></td>
        <td >Total TC Price: </td>
        <td ><?php echo round($alltcprice,3);?></td>
        <td >Grand Total : </td>
        <td ><?php echo round($grandtotal,3);?></td>
  </tr>
</table>
 <ul class="pagination pull-right mb-0 mt-10 printhidden">
          <nav class="pagination_sec">
                      <ul class="pagination">
                        <?php if($links) { echo $links; }; ?>
                    </ul> 
                   </nav>
   </ul>



</div>
<!-- Aprove-Dealer-Form -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="approve_users_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content edit-profile p-20 no-radius">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="fa fa-times fs-25"></span></button>
      <div class="alert alert-success">
    <strong>Customer Id:</strong> <b>C<?php echo $userdata->id;?></b><br/>
     <strong>Customer Name:</strong> <b><?php echo $userdata->customer_name;?></b>
  </div>
      <h3 class="fw-6 mt-0 mb-30 col-xs-12">Milk Receipt</h3>
    
   <form class="clearfix p-15" method="post" id="addreceiptform" action="#">
        <div class="col-md-8 mb-15">
          <label>Receipt Date</label>
          <!-- <div class="input-group  "> -->
            <input autocomplete="off" readonly class="form-control no-radius filtertodate nepali-calendar" id="nepali-calendar" name="date" placeholder="YYYY/MM/DD" type="text" value="">
            <!-- <div class="input-group-addon no-radius"><i class="fa fa-calendar"></i></div> -->
         
        <!-- </div> -->
        </div>
        <div class="col-md-8 mb-15">
        <input type="hidden"   name="user_id" value="<?php echo $userdata->id;?>">
          <label>Milk</label>
         <input type="text" id="milkqty" name="milk" class="form-control no-radius" placeholder="Milk" >
         
        </div>
        <div class="col-md-8 mb-15">
          <label>Fat</label>
          <input type="text" id="fatqty" name="fat" class="form-control no-radius" placeholder="Fat">
        </div>
        <div class="clearfix"></div>
        <div class="col-md-8 mb-15">
          <label>Lacto</label>
          <input type="text" id="lactoqty" name="lacto" class="form-control no-radius" placeholder="Lacto">
        </div>
         <div class="clearfix"></div>
           
        <div class="text-right mt-30 col-xs-12">
          <button type="submit" class="btn btn-pink" id="addreceipt">Save</button>
        </div>
        <div class="clearfix"></div>
      </form>   
    </div>
  </div>
</div>
<script type="text/javascript">
      // var studentdetail='<?php echo site_url('/'.STAFF.'get_user')?>';
      // var approveuser='<?php echo site_url('/'.STAFF.'approve_user')?>';
      // var urlCheckDuplicateEmail = '<?php echo site_url("user/register/check_email_availability");?>';
      // var urlCheckDuplicateUsername = '<?php echo site_url("user/register/check_username_availability");?>';
</script>

<script>
 
</script>