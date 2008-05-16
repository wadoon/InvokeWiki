<?
require_once("init.inc.php");

function tagcloud_article()
{
  global $db, $logger;
  require_once("TagCloud.php");
  $tc = new HTML_TagCloud();

  $sql = "SELECT Common_Name, Created, COUNT(at.Article_Tag_Id) AS Count".
    " FROM articletags NATURAL JOIN article_articletags at GROUP BY Common_Name, Created; ";

  $tags = $db->fetchAll($sql);
   
  foreach($tags as $tag)
    {
      $tc->addElement($tag['Common_Name'], 'search.php?tag='.$tag['Common_Name'], $tag['Count'], $tag['Created']);
    }
  echo $tc->buildAll();
}

function indexstats()
{
  global $lucene;
  echo "Indexgröße: " . $lucene->getIndexSize() . " KB | Dokumente:  " . $lucene->getDocsCount() ;
}

function latestusers($param)
{
  global $db;
  $limit = $param[0] ? $param[0]  : 5;
  $users = $db->fetchAll("SELECT * FROM users ORDER BY Created DESC LIMIT ?", $limit);
  echo "<ul>";
  foreach($users as $user)
    echo "<li> $user[First_Name] $user[Last_Name]</li>";
  echo "</ul>";
}

function latestarticles($param)
{
  global $db;
  $limit = $param[0] ? $param[0]  : 5;
  $articles = $db->fetchAll("SELECT Alias, Title FROM article ORDER BY Created DESC LIMIT ?", $limit);
  echo "<ul>";
  foreach($articles as $article)
    echo "<li><a href='wiki.php?alias=$article[Alias]'>$article[Title]</li>";
  echo "</ul>";
}
         
function latestversions($param)
{
  global $db;
  $limit = $param[0] ? $param[0]  : 5;
  $articles = $db->fetchAll("SELECT Alias, v.Created, Title FROM article a ".
			 " INNER JOIN articleversion v ORDER BY v.Created DESC LIMIT ?", $limit);
  echo "<ul>";
  foreach($articles as $article)
    echo "<li><a href='wiki.php?alias=$article[Alias]'>$article[Title]</li>";
  echo "</ul>";
}
try
{
  call_user_func  ($action, explode(',',$param));
}
catch(Exception $e)
{
  echo "<div class='error'>Function $action does not exits ".$e->getMessage()."</div>";
}
?>