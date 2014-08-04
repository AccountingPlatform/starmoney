<?php
/**
 * Created by PhpStorm.
 * User: zhangxing
 * Date: 14-8-3
 * Time: 下午9:40
 */

header("Content-Type:text/html;charset=utf-8");
require_once __DIR__ . "/lib/excel/reader.php";
require_once __DIR__ . "/env.php";
$sql = "TRUNCATE table `detail`";
$result = mysql_query($sql);
if ($result) {
    echo "清空表成功！";
} else {
    echo "清空表失败！";
}
$reader = new Spreadsheet_Excel_Reader();
$reader->setOutputEncoding('utf-8');
$reader->read("data.xls");
$sheets = $reader->sheets;
$sheetCount = count($sheets);
for ($i = 1; $i <= $sheetCount; $i++) {
    $nowSheet = $sheets[$i - 1];
    $numRows = $nowSheet['numRows'];
    $numCols = $nowSheet['numCols'];
    $cells = $nowSheet['cells'];
    for ($j = 5; $j <= $numRows; $j++) {
        if (!isset($cells[$j])) continue;
        $date = date("Y-m-d", strtotime($cells[$j][1]) - 86400);
        $type = $cells[$j][2];
        $money = $cells[$j][3];
        $money = substr($money, 1, strlen($money) - 1);
        $note = $cells[$j][4];
        $operator = $cells[$j][5];
        $sql = "insert into detail(`date`,`type`,`money`,`note`,`operator`) values('{$date}','{$type}','{$money}','{$note}','{$operator}')";
        $result = mysql_query($sql);
        if ($result) {
            echo "导入成功：";
        } else {
            echo "导入失败：" . mysql_error();
        }
        echo $sql . "<br/>";
    }
}