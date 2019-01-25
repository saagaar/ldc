<div class="filterview">
<table class="table footable toggle-square-filled product_manage mb-0">
            <thead>
              <tr class="bg-white">
                <th class="no_sort text-center" width="1%">C.No</th>
                <th data-hide="phone,tablet" class="no_sort" width="20%"> Full Name</th>
                <th data-hide="phone,tablet" class="no_sort text-center" width="20%">Address</th>
                <th class="no_sort" width="4%">Phone</th>
                <th data-hide="phone" class="no_sort" width="2%">Fat Rate</th>
                 <th class="no_sort" width="2%">SNF Rate</th>
                 <th class="no_sort" width="2%">TC Rate</th>
                 <th class="no_sort" width="2%">Commission</th>
                <th data-hide="phone" class="no_sort text-center" width="20%">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            $i=1;
          
            if(is_array($members) && count($members)>0)
            {
	            foreach($members as $eachmember):
	            ?>
	              <tr class="bg-white no-shadow">                                          
	                <td class="text-center"><?php echo 'C'.$eachmember->member_id;?></td>
	                <td><?php echo $eachmember->customer_name;?></td>
	                <td><?php echo $eachmember->address;?></td>
	                <td><?php echo $eachmember->phone;?></td>
	                <td><?php echo $eachmember->fat_rate;?></td>
	                <td><?php echo $eachmember->snf_rate;?></td>
	                <td><?php echo $eachmember->tc_rate;?></td>
	                <td><?php echo $eachmember->commission;?></td>
	                <!-- <td><?php  if($eachmember->sales_status=='0') echo 'Claimed'; else echo 'Available';?></td> -->
	              
	                <td class="text-center">
	                <a href="<?php echo site_url('/'.ADMIN.'transaction/'.$eachmember->member_id)?>" data-memberid="<?php echo $eachmember->member_id;?>" class="btn btn-default 			"><i class="fa fa-eye"></i></a> 
	                <a href="#" data-memberid="<?php echo $eachmember->member_id;?>" class="btn btn-default edit_customer"><i class="fa fa-edit fs-25 "></i></a> 

	                <a href="<?php echo site_url('/'.ADMIN.'delete_data/'.$eachmember->member_id.'/members/Member')?>" class="text-muted ml-20 deleteitem" onclick="return doconfirm();"><i class="fa fa-trash-o fs-25"></i></a></td>
	              </tr>

	          <?php 
	          $i++;
	          endforeach;
	        }
	        else{
	        	?>
	        	 <tr class="bg-white no-shadow">
	        	 	<td colspan="9">No Records</td>
	        	 </tr>
				<?php
	        	}
	       ?>
            
            </tbody>
</table>

 <ul class="pagination pull-right mb-0 mt-10">
          <nav class="pagination_sec">
                      <ul class="pagination">
                        <?php if($links) { echo $links; }; ?>
                    </ul>	
                   </nav>
   </ul>

<script>
	var filterurl="<?php echo site_url('/'.ADMIN.'/ajax_management/')?>"
</script>
</div>