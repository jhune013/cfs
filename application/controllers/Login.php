<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        #load  the ajax request
        if ($this->input->is_ajax_request()) {
        
            $validation  =   validation([
                ['txt_username', '<strong>Username</strong>', 'required|trim', '#txt_username'],
                ['txt_password', '<strong>Password</strong>', 'required|trim', '#txt_password']
            ]);
         // Check for user login process
            if ($validation) {
                $this->response(false, $validation);
            }

            $txt_username   =   $this->input->post('txt_username', true);
            $txt_password   =   $this->input->post('txt_password', true);

            # Load the model
            $this->load->model('Users_master_model');

            $where  =   [
                'username'  =>  $txt_username
            ];

            $result =   $this->Users_master_model->get($where);

            #password verification  if true 
            if ($result) {
                $check_password     =   password_verify($txt_password, $result->password);

                if ($check_password) {
                    $session    =   [
                        'user_id'       =>  $result->user_id,
                        'user_session'  =>  $result,
                        'firstname'     => $result->firstname,
                        'user_role'     => $result->user_role
                    ];
                    $this->session->set_userdata($session);

                    #if validation is true proceed to it-helpdesk page
                    $this->response(true, 'Login Successfully', ['action' => 'redirect', 'url' => base_url('helpdesk'), 'slow' => true]);

                }
            }

            $this->response(false, 'Incorrect Username or Password');
        }

        $data   =   [
            'content' => 'content/login'
        ];
    
        $this->load->view('template_login', $data);
    }
}