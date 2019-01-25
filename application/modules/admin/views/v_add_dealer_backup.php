  <?php 
  $name='';
  $username='';
  $email='';
  $dealerid='';
  $operatorval='';
  // $outletidarr=array();
$noval=array();
  if($dealer)
  {
  	$name= $dealer->display_name;
  	$username=$dealer->username;
  	$email=$dealer->email;
  	$dealerid=$dealer->id; 
  	$operatorval=$dealer->operator;
  }
if($this->input->post('operator')) $operatorval=$this->input->post('operator');
if($this->input->post('dealer_name')) $name=$this->input->post('dealer_name');
if($this->input->post('dealer_name')) $email=$this->input->post('email');
if($this->input->post('username')) $username=$this->input->post('username');
$password=$this->input->post('password');
$outletid='';	
$retype_password=$this->input->post('retype_password');
if($this->input->post('parentid')) $parentidarr=$this->input->post('parentid') ;
if($this->input->post('outletid')) $outletidarr=$this->input->post('outletid') ;
if($this->input->post('type')) $typearr=$this->input->post('type');
if($this->input->post('outletname')) $outletnamearr=$this->input->post('outletname');
if($this->input->post('unitno')) $unitnoarr=$this->input->post('unitno');
if($this->input->post('streetname')) $streetnamearr=$this->input->post('streetname');
if($this->input->post('postalcode')) $postalcodearr=$this->input->post('postalcode');
$count=0;

if($this->input->post())
{
	$count=count($outletidarr);	
}
elseif($outlet!=false && count($outlet)>0)
{
	$count=count($outlet);
}
else{
	$count=0;
}

