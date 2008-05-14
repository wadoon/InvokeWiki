<div class="wiki_article">
<div style="float:right">
     <a href="?action=show_edit&alias={$article.Alias}&articleId={$article.Article_Id}">Bearbeiten</a>
</div>
     <h1>{$article.Title}</h1>
     <div class="rating">
	  {foreach from=$ratings item=rating}
	       <div id="rating_{$rating->id}">
	       {$rating->html}
	       {if $smarty.session.loggedIn}
		    <select onChange="rate( {$article.Article_Id},{$rating->id},$F(this))">
			 <option value="-1">-</option>
			 <option value="5">Sehr gut</option>
			 <option value="4">Gut </option>
			 <option value="3">Mittelmäßig</option>
			 <option value="2">Mangelhaft</option>
			 <option value="1">Fehlerhaft</option>			 		    </select>
	       {/if}
	       </div>
	  </div
	  {/foreach}
     </div>
{*
     <div class="sub">
     	  ArticleId: {$article.Article_Id} - 
	  Creator:   {$article.Creator} -
	  Created:   {$article.Created} -
	  Alias:     {$article.Alias} -
	  Version:   {$article.Version_No} -
	  Comment:   {$article.Comment}
     <div>*}
     {$article.Content}     

	<fieldset><legend>Tag-Suppe:</legend>
	  <label for="tagsearch">Tagssuche</label>
	  <input type="text" id="tagsearch" name="tagsearch" />	 
	  <button onClick="addArticleTag" >Hinzufügen</button>
	  <span id="indicator1" style="display: none"><img src="/images/spinner.gif" alt="Working..." /></span>
	  <div id="tag_choices" class="autocomplete"></div>	  
	  <div id="tag_soup"></div>	  
	</fieldset>
     </div>
     <script language="javascript">
       var articleId = {$article.Article_Id};
     </script>
     {literal}
     <script language="javascript">         
       new Ajax.Updater('tag_soup', 'include/_atagsoup.php?action=list&articleId='+articleId);
       
       new Ajax.Autocompleter("tagsearch", "tag_choices",
       "include/_atagsoup.php?action=search" , 
       {paramName: "value", 
        minChars: 1, 
        updateElement: addTagToListArticle, 
        indicator: 'indicator1'} );


 

       function addArticleTag()
       {
         var value = $F('tagsearch');
         if(value.empty()) return;
       
          new Ajax.Request('include/_atagsoup.php', 
          {
            parameters: {action:add, name:value},
            method:'get', 
            onSuccess : function(r) {
                                 $('tagsearch').value=''; 
            },
            onFailure:  function(r) { 
                                alert(r.responseText);
            }
          })
       }
     </script>
{/literal}     
     
     <div id="version_info">
       <a onClick="new Ajax.Updater('version_info','include/_versioninfo.php?articleId={$article.Article_Id}&version_no={$article.Version_No}')">Versioninformationen</a>
     </div>
</div>
     
