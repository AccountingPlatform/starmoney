<?php
/**
 * Created by PhpStorm.
 * User: zhangxing
 * Date: 14-7-22
 * Time: 下午10:01
 */

require_once(dirname(__FILE__) . "/env.php");
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "select * from `detail` where id = '{$id}'";
    $result = mysql_query($sql);
    if (!$detail = mysql_fetch_array($result)) {
        echo "<script type='text/javascript'>alert('No record!')</script>";
        echo "<script type='text/javascript'>location.href='index.php'</script>";
    }
} else {
    echo "<script type='text/javascript'>alert('Required id!')</script>";
    echo "<script type='text/javascript'>location.href='index.php'</script>";
}

if (isset($_POST['submit'])) {
    $date = $_POST['id'];
    $date = $_POST['date'];
    $type = $_POST['type'];
    $money = $_POST['money'];
    $note = $_POST['note'];
    $operator = $_POST['operator'];

    $sql = "update`detail` set `date`='{$date}',`type`='{$type}',`money`='{$money}',`note`='{$note}',`operator`='{$operator}' where id='{$id}'";
    $result = mysql_query($sql);
    if ($result) {
        echo "<script type='text/javascript'>alert('Success!')</script>";
        echo "<script type='text/javascript'>location.href='index.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('Fail!')</script>";
        echo "<script type='text/javascript'>history.back(0)</script>";
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>记账</title>
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
    <form id="detail_form" method="post" action="">
        <input type="hidden" name="id" value="<?= $detail['id'] ?>"/>

        <div class="control">
            <label>日期</label>

            <div class="data">
                <input type="text" name="date" value="<?= $detail['date'] ?>">
            </div>
            <i>Please input date</i>
        </div>
        <div class="control">
            <label>类型</label>

            <div class="data">
                <select name="type">
                    <option value="支出" <?php if ($detail['type'] == '支出') echo 'selected' ?>>支出</option>
                    <option value="收入" <?php if ($detail['type'] == '收入') echo 'selected' ?>>收入</option>
                </select>
            </div>
            <i>Please select type</i>
        </div>
        <div class="control">
            <label>金额</label>

            <div class="data">
                <input type="text" name="money" value="<?= $detail['money']?>" />
            </div>
            <i>Please input money</i>
        </div>
        <div class=" control">
                <label>备注</label>

                <div class="data">
                    <textarea name="note"><?= $detail['note'] ?></textarea>
                </div>
                <i>Please input note</i>
            </div>
            <div class="control">
                <label>经办人</label>

                <div class="data">
                    <input type="text" name="operator" value="<?= $detail['operator'] ?>">
                </div>
                <i>Please input operator</i>
            </div>
            <div class=" control">
                <div class="button">
                    <input type="submit" name="submit" value="Save"/>
                    <input type="reset" value="Reset"/>
                </div>
            </div>
    </form>
</div>
</body>
</html>
