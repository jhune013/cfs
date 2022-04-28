<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ticket_creation_model extends MY_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


     //read the ticket_creation_ list from db
    function fetch_data()
       
           $this->db->select("*");  
           $this->db->from("ticket_creation");  
           $query = $this->db->get();  
           return $query; 
        }
}