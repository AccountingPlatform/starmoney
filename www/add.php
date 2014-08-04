<?php
/**
 * 记账
 * Created by PhpStorm.
 * User: zhangxing
 * Date: 14-7-22
 * Time: 下午10:01
 */
require_once(dirname(__FILE__) . "/env.php");

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $type = $_POST['type'];
    $money = $_POST['money'];
    $note = $_POST['note'];
    $operator = $_POST['operator'];

    $sql = "insert into `detail` (`date`,`type`,`money`,`note`,`operator`) values('{$date}','{$type}','{$money}','{$note}','{$operator}')";
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        <div class="control">
            <label>Date</label>

            <div class="data">
                <input type="text" name="date" value="<?= date("Y-m-d") ?>">
            </div>
            <i>Please input date</i>
        </div>
        <div class="control">
            <label>Type</label>

            <div class="data">
                <select name="type">
                    <option value="支出" selected>支出</option>
                    <option value="收入">收入</option>
                </select>
            </div>
            <i>Please select type</i>
        </div>
        <div class="control">
            <label>Money</label>

            <div class="data">
                <input type="text" name="money">
            </div>
            <i>Please input money</i>
        </div>
        <div class="control">
            <label>Note</label>

            <div class="data">
                <textarea name="note"></textarea>
            </div>
            <i>Please input note</i>
        </div>
        <div class="control">
            <label>Operator</label>

            <div class="data">
                <input type="text" name="operator" value="本人">
            </div>
            <i>Please input operator</i>
        </div>
        <div class="control">
            <div class="button">
                <input type="submit" name="submit" value="Add"/>
                <input type="reset" value="Reset"/>
            </div>
        </div>
    </form>
</div>
</body>
</html>
