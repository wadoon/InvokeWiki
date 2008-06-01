{*
 * @File: profile.tpl
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/templates/profile.tpl $
 * $Id: profile.tpl 20 2008-06-01 13:38:31Z alex953 $
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
<h1>Benutzer-Profil</h1>
{include file="message.tpl"}
<form  encoding="utf-8"  id="register_form"  method="post">
  <input type="hidden" name="form" value="user_update" />
  <h2>Benutzerdaten</h2>
   <table>
     <tr>
       <th>UserId</th>
       <td>{$user.User_Id} 
	 {if $user.Is_Admin == 1} - Admin {/if}
       </td>
     <tr>
       <th>Erstellt am:</th>
       <td>{$user.Created}</td>
     </tr>
     </tr>
     <tr>
       <th>Vorname</th>
       <td><input type="text" name="First_Name" id="First_Name"
       value="{$user.First_Name}" /></td>
     </tr>
     <tr>
       <th>Nachname</th>
       <td><input type="text" name="Last_Name" id="Last_Name"
       value="{$user.Last_Name}" /></td>
     </tr>
     <tr>
       <th>E-Mail:</th>
       <td><input type="text" name="E_Mail" id="E_Mail"
       value="{$user.E_Mail}" /></td>
     </tr>
     <tr>
       <td colspan="2"><input type="submit" value="Setzen" /></td>           
     </tr>		     
   </table>
</form>
<form method="post">
<h2>Passwort setzen</h2>
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
</form>
<div>
  <h2>Tag-Suppe:</h2>
  <label for="tagsearch">Tagssuche</label>
  <input type="text" id="tagsearch" name="tagsearch" />
  <span id="indicator1" style="display: none"><img src="icons/hourglass.png" alt="Working..." /></span>
  <div id="tag_choices" class="autocomplete"></div>
  <div id="tag_soup"></div>
</div>
{literal}
<script language="javascript">
  new Ajax.Updater('tag_soup', 'include/_tagsoup.php?action=list');

  new Ajax.Autocompleter("tagsearch", "tag_choices",
  "include/_tagsoup.php?action=search", 
  {paramName: "value", 
   minChars: 1, 
   updateElement: addTagToList, 
   indicator: 'indicator1'} );
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
{/literal}
{include file="footer.tpl"}
