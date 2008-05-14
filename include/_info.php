<?
require_once("init.inc.php");

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