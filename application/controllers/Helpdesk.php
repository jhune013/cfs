<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helpdesk extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->requiredLoggedIn();
    }

	public function index()
	{
        $data   =   [
            'content'   => 'content/helpdesk/home',
            'title'     =>  'IT Helpdesk'  
        ];
    
        $this->load->view('template', $data);
	}

    public function request_a_ticket()
    {
        $this->load->model('Type_of_support_model');
        $support_types   =   $this->Type_of_support_model->list_all_reader(null, null, null, 'type_id ASC');

        $data   =   [
            'content'       =>  'content/helpdesk/request-a-ticket',
            'title'         =>  'IT Helpdesk - Request a ticket',
            'support_types' =>  $support_types
        ];
    
        $this->load->view('template', $data);
    }

    public function issues_list()
    {
        $data   =   [
            'content'   => 'content/helpdesk/issues-list',
            'title'     =>  'IT Helpdesk - Issues List'  
        ];
    
        $this->load->view('template', $data);
    }
}