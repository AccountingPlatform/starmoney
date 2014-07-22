<?php
/**
 * 财务列表
 * Created by PhpStorm.
 * User: zhangxing
 * Date: 14-7-21
 * Time: 下午10:21
 */
require_once (dirname(__FILE__) . "/env.php");

// 获取所有的收入支出
$sql = "select * from detail";
$result = mysql_query($sql);
$detail_list = array();
while ($rs = @mysql_fetch_assoc($result)) {
    array_push($detail_list, $rs);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>财务列表</title>
    <link href="css/index.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<div id="content">
    <div id="menu" class="clearfix">
        <ul>
            <li><a href="index.php">Index</a></li>
            <li><a href="add.php">Add</a></li>
        </ul>
    </div>
    <div id="detail_list">
        <table>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Type</th>
                <th>Money</th>
                <th>Note</th>
                <th>Operator</th>
                <th>Option</th>
            </tr>
            <?php foreach ($detail_list as $detail) { ?>
                <tr>
                    <td><?= $detail['id'] ?></td>
                    <td><?= $detail['date'] ?></td>
                    <td><?= $detail['type'] ?></td>
                    <td><?= $detail['money'] ?></td>
                    <td><?= $detail['note'] ?></td>
                    <td><?= $detail['operator'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $detail['id'] ?>">Edit</a>
                        |
                        <a href="del.php?id=<?= $detail['id'] ?>">Del</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
</body>
</html>