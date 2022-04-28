<div class="row justify-content-center align-items-center text-left pt-5 mt-4">
    <div class="m-6 col-sm-8 col-md-6 col-lg-4 shadow-sm p-5 mb-5 bg-white border rounded">
        <div class="pt-5 pb-5">
            <img class="rounded mx-auto d-block" src="<?php echo base_url('public/img/CONSISTENTofficialLOGO2018.png'); ?>" alt="" width=110px height=70px>
        
            <hr>

            <div class="main-login main-center">
                <form class="form" method="POST">
                    <div class="form-group form-parent">
                        <label>Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user fa" aria-hidden="true"></i></div>
                            </div>
                            <input type="text" class="form-control" name="txt_username" id="txt_username" placeholder="Type your username" placeholder="Username">
                        </div>
                    </div>

                    <div class="form-group form-parent">
                        <label>Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></div>
                            </div>
                         <input type="password" class="form-control" name="txt_password" id="txt_password" placeholder="•••••"value="">

                            <div class="input-group-prepend">
                                <span class="input-group-text" toggle="#txt_password"><i class="fa fa-fw fa-eye field-icon toggle-password"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <button type="submit" class="btn btn-danger btn-block">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>