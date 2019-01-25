<div class="dealer-report sales-status">
    <div class="chart-tittle rds_to">

        
        <?php
        $edit_profile_class = 'btn btn-default';
        $pendingclass = 'btn btn-default';
        if (isset($sub_menu) && $sub_menu == 'approve_staff')
            $pendingclass = 'btn btn-danger';
        else
            $edit_profile_class = 'btn btn-danger';
        ?>

        <a href="<?php echo site_url('/' . ADMIN . '/staff_management/pending') ?>" class="<?php echo $pendingclass; ?>  col-xs-6" >Approve New Staff</a>
        <a href="<?php echo site_url('/' . ADMIN . '/staff_management/edit_profile') ?>" class="<?php echo $edit_profile_class; ?>  col-xs-6">Approve Change Information</a>
        <div class="clearfix"></div>
    </div>

    <form name="approveusers" method="post" >
        <div>
            <div class="">
                <div class="mt-15 mb-15">
                    <h3 class="mt-0 fw-6 col-xs-5"><?php if (isset($job)) echo $job; ?></h3>
                    <div class="col-xs-7 p-0">
                        
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <span class="drop fa p-relative">
                                <select class="form-control filter filterdealer">
                                    <option value="">All Dealers</option>
                                    <?php
                                     foreach ($dealerlist as $list): ?>
                                        <option value="<?php echo $list->id ?>"><?php echo $list->display_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="filterview">

                <?php $this->load->view($secondary_view); ?>
                <div class="col-sm-12 col-xs-12 text-right ar pt-10 pr-5">
                        <?php if($sub_menu=='approve_staff'):?>
                            <button class="btn btn-primary btn-sm multipleselect hidden" formAction="<?php echo site_url('/' . ADMIN . '/approve_user') ?>" onclick="return doconfirmaccept();">Approve</button>
                            <button class=" multipleselect btn btn-danger btn-sm hidden" formAction="<?php echo site_url('/' . ADMIN . '/reject_member_data') ?>" onclick="return doconfirmreject();">Reject</button>
                        <?php endif;?>
                        </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    var filterurl = '<?php echo site_url('/' . ADMIN . '/ajax_staff_management/' . $type); ?>'
</script>