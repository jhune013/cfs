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


        <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
            <div class="container">
                <a class="navbar-brand" href="<?php echo base_url('helpdesk'); ?>">Consistent Frozen </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-5" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>


        <div class="wrapper">
            <div class="container">
                <?php echo $this->load->view($content, null, true); ?>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="<?php echo base_url('public/site/js/popper.min.js'); ?>" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('public/site/js/bootstrap.min.js'); ?>" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('public/site/js/dirty.js'); ?>"></script>
        
    </body>
</html>