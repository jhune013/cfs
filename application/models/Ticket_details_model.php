<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ticket_details_model extends MY_Model {

    function __construct()
    {
        parent::__construct();

        $this->tbl          = 'ticket_details';
        $this->primary_key  = 'td_no';
    }
}