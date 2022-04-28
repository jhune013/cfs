
<div class="container">
 
  <div class="container">
<div class="row">
  <div class="col-md-12 text-right">
    <br>
  <a href="/" class="btn btn-primary"></i> Add New tickets</button></a>
</div>
</div>
</div>

  <h2>Ticket</h2>
  <br>
  <table class="table table-bordered">  
                <tr>  
                     <th>ID</th>  
                     <th>ticket id</th>  
                     <th>type of support</th>  
                     <th>issue type</th>  
                     <th>remarks</th> 
                      <th>status</th>
                      <th>validity</th>
                       <th>priority</th> 
                        <th>details</th> 
                         <th>employee name</th>
                          <th>assign</th>
                           <th>opening date</th>
                            <th>level agreement</th> 
                             <th>resolve</th> 
                              <th>to respond</th> 
                               <th>to resolve</th> 

                </tr>  
           <?php  
           if($fetch_data->num_rows() > 0)  
           {  
                foreach($fetch_data->result() as $row)  
                {  
           ?>  
                <tr>  
                     <td><?php echo $row->create_id; ?></td>  
                     <td><?php echo $row->ticket_id; ?></td>  
                     <td><?php echo $row->type_support; ?></td>
                     <td><?php echo $row->issue_name_type; ?></td>
                     <td><?php echo $row->remark; ?></td> 
                     <td><?php echo $row->status; ?></td>
                     <td><?php echo $row->validity; ?></td>
                      <td><?php echo $row->details; ?></td>
                       <td><?php echo $row->employee_name; ?></td>
                        <td><?php echo $row->assign; ?></td>
                         <td><?php echo $row->opening_date; ?></td>
                          <td><?php echo $row->service_level_agreement_status; ?></td>
                               <td><?php echo $row->datetime_to_respond; ?></td>
                               <td><?php echo $row->datetime_to_resolve; ?></td>
                     <td></td>  
                     <td></a></td>  
                </tr>  
           <?php       
                }  
           }  
           else  
           {  
           ?>  
                <tr>  
                     <td colspan="5">No Data Found</td>  
                </tr>  
           <?php  
           }  
           ?>  
           </table>  
</div>
  </div>
</div>