<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ticket_creation_model extends MY_Model {

    function __construct()
    {
        parent::__construct();

        $this->tbl          = 'ticket_creation';
        $this->primary_key  = 'create_id';
    }


	// function update($data, $create_id)
	// {
	// 	$this->db->where('ticket_creation.create_id', $create_id);
	// 	return $this->db->update('ticket_creation', $ticket);

	// }
}