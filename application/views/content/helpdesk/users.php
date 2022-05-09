
<!-- ?php


echo "<pre>";
        print_r($records);
        die;


?>   -->


<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 pt-4">
            <h2>Users Management</h2>
        </div>
   <div class="col-lg-4 col-md-4 col-sm-12 pt-4 text-right">
    <a href="<?php echo base_url('helpdesk/add_new_user'); ?>" class="btn btn-primary"></i> Add New User</button></a>
    </div>
      </div>


    <div class="pt-5">
        <table class="table table-bordered" id="userlist">

            <thead>
                
                <tr>  
                    <th>Full name</th>
                
                    <th>User Type</th>
                    <th>Username</th>
                    <th>Email</th>
                   <!--  <th>Password</th> -->
                <!--    <th>Action</th> -->
                </tr> 
            </thead>
            <tbody>
<!-- < ?php foreach($records as $row){?>
<tr>

<td>< ?php echo $row->firstname;?> < ?php echo $row->lastname;?> </td>

<td>< ?php echo $row->user_type;?></td>
<td>< ?php echo $row->username;?></td>
<td>< ?php echo $row->email;?></td>


</tr>
< ?php }?> -->
            </tbody>
        </table>
    </div>
</div>