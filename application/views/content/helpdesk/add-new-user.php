<?php
    $tab_1          =   ($viewing ? 'View your User Profile' : 'User Profile');
   // $action         =   ($viewing ? base_url('helpdesk/update'): base_url('helpdesk/create_your_ticket'));
     $btn_edt        =   ($viewing ? 'Update' : 'SUBMIT');

   // if (isset($row)) {
   //      if ($row) {
   //          $txt_details    =   $row->details;
   //      }
   //  }
?>


<div class="container p-4">
<div class="container">

        <ul class="nav nav-tabs responsive-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo $tab_1; ?></a>
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
                                       <?php if ($firstname): ?>
                                                    <?php foreach ($firstname as $x): ?>
                                                        <?php
                                                         $selected  =   '';

                                                           if (isset($row)) {
                                                                if ($row->firstname == $x->firstname) {
                                                                   $selected  =   'selected';
                                                                }
                                                            }
                                                        ?>
                            	<input type="firstname" class="form-control" id="firstname" name="firstname" value="<?php echo $x->firstname; ?>" <?php echo $selected; ?>>
                                     <?php endforeach; ?>
                                                     <?php endif; ?>
                            </div>

                             </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-parent">
                                            <span class="required">*</span>
                                            <label class="control-label" style="padding-right: 0px;">Last Name</label>
                                          <!--   < ?php if ($lastname): ?> -->
                                            <!--         < ?php foreach ($lastname as $x): ?>
                                                        < ?php
                                                            $selected  =   '';

                                                           if (isset($row)) {
                                                            //    if ($row->lastname == $x->lastname) {
                                                                   $selected  =   'selected';
                                                                }
                                                            }
                                                        ?> -->
                                          <input type="lastname" class="form-control" id="lastname" name="lastname"> <!-- value="< ?php echo $x->lastname; ?>" < ?php echo $selected; ?>>
                                     < ?php endforeach; ?>
                                                < ?php endif; ?> -->
                                        </div>
                                    </div>

                                    
                                </div>  
                            </div>
                        </div>
                 
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group form-parent">
                                    <label class="control-label" style="padding-right: 0px;">Email</label>
                                     <!-- < ?php if ($email): ?>
                                                    < ?php foreach ($email as $x): ?>
                                                        < ?php
                                                            $selected  =   '';

                                                            if (isset($row)) {
                                                                if ($row->email == $x->email) {
                                                                    $selected  =   'selected';
                                                                }
                                                            }
                                                        ?> -->
                                     <input type="email" class="form-control" id="email"  name="email"> <!-- value="< ?php echo $x->email; ?>" < ?php echo $selected; ?>>
                                     <  ?php endforeach; ?>
                                                < ?php endif; ?> -->
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-parent">
                                	  <span class="required">*</span>
                                    <label class="control-label" style="padding-right: 0px;">Username</label>
                                   <!--  < ?php if ($username): ?>
                                                    < ?php foreach ($username as $x): ?>
                                                        < ?php
                                                            $selected  =   '';

                                                            if (isset($row)) {
                                                                if ($row->username == $x->username) {
                                                                    $selected  =   'selected';
                                                                }
                                                            }
                                                        ?> -->
                                    <input type="username" class="form-control" id="username"  name="username"> <!-- value="< ?php echo $x->username; ?>" < ?php echo $selected; ?>>
                                    < ?php endforeach; ?>
                                                < ?php endif; ?> -->
                                </div>
                            </div>

                            <!-- <div class="col-md-6">
                                <div class="form-group form-parent">
                                    <label class="control-label" style="padding-right: 0px;">Password</label>
                                   <input type="password" class="form-control" name= "password" id="password">
                                </div>
                                <div class="form-group form-parent">
                                <span class="input-group-text" toggle="#password"><i class="fa fa-fw fa-eye field-icon toggle-password"></i></span>
                            </div>
                            </div> -->
                              <div class="col-md-6">
                             <div class="form-group form-parent">
                                   <label>Password</label>
                                   <!-- < ?php if ($password): ?>
                                                    < ?php foreach ($password as $x): ?>
                                                        < ?php
                                                            $selected  =   '';

                                                            if (isset($row)) {
                                                                if ($row->password == $x->password) {
                                                                    $selected  =   'selected';
                                                                }
                                                            }
                                                        ?> -->
                        <div class="input-group">
                            <div class="input-group-prepend">
                               
                            </div>
                         <input type="password" class="form-control" name="txt_password" id="txt_password" placeholder="•••••" value=""><!-- < ?php echo $x->password; ?>" < ?php echo $selected; ?>>
                                    < ?php endforeach; ?>
                                                < ?php endif; ?> -->

                            <div class="input-group-prepend">
                                <span class="input-group-text" toggle="#txt_password"><i class="fa fa-fw fa-eye field-icon toggle-password"></i></span>
                            </div>
                        </div>
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
                                                    $selected_status    =   "";


                                                    if (isset($row)) {
                                                       
                                                            if ($row->role_id == $x->user_type_id) {
                                                                $selected_status  =   'selected';
                                                            }
                                                        }
                                                    
                                                ?>
                                                

                                               <option value="<?php echo $x->user_type_id; ?>" <?php echo $selected_status; ?>><?php echo $x->user_type; ?></option>
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
                                <button type="submit" class="btn btn-primary w-100"><?php echo $btn_edt; ?></button> 
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