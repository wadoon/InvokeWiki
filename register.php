<?
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