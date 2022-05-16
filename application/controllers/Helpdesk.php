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
        $this->load->model('Ticket_creation_model');

        // $where =    [
        //      'column_name'   =>  'value'
        // ];

        // $join   =   [
        //     ['table1', 'table1.column = main.column', 'left'],
        //     ['table2', 'table2.column = main.column'],
        // ];

        // $params     =   [
        //     'like'  =>  [
        //         ['column', 'value']
        //     ],
        //     'select' => 'column name',
        //     'group_by'  =>  ['column name', column name]
        // ];

       $Open        =   '1';
       $where            =   [
           'status_id'   =>   $Open
            ];

       $Open        = $this->Ticket_creation_model->get_reader($where, null, null, ['return_count' => true]);

       

        $data   =   [
            'content'   => 'content/helpdesk/home',
            'title'     =>  'IT Helpdesk',
            'Open'     =>  $Open
            
        ];
    
        $this->load->view('template', $data);
	}

    #this function is to load the request a ticket page
    public function request_a_ticket()
    {

        $this->load->model('Type_of_support_model');        #load Type_of_support_model 
        $this->load->model('Remarks_model');                #load Remarks_model 
        $this->load->model('Status_model');                 #load Status_model 
        $this->load->model('Validity_model');               #load Validity_model 


        $support_types   =   $this->Type_of_support_model->list_all_reader(null, null, null, 'type_id ASC');
        $remarks         =   $this->Remarks_model->list_all_reader(null, null, null, 'remark_id ASC');
        $status          =   $this->Status_model->list_all_reader(null, null, null, 'status_id ASC');
        $validity        =   $this->Validity_model->list_all_reader(null, null, null, 'Validity_id ASC');
        $data   =   [
            'content'       =>  'content/helpdesk/request-a-ticket',
            'title'         =>  'IT Helpdesk - Request a ticket',
            'support_types' =>  $support_types,
            'remarks'       =>  $remarks,
            'status'        =>  $status,
            'validity'      =>  $validity,
            'viewing'       =>  false
        ];
         #load the template
        $this->load->view('template', $data);
    }

    #this function is to save our ticket to database
    public function create_your_ticket()
    {
        #validation before we save the ticket, check if type of support, type of issue , and details
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

            //load the Ticket_creation_model
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
                'employee_name'     =>  $this->user->firstname . ' ' . $this->user->lastname
            ];
            $insert_row     =   $this->Ticket_creation_model->create($insert);

            if ($insert_row) {
                $this->load->model('Ticket_details_model');

                $this->Ticket_details_model->create([
                    'td_create_id'  =>  $insert_row->create_id,
                    'td_message'    =>  $details,
                    'td_user_id'    =>  $this->user->user_id
                ]);

                $this->response(true, 'Ticket ID #' . $insert_row->ticket_id . ' is created.',['action' => 'redirect', 'url' => base_url('helpdesk/issues_list'), 'slow' => true]);
            } else {
                $this->response(false, 'Please try again.');

            }
        }
    }
    #load the ticket list in  table list
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
                    ['CONCAT(ticket_role, "-", ticket_id)', $search],
                    ['employee_name', $search, 'MATCH', 'Before']
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
                        '<a class="link" href="' . base_url('helpdesk/view_ticket/' . $x->create_id) . '" data-id="' . $x->create_id . '">' . $x->ticket_role . '-' . $x->ticket_id . '</a>',
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

    #function to view the ticket 
    public function view_ticket($create_id)
    {
        $this->load->model('Type_of_support_model');        #load Type_of_support_model 
        $this->load->model('Remarks_model');                #load Remarks_model
        $this->load->model('Status_model');                 #load Status_model 
        $this->load->model('Validity_model');                #load Validity_model 
        $this->load->model('Ticket_creation_model');         #load Ticket_creation_model 
        $this->load->model('Issue_type_model');               #load Issue_type_model     
        $this->load->model('Ticket_details_model');  

        $support_types  =   $this->Type_of_support_model->list_all_reader(null, null, null, 'type_id ASC');
        $remarks        =   $this->Remarks_model->list_all_reader(null, null, null, 'remark_id ASC');
        $status         =   $this->Status_model->list_all_reader(null, null, null, 'status_id ASC');
        $validity       =   $this->Validity_model->list_all_reader(null, null, null, 'Validity_id ASC');

        $join           =   [
            ['priority', 'priority.id = ticket_creation.priority_id']
        ];

        $row            =   $this->Ticket_creation_model->get_reader(['create_id' => $create_id], null, $join);

        $issue_types    =   false;
        $details        =   false;
        $priority_list  =   false;

        if ($row) {
            $issue_types    =   $this->Issue_type_model->list_all_reader(['type_id' => $row->type_id]);
            $join           =   [
                ['users_master', 'users_master.user_id = ticket_details.td_user_id']
            ];
            $details        =   $this->Ticket_details_model->list_all_reader(['td_create_id' => $create_id], null, null, null, $join);

            $time_to_respond    =   'PROCESS';
            $time_to_resolve    =   'PROCESS';
            $on_hold            =   false;
            $replied            =   false;
            $closed             =   false;
            $open               =   false;
            
           
            # Statement for showing the response

            if (!in_array($row->status_id, [3])) { 
                $tmp_message        =   $this->Ticket_details_model->list_all_reader(['td_create_id' => $create_id], null, null);

                if (count($tmp_message) <= 1) {
                    $need_to_respond    =   strtotime($row->opening_date . ' + ' . $row->p_time_to_respond);

                    if (strtotime(time_today()) >= $need_to_respond) {
                        $time_to_respond =  'FAILED';
                    }

                } else if (count($tmp_message) >= 2) {
                    $need_to_respond    =   strtotime($row->opening_date . ' + ' . $row->p_time_to_respond);
                    if (strtotime($tmp_message[1]->td_created) >= $need_to_respond) {
                        $time_to_respond =  'FAILED';
                    } else {
                        $time_to_respond    =   'SUCCESS';
                    }
                }

                $time_to_resolve    =   'PROCESS';
                if ($row->status_id != 4) {
                    $need_to_resolve    =   strtotime($row->opening_date . ' + ' . $row->p_time_to_resolve);

                    if (!empty($row->on_hold_date)) {
                        $need_to_resolve    =   strtotime($row->on_hold_date . ' + ' . $row->p_time_to_resolve);
                    }

                    if (strtotime(time_today()) >= $need_to_resolve) {
                        $time_to_resolve =  'FAILED';
                    }
                    
                } else {
                    $need_to_resolve    =   strtotime($row->opening_date . ' + ' . $row->p_time_to_resolve);
                    
                    if (!empty($row->on_hold_date)) {
                        $need_to_resolve    =   strtotime($row->on_hold_date . ' + ' . $row->p_time_to_resolve);
                    }
                    
                    if (strtotime($row->resolve_time) >= $need_to_resolve) {
                        $time_to_resolve =  "FAILED";
                    } else {
                        $time_to_resolve = "SUCCESS";
                    }
                }

                //  $time_to_resolve    =   false;
                // if ($row->status_id != 4) {
                // $need_to_resolve    =   strtotime($row->opening_date . ' + ' . $row->p_time_to_resolve);
                //      if (strtotime(time_today()) <= $need_to_resolve) {
                //     $time_to_resolve =  true;
                //    }
                // }


            } else {
                $on_hold     =  true;
            }




            $this->load->model('Priority_model');
            $priority_list  =   $this->Priority_model->list_all_reader(['tos_type_id' => $row->type_id], null, null, 'id ASC');


        }

        $data   =   [
            'content'           =>  'content/helpdesk/request-a-ticket',
            'title'             =>  'IT Helpdesk - Edit a ticket',
            'support_types'     =>  $support_types,
            'remarks'           =>  $remarks,
            'status'            =>  $status,   
            'validity'          =>  $validity,
            'issue_types'       =>  $issue_types,
            'priority_list'     =>  $priority_list,
            'row'               =>  $row,
            'details'           =>  $details,
            'time_to_respond'   =>  $time_to_respond,
            'time_to_resolve'   =>  $time_to_resolve,
            'on_hold'           =>  $on_hold,
            'replied'           =>  $replied,
            'closed'            =>  $closed,
            'open'              =>  $open,
            'viewing'           =>  true
        ];
    
        $this->load->view('template', $data);
        // echo "<pre>";
        // print_r($data);
        // die;

    }


    #load the dynamic dropdown
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
            $this->load->model('Priority_model');
            $where          =   [
                'tos_type_id'   =>  $value
            ];

            $prioritylist    =   $this->Priority_model->list_all_reader($where, null, null, 'id ASC');
            $priority_html      =   '<option value="" selected disabled hidden>Select...</option>';
            if ($prioritylist) {
                foreach ($prioritylist as $k => $x) {
                    $priority_html    .=  '<option value="' . $x->id . '" ' . ($k == 0 ? 'selected' : '') . '>' . $x->priority_name . '</option>';
                }
            }

            echo json_encode([
                'issue_type_html'   =>  $issue_type_html,
                'priority_html'     =>  $priority_html
            ]);
        }
    }

    public function update($create_id)
    {
        if ($this->input->is_ajax_request()) {
            $validation  =   validation([
                ['typeofsupport', '<strong>Type of Support</strong>', 'required|trim', '#typeofsupport'],
                ['issue_name_type', '<strong>Issue Type</strong>', 'required|trim', '#issue_name_type'],
                ['status', '<strong>Status</strong>', 'required|trim', '#status'],
                ['priority', '<strong>Priority</strong>', 'required|trim', '#priority']
            ]);

            if ($validation) {
                $this->response(false, $validation);
            }
    
        //  $row            =   $this->Ticket_creation_model->get_reader(['create_id' => $create_id]);
            $typeofsupport      =  $this->input->post('typeofsupport', true);
            $typeofsupport      =   $this->input->post('typeofsupport', true);
            $issue_name_type    =   $this->input->post('issue_name_type', true);
            $remark             =   $this->input->post('remark', true);
            $status             =   $this->input->post('status', true);
            $validity           =   $this->input->post('validity', true);
            $priority           =   $this->input->post('priority', true);
            $details            =   $this->input->post('details', true);

            $this->load->model('Ticket_creation_model');
            $this->load->model('Ticket_details_model');

            $update    =   [
                'type_id'           =>  $typeofsupport,
                'issue_id'          =>  $issue_name_type,
                'remark_id'         =>  $remark,
                'status_id'         =>  $status,
                'validity_id'       =>  $validity,
                'priority_id'       =>  $priority
            ];

            if ($status == 3) {
                $update['on_hold_date']     =   date('Y-m-d H:i:s');
            }
            $update_row     =   $this->Ticket_creation_model->update($update, ['create_id' => $create_id]);

            if ($status == 4) {
                $update['resolve_time']     =   date('Y-m-d H:i:s');
            }
            $update_row     =   $this->Ticket_creation_model->update($update, ['create_id' => $create_id]);


            if (!empty($details)) {
                $this->Ticket_details_model->create([
                    'td_create_id'  =>  $create_id,
                    'td_message'    =>  $details,
                    'td_user_id'    =>  $this->user->user_id
                ]);
            }

            $this->response(true, 'Updated Successfully', ['action' => 'redirect', 'url' => base_url('helpdesk/view_ticket/' . $create_id), 'slow' => true]);
        }
    }

    public function upload_image()
    {
        if ($this->input->is_ajax_request()) {
            if ($_FILES['file']['name']) {
                if (!$_FILES['file']['error']) {
                   $name        =   md5(rand(100, 200));
                   $ext         =   explode('.', $_FILES['file']['name']);
                   $filename    =   $name . '.' . $ext[1];
                   $destination =   'public/img/uploads/' . $filename; //change this directory
                   $location    =   $_FILES["file"]["tmp_name"];
                   move_uploaded_file($location, $destination);
                   echo base_url($destination);
                } else {
                    echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
                }
            }
        }
    }

    public function users_list()
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

            $this->load->model('Users_master_model');

            $params     =   [
                'like'   => [
                    ['CONCAT(emp_prefix, "-", emp_no)', $search],
                    // ['column', 'search value', 'MATCH|AFTER|BEFORE|NONE']
                   ['username', $search, 'MATCH', 'Before']
                ]
            ];

            if (empty($search)) {
                unset($params['like']);
            }

            $results            =   $this->Users_master_model->list_all_reader(null, $limit, $offset, 'emp_no DESC', null, $params);


            $params['return_count']     =   true;
            $object['recordsFiltered']  =   $this->Users_master_model->list_all_reader(null, $limit, $offset, 'user_type_id DESC', null, $params);

            if (isset($params['like'])) {
                unset($params['like']);
            }

            $object['recordsTotal']     =   $this->Users_master_model->list_all_reader(null, $limit, $offset, 'user_id DESC', null, $params);

            if ($results) {
                foreach ($results as $x) {
                    array_push($object['data'], [
                        '<a class="link" href="' . base_url('helpdesk/view_userprofile/' . $x->user_id) . '" data-id="' . $x->user_id . '">' . $x->emp_prefix . '-' . $x->emp_no . '</a>',
                        $x->firstname  .' '. $x->lastname ,
                        $x->user_type,
                        $x->username,
                        $x->email,
                        ''

                    ]);

                }
            }
           
            echo json_encode($object);
            exit();

        }

       $this->load->model('Users_master_model');

        $records   =   $this->Users_master_model->list_all_reader(null, null, null, 'user_id ASC');
           

        $data   =   [
            'content'   => 'content/helpdesk/users',
            'title'     =>  'IT Helpdesk - User List'
            //'records'   =>  $records
                    ];
    
        $this->load->view('template', $data);

    }

    public function view_userprofile($user_id)
    {
         $this->load->model('Users_master_model');
         $this->load->model('User_role_model');               #load User Role Model

            $where          =   [
                'user_id'   =>  $user_id,
            ];

         $user_type        =   $this->User_role_model->list_all_reader(null, null, null, 'role_id ASC');
         $user              =   $this->Users_master_model->get_reader($where);
         // $lastname         =   $this->Users_master_model->list_all_reader($where);
         // $email            =   $this->Users_master_model->list_all_reader($where);
         // $username         =   $this->Users_master_model->list_all_reader($where);
         // $password         =   $this->Users_master_model->list_all_reader($where);
         



        $data =[

            'content'         => 'content/helpdesk/add-new-user',
            'title'           =>  'IT Helpdesk - User List' ,
            'user'      =>  $user,
            // 'lastname'        =>  $lastname,
            // 'username'        =>  $username,
            // 'email'           =>  $email,    
            // 'password'        =>  $password,
            'user_type'       =>  $user_type,
                   
            'viewing'           =>  true
        ];
         $this->load->view('template', $data);
        //  echo "<pre>";
        // print_r($data);
        // die;
    }

    public function add_new_user()
    {
         $this->load->model('User_role_model');               #load User Role Model
         $user_type   =   $this->User_role_model->list_all_reader(null, null, null, 'role_id ASC');

        $data =[

            'content'   => 'content/helpdesk/add-new-user',
            'title'     =>  'IT Helpdesk - User List' ,
            'user_type' =>  $user_type,
            'viewing'   =>  false
        ];
         $this->load->view('template', $data);

    }



    public function create_user()
    {

         if ($this->input->is_ajax_request()) {
            $validation  =   validation([
                ['firstname', '<strong>First Name</strong>', 'required|trim', '#firstname'],
                ['lastname', '<strong>Last Name</strong>', 'required|trim', '#lastname'],
                ['email', '<strong>Email</strong>', 'required|trim', '#email'],
                ['username', '<strong>Username</strong>', 'required|trim', '#username'],
                ['password', '<strong>password</strong>', 'required|trim', '#txt_password'],
                ['user_type', '<strong>User type</strong>', 'required|trim', '#user_type']
            ]);

            if ($validation) {
                $this->response(false, $validation);
            }

            $firstname            =     $this->input->post('firstname', true);
            $lastname             =     $this->input->post('lastname', true);
            $email                =     $this->input->post('email', true);
            $username             =     $this->input->post('username', true);
            $password             =     $this->input->post('password', true);
            $user_type            =     $this->input->post('user_type', true);
            $hashed_password      =     password_hash($password, PASSWORD_DEFAULT);
          

            //load the Ticket_creation_model
            $this->load->model('Users_master_model');

            $emp_prefix        =   'EMP';

            $where      =   [
                'emp_prefix'   =>  $emp_prefix
            ];

            $params     =   [
                'select'    =>      'LPAD(MAX(emp_no), 5, 0) as max_emp_no'
            ];

            $max_emp_no  =   $this->Users_master_model->get_reader($where, null, null, $params);
            $tmp_max_emp_no  =   '';


            if ($max_emp_no) {
                if (!empty($max_emp_no->max_emp_no)) {
                    $tmp_max_emp_no  =   $max_emp_no->max_emp_no;
                }
            }

            if (empty($tmp_max_emp_no)) {
                $tmp_max_emp_no  =   '00001';
            } else {
                $tmp_max_emp_no  +=  1;

                $tmp_max_emp_no  =   str_pad($tmp_max_emp_no,  5, "0", STR_PAD_LEFT);
            }

            $insert     =   [
                'emp_prefix'        =>  $emp_prefix,
                'emp_no'            =>  $tmp_max_emp_no,
                'firstname'         =>  $firstname,
                'lastname'          =>  $lastname,
                'username'          =>  $username,
                'email'             =>  $email,    
                'password'          =>  $hashed_password,
                'user_type'         =>  $user_type
                
                ];
                   
            $insert_row     =   $this->Users_master_model->create($insert);
                 // print_r($insert); exit();
            
        
            if ($insert_row) {

                $this->response(true, 'Employe ID '. $insert_row->emp_no .' is created.',['action' => 'redirect', 'url' => base_url('helpdesk/users_list'), 'slow' => true]);
            } else {
                $this->response(false, 'Please try again.');

            }
        }
    }


    public function  it_dashboard()
    {

      #count the tickets where status is Open 
        $this->load->model('Ticket_creation_model'); #load the Tickets Model
    
       $Open        =   '1';
       $where            =   [
           'status_id'   =>   $Open
            ];

       $Open        = $this->Ticket_creation_model->get_reader($where, null, null, ['return_count' => true]);

        #count the tickets where status is Replied 
       $this->load->model('Ticket_creation_model');
       $replied        =   '2';
       $where         =   [
        'status_id'   =>   $replied
            ];

       $replied        = $this->Ticket_creation_model->get_reader($where, null, null, ['return_count' => true]);



         #count the tickets where status is Onhold 
       $this->load->model('Ticket_creation_model');
       $onhold        =   '3';
       $where         =   [
        'status_id'   =>   $onhold
            ];

       $onhold        = $this->Ticket_creation_model->get_reader($where, null, null, ['return_count' => true]);


          #count the tickets where status is Closed 
       $this->load->model('Ticket_creation_model');
       $closed        =   '4';
       $where         =   [
        'status_id'   =>   $closed
            ];

       $closed        = $this->Ticket_creation_model->get_reader($where, null, null, ['return_count' => true]);



        $data   =   [
            'content'   => 'content/helpdesk/it-dashboard',
            'title'     =>  'IT Helpdesk - IT Helpdesk Dashboard',
            'Open'      =>   $Open ,
            'replied'   =>   $replied,
            'onhold'    =>   $onhold,
            'closed'    =>   $closed
             
                    ];
    
        $this->load->view('template', $data);

    }
    
    public function hr_helpdesk()
    {
      

       

       

        $data   =   [
            'content'   => 'content/helpdesk/hr-home',
            'title'     =>  'HR Helpdesk'
           
            
        ];
    
        $this->load->view('template', $data);

    }
   
}  