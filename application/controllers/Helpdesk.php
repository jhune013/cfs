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
        $this->load->model('Remarks_model');
        $this->load->model('Status_model');
        $this->load->model('Priority_model');
        $this->load->model('Validity_model');
        $support_types   =   $this->Type_of_support_model->list_all_reader(null, null, null, 'type_id ASC');
        $remarks         =   $this->Remarks_model->list_all_reader(null, null, null, 'remark_id ASC');
        $status          =   $this->Status_model->list_all_reader(null, null, null, 'status_id ASC');
        $priority        =   $this->Priority_model->list_all_reader(null, null, null, 'id ASC');
        $validity        =   $this->Validity_model->list_all_reader(null, null, null, 'Validity_id ASC');
        $data   =   [
            'content'       =>  'content/helpdesk/request-a-ticket',
            'title'         =>  'IT Helpdesk - Request a ticket',
            'support_types' =>  $support_types,
            'remarks'       =>  $remarks,
            'status'        =>   $status,   
            'priority'      => $priority,
            'validity'      => $validity 
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

    public function request_issue_types()
    {
        if ($this->input->is_ajax_request()) {
            $value  =   $this->input->post('value', true);

            $this->load->model('Issue_type_model');

            $where          =   [
                'type_id'   =>  $value
            ];

            $issue_types    =   $this->Issue_type_model->list_all_reader($where);

            $issue_type_html    =   '<option value="" selected disabled hidden>Select...</option>';
            if ($issue_types) {
                foreach ($issue_types as $x) {
                    $issue_type_html    .=  '<option value="' . $x->issue_type_id . '">' . $x->issue_name_type . '</option>';
                }
            }

            echo json_encode([
                'issue_type_html'   =>  $issue_type_html
            ]);
        }
    }
}