<h1>Sie sind nicht eingeloggt</h1>
<div class="error">
  Um diese Seite oder Aktion auszuführen müssen Sie eingeloggt sein.
</div>
{if !$smarty.session.loggedIn }
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
{/if}		
	
