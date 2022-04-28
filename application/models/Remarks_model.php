<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remarks_model extends MY_Model {

    function __construct()
    {
        parent::__construct();

        $this->tbl          = 'remarks';
        $this->primary_key  = 'remark_id';
    }
}