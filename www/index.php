<?php
/**
 * 财务列表
 * Created by PhpStorm.
 * User: zhangxing
 * Date: 14-7-21
 * Time: 下午10:21
 */
require_once(dirname(__FILE__) . "/env.php");

// 获取所有的收入支出
$month = isset($_GET['month']) ? $_GET['month'] : date("Y-m");
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageCount = 10;
$sql = "select count(*) as total from detail where LEFT(`date`,7) = '" . $month . "'";
$rs = mysql_fetch_assoc(mysql_query($sql));
$total = $rs['total'];
$totalPage = ceil($total / $pageCount);
$start = ($page - 1) * $pageCount;
//计算收入笔和收入总额
$sql = "select count(*) as in_count,sum(money) as income from detail where LEFT(`date`,7) = '" . $month . "' AND type = '收入'";
$rs = mysql_fetch_assoc(mysql_query($sql));
$in_count = $rs['in_count'];
$income = $rs['income'];
//计算支出笔和支出总额
$sql = "select count(*) as ex_count,sum(money) as expand from detail where LEFT(`date`,7) = '" . $month . "' AND type = '支出'";
$rs = mysql_fetch_assoc(mysql_query($sql));
$ex_count = $rs['ex_count'];
$expand = $rs['expand'];
//详细列表
$sql = "select * from detail where LEFT(`date`,7) = '" . $month . "' limit $start,$pageCount";
$result = mysql_query($sql);
$detail_list = array();
while ($rs = @mysql_fetch_assoc($result)) {
    $detail_list[] = $rs;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title><?= str_replace("-", "年", $month) ?>月---个人财务报表</title>
    <link href="css/index.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<div id="content">
    <div id="menu" class="clearfix">
        <ul>
            <li><a href="index.php">本月清单</a></li>
            <li><a href="add.php">添加账单</a></li>
        </ul>
    </div>
    <div id="query" class="clearfix">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
            <input type="text" name="month" value="<?= $month ?>">
            <input type="submit" value="查询">
        </form>
    </div>
    <div id="count" class="clearfix">
        <span>总记录：<b><?= $total ?></b>笔</span>
        <span>收入：<b><?= $in_count ?></b>笔</span>
        <span>支出：<b><?= $ex_count ?></b>笔</span>
        <span>总收入：<b><?= abs($income) ?></b>元</span>
        <span>总支出：<b><?= abs($expand) ?></b>元</span>

        <div class="clearfix"></div>
    </div>
    <div id="detail_list" class="clearfix">
        <table>
            <tr>
                <th>编号</th>
                <th>日期</th>
                <th>类型</th>
                <th>金额</th>
                <th>备注</th>
                <th>经办人</th>
                <th>操作</th>
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
                        <a href="edit.php?id=<?= $detail['id'] ?>">编辑</a>
                        |
                        <a href="del.php?id=<?= $detail['id'] ?>">删除</a>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="7" class="page">
                    <a href="<?= $_SERVER['PHP_SELF'] ?>?month=<?= $month ?>&page=1">首页</a>
                    <a href="<?= $_SERVER['PHP_SELF'] ?>?month=<?= $month ?>&page=<?= $page - 1 <= 0 ? 1 : $page - 1 ?>">上一页</a>
                    <a href="<?= $_SERVER['PHP_SELF'] ?>?month=<?= $month ?>&page=<?= $page + 1 > $totalPage ? $totalPage : $page + 1 ?>">下一页</a>
                    <a href="<?= $_SERVER['PHP_SELF'] ?>?month=<?= $month ?>&page=<?= $totalPage ?>">尾页</a>
                </td>
            </tr>
        </table>
    </div>
</div>
<div id="footer">
    版权所有：zhangxing
</div>
</body>
</html>