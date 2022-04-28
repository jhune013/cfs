<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
    public $primary_key;
    public $id;
    public $tbl;
    public $fields;

    public function __construct()
    {
        parent::__construct();
        $this->db_reader = $this->load->database('db_reader', TRUE);
        $this->db_reader->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
    }

    public function __destruct() 
    {  
        $this->db->close();  
        $this->db_reader->close();  
    }  

    public function get($where = null, $order = null, $join = null, $params = null)
    {
        if (isset($params['reader'])) {
            return $this->get_reader($where, $order, $join, $params);
        } else {
            # accept string but the default where is to the primary key
            if (!empty($where)) {
                if (!is_array($where)) {
                    $where  =   [$this->primary_key => $where];
                }
                $this->db->where($where);
            }

            # This statement will accept array or string order
            if (!empty($order)) {
                if (!is_array($order)) {
                    $order  =   [$order];
                }
                $this->db->order_by(implode(', ', $order));
            }

            # This statement will accept array only for joining
            if (!empty($join)) {
                if (is_array($join)) {
                    $isMultiArray   =   is_array($join[0]);

                    if ($isMultiArray) {
                        foreach($join as $array) {
                            $joinTable      =   $array[0];
                            $joinWhere      =   $array[1];
                            $joinStatus     =   $array[2] ?? null;

                            $this->db->join($joinTable, $joinWhere, $joinStatus);
                        }
                    } else {
                        $joinTable      =   $join[0];
                        $joinWhere      =   $join[1];
                        $joinStatus     =   $join[2] ?? null;

                        $this->db->join($joinTable, $joinWhere, $joinStatus);
                    }
                }
            }

            $return_type = false;

            if (!is_null($params)) {
                if (isset($params['group_by'])) {
                    $group_by   =   $params['group_by'];
                    if (is_array($group_by)) {
                        $group_by   =   implode(', ', $group_by);
                    }
                    $this->db->group_by($group_by);
                }

                if (isset($params['select'])) {
                    $select = $params['select'];
                    $this->db->select($select);
                }

                if (isset($params['return_type'])) {
                    $return_type = $params['return_type'];
                }

                if (isset($params['like'])) {

                    $like   =   $params['like'];

                    if (is_array($like)) {
                        $isMultiArray   =   is_array($like[0]);

                        $this->db->group_start();
                            if ($isMultiArray) {
                                foreach ($like as $keyV => $v) {
                                    if (is_array($v[0])) {
                                        foreach ($v as $keyX => $x) {
                                            $this->db->group_start();
                                                foreach ($x as $y) {
                                                    $likeColumn =   $y[0];
                                                    $likeValue  =   $y[1];
                                                    $likeExp    =   $y[2] ?? null;
                                                    $likeParam  =   strtolower($y[3] ?? null);

                                                    if ($likeParam == null || $likeParam == 'and') {
                                                        $this->db->like($likeColumn, $likeValue, $likeExp);
                                                    } else {
                                                        $this->db->or_like($likeColumn, $likeValue, $likeExp);
                                                    }
                                                }
                                            $this->db->group_end();
                                        }
                                    } else {
                                        $likeColumn =   $v[0];
                                        $likeValue  =   $v[1];
                                        $likeExp    =   $v[2] ?? null;
                                        $likeParam  =   strtolower($v[3] ?? null);

                                        if ($likeParam == null || $likeParam == 'and') {
                                            $this->db->like($likeColumn, $likeValue, $likeExp);
                                        } else {
                                            $this->db->or_like($likeColumn, $likeValue, $likeExp);
                                        }
                                    }
                                }
                            } else {
                                $likeColumn =   $like[0];
                                $likeValue  =   $like[1];
                                $likeExp    =   $like[2] ?? null;
                                $likeParam  =   strtolower($like[3] ?? null);

                                if ($likeParam == null || $likeParam == 'and') {
                                    $this->db->like($likeColumn, $likeValue, $likeExp);
                                } else {
                                    $this->db->or_like($likeColumn, $likeValue, $likeExp);
                                }
                            }
                        $this->db->group_end();
                    }
                }

                if (isset($params['in_where'])) {
                    if (is_array($params['in_where'])) {
                        if (is_array($params['in_where'][0])) {
                            foreach ($params['in_where'] as $v) {
                                $this->db->where_in($v[0], $v[1]);
                            }
                        } else {
                            $this->db->where_in($params['in_where'][0], $params['in_where'][1]);
                        }
                    }
                }

                if (isset($params['return_count'])) {
                    return $this->db->count_all_results($this->tbl);
                }
            }

            $query = $this->db->get($this->tbl, 1);

            if ($return_type) {
                if ($return_type == 'array') {
                    return $query->num_rows() > 0 ? $query->row_array() : false;
                } else {
                    return $query->num_rows() > 0 ? $query->row() : false;
                }
            } else {
                return $query->num_rows() > 0 ? $query->row() : false;
            }
        }
    }

    public function get_reader($where = null, $order = null, $join = null, $params = null)
    {
        if (!empty($where)) {
            if (!is_array($where)) {
                $where  =   [$this->primary_key => $where];
            }
            $this->db_reader->where($where);
        }

        # This statement will accept array or string order
        if (!empty($order)) {
            if (!is_array($order)) {
                $order  =   [$order];
            }
            $this->db_reader->order_by(implode(', ', $order));
        }

        # This statement will accept array only for joining
        if (!empty($join)) {
            if (is_array($join)) {
                $isMultiArray   =   is_array($join[0]);

                if ($isMultiArray) {
                    foreach($join as $array) {
                        $joinTable      =   $array[0];
                        $joinWhere      =   $array[1];
                        $joinStatus     =   $array[2] ?? null;

                        $this->db_reader->join($joinTable, $joinWhere, $joinStatus);
                    }
                } else {
                    $joinTable      =   $join[0];
                    $joinWhere      =   $join[1];
                    $joinStatus     =   $join[2] ?? null;

                    $this->db_reader->join($joinTable, $joinWhere, $joinStatus);
                }
            }
        }

        $return_type = false;

        if (!is_null($params)) {
            if (isset($params['group_by'])) {
                $group_by   =   $params['group_by'];
                if (is_array($group_by)) {
                    $group_by   =   implode(', ', $group_by);
                }
                $this->db_reader->group_by($group_by);
            }

            if (isset($params['select'])) {
                $select = $params['select'];
                $this->db_reader->select($select);
            }

            if (isset($params['return_type'])) {
                $return_type = $params['return_type'];
            }

            if (isset($params['like'])) {

                $like   =   $params['like'];

                if (is_array($like)) {
                    $isMultiArray   =   is_array($like[0]);

                    $this->db_reader->group_start();
                        if ($isMultiArray) {
                            foreach ($like as $keyV => $v) {
                                if (is_array($v[0])) {
                                    foreach ($v as $keyX => $x) {
                                        $this->db_reader->group_start();
                                            foreach ($x as $y) {
                                                $likeColumn =   $y[0];
                                                $likeValue  =   $y[1];
                                                $likeExp    =   $y[2] ?? null;
                                                $likeParam  =   strtolower($y[3] ?? null);

                                                if ($likeParam == null || $likeParam == 'and') {
                                                    $this->db_reader->like($likeColumn, $likeValue, $likeExp);
                                                } else {
                                                    $this->db_reader->or_like($likeColumn, $likeValue, $likeExp);
                                                }
                                            }
                                        $this->db_reader->group_end();
                                    }
                                } else {
                                    $likeColumn =   $v[0];
                                    $likeValue  =   $v[1];
                                    $likeExp    =   $v[2] ?? null;
                                    $likeParam  =   strtolower($v[3] ?? null);

                                    if ($likeParam == null || $likeParam == 'and') {
                                        $this->db_reader->like($likeColumn, $likeValue, $likeExp);
                                    } else {
                                        $this->db_reader->or_like($likeColumn, $likeValue, $likeExp);
                                    }
                                }
                            }
                        } else {
                            $likeColumn =   $like[0];
                            $likeValue  =   $like[1];
                            $likeExp    =   $like[2] ?? null;
                            $likeParam  =   strtolower($like[3] ?? null);

                            if ($likeParam == null || $likeParam == 'and') {
                                $this->db_reader->like($likeColumn, $likeValue, $likeExp);
                            } else {
                                $this->db_reader->or_like($likeColumn, $likeValue, $likeExp);
                            }
                        }
                    $this->db_reader->group_end();
                }
            }

            if (isset($params['in_where'])) {
                if (is_array($params['in_where'])) {
                    if (is_array($params['in_where'][0])) {
                        foreach ($params['in_where'] as $v) {
                            $this->db_reader->where_in($v[0], $v[1]);
                        }
                    } else {
                        $this->db_reader->where_in($params['in_where'][0], $params['in_where'][1]);
                    }
                }
            }

            if (isset($params['or_where'])) {
                if (!is_array($params['or_where'])) {
                    $params['or_where']  =   [$this->primary_key => $params['or_where']];
                }
                $this->db_reader->or_where($params['or_where']);
            }

            if (isset($params['return_count'])) {
                return $this->db_reader->count_all_results($this->tbl);
            }
        }

        $query = $this->db_reader->get($this->tbl, 1);

        if ($return_type) {
            if ($return_type == 'array') {
                return $query->num_rows() > 0 ? $query->row_array() : false;
            } else {
                return $query->num_rows() > 0 ? $query->row() : false;
            }
        } else {
            return $query->num_rows() > 0 ? $query->row() : false;
        }
    }

    public function list_all($where = null, $limit = null, $offset = null, $order = null, $join = null, $params = null)
    {
        if (isset($params['reader'])) {
            return $this->list_all_reader($where, $limit, $offset, $order, $join, $params);
        } else {
            if (empty($limit)) {
                $limit  =   PHP_INT_MAX;
            }

            if (empty($offset)) {
                $offset  =   0;
            }

            # accept string but the default where is to the primary key
            if (!empty($where)) {
                if (!is_array($where)) {
                    $where  =   [$this->primary_key => $where];
                }
                $this->db->where($where);
            }

            # This statement will accept array or string order
            if (!empty($order)) {
                if (!is_array($order)) {
                    $order  =   [$order];
                }
                $this->db->order_by(implode(', ', $order));
            }

            # This statement will accept array only for joining
            if (!empty($join)) {
                if (is_array($join)) {
                    $isMultiArray   =   is_array($join[0]);

                    if ($isMultiArray) {
                        foreach($join as $array) {
                            $joinTable      =   $array[0];
                            $joinWhere      =   $array[1];
                            $joinStatus     =   $array[2] ?? null;

                            $this->db->join($joinTable, $joinWhere, $joinStatus);
                        }
                    } else {
                        $joinTable      =   $join[0];
                        $joinWhere      =   $join[1];
                        $joinStatus     =   $join[2] ?? null;

                        $this->db->join($joinTable, $joinWhere, $joinStatus);
                    }
                }
            }

            $return_type = false;

            if (!is_null($params)) {
                if (isset($params['group_by'])) {
                    $group_by   =   $params['group_by'];
                    if (is_array($group_by)) {
                        $group_by   =   implode(', ', $group_by);
                    }
                    $this->db->group_by($group_by);
                }

                if (isset($params['select'])) {
                    $select = $params['select'];
                    $this->db->select($select);
                }

                if (isset($params['return_type'])) {
                    $return_type = $params['return_type'];
                }

                if (isset($params['like'])) {

                    $like   =   $params['like'];
                    if (!empty($like)) {
                        if (is_array($like)) {
                            $isMultiArray   =   is_array($like[0]);

                            $this->db->group_start();
                                if ($isMultiArray) {
                                    foreach ($like as $keyV => $v) {
                                        if (is_array($v[0])) {
                                            foreach ($v as $keyX => $x) {
                                                $this->db->group_start();
                                                    foreach ($x as $y) {
                                                        $likeColumn =   $y[0];
                                                        $likeValue  =   $y[1];
                                                        $likeExp    =   $y[2] ?? null;
                                                        $likeParam  =   strtolower($y[3] ?? null);

                                                        if ($likeParam == null || $likeParam == 'and') {
                                                            $this->db->like($likeColumn, $likeValue, $likeExp);
                                                        } else {
                                                            $this->db->or_like($likeColumn, $likeValue, $likeExp);
                                                        }
                                                    }
                                                $this->db->group_end();
                                            }
                                        } else {
                                            $likeColumn =   $v[0];
                                            $likeValue  =   $v[1];
                                            $likeExp    =   $v[2] ?? null;
                                            $likeParam  =   strtolower($v[3] ?? null);

                                            if ($likeParam == null || $likeParam == 'and') {
                                                $this->db->like($likeColumn, $likeValue, $likeExp);
                                            } else {
                                                $this->db->or_like($likeColumn, $likeValue, $likeExp);
                                            }
                                        }
                                    }
                                } else {
                                    $likeColumn =   $like[0];
                                    $likeValue  =   $like[1];
                                    $likeExp    =   $like[2] ?? null;
                                    $likeParam  =   strtolower($like[3] ?? null);

                                    if ($likeParam == null || $likeParam == 'and') {
                                        $this->db->like($likeColumn, $likeValue, $likeExp);
                                    } else {
                                        $this->db->or_like($likeColumn, $likeValue, $likeExp);
                                    }
                                }
                            $this->db->group_end();
                        }
                    }
                }

                if (isset($params['or_where'])) {
                    if (!is_array($params['or_where'])) {
                        $params['or_where']  =   [$this->primary_key => $params['or_where']];
                    }
                    $this->db->or_where($params['or_where']);
                }

                if (isset($params['in_where'])) {
                    if (is_array($params['in_where'])) {
                        if (is_array($params['in_where'][0])) {
                            foreach ($params['in_where'] as $v) {
                                $this->db->where_in($v[0], $v[1]);
                            }
                        } else {
                            $this->db->where_in($params['in_where'][0], $params['in_where'][1]);
                        }
                    }
                }

                if (isset($params['not_in'])) {

                    if (is_array($params['not_in'])) {
                        $this->db->where_not_in($params['not_in'][0], $params['not_in'][1]);
                    }
                }

                if (isset($params['return_count'])) {
                    return $this->db->count_all_results($this->tbl);
                }

            } 


            $query = $this->db->get($this->tbl, $limit, $offset);

            if ($return_type) {
                if ($return_type == 'array') {
                    return $query->num_rows() > 0 ? $query->result_array() : false;
                } else {
                    return $query->num_rows() > 0 ? $query->result() : false;
                }
            } else {
                return $query->num_rows() > 0 ? $query->result() : false;
            }
        }
    }

    public function list_all_reader($where = null, $limit = null, $offset = null, $order = null, $join = null, $params = null)
    {
        if (empty($limit)) {
            $limit  =   PHP_INT_MAX;
        }

        if (empty($offset)) {
            $offset  =   0;
        }

        # accept string but the default where is to the primary key
        if (!empty($where)) {
            if (!is_array($where)) {
                $where  =   [$this->primary_key => $where];
            }
            $this->db_reader->where($where);
        }

        # This statement will accept array or string order
        if (!empty($order)) {
            if (!is_array($order)) {
                $order  =   [$order];
            }
            $this->db_reader->order_by(implode(', ', $order));
        }

        # This statement will accept array only for joining
        if (!empty($join)) {
            if (is_array($join)) {
                $isMultiArray   =   is_array($join[0]);

                if ($isMultiArray) {
                    foreach($join as $array) {
                        $joinTable      =   $array[0];
                        $joinWhere      =   $array[1];
                        $joinStatus     =   $array[2] ?? null;

                        $this->db_reader->join($joinTable, $joinWhere, $joinStatus);
                    }
                } else {
                    $joinTable      =   $join[0];
                    $joinWhere      =   $join[1];
                    $joinStatus     =   $join[2] ?? null;

                    $this->db_reader->join($joinTable, $joinWhere, $joinStatus);
                }
            }
        }

        $return_type = false;

        if (!is_null($params)) {
            if (isset($params['group_by'])) {
                $group_by   =   $params['group_by'];
                if (is_array($group_by)) {
                    $group_by   =   implode(', ', $group_by);
                }
                $this->db_reader->group_by($group_by);
            }

            if (isset($params['select'])) {
                $select = $params['select'];
                $this->db_reader->select($select);
            }

            if (isset($params['return_type'])) {
                $return_type = $params['return_type'];
            }

            if (isset($params['like'])) {

                $like   =   $params['like'];
                if (!empty($like)) {
                    if (is_array($like)) {
                        $isMultiArray   =   is_array($like[0]);

                        $this->db_reader->group_start();
                            if ($isMultiArray) {
                                foreach ($like as $keyV => $v) {
                                    if (is_array($v[0])) {
                                        foreach ($v as $keyX => $x) {
                                            $this->db_reader->group_start();
                                                foreach ($x as $y) {
                                                    $likeColumn =   $y[0];
                                                    $likeValue  =   $y[1];
                                                    $likeExp    =   $y[2] ?? null;
                                                    $likeParam  =   strtolower($y[3] ?? null);

                                                    if ($likeParam == null || $likeParam == 'and') {
                                                        $this->db_reader->like($likeColumn, $likeValue, $likeExp);
                                                    } else {
                                                        $this->db_reader->or_like($likeColumn, $likeValue, $likeExp);
                                                    }
                                                }
                                            $this->db_reader->group_end();
                                        }
                                    } else {
                                        $likeColumn =   $v[0];
                                        $likeValue  =   $v[1];
                                        $likeExp    =   $v[2] ?? null;
                                        $likeParam  =   strtolower($v[3] ?? null);

                                        if ($likeParam == null || $likeParam == 'and') {
                                            $this->db_reader->like($likeColumn, $likeValue, $likeExp);
                                        } else {
                                            $this->db_reader->or_like($likeColumn, $likeValue, $likeExp);
                                        }
                                    }
                                }
                            } else {
                                $likeColumn =   $like[0];
                                $likeValue  =   $like[1];
                                $likeExp    =   $like[2] ?? null;
                                $likeParam  =   strtolower($like[3] ?? null);

                                if ($likeParam == null || $likeParam == 'and') {
                                    $this->db_reader->like($likeColumn, $likeValue, $likeExp);
                                } else {
                                    $this->db_reader->or_like($likeColumn, $likeValue, $likeExp);
                                }
                            }
                        $this->db_reader->group_end();
                    }
                }
            }

            if (isset($params['or_where'])) {
                if (!is_array($params['or_where'])) {
                    $params['or_where']  =   [$this->primary_key => $params['or_where']];
                }
                $this->db_reader->or_where($params['or_where']);
            }

            if (isset($params['in_where'])) {
                if (is_array($params['in_where'])) {
                    if (is_array($params['in_where'][0])) {
                        foreach ($params['in_where'] as $v) {
                            $this->db_reader->where_in($v[0], $v[1]);
                        }
                    } else {
                        $this->db_reader->where_in($params['in_where'][0], $params['in_where'][1]);
                    }
                }
            }

            if (isset($params['not_in'])) {

                if (is_array($params['not_in'])) {
                    $this->db_reader->where_not_in($params['not_in'][0], $params['not_in'][1]);
                }
            }

            if (isset($params['return_count'])) {
                return $this->db_reader->count_all_results($this->tbl);
            }

        } 


        $query = $this->db_reader->get($this->tbl, $limit, $offset);

        if ($return_type) {
            if ($return_type == 'array') {
                return $query->num_rows() > 0 ? $query->result_array() : false;
            } else {
                return $query->num_rows() > 0 ? $query->result() : false;
            }
        } else {
            return $query->num_rows() > 0 ? $query->result() : false;
        }
    }

    public function create($fields, $return = true)
    {
        $this->db->insert($this->tbl, $fields);
        
        if ($return) {
            return $this->db->affected_rows() > 0 ? $this->get($this->db->insert_id()) : false;
        }
    }

    public function batch_insert($fields)
    {
        $this->db->insert_batch($this->tbl, $fields);

        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function update($fields, $where = null, $wherein = null)
    {
        if (!empty($where)) {
            if (!is_array($where)) {
                $where  =   [$this->primary_key => $where];
            }
            $this->db->where($where);
        } else {
            if (!empty($wherein)) {
                $this->db->where_in($wherein);
            } else {
                $this->db->where($this->primary_key, $this->id);
            }
        }

        $this->db->update($this->tbl, $fields);

        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function delete($soft_delete = false, $where = null)
    {
        if ($soft_delete) {
            return $this->update(['deleted' => date('Y-m-d H:i:s')]);
        }

        if ($this->id != null) {
            $this->db->where([$this->primary_key => $this->id]);
        } else {
            if (!empty($where)) {
                if (!is_array($where)) {
                    $where  =   [$this->primary_key => $where];
                }
                $this->db->where($where);
            }
        }

        $this->db->delete($this->tbl);

        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function randomString($len = '8')
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = '';
        for ($i=0; $i < $len; $i++) {
            $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
        }
        return $str;
    }

    public function logs_query($query_array, $table, $datatable = false)
    {
        return $this->db->count_all_results($table);
    }

    public function direct_query($params)
    {
        $return_type = false;

        if (!is_null($params)) {

            $query = $this->db->query($params['query']);

            if (isset($params['return_type'])) {
                $return_type = $params['return_type'];
            }

            if ($return_type) {
                if ($return_type == 'array') {
                    return $query->num_rows() > 0 ? $query->result_array() : false;
                } else {
                    return $query->num_rows() > 0 ? $query->result() : false;
                }
            } else {
                return $query->num_rows() > 0 ? $query->result() : false;
            }
        }

        return false;
    }

    public function direct_query_reader($params)
    {
        $return_type = false;

        if (!is_null($params)) {

            $query = $this->db_reader->query($params['query']);

            if (isset($params['return_type'])) {
                $return_type = $params['return_type'];
            }

            if ($return_type) {
                if ($return_type == 'array') {
                    return $query->num_rows() > 0 ? $query->result_array() : false;
                } else {
                    return $query->num_rows() > 0 ? $query->result() : false;
                }
            } else {
                return $query->num_rows() > 0 ? $query->result() : false;
            }
        }

        return false;
    }
}

/* End of file my_model.php */
/* Location: ./app-backoffice/core/my_model.php */

class DB_reader_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db_reader = $this->load->database('db_reader', TRUE);
        $this->db_reader->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
    }
}