?>

   <form class="" method="post" id="adddealerform">
        <div class="lite_gre_bg">
		          <h4 class="m-0 p-20"><b><?php echo ucfirst($action_type)?> Dealer</b></h4>
		          <div class="bg-white p-20">
			          <div class="row mb-15">
			         
			            <input type="hidden" class="form-control no-radius" name="id" id="parentuserid" value="<?php echo $dealerid;?>">
			        
					          <div class="col-xs-6"><label>Incharge Dealer Email</label>
					          		<input type="text" class="form-control no-radius" name="email" placeholder="Email" value="<?php echo $email;?>">
					          		<?php echo form_error('email');?>
					          </div>
					            <div class="col-xs-6"><label>Operator</label>
					          		<select class="form-control mb-15 no-radius" name="operator">
			                            <option value="">---Select---</option>
			                            <?php
			                               if(is_array($operators) && count($operators)>0):
			                               foreach($operators as $eachoperator):?>
			                              <option <?php if($eachoperator->id==$operatorval) echo 'selected';?> value="<?php echo $eachoperator->id;?>">	<?php echo $eachoperator->operator?></option>
			                           		 <?php 
			                            	endforeach; 
			                              endif;
                          				  ?>
                   					 </select>
					          		<?php echo form_error('operator');?>
					          </div>
					        
					    </div>
					     <div class="row mb-10">
				     		<div class="col-xs-6"><label>New Password</label>
					          		<input type="password" name="password" id="password" class="form-control no-radius" placeholder="Password"  >
					          		<?php echo form_error('password');?>
					        </div>
					       <div class="col-xs-6"><label>Dealer Name</label>
					          		<input type="text" id="dealername"  name="dealer_name" class="form-control no-radius" placeholder="Name" value="<?php echo $name;?>">
					          		<?php echo form_error('dealer_name');?>
					          </div>
					        
					     </div>
					     <div class="row mb-10">
					          <div class="col-xs-6"><label>Re-type New Password</label>
					          		<input type="password" name="retype_password" class="form-control no-radius" placeholder="Re-type Password" >
					          		<?php echo form_error('retype_password');?>
					          </div>
					           <div class="col-xs-6	"><label>Dealer Id</label>
					          		<input type="text" name="username" class="form-control no-radius" placeholder="Id" value="<?php echo $username;?>">
					          		<?php echo form_error('username');?>
					          </div>
					      </div>
			          
		          </div>
		          <h4 class="m-0 p-20 pull-left col-xs-12"><b>Outlet List</b> <a class="btn btn-pink pull-right add_outlet">Add Outlet</a></h4>
		          <div class="clearfix"></div>
		        	<div class="scroll">
		          <table class="table toggle-square-filled mb-0 add-dealer" id="dealeraddtable">
		            <thead>
		              <tr class="bg-white">
		                <th class="text-center" style="min-width:35px">No</th>
		                <th class="" style="min-width:105px">ID</th>
		                <th class="" style="min-width:75px">Type</th>
		                <th style="min-width:155px">Outlet</th>
		                <th class="" style="min-width:90px">Unit No</th>
		                <th class="" style="min-width:150px">Street Name</th>
		                <th class="" style="min-width:155px">Postal Code</th>
		                <th class=" text-center" style="min-width:60px">Delete</th>
		              </tr>
		            </thead>
		            <tbody class="tbodyaddoutlet">
		           <?php if($count>0):
		           // echo validation_errors();
		           for($i=0 ;$i<$count;$i++) :

		         	  $outletid='';
					  $type='';
					  $outletname='';
					  $unit_no='';
					  $streetname='';
					  $postalcode='';
					  $id='';

				   if(($this->input->post() && isset($parentidarr["a$i"]))) $id=$parentidarr["a$i"];elseif($outlet) $id=$outlet[$i]->id;
		           	if($this->input->post() && isset($outletidarr["a$i"])) $outletid=$outletidarr["a$i"]; elseif($outlet) $outletid=$outlet[$i]->outlet_id;

		           	if(($this->input->post() && isset($typearr["a$i"]))) $type=$typearr["a$i"]; elseif($outlet) $type=$outlet[$i]->type;
		           	if($this->input->post() && isset($outletnamearr["a$i"])) $outletname=$outletnamearr["a$i"]; elseif($outlet) $outletname=$outlet[$i]->outlet;
		           	if($this->input->post() && isset($unitnoarr["a$i"])) $unit_no=$unitnoarr["a$i"]; elseif($outlet) $unit_no=$outlet[$i]->unit_no;
		           	if($this->input->post() && isset($streetnamearr["a$i"])) $streetname=$streetnamearr["a$i"]; elseif($outlet) $streetname=$outlet[$i]->street_name;
		           	if($this->input->post() && isset($postalcodearr["a$i"])) $postalcode=$postalcodearr["a$i"]; elseif($outlet) $postalcode=$outlet[$i]->postalcode;
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
			                 <td>
			                	<input type="text" class="inputelement form-control no-radius postalcode-input" name="postalcode[a<?php echo $i;?>]" placeholder="Postal Code" value="<?php echo $postalcode;?>">
			                	<?php echo form_error("postalcode[a$i]");?>
			                </td>
			                <td class="text-center"><a class="text-muted fs-20 delete_outlet" data-outlet="<?php echo $id ?>"><i class="fa fa-trash-o"></i></a></td>
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
			                	<!-- <input type="text" class="inputelement form-control no-radius" name='outletname[1]' placeholder="Outlet id"> -->
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
			                 <td>
			                	<input type="text" class="inputelement form-control postalcode-input no-radius" name="postalcode[a0]" placeholder="Postal Code">
			                	<?php echo form_error('postalcode[a0]');?>
			                </td>
			                <td class="text-center"><a class="text-muted fs-20 delete_outlet"><i class="fa fa-trash-o"></i></a></td>
		              </tr>  
		         	<?php
		             	endif;
		             ?>   
		            </tbody>
		          </table>
		          </div>
		          <?php 
		          if($action_type=='edit') $action_type='editaction';
		          ?>

		          <div class="text-right p-20 bg-white no-shadow"><button type="submit" data-type="<?php echo $action_type;?>" class="btn btn-pink" id="<?php echo $action_type;?>dealerbtn">Save</button></div>

        </div>          
  </form>
  <script>

    var urlCheckDuplicateEmail = '<?php echo site_url("user/register/check_email_availability");?>';
    var urlCheckDuplicateUsername = '<?php echo site_url("user/register/check_username_availability");?>';
    var deleteoutlet ='<?php echo site_url("/".MY_ACCOUNT."/delete_data/")?>'
    </script>