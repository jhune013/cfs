<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->_ci =& get_instance();
        $this->load->helper('email');
        $this->load->helper('file');
    }


    public function requiredLoggedIn()
    {
        if (isset($this->session->user_session)) {

            if (isset($this->session->user_session->USERS_NO)) {

                $this->makeSession();

                if (empty($this->user)) {
                    redirect(base_url('login'));
                }

            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function response($success, $text = '', $params = null)
    {
        if (is_bool($success)) {

            $response['success'] = $success;

            if ($text) {
                $response['text'] = $text;
            }

            if (is_array($params)) {
                foreach($params as $key => $val) {
                    $response[$key] = $val;
                }
            }
        } else {
            $response = $success;
        }

        echo json_encode($response);
        exit;
    }
}