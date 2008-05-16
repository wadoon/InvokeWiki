{include file="header.tpl"}
{include file="menu.tpl"}
<h1>Suche:</h1>
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
	new Ajax.Updater('search_content', 'include/_searchwiki.php?query={$smarty.request.search_wiki}');
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
