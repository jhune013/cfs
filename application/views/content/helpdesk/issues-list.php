<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 pt-4">
            <h2>Ticket</h2>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 pt-4 text-right">
            <a href="<?php echo base_url('helpdesk/request_a_ticket'); ?>" class="btn btn-primary"></i> Add New tickets</button></a>
        </div>
    </div>


<!--  <div class="category-filter">
      <select id="categoryFilter" class="form-control">
        <option value="">Show All</option>
        <option value="Open">Open</option>
        <option value="Replied">Replied</option>
        <option value="On Hold<">On Hold</option>
      </select>
    </div> -->

    <div class="pt-5">
        <table class="table table-bordered" id="issue_list_tbl">

            <thead>
                
                <tr>  
                    <th>Subject</th>
                    <th>Issue Type</th>
                    <th>Employee</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Assignee</th>
                </tr> 
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>