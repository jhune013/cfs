<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Priority_model extends MY_Model {

    function __construct()
    {
        parent::__construct();

        $this->tbl          = 'priority';
        $this->primary_key  = 'id';
    }
}