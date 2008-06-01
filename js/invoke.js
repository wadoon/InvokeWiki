/*
 * @File: invoke.js
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/js/invoke.js $
 * $Id: invoke.js 20 2008-06-01 13:38:31Z alex953 $
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
 */
 
function addTagToList(item)
{
    var tagid = item.value;
    new Ajax.Request('include/_tagsoup.php',
		     {
			 parameters : { action: 'add' , id : tagid},
			 onComplete: function(content){
			     new Ajax.Updater('tag_soup', 'include/_tagsoup.php?action=list');
			 }
		     }
		     );
    $('tagsearch').value = '';
}

function addTagToListArticle(item)
{
    var tagid = item.value;
    new Ajax.Request('include/_atagsoup.php',
		     {
			 parameters : { action: 'add' ,articleTag : tagid, articleId : articleId},method:'get',
			     onComplete: function(content){
			     new Ajax.Updater('tag_soup', 'include/_atagsoup.php?action=list&articleId=' + articleId);
			 }
		     }
		     );
    $('tagsearch').value = '';

}

function deleteTag(userid,tagid)
{
    new Ajax.Request('include/_tagsoup.php',
		     {
			 parameters : { action: 'delete' , id : tagid},
			 onComplete: function(content){
			     new Ajax.Updater('tag_soup', 'include/_tagsoup.php?action=list');
			 }
		     }
		     );
}

function register_onSubmit()
{
    var form = $('register_form');
        
    if(!$F('agbs') )
    {
        alert('Sie haben die AGBS nicht aktzeptiert.')
        return false;
    }
 
    return true;
/*
    form.disable();
    
    var hash = form.serialize(true);
    hash.set("register", true);
     
    
    new Ajax.Request('register.php', {
        parameters:  hash,
        method:'get',
        evalJSON: true,      
        onComplete: function(response, json) {
            if(json.errorlevel == 0)
            {
                self.location.href='index.php'
                return;
            }           
            form.enable();
            $('error').update(json.message);
            $('error').visible=true;
        }
      }
    );
    
    return false;*/
}

resizeEditorBox = function (editorID) {
	var frame, doc, docHeight, frameHeight;
	
	frame = document.getElementById(editorID+"_ifr");
	if ( frame != null ) {
		//get the document object
		if (frame.contentDocument) { 
			doc = frame.contentDocument; 
		} else if (frame.contentWindow) { 
			doc = frame.contentWindow.document; 
		} else if (frame.document) { 
			doc = frame.document; 
		}
		
		if ( doc == null )
			return;
		
		//prevent the scrollbar from showing
		doc.body.style.overflow = "hidden";
	
		docHeight;
		frameHeight = parseInt(frame.style.height);
		
		//Firefox
		if ( doc.height ) { docHeight = doc.height; }
		//MSIE
		else { docHeight = parseInt(doc.body.scrollHeight); }
		
		//MAKE BIGGER
		if ( docHeight > frameHeight-20 ) { frame.style.height = (docHeight+20) + "px"; }
		//MAKE SMALLER
		else if ( docHeight < frameHeight-20 ) { frame.style.height = Math.max((docHeight+20), 100) + "px"; }
		
		//only repeat while editor is visible
		setTimeout("adjustMceHeight('" + editorID + "')", 1);
	}
}

function rate(articleId, ratingType,value)
{
    if(value == -1) return;
    new Ajax.Updater('rating_'+ratingType, 'include/_rate.php',
		     {
			method:'get',
			parameters:{
			    article_id:articleId,
			    ratingTypeId:ratingType,
			    rating:value
			    }
		     });
}