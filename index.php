<?php
require_once 'include/init.inc.php';
$smarty->assign("site_name", "InVoke");
$smarty->assign("site_title", "Startseite");
$smarty->display("index.tpl");
?>
