<?
/*
 * @File: register.php
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/register.php $
 * $Id: register.php 20 2008-06-01 13:38:31Z alex953 $
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

require_once("include/init.inc.php");

if(  $_REQUEST['register'] )
  {
    //handling for getting the data.
    $message['errorlevel']=0;
    $message['message']="";
    
    require_once 'Zend/Validate/EmailAddress.php';
    require_once 'Zend/Validate/NotEmpty.php';
    require_once 'Zend/Json.php';
    
    $valEmail  = new Zend_Validate_EmailAddress();
    $nonEmpty = new Zend_Validate_NotEmpty();
    
    if (! $valEmail->isValid($e_mail)) 
      {
	$message['errorlevel'] +=1;
	$message['message'][] ='E-Mail Adresse ist nicht gültig';
	$message['name'][] = 'e_mail';
      }
    
    if (!$nonEmpty->isValid($last_name) )
      {
	$message['errorlevel'] +=1;
	$message['message'][] ='Bitte geben Sie Ihren Nachnamen an.';
	$message['name'][] = 'last_name';
      }
    
    if (!$nonEmpty->isValid($first_name) )
      {
	$message['errorlevel'] +=1;
	$message['message'][] ='Bitte geben Sie Ihren Vornamen an.';
	$message['name'][] = 'first_name';
      }
    
    if ($pwd1 != $pwd2)
      {
	$message['errorlevel'] +=1;
	$message['message'][] ='Ihr Passwort stimmt nicht überein';
      }

    if( $agbs != 'on')
      {
	$message['errorlevel'] = +1;
	$message['message'][]='Sie müssen die AGBS akzeptieren';
      }
       
    if($message['errorlevel'] > 0)
      {
	$smarty->assign('error', implode( $message['message'] , '<br>'));
      }
    else
      {
	$db_array = array
	  (
	   'last_name' => $last_name,
	   'first_name' => $first_name,
	   'e_mail'=>$e_mail,
	   'pass'=>new Zend_DB_Expr("PASSWORD('$pwd1')")
	   );

	try
	  {
	    $db->beginTransaction();
	    $db->insert('users',$db_array);
	    $id = $db->lastInsertId();

	    $tags_id = $db->fetchCol('SELECT * FROM usertags WHERE user_tag_id <= ?',10);
	    foreach($tags_id as $tid)
	      $db->insert('users_usertags', array( 'User_Id'=>$id, 'User_Tag_Id' => $tid));
	    $db->commit();
	    
	    $smarty->assign('success', "Ihre Account wurde erstellt.");
	    login($e_mail,$pwd1);
	    include 'index.php';
	    exit();
	  }catch(Exception $e)
	     {
	       $smarty->assign('error', $e->getMessage());
	       $db->rollBack();
	     }
      }
  }
$smarty->assign("site_title",'Registriere Dich!');
$smarty->display("register.tpl");
?>