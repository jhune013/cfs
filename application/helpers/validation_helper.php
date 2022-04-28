<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('validation')) {

    function validation($config)
    {
        $error  =   [];
        $ci =& get_instance();

        if (is_array($config)) {
            foreach ($config as $x) {
                $ci->form_validation->set_rules($x[0], $x[1], $x[2]);
            } 

            if (!$ci->form_validation->run()) {

                $error['data']       =   [];

                foreach ($config as $x) {
                    if (form_error($x[0])) {
                        $toPush     =   [
                            'key'        =>  $x[0],
                            'attr_class' =>  $x[3] ?? null,
                            'message'    =>  $x[4] ?? strip_tags(form_error($x[0]), '<strong>')
                        ];

                        array_push($error['data'], array_filter($toPush));
                    }
                }

                if (count($error['data']) == 0) {
                    $error['message'] = validation_errors();
                }

                return array_filter($error);
            }
        }

        return false;
    }
}