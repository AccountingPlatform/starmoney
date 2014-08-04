<?php
/**
 * Created by PhpStorm.
 * User: zhangxing
 * Date: 14-8-3
 * Time: 下午8:58
 */
header("Content-Type:text/html;charset=utf-8");
require_once __DIR__ . "/../lib/excel/reader.php";
require_once __DIR__ . "/../env.php";
$reader = new Spreadsheet_Excel_Reader();
$reader->setOutputEncoding('utf-8');
$reader->read("data.xls");
$sheets = $reader->sheets;
$sheetCount = count($sheets);
echo "共有工作表：" . $sheetCount . "个<br/>";
for ($i = 1; $i <= $sheetCount; $i++) {
    echo "<input type='button' value='sheet" . $i . "'/>";
}

$sheetIndex = isset($_GET['sheetIndex']) ? $_GET['sheetIndex'] : 1;
$nowSheet = $sheets[$sheetIndex - 1];
$numRows = $nowSheet['numRows'];
$numCols = $nowSheet['numCols'];
echo "<br/>" . $numRows . "行," . $numCols . "列<br/>";

$cells = $nowSheet['cells'];
echo "<table width='100%' border='1'>";
for ($i = 1; $i <= $numRows; $i++) {
    echo "<tr>";
    for ($j = 1; $j <= $numCols; $j++) {
        if (isset($cells[$i][$j])) {
            echo "<td>" . $cells[$i][$j] . "</td>";
        }
    }
    echo "</tr>";
}
echo "</table>";