<?
/*
 * @File: __lucene_rebuild.php
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/include/__lucene_rebuild.php $
 * $Id: __lucene_rebuild.php 20 2008-06-01 13:38:31Z alex953 $
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
 
     require_once("init.inc.php");     
?>
<pre>
Author:      Alexander Weigl <alex953@gmail.com>
Date:        2008-05-17
Description: Rebuilding the lucene index!
<?    
    $lucene->newIndex();    
    $time_start = microtime(true);
    $article = $db->fetchAll("SELECT * FROM article a" .
                    " INNER JOIN articleversion v"     .
                    " ON  a.article_id = v.article_id" .
                    " INNER JOIN users u on u.User_Id = v.Creator ");
    
    echo "Query finsihed: " +
    count($article) . " Datasets in " . ($query_start - microtime(true)) . " s \n";    
                    
    foreach($article as $av )
    {
        $atime = microtime(true);    
        echo "Indexing: (A: $av[Article_Id]|V: $av[Version_No]) $av[Title] ... ";
        $lucene->indexArticleArray( $av );
        echo " finish " . ( microtime(true) - $atime) . " s \n";
    }
    
    echo "Indexing finished! (" . ( microtime(true) - $time_start ) . " s)\n";
?>
</pre>
