<?php /* Smarty version 2.6.19, created on 2008-05-13 19:35:03
         compiled from nologin.tpl */ ?>
<h1>Sie sind nicht eingeloggt</h1>
<div class="error">
  Um diese Seite oder Aktion auszuführen müssen Sie eingeloggt sein.
</div>
<?php if (! $_SESSION['loggedIn']): ?>
<form action="" method="post">
  <input type="hidden" name="login" value="true" />
  <table>
    <tr>
      <td> E-Mail-Adresse:</td> 
      <td><input type="text" name="e_mail" id="e_mail" /></td>
    </tr>
    <tr>
      <td>Passwort:</td>
      <td><input type="password" name="pwd" id="pwd"/></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="login"></td>
    </tr>
    </table>
</form>          
<?php endif; ?>		
	