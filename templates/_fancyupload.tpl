{*
 * @File: _fancyupload.tpl
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/templates/_fancyupload.tpl $
 * $Id: _fancyupload.tpl 20 2008-06-01 13:38:31Z alex953 $
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
<form action="include/_uploadarticle.php" method="post" enctype="multipart/form-data" id="fancy-upload">
      	<fieldset id="fancy-fallback">
		<legend>File Upload</legend>
		<p>Wähle ein Datei zum Upload aus:<br />
		<strong>This form s just an example fallback for the unobtrusive behaviour of FancyUpload.</strong>		</p>
		<label for="fancy-photoupload">
			Upload Photos:
			<input type="file" name="photoupload" id="demo-photoupload" />
		</label>
	</fieldset>
 
	<div id="fancy-status" class="hide">
		<p>
			<a href="#" id="fancy-browse-all">Browse Files</a> |
			<a href="#" id="fancy-browse-images">Browse Only Images</a> |
			<a href="#" id="fancy-clear">Clear List</a> |
			<a href="#" id="fancy-upload">Upload</a>
		</p>
		<div>
			<strong class="overall-title">Overall progress</strong><br />
			<img src="js/fancyupload/bar.gif" class="progress overall-progress" />
		</div>
		<div>
			<strong class="current-title">File Progress</strong><br />
			<img src="js/fancyupload/bar.gif" class="progress current-progress" />
		</div>
		<div class="current-text"></div>
	</div>
	<ul id="fancy-list"></ul> 
</form>