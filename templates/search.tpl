{include file="header.tpl"}
{include file="menu.tpl"}
<h1>Suche:</h1>

Ihre Suchanfrage: <b>{$smarty.request.search_wiki}</b>
<div id="search_content">
<center>	Suche wird ausgeführt ... </center>
</div>
<script language="javascript">
	new Ajax.Updater('search_content', 'include/_searchwiki.php?query={$smarty.request.search_wiki}');
</script>
{include file="footer.tpl"}
