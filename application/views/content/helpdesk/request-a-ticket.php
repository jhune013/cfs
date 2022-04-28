<div class="container p-4">
 
    <div class="container">

        <ul class="nav nav-tabs responsive-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Create your Ticket</a>
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
                    <form class="form" action="<?php echo base_url('helpdesk/create_your_ticket'); ?>" method="post">
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
                                                    <?php foreach ($support_types as $row): ?>
                                                        <option value="<?php echo $row->type_id; ?>"><?php echo $row->support_type; ?></option>
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
                                    <select class="form-control" id="remark" name="remark">
                                        <option value="" selected disabled hidden>Select...</option>
                                        <?php if ($remarks): ?>
                                            <?php foreach ($remarks as $row): ?>
                                                <option value="<?php echo $row->remark_id; ?>"><?php echo $row->remark_name; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-parent">
                                    <label class="control-label" style="padding-right: 0px;">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="" selected disabled hidden>Select...</option>
                                        <?php if($status):?>
                                            <?php foreach($status as $row): ?>
                                                <?php
                                                    $selected_status    =   "";

                                                    if ($row->status_id == 1) {
                                                        $selected_status    =   'selected';
                                                    }
                                                ?>
                                                <option value="<?php echo $row->status_id; ?>" <?php echo $selected_status; ?>><?php echo $row->status_name; ?></option>
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
                                            <?php foreach($validity as $row): ?>
                                                <option value="<?php echo $row->validity_id; ?>"><?php echo $row->validity_name; ?></option>
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
                                            <?php foreach($priority as $row): ?>
                                                <?php
                                                    $selected_priority    =   "";

                                                    if ($row->id == 1) {
                                                        $selected_priority    =   'selected';
                                                    }
                                                ?>
                                                <option value="<?php echo $row->id; ?>" <?php echo $selected_priority; ?>><?php echo $row->priority_name; 
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
                                <div class="form-group form-parent">
                                    <p><b><span class="required">*</span>Details</b></p>
                                    <textarea class="summernote" name="details" id="details"></textarea> 
                                </div>
                            </div>
                            <div class="col-md-3 offset-md-9 pt-4">
                                <button type="submit" class="btn btn-primary w-100">SUBMIT</button>
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