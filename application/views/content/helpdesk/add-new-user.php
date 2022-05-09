<div class="container p-4">
<div class="container">

        <ul class="nav nav-tabs responsive-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">User Profile</a>
            </li>
          <!--   <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Service Level Agreement</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false>">Reference</a>
            </li> -->
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="container pt-4">
                  
`                 
                    <form class="form" action="<?php echo base_url('helpdesk/create_user'); ?>" method="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                            	 <div class="form-group form-parent">
                            	  <span class="required">*</span>
                            	<label class="control-label" style="padding-right: 0px;">First Name</label>
                            	<input type="firstname" class="form-control" id="firstname" name="firstname">
                            </div>
                             </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-parent">
                                            <span class="required">*</span>
                                            <label class="control-label" style="padding-right: 0px;">Last Name</label>
                                          <input type="lastname" class="form-control" id="lastname" name="lastname">
                                        </div>
                                    </div>

                                    
                                </div>  
                            </div>
                        </div>
                 
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group form-parent">
                                    <label class="control-label" style="padding-right: 0px;">Email</label>
                                     <input type="email" class="form-control" id="email"  name="email">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-parent">
                                	  <span class="required">*</span>
                                    <label class="control-label" style="padding-right: 0px;">Username</label>
                                    <input type="username" class="form-control" id="username"  name="username">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-parent">
                                    <label class="control-label" style="padding-right: 0px;">Password</label>
                                   <input type="password" class="form-control" name= "password" id="password">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-parent">
                                    <label class="control-label" style="padding-right: 0px;">User Type</label>
                                    <select class="form-control" id="user_type" name="user_type">
                                        <option value="" selected disabled hidden>Select...</option>
                                         <?php if($user_type):?>
                                            <?php foreach($user_type as $x): ?>

                                                <?php
                                                    $selected  =   '';

                                                    if (isset($row)) {
                                                        if ($row->role_id == $x->role_id) {
                                                            $selected  =   'selected';
                                                        }
                                                    }
                                                ?>
                                                <option value="<?php echo $x->role_id; ?>" <?php echo $selected; ?>><?php echo $x->user_type; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                            </div>
                             <!-- <div class="col-md-6">
                                <div class="form-group form-parent">
                                	<input class="form-check-input" type="checkbox" id="check1" name="option1" value="" checked>
  									<label class="control-label">Active / Inactive </label>
                                </div>
                            </div> -->
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- <div class="form-group form-parent">
                                    <p><b><span class="required">*</span>Details</b></p>
                                  
                                </div> -->
                            </div>

                            <div class="col-md-3 offset-md-9 pt-4">
                                <button type="submit" class="btn btn-primary w-100">Submit</button> 
                                 </div>
                            
                        </div>
                        
                    </form>
              </div>
          </div>
         <!--  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">sdsds</div>
          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">ddfdf</div> -->
        </div>
    </div>


</div>