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

    public function create_your_ticket()
    {
        if ($this->input->is_ajax_request()) {
            $validation  =   validation([
                ['typeofsupport', '<strong>Type of Support</strong>', 'required|trim', '#typeofsupport'],
                ['issue_name_type', '<strong>Issue Type</strong>', 'required|trim', '#issue_name_type'],
                ['status', '<strong>Status</strong>', 'required|trim', '#status'],
                ['priority', '<strong>Priority</strong>', 'required|trim', '#priority'],
                ['details', '<strong>Details</strong>', 'required|trim', '#details']
            ]);

            if ($validation) {
                $this->response(false, $validation);
            }

            $typeofsupport      =   $this->input->post('typeofsupport', true);
            $issue_name_type    =   $this->input->post('issue_name_type', true);
            $remark             =   $this->input->post('remark', true);
            $status             =   $this->input->post('status', true);
            $validity           =   $this->input->post('validity', true);
            $priority           =   $this->input->post('priority', true);
            $details            =   $this->input->post('details', true);

            $this->load->model('Ticket_creation_model');

            $ticket_role        =   'ITD';

            $where      =   [
                'ticket_role'   =>  $ticket_role
            ];

            $params     =   [
                'select'    =>      'LPAD(MAX(ticket_id), 5, 0) as max_ticket_id'
            ];

            $max_ticket_id  =   $this->Ticket_creation_model->get_reader($where, null, null, $params);
            $tmp_max_ticket_id  =   '';


            if ($max_ticket_id) {
                if (!empty($max_ticket_id->max_ticket_id)) {
                    $tmp_max_ticket_id  =   $max_ticket_id->max_ticket_id;
                }
            }

            if (empty($tmp_max_ticket_id)) {
                $tmp_max_ticket_id  =   '00001';
            } else {
                $tmp_max_ticket_id  +=  1;

                $tmp_max_ticket_id  =   str_pad($tmp_max_ticket_id,  5, "0", STR_PAD_LEFT);
            }

            $insert     =   [
                'ticket_role'       =>  $ticket_role,
                'ticket_id'         =>  $tmp_max_ticket_id,
                'type_id'           =>  $typeofsupport,
                'issue_id'          =>  $issue_name_type,
                'remark_id'         =>  $remark,
                'status_id'         =>  $status,
                'validity_id'       =>  $validity,
                'priority_id'       =>  $priority,
                'details'           =>  $details,
                'employee_name'     =>  $this->user->firstname . ' ' . $this->user->lastname
            ];
            $insert_row     =   $this->Ticket_creation_model->create($insert);

            if ($insert_row) {
                $this->response(true, 'Ticket ID #' . $insert_row->ticket_id . ' is created.');
            } else {
                $this->response(false, 'Please try again.');
            }
        }
    }

    public function issues_list()
    {
        if ($this->input->is_ajax_request()) {
            $draw   =   $this->input->get('draw', true);
            $limit  =   $this->input->get('length', true) ?? null;
            $offset =   $this->input->get('start', true) ?? null;
            $search =   $this->input->get('search[value]', true) ?? null;

            $object     =   [
                'draw'            => $draw,
                'recordsTotal'    => 0,
                'recordsFiltered' => 0,
                'data'            => []
            ];

            $this->load->model('Ticket_creation_model');

            $join       =   [
                ['type_of_support', 'type_of_support.type_id = ticket_creation.type_id'],
                ['issue_type', 'issue_type.issue_type_id = ticket_creation.issue_id'],
                ['status', 'status.status_id = ticket_creation.status_id'],
                ['priority', 'priority.id = ticket_creation.priority_id'],
                ['remarks', 'remarks.remark_id = ticket_creation.remark_id', 'LEFT'],
                ['validity', 'validity.validity_id = ticket_creation.validity_id', 'LEFT']
            ];

            $params     =   [
                'like'   => [
                    ['CONCAT(ticket_role, "-", ticket_id)', $search]
                ]
            ];

            if (empty($search)) {
                unset($params['like']);
            }

            $results            =   $this->Ticket_creation_model->list_all_reader(null, $limit, $offset, 'ticket_creation.create_id DESC', $join, $params);


            $params['return_count']     =   true;
            $object['recordsFiltered']  =   $this->Ticket_creation_model->list_all_reader(null, $limit, $offset, 'ticket_creation.create_id DESC', $join, $params);

            if (isset($params['like'])) {
                unset($params['like']);
            }

            $object['recordsTotal']     =   $this->Ticket_creation_model->list_all_reader(null, $limit, $offset, 'ticket_creation.create_id DESC', $join, $params);

            if ($results) {
                foreach ($results as $x) {
                    array_push($object['data'], [
                        '<a class="link" id="btn_ticket_id" data-id="' . $x->create_id . '">' . $x->ticket_role . '-' . $x->ticket_id . '</a>',
                        $x->issue_name_type,
                        $x->employee_name,
                        $x->status_name,
                        $x->priority_name,
                        ''
                    ]);
                }
            }

            echo json_encode($object);
            exit();

        }

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