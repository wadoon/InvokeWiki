<?php /* Smarty version 2.6.19, created on 2008-05-13 18:43:05
         compiled from profile.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h1>Benutzer-Profile</h1>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "message.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form  encoding="utf-8"  id="register_form"  method="post">
  <input type="hidden" name="form" value="user_update" />
   <table>
     <tr>
       <th>UserId</th>
       <td><?php echo $this->_tpl_vars['user']['User_Id']; ?>
 
	 <?php if ($this->_tpl_vars['user']['Is_Admin'] == 1): ?> - Admin <?php endif; ?>
       </td>
     <tr>
       <th>Erstellt am:</th>
       <td><?php echo $this->_tpl_vars['user']['Created']; ?>
</td>
     </tr>
     </tr>
     <tr>
       <th>Vorname</th>
       <td><input type="text" name="First_Name" id="First_Name"
       value="<?php echo $this->_tpl_vars['user']['First_Name']; ?>
" /></td>
     </tr>
     <tr>
       <th>Nachname</th>
       <td><input type="text" name="Last_Name" id="Last_Name"
       value="<?php echo $this->_tpl_vars['user']['Last_Name']; ?>
" /></td>
     </tr>
     <tr>
       <th>E-Mail:</th>
       <td><input type="text" name="E_Mail" id="E_Mail"
       value="<?php echo $this->_tpl_vars['user']['E_Mail']; ?>
" /></td>
     </tr>
     <tr>
       <td colspan="2"><input type="submit" value="Setzen" /></td>           
     </tr>		     
   </table>
</form>
<form method="post">
<fieldset>
  <legend>Passwort setzen:</legend>
  <input type="hidden" name="form" value="set_pwd" />
  <table>
    <tr>
      <th>Altes Passwort:</th>
      <td><input type="password" name="old_pwd" /></td>
      </tr>
     <tr>
       <th>Passwort:</th>
       <td><input type="password" name="pwd1" id="pwd1" ></td>
       </tr>
     <tr>
       <th>Passwort (wiederholen:)</th>
       <td><input type="password" name="pwd2" id="pwd2"></td>
     </tr>
     <tr>
       <td colspan="2"><input type="submit" value="Setzen" /></td>           
     </tr>
   </table>
</fieldset>
</form>
<div>
	<fieldset><legend>Tag-Suppe:</legend>
	  <label for="tagsearch">Tagssuche</label>
	  <input type="text" id="tagsearch" name="tagsearch" />
	  
	  <span id="indicator1" style="display: none"><img src="/images/spinner.gif" alt="Working..." /></span>
	  <div id="tag_choices" class="autocomplete"></div>

	  <div id="tag_soup"></div>

	</fieldset>
</div>
<?php echo '
<script language="javascript">
  new Ajax.Updater(\'tag_soup\', \'include/_tagsoup.php?action=list\');

  new Ajax.Autocompleter("tagsearch", "tag_choices",
  "include/_tagsoup.php?action=search", 
  {paramName: "value", 
   minChars: 1, 
   updateElement: addTagToList, 
   indicator: \'indicator1\'} );
</script>

<style>
    div.autocomplete {
      position:absolute;
      width:250px;
      background-color:white;
      border:1px solid #888;
      margin:0px;
      padding:0px;
    }
    div.autocomplete ul {
      list-style-type:none;
      margin:0px;
      padding:0px;
    }
    div.autocomplete ul li.selected { background-color: #ffb;}
    div.autocomplete ul li {
      list-style-type:none;
      display:block;
      margin:0;
      padding:2px;
      height:32px;
      cursor:pointer;
    }
</style>
'; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>