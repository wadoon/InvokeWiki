<?
/*****************************************************************
 * File: include/init.inc.php
 * Version: 1.0
 * Date: 08.10.2007 - 17:19:40
 * Autor: alex
 *
 * --[History] ----------------------------------------------------
 * 08.10.2007 alex: inital comment

 *****************************************************************/
session_start();

#include directory
$incd = dirname(__FILE__);

if(strpos($_ENV['Path'], ';'))  // check for winodws
	$s = ';';
else
	$s = ':';
ini_set( 'include_path', ini_get('include_path'). ".${s}$incd${s}${incd}/../libs$s") or die("Can not set include path");
#

#Get Database
require_once "Zend/Db.php";
require_once "Zend/Log.php";
require_once "Zend/Log/Writer/Db.php";
require_once "Zend/Debug.php";
#Smarty Template Engine
require_once 'Smarty.class.php';

#Read Config
require_once $incd.'/../config.php';

#create Smarty-Template Engine
$smarty = &new Smarty;
$_GLOBALS['smarty'] = $smarty;
#End init smarty

#make db-connectivity
$db = Zend_Db::factory('Mysqli', $config['db']);
$_GLOBALS['db'] = &$db;
#


#Get default functions
require 'functions.inc.php';

#$smarty->assign("session", $_SESSION);
$smarty->assign("site_title", "InVoke");
$writer = new Zend_Log_Writer_Db($db, 'log');
$logger = new Zend_Log($writer);

$smarty->assign('config',$config);

$smarty->template_dir = dirname( dirname (__FILE__) )."/templates";
$smarty->compile_dir = dirname( dirname (__FILE__) )."/templates_c";

foreach($_REQUEST as $key => $value) $$key = $value;


if(isset($_REQUEST['login']))
   login(  
	 $_REQUEST['e_mail'], 
	 $_REQUEST['pwd']
	   );
if(isset($_REQUEST['logout'])) logout();


#Intall Lucene Support
require_once("lucene.inc.php");

$lucene = &new Lucene($config['index_path']);

#mb_http_output("UTF-8");
#ob_start("mb_output_handler");
?>