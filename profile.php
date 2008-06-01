<?
/*
 * @File: profile.php
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/profile.php $
 * $Id: profile.php 20 2008-06-01 13:38:31Z alex953 $
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
 
require_once('include/init.inc.php');
$smarty->assign('site_name', "Benutzerprofil");
#print_r($_REQUEST);
if($_REQUEST['form']=='user_update')
  {
    $db_array=array(
		    "last_name"=>$Last_Name,
		    "first_name"=>$First_Name,
		    "e_mail"=>$E_Mail);
    try
      {
	$logger->info("$_SESSION[loggedIn] update from ".
		      implode(', ' , 
			      $db->fetchRow('SELECT * FROM users WHERE user_id = ?',$_SESSION['loggedIn'])) 
			      . ' to ' 
			      . implode(', ', $db_array));
	$db->update("users", $db_array,'user_id = '.$_SESSION['loggedIn']);
	$smarty->assign('success','Änderung erfolgreich');
      }catch(Exception $e)
	 {
	   $smarty->assign('error', $e->getMessage());
	 }
  }

if($_REQUEST['form']=='set_pwd')
  {
    if( $pwd1 != $pwd2)
      {
	$smarty->assign('error', "Passwörter stimmen nicht überein");
      }
    else
      {
	try
	  {
	    $logger->info("update $_SESSION[loggedIn] password");
	   $count =  $db->update('users',
			array("Pass"=>new Zend_Db_Expr("Password('$pwd1')")),
			 "user_id = $_SESSION[loggedIn]"
			." AND pass = password('$old_pwd')");
	   if($count == 1)
	     {
	       $smarty->assign('success', "Passwort geändert");
	       $logger->info("update user $_SESSION[loggedIn] password");
	     }
	   else
	     {
	       $str = "Passwort wurde nicht geändert. <br> Altes Passwort stimmt nicht";
	       $logger->err($str . " - " . $_SESSION['loggedIn']);
	       $smarty->assign('error', $str);

	   }
	  }catch(Exception $e)
	     {
	       $smarty->assign('error', "Konnte Passwort nicht ändern<br>"
			       .$e->getMessage());
	     }
		       
      }
  }


$user = $db->fetchRow("SELECT * FROM users WHERE user_id = ?", $_SESSION['loggedIn']);
$smarty->assign('user',$user);
$smarty->display('profile.tpl');
?>
