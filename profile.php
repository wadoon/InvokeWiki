<?
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
