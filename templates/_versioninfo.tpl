{debug}
<table>
  <tr>
    <th>Version</th>
    <th>Informationen</th>
    {foreach from=$versions item=version}
  <tr>
    <th>
      {if $version.Version_No == $version_no}
      <b>{$version_no}</b>
      {else}
      <a href="wiki.php?alias={$article.Alias}&version_no={$version.Version_No}">{$version.Version_No}</a>
      {/if}
    </th>
    <td>
      <pre>
Erstellt am:{$version.Created}
Von:        {$version.First_Name} {$version.Last_Name}
Kommentar:  {$version.Comment} </pre>
      <div style="font-size:8pt">
	{$version.Content|strip_tags|truncate:30:"...":true}
      </div>
    </td>
  </tr>
  {/foreach}
</table>
