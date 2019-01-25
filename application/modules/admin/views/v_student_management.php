 <div class="incent_tab chart-tittle rds_to p-15">

 <?php 
 $registerclass='btn btn-default';
 $pendingclass='btn btn-default'; 
 if($secondary_view=='v_student_registered') $registerclass='btn btn-danger';
        else $pendingclass='btn btn-danger';

 ?>
    <a href="<?php echo site_url('/'.ADMIN.'student_management/pendingadmin')?>" class="<?php echo $pendingclass;?> col-xs-6">Approve Staff</a>
    <a href="<?php echo site_url('/'.ADMIN.'student_management/active')?>" class="<?php echo $registerclass   ;?> col-xs-6">Registered Staff</a>
    <div class="clearfix"></div>
</div>
        <div class="lite_gre_bg">
        <div class="title-sec no-shadow">
        <form class="p-relative">
            <input type="text" class="form-control filtername" placeholder="Search by name"><button class="btn btn-pink filteroptname"><i class="fa fa-search"></i></button>
          </form>
            </div>

            <div class="filterview">
              <?php $this->load->view($secondary_view); ?>
            </div>

            
<script type="text/javascript">
    var filterurl='<?php echo site_url('/'.ADMIN.'ajax_student_management/'.$type);?>';
    var documentattachmentpath ='<?php echo site_url(IDENTIFICATION_ATTACHMENT);?>';
    
</script>