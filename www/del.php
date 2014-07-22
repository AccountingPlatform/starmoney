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
    $sql = "delete from `detail` where id = '{$id}'";
    $result = mysql_query($sql);
    if ($result) {
        echo "<script type='text/javascript'>alert('Success!')</script>";
    } else {
        echo "<script type='text/javascript'>alert('Fail!')</script>";
    }
    echo "<script type='text/javascript'>location.href='index.php'</script>";
}