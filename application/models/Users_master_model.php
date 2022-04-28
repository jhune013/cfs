<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_master_model extends MY_Model {

    function __construct()
    {
        parent::__construct();

        $this->tbl          = 'users_master';
        $this->primary_key  = 'user_id';
    }
}