<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status_model extends MY_Model {

    function __construct()
    {
        parent::__construct();

        $this->tbl          = 'status';
        $this->primary_key  = 'status_id';
    }
}