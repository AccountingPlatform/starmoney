<?php
/**
 * Created by PhpStorm.
 * User: zhangxing
 * Date: 14-7-21
 * Time: 下午10:21
 */
header("Content-Type:text/html;charset=utf-8");
// 定义网站根目录
define('WEB_ROOT', dirname(dirname(__FILE__)));
// 获取数据库配置文件
$dbconf = include(WEB_ROOT . "/etc/dbconfig.php");
// 连接数据库，选择数据库，设置字符集
$link = mysql_connect($dbconf['dbhost'], $dbconf['dbuser'], $dbconf['dbpwd']) or die('connect mysql error!' . mysql_error());
mysql_select_db($dbconf['dbname'], $link) or die('select db error!' . mysql_error());
$sql = "set names '" . $dbconf['dbname'] . "'";
mysql_query($sql, $link);

//菜单
echo "<div style='width:80%;margin:0 auto;'>";
echo "<a href='add.php'>Add</a>";
echo "</div>";

// 获取所有的收入支出
$sql = "select * from detail";
$result = mysql_query($sql);
echo "<table style='width:80%;margin:0 auto;border:1px solid #000'>";
echo "<tr><th>ID</th><th>Date</th><th>Type</th><th>Money</th><th>Note</th><th>Operator</th><th>Option</th>";
while ($rs = @mysql_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$rs['id']}</td>";
    echo "<td>{$rs['date']}</td>";
    echo "<td>{$rs['type']}</td>";
    echo "<td>{$rs['money']}</td>";
    echo "<td>{$rs['note']}</td>";
    echo "<td>{$rs['operator']}</td>";
    echo "<td><a href='edit.php?id={$rs['id']}'>Edit</a> | <a href='delete.php?id={$rs['id']}'>Delete</a></td>";
    echo "<tr>";
}
echo "</table>";