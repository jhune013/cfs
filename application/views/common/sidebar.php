<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Consistent Helpdesk</h3>
    </div>

    <ul class="list-unstyled components">
        <h5><p>Hello, <?php echo $this->session->userdata('firstname'); ?> </p></h5>
        <p>Access Level: <?php echo $this->session->userdata('user_type'); ?></p>
        <li class="active">
             <a href="<?php echo base_url('helpdesk'); ?>">IT Helpdesk</a>
           
        </li>
        <li>
            <a href="<?php echo base_url('helpdesk/hr_helpdesk'); ?>">HR Helpdesk</a>
        </li>
        <li>
            <a href="#">Admin Helpdesk</a>
                
        </li>
    
    </ul>
</nav>