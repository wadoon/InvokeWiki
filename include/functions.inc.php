<?

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
	  $_SESSION['admin']    = (bool) $id['is_admin'];
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
?>