<?
/*
 * @File: _filebrowser.php
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/include/_filebrowser.php $
 * $Id: _filebrowser.php 20 2008-06-01 13:38:31Z alex953 $
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
 
require_once('init.inc.php');

$files = array();

$suffixes = $_GET['type']=='file' ? '/.*$/' : "/.*\.(jpg|gif|png)$/";

if($handle = opendir( $config['upload_dir'] ) )
  {
    
    while( false !== ($file = readdir($handle) ) )
      {
	if($file == '..' or $file == '.') continue;
	if(!preg_match($suffixes,$file)) continue;

	$pos_ = strpos($file, '_');
	$file_name = substr($file, ++$pos_);
	$new_file = array(
			  'name'=>$file_name,
			  'url' => "$config[upload_url]/$file",
			  'size'=> filesize($config['upload_dir'].'/'.$file),
			  'date'=> filectime($config['upload_dir'].'/'.$file)
			  );
	$files[]=$new_file;
      }
#    var_dump($files);

    if($_GET['output']=='js')
      {
	echo "var ";
	if($_GET['type']=='image')
	  echo "tinyMCEImageList";
	else
	  echo "tintyMCELinkList";
	
	echo " = new Array( ";
	 
	for($i=0; $i<count($files);)
	  {
	    $file = $files[$i];	 
	    echo "['$file[name]','$file[url]']";
	    echo ++$i==count($files) ? '' :',';
	  }
	echo ');';
      }
    else
      {
	$smarty->assign('files',$files);
	$smarty->display('_filebrowser.tpl');
      }
  }
 else
   {
     throw new Exception();
   }
?>