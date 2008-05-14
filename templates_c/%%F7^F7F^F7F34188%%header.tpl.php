<?php /* Smarty version 2.6.19, created on 2008-05-13 18:43:05
         compiled from header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'debug', 'header.tpl', 1, false),)), $this); ?>
<?php echo smarty_function_debug(array(), $this);?>

<HTML>
<HEAD>
<link rel="stylesheet" type="text/css" href="css/main.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="js/prototype.js"    type="text/javascript"></script>
<script src="js/scriptaculous.js" type="text/javascript" language="javascript"></script>
<script src="js/invoke.js" type="text/javascript" language="javascript"></script>
<?php if ($this->_tpl_vars['ext_js']): ?>
  <?php echo '
   <script language="javascript" type="text/javascript">
    {$ext_js}
   </script>
  '; ?>

<?php endif; ?>
<TITLE><?php echo $this->_tpl_vars['site_title']; ?>
 - <?php echo $this->_tpl_vars['site_name']; ?>
</TITLE>
</HEAD>
<body>
<div class="content">
	<div class="head" style="height:50px; background:#ccc; vertical-align:bottom;" >
            <form action="search.php" style="float:right">
	    	  <label for="search_wiki">Suche:</label>
		  <input type="text" name="search_wiki" id="search_wiki" />
	    </form>	 

      	  <?php if (! $_SESSION['loggedIn']): ?>
	    <form action="" method="post">
	      <input type="hidden" name="login" value="true" />
	      Login: <input type="text" name="e_mail" id="e_mail" />
              <input type="password" name="pwd" id="pwd"/>
	      <input type="submit" value="login">
	    </form>          
	    <?php endif; ?>		
	    
	</div>
	<div class="innerContent">
	  <noscript class="error" align="center">
	    Bitte aktivieren Sie JavaScript!
	  </noscript>