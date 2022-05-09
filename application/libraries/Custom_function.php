<?php
    
    function time_today()
    {
        return date('M d, Y g:i:s A');
    }

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

    function mydate($format, $unixstamp = null)
    {
        if ( is_int($unixstamp) && strlen($unixstamp) <= 10 ) {
            return date($format, $unixstamp);
        } else if (strlen($unixstamp) <= 10 && is_string($unixstamp)) {
            return date($format, $unixstamp);
        } else if ( is_float($unixstamp) ) {
            $vMil   =   substr(round($unixstamp, 3), -3);
            $format =   str_replace('v', $vMil, $format);

            return date($format, round($unixstamp/1000));
        } else if ( is_numeric($unixstamp) ) {
            $vMil   =   substr(round($unixstamp, 3), -3);
            $format =   str_replace('v', $vMil, $format);

            return date($format, round($unixstamp/1000));
        } else {

            $milliseconds   =   round(microtime(true) * 1000);
            $vMil           =   substr(round($milliseconds, 3), -3);
            $format         =   str_replace('v', $vMil, $format);

            return date($format);
        }

    }

    function mystrtotime($string_date, $operator = null)
    {
        $microSearch        =   strpos($string_date, '.');
        $microSeconds       =   '';

        if ( $microSearch ) {
            $microSeconds   =   substr($string_date, $microSearch, 4);
            $string_date    =   str_replace($microSeconds, '', $string_date);
        }

        $date               =   new DateTime($string_date);

        if ( !is_null($operator) ){
            $date->modify($operator);
        }

        if ( $microSearch ) {
            $microSeconds   =   str_replace('.', '', $microSeconds);
        } else {
            $microSeconds   =   $date->format('v');
        }

        if ( $microSeconds == 000 ) {
            // $microSeconds    =   '';
        }

        $unix_timestamp     =   $date->getTimestamp() . $microSeconds;

        return $unix_timestamp;
    }

?>