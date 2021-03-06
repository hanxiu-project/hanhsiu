<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>待發公告管理 | 管理後台</title>

    <?php
include 'head.php';
?>

</head>

<body>
<?php
session_start();
include 'verification.php';
?>
<div id="wrapper">
    <?php include 'nav.php';?>
    <?php include '../database.php';?>

    <!--建立新公告-->
    <div class="row" style="margin-bottom: 20px; text-align: left">
        <div class="col-lg-12">
            <a href="AdminPostsPost.php" class="btn btn-success  ">建立新公告</a>

        </div>
    </div>

    <div class="col-lg-12">
            <h2><b>待發公告管理</b><h1>
        </div>


    <!--Body-->
    <div id="page-wrapper">

        <div class="container-fluid">

            <div class='wrapper'>
                <meta http-equiv="content-type" content="text/html;charset=UTF-8">

                <?php
/*資料庫連結*/

# 設定時區
date_default_timezone_set('Asia/Taipei');
$getDate = date("Y-m-d");

mysqli_query($db_link, 'SET CHARACTER SET UTF-8');

$sql = "SELECT * FROM posts where old='0' && keep='1' order by date DESC";
$result = mysqli_query($db_link, $sql);
$resultfortd = mysqli_query($db_link, $sql);
$rowfortd = $resultfortd->fetch_assoc();
echo "<form  name='form1' method='POST' action=''>";
echo "<table border=1 width=100% style=font-size:24px;line-height:50px; >";
echo "<tr align=center>";
echo "<td>公告標題</td>";
echo "<td>公告時間</td>";
echo "<td>下架日期</td>";
echo "<td>放置首頁天數</td>";
if ($rowfortd["p_id"] != null) {
    echo "<td></td>";
    echo "<td></td>";
}
echo "</tr>";

$sqlkeep = "SELECT * FROM posts where old='0' && keep='1' && save='0' order by date DESC";
$resultkeep = mysqli_query($db_link, $sqlkeep);

$date_nums = mysqli_num_rows($resultkeep); //講記數量
$per = 10; //10筆換頁
$pages = ceil($date_nums / $per); //共幾頁
if (!isset($_GET["page"])) {
    $page = 1;
} else {
    $page = intval($_GET["page"]); //確認頁數只能是數值資料
}

$start = ($page - 1) * $per;

$sqlresult = "SELECT * FROM posts where old='0' && keep='1' && save='0' order by date DESC Limit $start , $per";
$keepresult[$start] = mysqli_query($db_link, $sqlresult);
$keepresult[$page] = mysqli_query($db_link, $sqlresult);

while ($row = mysqli_fetch_assoc($keepresult[$start])) {
    $date1 = strtotime($row[date]);
    $date2 = strtotime($row[newday]);
    $days = (($date2 - $date1) / 86400);
    echo "<tr align=center>";
    echo "<td>$row[title]</td>";
    echo "<td>$row[date]</td>";
    echo "<td>$row[newday]</td>";
    echo "<td>$days</td>";
    echo "<td><input type='submit' class='btn btn-sm btn-primary' style='width:100px;height:30px;' name='$row[p_id]+1' value='編輯'></td>";
    echo "<td><input type='submit' class='btn btn-sm btn-danger ' style='width:100px;height:30px;' name='$row[p_id]+2' value='刪除'></td>";

    echo "</tr>";
}
echo "</form>";
echo "</table>";

echo "<center>";
echo '共 ' . $date_nums . ' 筆-在 ' . $page . ' 頁-共 ' . $pages . ' 頁';
echo "<br/><a href=?page=1>首頁</a> ";
echo "第 ";
for ($i = 1; $i <= $pages; $i++) {
    if ($page - 10 < $i && $i < $page + 10) {
        echo "<a href=?page=$i>" . $i . "</a> ";
    }
}
echo " 頁 <a href=?page=$pages>末頁</a>";
echo "</center>";

$sql2 = "SELECT * FROM posts";
$result2 = mysqli_query($db_link, $sql2);

while ($row2 = $result2->fetch_assoc()) {
    if (isset($_POST["$row2[p_id]+1"])) {
        $_SESSION["edit_p_id"] = $row2["p_id"];
        echo "<script langauge = 'javascript' type='text/javascript'>";
        echo "window.location.href = 'AdminPostsEdit.php'";
        echo "</script>";
    }

    if (isset($_POST["$row2[p_id]+2"])) {
        $_SESSION["delete_p_id"] = $row2["p_id"];
        $sql_delete = "DELETE FROM posts WHERE posts.p_id = $_SESSION[delete_p_id]";
        mysqli_query($db_link, $sql_delete);
        echo "<script>alert('成功刪除!');location.href='AdminPostsKeep.php'</script>";
    }
}

mysqli_close($db_link);
?>

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>
</body>

</html>
