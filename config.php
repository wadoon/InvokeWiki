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

$config['upload_dir'] = dirname(__FILE__).'/upload';
$config['index_path']    = dirname(__FILE__) .'/lindex';
$config['max_file_size'] = 10 * 1024 * 1024; // 10MB
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
