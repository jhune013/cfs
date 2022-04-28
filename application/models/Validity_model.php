<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validity_model extends MY_Model {

    function __construct()
    {
        parent::__construct();

        $this->tbl          = 'validity';
        $this->primary_key  = 'validity_id';
    }
}