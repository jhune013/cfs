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
                <div class="container">
                    <div class="row">
                        <div class="col-8">
                            <br>
                            <form name="myForm" id="new-ticket-form" class="" action="/" method="post">
                                <div class="form-row">
                                    <div class="col form-group">
                                    </div>
                                    <div class="col form-group">
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
                                <div class="form-row">
                                    <div class="col form-group">
                                    </div>
                                    <div class="col form-group">
                                        <span class="required">*</span>
                                        <label class="control-label" style="padding-right: 0px;">Issue Type</label>

                                        <select class="form-control" id="issue_name_type" name="issue_name_type">
                                            <option value="" selected disabled hidden>Select...</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="col form-group">
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
                                    <div class="col form-group">
                                        <label class="control-label" style="padding-right: 0px;">Status</label>
                                        <select class="form-control" id="status" name="status"  >
                                            <option value="" selected disabled hidden>Select...</option>
                                            <?php if($status):?>
                                                <?php foreach($status as $row): ?>
                                                    <option value="<?php echo $row->status_id; ?>"><?php echo $row->status_name; 
                                                    ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col form-group">
                                        <label class="control-label" style="padding-right: 0px;">Validity</label>
                                        <select class="form-control" id="validity" name="validity">
                                            <option value="" selected disabled hidden>Select...</option>
                                            <?php if($validity):?>
                                                <?php foreach($validity as $row): ?>
                                                    <option value="<?php echo $row->validity_id; ?>"><?php echo $row->validity_name; 
                                                    ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col form-group">
                                        <label class="control-label" style="padding-right: 0px;">Priority</label>
                                        <select class="form-control" id="priority" name="priority"  >
                                            <option value="" selected disabled hidden>Select...</option>
                                            <?php if($priority):?>
                                                <?php foreach($priority as $row): ?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->priority_name; 
                                                    ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="col form-group">
                                    <p><b><span class="required">*</span>Details</p></b>
                                    <textarea  name="details" id="details"></textarea> 
                                </div>
                            </form>
                        </div>
                    </div>
              </div>
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">sdsds</div>
          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">ddfdf</div>
        </div>
    </div>
</div>