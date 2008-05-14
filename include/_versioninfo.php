<?
require_once("init.inc.php");


$article = $db->fetchRow("SELECT * FROM article WHERE article_id = ?", $articleId);
$version = $db->fetchAll ("SELECT * FROM articleversion av ".
			  " INNER JOIN users ". 
			  " ON av.creator = users.user_id" .
			  " WHERE article_id = ? ORDER BY av.created DESC", $articleId);

#Zend_Debug::dump($article, "Artikel");
#Zend_Debug::dump($version, "Version");

$smarty->assign('articleId', $articleId);
$smarty->assign('version_no',$version_no);
$smarty->assign('article',$article);
$smarty->assign('versions',$version);
$smarty->display('_versioninfo.tpl');
?>