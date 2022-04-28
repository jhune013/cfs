<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Type_of_Support extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('type_of_Support_model');

    }
    public function index()
    {
          $this->load->view('content/request-a-ticket', $data);

    }
}