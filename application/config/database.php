<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db_hostname    =   'localhost';
$db_username    =   'root';
$db_password    =   '';
$db_name        =   'cfs_db';

if ($_SERVER['REMOTE_ADDR'] == "192.168.33.1") {
    $db_hostname    =   'localhost';
    $db_username    =   'root';
    $db_password    =   'root';
    $db_name        =   'cfs_db';
}


$db['default'] = array(
	'dsn'          => '',
	'hostname'     => $db_hostname,
	'username'     => $db_username,
	'password'     => $db_password,
	'database'     => $db_name,
	'dbdriver'     => 'mysqli',
	'dbprefix'     => '',
	'pconnect'     => FALSE,
	'db_debug'     => (ENVIRONMENT !== 'production'),
	'cache_on'     => FALSE,
	'cachedir'     => '',
	'char_set'     => 'utf8',
	'dbcollat'     => 'utf8_general_ci',
	'swap_pre'     => '',
	'encrypt'      => FALSE,
	'compress'     => FALSE,
	'stricton'     => FALSE,
	'failover'     => array(),
	'save_queries' => TRUE
);

$db['db_reader'] = array(
    'dsn'          => '',
    'hostname'     => $db_hostname,
    'username'     => $db_username,
    'password'     => $db_password,
    'database'     => $db_name,
    'dbdriver'     => 'mysqli',
    'dbprefix'     => '',
    'pconnect'     => FALSE,
    'db_debug'     => (ENVIRONMENT !== 'production'),
    'cache_on'     => FALSE,
    'cachedir'     => '',
    'char_set'     => 'utf8',
    'dbcollat'     => 'utf8_general_ci',
    'swap_pre'     => '',
    'encrypt'      => FALSE,
    'compress'     => FALSE,
    'stricton'     => FALSE,
    'failover'     => array(),
    'save_queries' => TRUE
);