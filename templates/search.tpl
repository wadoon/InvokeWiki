{*
 * @File: search.tpl
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/templates/search.tpl $
 * $Id: search.tpl 20 2008-06-01 13:38:31Z alex953 $
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
<h2>Suche:</h2>
<form action="" onSubmit="return false;">
      <label for="query"><b>Ihre Suchanfrage: </b></label> 
      <input type="text" value="{$smarty.request.search_wiki}" id="query" name="query" />
      <button 
	 onClick="new
	Ajax.Updater('search_content','include/_searchwiki.php?query='+$F('query'));">
	Volltext-Suche
      </button><br />
      <label for="query"><b>Ihre Suchanfrage: </b></label> 
      <input type="text" value="{$smarty.request.tag}" id="tag" name="tag" />
      <button 
	 onClick="new Ajax.Updater('search_content','include/_searchwiki.php?tag='+$F('tag'));">
	Tag-Suche
      </button>
    
      <span id="indicator1" style="display: none"><img src="/images/spinner.gif" alt="Working..." /></span>
      <div id="tag_choices" class="autocomplete"></div>
</form>


<div id="search_content">
<center>	Suche wird ausgeführt ... </center>
</div>
<script language="javascript">
	new Ajax.Updater('search_content',
			 'include/_searchwiki.php?query={$smarty.request.search_wiki}&tag={$smarty.request.tag}');
</script>

{literal}
<script language="javascript">
  new Ajax.Updater('tag_soup', 'include/_atagsoup.php?action=list');

  new Ajax.Autocompleter("tag", "tag_choices",
  "include/_atagsoup.php?action=search", 
  {paramName: "value", 
   minChars: 1, 
//   updateElement: addTagToList, 
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
