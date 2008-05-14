<?php /* Smarty version 2.6.19, created on 2008-05-13 18:50:13
         compiled from _latestuser.tpl */ ?>
<div id="latestusers" class="info" >
     <h3>Neueste Anmeldungen</h3>
     <div id="latestusers0">
          Loading ...	
	 </div>	  
</div>
<script language="javascript">
	new Ajax.Updater('latestusers0', 'include/_info.php?action=latestusers&params=5');
</script>