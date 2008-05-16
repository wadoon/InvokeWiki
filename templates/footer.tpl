{*
 * File: footer.tpl
 * Version: 1.0
 * Date: 08.10.2007
 * Autor: alex
 *}
</div>
<div id="footer">Suchindex:
<span id="lucene-status">
     <script language="javascript">
     new Ajax.Updater('lucene-status', 'include/_info.php?action=indexstats');
     </script>
</span>

{*Request took: {$smarty.now-$smarty.server.REQUEST_TIME} secs*}
{*foreach from=$smarty.server key=key item=value}
	{$key} = {$value}<br>
{/foreach*}
<br>
BBS Technik Koblenz | Beatusstr. 143-147 | 56073 Koblenz
© by BBS Technik Koblenz 2005 | Designed by Alexander Weigl | 
 <a href="admin.php">Admin</a>
</div>
</div>
</body>
</html>
