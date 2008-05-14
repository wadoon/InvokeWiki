<?php /* Smarty version 2.6.19, created on 2008-05-13 18:43:25
         compiled from search.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h1>Suche:</h1>

Ihre Suchanfrage: <b><?php echo $_REQUEST['search_wiki']; ?>
</b>
<div id="search_content">
<center>	Suche wird ausgeführt ... </center>
</div>
<script language="javascript">
	new Ajax.Updater('search_content', 'include/_searchwiki.php?query=<?php echo $_REQUEST['search_wiki']; ?>
');
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>