<?
/*****************************************************************
 * File: /config.php
 * Version: 1.0
 * Date: 08.10.2007 - 17:23:15
 * Autor: alex
 *
 * --[History] ---------------------------------------------------
 * 08.10.2007 alex: inital comment
 *****************************************************************/
#$config['auth_file']  = 'auth';
$config['index_path'] = dirname(__FILE__) .'/lindex';
$config['db'] = array(
    'host'     => 'localhost',
    'username' => 'root',
    'password' => 'mysql',
    'dbname'   => 'invoke',
    #'profiler'   => true,
	'options' => array(
		Zend_Db::AUTO_QUOTE_IDENTIFIERS => false
	)
);
?>
