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
    <div id="menu">
        <ul>
            <li><a href="index.php">Index</a></li>
            <li><a href="add.php">Add</a></li>
        </ul>
    </div>
    <form id="detail_form" method="post" action="">
        <input type="hidden" name="id" value="<?= $detail['id'] ?>"/>

        <div class="control">
            <label>Date</label>

            <div class="data">
                <input type="text" name="date" value="<?= $detail['date'] ?>">
            </div>
            <i>Please input date</i>
        </div>
        <div class="control">
            <label>Type</label>

            <div class="data">
                <select name="type">
                    <option value="spend" <?php if ($detail['type'] == 'spend') echo 'selected' ?>>Spend</option>
                    <option value="income" <?php if ($detail['type'] == 'income') echo 'selected' ?>>Income</option>
                </select>
            </div>
            <i>Please select type</i>
        </div>
        <div class="control">
            <label>Money</label>

            <div class="data">
                <input type="text" name="money" value="<?= $detail['money'] ?>>
            </div>
            <i>Please input money</i>
        </div>
        <div class=" control">
                <label>Note</label>

                <div class="data">
                    <textarea name="note"><?= $detail['note'] ?></textarea>
                </div>
                <i>Please input note</i>
            </div>
            <div class="control">
                <label>Operator</label>

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
