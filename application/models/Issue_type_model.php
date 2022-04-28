<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Issue_type_model extends MY_Model {

    function __construct()
    {
        parent::__construct();

        $this->tbl          = 'issue_type';
        $this->primary_key  = 'issue_type_id';
    }
}