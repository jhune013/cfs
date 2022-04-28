<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ticket extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
     


        public function index()
    {
        //load ticket_creation_model 
          $this->load->model('Ticket_creation_model');  
           //call the model function to get the ticket_creation data
         $data["fetch_data"] = $this->Ticket_creation_model->fetch_data();           
          //load the issues-list 
          $this->load->view('issues-list',$data);
    }
    
}