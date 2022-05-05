<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_role_model extends MY_Model {

    function __construct()
    {
        parent::__construct();

        $this->tbl          = 'user_role';
        $this->primary_key  = 'role_id';
    }
}