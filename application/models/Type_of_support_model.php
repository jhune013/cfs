<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class type_of_support_model extends MY_Model {

    function __construct()
    {
        parent::__construct();

        $this->tbl          = 'type_of_support';
        $this->primary_key  = 'type_id';
    }

}