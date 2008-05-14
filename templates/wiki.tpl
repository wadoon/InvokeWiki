{include file="header.tpl"}
{include file="message.tpl"}
{if $new_article}
        {include file="wiki_new.tpl"}
{elseif $show_edit}
	{include file="wiki_edit.tpl"}
{else}
	{include file="wiki_show.tpl"}
{/if}
{include file="footer.tpl"}
