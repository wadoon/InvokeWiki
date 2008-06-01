<?
/*
 * @File: config.php
 * @Version: 1.0
 * @Date: 17.05.2008
 * @Autor: Alexander Weigl
 * 
 * SVN:
 * $LastChangedDate: 2008-06-01 15:38:31 +0200 (So, 01 Jun 2008) $
 * $LastChangedRevision: 20 $
 * $LastChangedBy: alex953 $
 * $HeadURL: https://invokewiki.googlecode.com/svn/branches/design-improvments/config.php $
 * $Id: config.php 20 2008-06-01 13:38:31Z alex953 $
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
$config['allowable_tags'] =
    "<a><p><strong><b><i><em><u><div><span><table><tr><td><tbody><thead><tfoot><img><sub><sup><li><ol><ul><h1><h2><h3><h4><pre>";
$config['root_url'] = 'http://mars/ax/invokewiki/'; 
$config['upload_url']  = $config['root_url'] . 'upload';
$config['upload_dir'] = dirname(__FILE__).'/upload';
$config['index_path']    = dirname(__FILE__) .'/lindex';
$config['max_file_size'] = 10 * 1024 * 1024; // 10MB
$config['db'] = array(
    'host'     => 'localhost',
    'username' => 'invoke',
    'password' => 'invoke',
    'dbname'   => 'invoke',
    'profiler'   => true,
	'options' => array(
		Zend_Db::AUTO_QUOTE_IDENTIFIERS => false
	)
);
					
?>
