<?php /* Smarty version 2.6.19, created on 2008-05-13 18:50:13
         compiled from _latestarticles.tpl */ ?>
<div id="latestarticles" class="info">
  <h3>Neueste Artikel</h3>
<div id="latestarticles0">
    Loading ...
  </div>
</div>
<script language="javascript">
  new Ajax.Updater('latestarticles0', 'include/_info.php?action=latestarticles&params=5');
</script>