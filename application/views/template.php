<!doctype html> 
<html lang="en">
    <head>
        <title><?php echo isset($title) ? $title : 'Consistent Helpdesk'; ?></title>

        <meta name="description" content="<?php echo isset($meta_description) ? $meta_description : 'Consistent Helpdesk'; ?>">

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php $this->load->view('common/link'); ?>

    </head>
    <body>
        <?php $this->load->view('common/header.php'); ?>

        <div class="wrapper">
            <?php $this->load->view('common/sidebar.php'); ?>
            <?php echo $this->load->view($content, null, true); ?>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="<?php echo base_url('public/site/js/popper.min.js'); ?>" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('public/site/js/bootstrap.min.js'); ?>" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
        <script src="<?php echo base_url('public/site/js/dirty.js'); ?>"></script>
     
    </body>
</html>