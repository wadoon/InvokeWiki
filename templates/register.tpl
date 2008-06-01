{*
 * @File: register.tpl
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/templates/register.tpl $
 * $Id: register.tpl 20 2008-06-01 13:38:31Z alex953 $
 * $Author: alex953 $
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public
 * License as published by the Free Software Foundation; either
 * version 3.0 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *}
 
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
