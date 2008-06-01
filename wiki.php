<?
/*
 * @File: wiki.php
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/wiki.php $
 * $Id: wiki.php 20 2008-06-01 13:38:31Z alex953 $
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
	    
	    // Issue #13
	    
	    $content = strip_tags($content, $config['allowable_tags']);
	    
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
	  
	  if(! $_SESSION['is_admin'] AND 
	     $db->fetchOne('SELECT Closed FROM article WHERE Article_Id = ?', $articleId) == 1  )
	    throw new Exception("Dieser Artikel ist gesperrt für jegliche Änderung von Ihnen.". 
				" <b>Sie sind nicht Admin!</b>");
	  
	    // Issue #13
	    
	  $content = strip_tags($content, $config['allowable_tags']);

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
    if( count($article) )
      {
	$article['Content'] =  stripslashes  ( $article['Content'] );
	if($article['Deleted'])
	  {
	    $smarty->assign("article_deleted", $article);
	  }
	else
	  {
	    $smarty->assign("article", $article);
	    $smarty->assign("new_article", $new_article=false);
	  }
      }
    else
      {
        $smarty->assign("new_article", $new_article=true);
        $smarty->assign("prototype" , true); #unload prototype because mootools
      }
  }


if($action == 'show_edit')
  {
    if(! $_SESSION['is_admin'] AND 
       $db->fetchOne('SELECT Closed FROM article WHERE Article_Id = ?', $articleId) == 1  )
      {

	$smarty->assign('error',"Dieser Artikel ist gesperrt für jegliche Änderung von Ihnen.". 
			" <b>Sie sind nicht Admin!</b>");
	$smarty->assign('do_not_show', true);
      }
    $smarty->assign("show_edit", 1);        
    $smarty->assign("prototype" , true); #unload prototype because mootools
  }

$rating = new Rating($article['Article_Id']);

qps();
$smarty->assign('site_name', 'Invoke-Wiki' );
$smarty->assign('site_title', $article['Title'] );
$smarty->assign('rating_average',$rating->average);
$smarty->assign('ratings', $rating->ratings);
$smarty->assign("new_article", $new_article);
$smarty->display("wiki.tpl");
?>
