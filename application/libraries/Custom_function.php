<?php

    function http_protocol()
    {
        $forwarded_proto    =   $_SERVER['HTTP_X_FORWARDED_PROTO']  ?? null;
        $forwaded_port      =   $_SERVER['HTTP_X_FORWARDED_PORT']   ?? null;

        $local = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $protocol           =   false;

        if (!empty($forwarded_proto) && !empty($forwaded_port)) {
            if ($forwarded_proto == 'https' && $forwaded_port == 443 ) {
                $protocol   = true;
            }
        }
        
        return ($protocol ? 'https://' : $local);
    }

?>