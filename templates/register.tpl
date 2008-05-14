{include file="header.tpl"}
<h1>Registriere Dich</h1>
{include file="message.tpl"}
<form  encoding="utf-8"  id="register_form"
       onSubmit="register_onSubmit();" method="post">
  <input type="hidden" name="register" value="true" />
   <table>
     <tr>
       <th>Vorname</th>
       <td><input type="text" name="first_name" id="first_name"
       value="{$smarty.request.first_name}" /></td>
     </tr>
     <tr>
       <th>Nachname</th>
       <td><input type="text" name="last_name" id="last_name"
       value="{$smarty.request.last_name}" /></td>
     </tr>
     <tr>
       <th>E-Mail:</th>
       <td><input type="text" name="e_mail" id="e_mail"
       value="{$smarty.request.e_mail}" /></td>
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
       <td colspan="2">
	 <input type="checkbox" id="agbs" name="agbs" />
	 <label for="agbs">Ich aktzeptiere die Nutzungsbedingungen</label>
	 </td>
     </tr>
     <tr>
       <td><input type="reset" /> </td>
       <td><input type="submit" value="Registrieren" /></td>           
   </table>
</form>
{include file="footer.tpl"}
