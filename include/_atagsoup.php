<?
/**
 *
 *
 *
 *
 *
 */

require_once("init.inc.php");


function ls($id)
{
  global $db, $logger, $smarty;
  
  require_once 'TagCloud.php';
  
  $taglist =  $db->fetchAll( "SELECT article_tags_id, common_name ,UNIX_TIMESTAMP( created ) as created, count(*) AS c FROM articletags at ".
    " INNER JOIN article_articletags aat ON aat.article_tag_id = at.article_tags_id".
    " GROUP BY article_tags_id, common_name , created, article_id".
    " HAVING article_id = ?", $id);


  if( ! count( $taglist ) ) return '';

  $tags = new HTML_TagCloud();  

  foreach($taglist as $line)
    {
      $tags->addElement($line['common_name'], "search.php?tagid=$line[user_tag_id]", $line['c'], $line['created'] );
    }
  print $tags->buildALL();

}

function search($search)
{
  global $db, $logger;
  $search = $_REQUEST['value'];  
  $list = $db->fetchPairs('SELECT DISTINCT *  FROM articletags WHERE common_name LIKE ?', "%$search%");
  
  echo "<ul>";
  foreach($list as $k => $v)
    {
      echo "<li value=\"$k\">$v</li>";
    }
  echo "</ul>";
}

function add($articleId, $articleTag)
{
  global $db, $logger;
  
  try 
    {
      $db_array = array('article_id' =>$articleId, 'article_tag_id' => $articleTag);  
      $db->insert('article_articletags',$db_array);
    }catch(Exception $e)
       {
	 $logger->err($e->getMessage() . ' ' . __FILE__ . '@' . __LINE__ );
	 throw $e;
       }
}

switch($_REQUEST['action'])
  {
  case "list":
    ls($_GET['articleId']);
    break;
  case "search":
    search($_GET['keyword'] );
    break;
  case 'add':
    add( $_GET['articleId'] , $_GET['articleTag'] );
    break;
  }
?>