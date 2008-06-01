<?
/*
 * @File: init.inc.js
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/include/init.inc.php $
 * $Id: init.inc.php 20 2008-06-01 13:38:31Z alex953 $
 * $Author: alex953 $
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public
 * License as published by the Free Software Foundation; either
 * version 3.0 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */
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