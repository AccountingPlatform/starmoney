<?php
/**
 * Created by PhpStorm.
 * User: zhangxing
 * Date: 14-7-22
 * Time: 下午10:52
 */
header("Content-Type:text/html;charset=utf-8");
// 定义网站根目录
define('WEB_ROOT', dirname(dirname(__FILE__)));
// 获取数据库配置文件
$dbconf = include(WEB_ROOT . "/etc/dbconfig.php");
// 连接数据库，选择数据库，设置字符集
$link = mysql_connect($dbconf['dbhost'], $dbconf['dbuser'], $dbconf['dbpwd']) or die('connect mysql error!' . mysql_error());
mysql_select_db($dbconf['dbname'], $link) or die('select db error!' . mysql_error());
$sql = "set names '" . $dbconf['charset'] . "'";
mysql_query($sql, $link);
?>