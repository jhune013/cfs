<div class="container">
 
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
                <br>
                <button type="submit" form="new-ticket-form" class="btn btn-primary btn-sm">Save</button>
            </div>
        </div>

        <ul class="nav nav-tabs responsive-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Create your Ticket</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"Service Level Agreement</a>
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
                            <form name="myForm" id="new-ticket-form" class="" onsubmit="return validateForm()" action="/" method="post">
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
                                                    <option value="<?php echo $row->support_type; ?>"><?php echo $row->support_type; ?></option>
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
                                        </select>
                                    </div>
                                    <div class="col form-group">
                                        <label class="control-label" style="padding-right: 0px;">Status</label>
                                        <select class="form-control" id="status" name="status"  >
                                            <option  value="" disabled selected>-- Please choose an option --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col form-group">
                                        <label class="control-label" style="padding-right: 0px;">Validity</label>
                                        <select class="form-control" id="validity" name="validity">
                                        </select>
                                    </div>
                                    <div class="col form-group">
                                        <label class="control-label" style="padding-right: 0px;">Priority</label>
                                        <select class="form-control" id="priority" name="priority"  >
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