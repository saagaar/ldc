 <?php  


if((($message)))
{

 foreach($message as $messagedetail){
    $class='';
    // if($usertype=='brand')
  if($messagedetail->ismsgseen=='0'){
    $class="unseenmsg";
  }
  ?>
                            <tr class="msglist <?php echo $class;?>">
                           
                                   
                                <td width="5%"><input type="checkbox"></td>
                                <td width="35%" class="relative"><a href="#open_msz" data-toggle="tab"> <?php echo $messagedetail->receiver_email?></a><?php if($class=='unseenmsg'){?><span class="new_msg">New</span> <?php } ?>
                                </td>
                                <td width="60%"><a href="#open_msz" data-toggle="tab"><b><?php echo substr($messagedetail->message,0,50).'...';?></a></td>
                                
                          </tr>
 <?php               } 
}else{
    ?>
  <tr>  <td colspan="3"><?php echo 'No Records found';?></td></tr>
    <?php 
}
