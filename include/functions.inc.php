<?
/*
 * @File: functions.inc.php
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/include/functions.inc.php $
 * $Id: functions.inc.php 20 2008-06-01 13:38:31Z alex953 $
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
 
function login($user, $password)
{
  global $smarty, $logger;
  if(!login0($user,$password))
    {
      $smarty->assign('error', "E-Mail-Adresse und Passwort gehen nicht zusammen.<br> Bitte versuchen Sie es erneut.");
      $logger->warn("user '$user' login was declined");
    }
  else
    {
      $smarty->assign('success', "Sie sind eingeloggt");
      $logger->info("user '$user' was login successfully");
    }
}

function login0($user, $password)
{
  global $db, $logger;
  $logger->info("login from user $user");
  try
    {
      $id = $db->fetchRow("SELECT user_id, is_admin FROM users WHERE e_mail = ? and pass = password(?);", 
			  array($user,$password));
      if(count($id))
	{
	  $_SESSION['loggedIn'] = (int) $id['user_id'];
	  $_SESSION['is_admin']    = (bool) $id['is_admin'];
	  return true;
	}
      else
	return false;
    }
  catch(Exception $e)
    {
      throw $e;
    }
}

function logout()
{
  return session_destroy();
}

function qps()
{
  global $db,$smarty;
  $profiler = $db->getProfiler();
  
  $smarty->assign("num_queries", $profiler->getTotalNumQueries());
  $smarty->assign("elap_seconds", $profiler->getTotalElapsedSecs());
  $smarty->assign("queries", $profiler->getQueryProfiles());
}
?>