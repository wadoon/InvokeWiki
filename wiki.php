<?
require_once("include/init.inc.php");
require_once("include/rating.inc.php");

$new_article = false;
$site = $_GET['alias'];


#?action=new_article&title=test&alias=&content=&anyfile1=
  if($action == 'new_article' and $_SESSION['loggedIn'])
    {
      if(empty($title) or empty($alias) or empty($content) )
	{
	  $smarty->assign('error', 'Es sind nicht alle Felder ausgefüllt');
	}
      else
	{
	  try
	  {
	    $db->beginTransaction();
	    $article = array(
			     'Title'=>$title,
			     'Creator'=>$_SESSION['loggedIn'],
			     'Alias'=>$alias
			     );
	    $db->insert("article",$article);
	    $a_id = $db->lastInsertId();
	    
	    $article_version = array('Article_Id'=>$a_id, 
				     'Content'=>$content,
				     'Creator'=>$_SESSION['loggedIn'], 
				     'Comment'=>'Neuer Artikel');
	    $db->insert('articleversion', $article_version);	  
	    $lucene->indexArticleVersion($a_id, 0);
	    $db->commit();
	    $site=$alias;
	  }catch(Exception $e)
	  {
	    $db->rollBack();
	    $logger->err($e);
	    $smarty->assign('error', $e->getMessage());
	  }
	  
	}
    }
elseif($action=='edit_article' and $_SESSION['loggedIn'])
{
  if(empty($content) or empty($articleId))
    {
      $smarty->assign('error', "Es sind nicht alle Felder ausgefüllt");
    }
  else
    {
      $site=$alias;
      try
	{
	  $db->beginTransaction();
	  $av =array('Article_Id'=>$articleId, 
		     'Version_No'=>
		     $db->fetchOne("SELECT Version_No + 1 FROM articleversion ". 
				   " WHERE Article_ID = ? ORDER BY version_no desc;", $articleId),
		     'Content'=>$content,
		     'Creator'=>$_SESSION['loggedIn'], 
		     'Comment'=>$comment); 
	  $db->insert("articleversion", $av);
	  $version_no = $db->lastInsertId();
	  $lucene->indexArticleVersion($articleId, $av['Version_No'] );
	  $db->commit();
	}catch(Exception $e)
	  {
	    $db->rollBack();
	    $logger->err($e);
	    $smarty->assign('error', $e->getMessage());
	  }	
    }
}


if(!$site)
  {
    $new_article=true;
    $smarty->assign("prototype" , true); #unload prototype because mootools
  }
else
  { 
    
    
    $article = array();
    if(isset( $version_no ))
      {
	$article = $db->fetchRow("SELECT * FROM article".
				 " INNER JOIN articleversion ".
				 " on articleversion.article_id = ".
				 " article.article_id".
				 " WHERE alias = ? and version_no = ? ". 
				 " ORDER BY version_no desc limit 1;", 
				 array( $site , $_GET['version_no']) ); 
	if( ! count($article) )
	  $smarty->assign("error", "Version ist nicht vorhanden. Zeige die letzte Version an.");
       
      }

    if(! count($article))
      $article = $db->fetchRow("SELECT * FROM article ".
			       " INNER JOIN articleversion ".
			       " on articleversion.article_id = ".
			       " article.article_id ".
			       " WHERE alias = ? ORDER BY version_no desc ".
			       " limit 1;", $site); 
#    print_r($article);
    if( count($article))
      {
	$smarty->assign("article", $article);
	$smarty->assign("new_article", $new_article=false);
      }
    else
      $new_article=true;

  }


$rating = new Rating($article['Article_Id']);

$smarty->assign('rating_average',$rating->average);
$smarty->assign('ratings', $rating->ratings);
$smarty->assign("new_article", $new_article);
$smarty->assign("show_edit", $action =='show_edit'?1:0);
$smarty->display("wiki.tpl");
?>