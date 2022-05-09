<?php
    $tab_1          =   ($viewing ? 'View your Ticket' : 'Create your Ticket');
    $action         =   ($viewing ? base_url('helpdesk/update/'.$row->create_id): base_url('helpdesk/create_your_ticket'));
    $btn_edt        =   ($viewing ? 'Update' : 'SUBMIT');
     $txt_details   =   '';

    if (isset($row)) {
        if ($row) {
            $txt_details    =   $row->details;
        }
    }
?>

<div class="container p-4">
 
    <div class="container">

        <ul class="nav nav-tabs responsive-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo $tab_1; ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Service Level Agreement</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false>">Reference</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="container pt-4">
                    
                    <?php if ($viewing): ?>
                        <?php if ($time_to_respond && $time_to_resolve): ?>
                            <div>PUT NOTIFICATION - TIME TO RESPOND & RESOLVE FAILED</div>
                        <?php elseif ($time_to_respond): ?>
                            <div>PUT NOTIFICATION - TIME TO RESPOND FAILED</div>
                        <?php elseif ($time_to_resolve): ?>
                            <div>PUT NOTIFICATION - TIME TO RESOLVE FAILED</div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- <form class="form" id="editForm" action="< ?php echo base_url(); ?>helpdesk/update/< ?php echo $row->create_id; ?>" method="post"> -->
                    <form class="form" id="editForm" action="<?php echo $action; ?>" method="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-parent">
                                            <span class="required">*</span>
                                            <label class="control-label" style="padding-right: 0px;">Type of support</label>

                                            <select class="form-control" id="typeofsupport" name="typeofsupport">
                                                <option value="" selected disabled hidden>Select...</option>
                                                <?php if ($support_types): ?>
                                                    <?php foreach ($support_types as $x): ?>
                                                        <?php
                                                            $selected  =   '';

                                                            if (isset($row)) {
                                                                if ($row->type_id == $x->type_id) {
                                                                    $selected  =   'selected';
                                                                }
                                                            }
                                                        ?>
                                                        <option value="<?php echo $x->type_id; ?>" <?php echo $selected; ?>><?php echo $x->support_type; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-parent">
                                            <span class="required">*</span>
                                            <label class="control-label" style="padding-right: 0px;">Issue Type</label>

                                            <select class="form-control" id="issue_name_type" name="issue_name_type">
                                                <option value="" selected disabled hidden>Select...</option>

                                                <?php if (isset($issue_types)): ?>
                                                    <?php if ($issue_types): ?>
                                                        <?php foreach ($issue_types as $x): ?>

                                                            <?php
                                                                $selected  =   '';

                                                                if (isset($row)) {
                                                                    if ($row->issue_id == $x->issue_type_id) {
                                                                        $selected  =   'selected';
                                                                    }
                                                                }
                                                            ?>
                                                            <option value="<?php echo $x->issue_type_id; ?>" <?php echo $selected; ?>><?php echo $x->issue_name_type; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group form-parent">
                                    <label class="control-label" style="padding-right: 0px;">Other Remark</label>
                                    <select class="form-control" id="remark" name="remark"  >
                                        <option value="" selected disabled hidden>Select...</option>
                                        <?php if ($remarks): ?>
                                            <?php foreach ($remarks as $x): ?>

                                                <?php
                                                    $selected  =   '';

                                                    if (isset($row)) {
                                                        if ($row->remark_id == $x->remark_id) {
                                                            $selected  =   'selected';
                                                        }
                                                    }
                                                ?>
                                                <option value="<?php echo $x->remark_id; ?>" <?php echo $selected; ?>><?php echo $x->remark_name; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-parent">
                                    <label class="control-label" style="padding-right: 0px;">Status</label>
                                    <select class="form-control" id="status" name="status"  required>
                                        <option value="" selected disabled hidden>Select...</option>
                                        <?php if($status):?>
                                            <?php foreach($status as $x): ?>
                                                <?php
                                                    $selected_status    =   "";


                                                    if (isset($row)) {
                                                        if ($row) {
                                                            if ($row->status_id == $x->status_id) {
                                                                $selected_status  =   'selected';
                                                            }
                                                        } else {
                                                            if ($x->status_id == 1) {
                                                                $selected_status    =   'selected';
                                                            }
                                                        }
                                                    } else {
                                                        if ($x->status_id == 1) {
                                                            $selected_status    =   'selected';
                                                        }
                                                    }
                                                ?>
                                                <option value="<?php echo $x->status_id; ?>" <?php echo $selected_status; ?>><?php echo $x->status_name; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-parent">
                                    <label class="control-label" style="padding-right: 0px;">Validity</label>
                                    <select class="form-control" id="validity" name="validity">
                                        <option value="" selected disabled hidden>Select...</option>
                                        <?php if($validity):?>
                                            <?php foreach($validity as $x): ?>

                                                <?php
                                                    $selected  =   '';

                                                    if (isset($row)) {
                                                        if ($row->validity_id == $x->validity_id) {
                                                            $selected  =   'selected';
                                                        }
                                                    }
                                                ?>
                                                <option value="<?php echo $x->validity_id; ?>" <?php echo $selected; ?>><?php echo $x->validity_name; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-parent">
                                    <label class="control-label" style="padding-right: 0px;">Priority</label>
                                    <select class="form-control" id="priority" name="priority" required>
                                        <option value="" selected disabled hidden>Select...</option>
                                        <?php if($priority):?>
                                            <?php foreach($priority as $x): ?>
                                                <?php
                                                    $selected_priority    =   "";

                                                    if ($x->id == 1) {
                                                        $selected_priority    =   'selected';
                                                    }
                                                ?>
                                                <option value="<?php echo $x->id; ?>" <?php echo $selected_priority; ?>><?php echo $x->priority_name; 
                                                ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b><span class="required">*</span>Details</b></p>
                            </div>
                            <?php if ($viewing): ?>
                                <?php if ($details): ?>
                                    <div class="col-md-12">
                                        <?php foreach ($details as $x): ?>
                                            <div style="background: #F8F9FA;padding: 10px;border-radius: 5px;margin-bottom: 5px;">
                                                <?php echo $x->td_message;?>
                                                <div><?php echo $x->firstname . ' ' . $x->lastname . ' - ' . mydate('M d, Y g:i:s.v A', mystrtotime($x->td_created)); ?></div>
                                            </div>
                                        <?php endforeach;?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <div class="col-md-12 pt-4">
                                <div class="form-group form-parent">
                                    <textarea class="summernote" name="details" id="details"></textarea> 
                                </div>
                            </div>

                            <div class="col-md-3 offset-md-9 pt-4">
                                <button type="submit" class="btn btn-primary w-100"><?php echo $btn_edt; ?></button> 
                                 </div>
                              <div class="col-md-3 offset-md-9 pt-4">
                               <!--  <button type="submit" class="btn btn-primary w-100">edit</button> 
 -->
                            </div>
                        </div>
                    </form>
              </div>
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">sdsds</div>
          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">ddfdf</div>
        </div>
    </div>
</div>